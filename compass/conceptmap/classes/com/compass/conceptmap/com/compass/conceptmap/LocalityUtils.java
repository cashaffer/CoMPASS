
package com.compass.conceptmap;

import java.util.Collection;
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.Iterator;
import java.util.Vector;

import com.compass.conceptmap.graphelements.GESUtils;
import com.compass.conceptmap.graphelements.Locality;
import com.compass.conceptmap.graphelements.TGForEachNode;

/**
 *
 * <p>Title: </p>
 * <p>Description: Do animation</p>
 * <p>Copyright: Copyright (c) 2006</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */
public class LocalityUtils {

    TGPanel tgPanel;
    Locality locality;

    public static final int INFINITE_LOCALITY_RADIUS = Integer.MAX_VALUE;

    ShiftLocaleThread shiftLocaleThread;
    boolean fastFinishShift=false;  // If finish fast is true, quickly wrap up animation

    public LocalityUtils(Locality loc, TGPanel tgp) {
        locality = loc;
        tgPanel = tgp;
    }

    public void fastFinishAnimation() {
        fastFinishShift = true;
    }

    /** Mark for deletion nodes not contained within distHash. */
    private synchronized boolean markDistantNodes(final Collection subgraph) {
        final boolean[] someNodeWasMarked = new boolean[1];
        someNodeWasMarked[0] = false;
        Boolean x;
        TGForEachNode fen = new TGForEachNode() {
            public void forEachNode(Node n) {
                if(!subgraph.contains(n)) {
                    n.markedForRemoval=true;
                    someNodeWasMarked[0] = true;
                }
            }
        };

        locality.forAllNodes(fen);
        return someNodeWasMarked[0];
    }

    /** remove distant nodes marked with markedForRemoval from the visible locality*/
    private synchronized void removeMarkedNodes() {
        final Vector nodesToRemove = new Vector();

        TGForEachNode fen = new TGForEachNode() {
            public void forEachNode(Node n) {
                if(n.markedForRemoval)  {
                    nodesToRemove.addElement(n);
                    n.markedForRemoval=false;
                }
            }
        };
        synchronized(locality) {
            locality.forAllNodes(fen);
            locality.removeNodes(nodesToRemove);
        }
    }

    /** Add to locale nodes within radius distance of a focal node. */
    private synchronized void addNearNodes(Hashtable distHash, int radius) throws TGException {
        for ( int r=0; r<radius+1; r++ ) {
            Enumeration localNodes = distHash.keys();
            while (localNodes.hasMoreElements()) {
                Node n = (Node)localNodes.nextElement();
                if(!locality.contains(n) && ((Integer)distHash.get(n)).intValue()<=r) {
                    n.justMadeLocal = true;
                    locality.addNodeWithEdges(n);
                }
            }
        }
    }

    /** This function is to update visible edges: remove all edges with 3rd level node-----3rd level node */
    private synchronized void removeThirdLevelEdge(Hashtable distHash) throws TGException {
            Enumeration localNodes = distHash.keys();
            while (localNodes.hasMoreElements()) {
                Node n = (Node)localNodes.nextElement();
                if(n.depth ==2){
                  Iterator i=n.getEdges();
                  while(i.hasNext()){
                    Edge e=(Edge) i.next();
                    if(e.getOtherEndpt(n).depth == 2)
                      locality.removeEdge(e);
                  }
                }
                else{
                  Iterator i=n.getEdges();
                  while(i.hasNext()){
                    Edge e=(Edge) i.next();
                    if(!locality.contains(e))
                      locality.addEdge(e);
                  }
                }
            }
    }

    /** This function is to remove the mark "justMadeLocal" of the new added nodes*/
    private synchronized void unmarkNewAdditions() {
        TGForEachNode fen = new TGForEachNode() {
            public void forEachNode(Node n) {
                n.justMadeLocal=false;
            }
        };
        locality.forAllNodes(fen);
    }

    /** There are 4 steps animation. After the animition finishes, reset the animition levels to 1 */
    private void resetNodeAnimation(){
      TGForEachNode fen = new TGForEachNode() {
        public void forEachNode(Node n) {
            n.animationColorLevel=1;
          }
      };
      synchronized (locality) {
        locality.forAllNodes(fen);
      }
    }

    private void markNodeAnimation(){
      TGForEachNode fen = new TGForEachNode() {
        public void forEachNode(Node n) {
            if(n.markedForRemoval||n.justMadeLocal)
              n.animationColorLevel++;
          }
      };
      synchronized (locality) {
        locality.forAllNodes(fen);
      }
    }


    /** The thread that gets instantiated for doing the locality shift animation. */
    class ShiftLocaleThread extends Thread {
        Hashtable distHash;
        Node focusNode;
        int radius;
        int maxAddEdgeCount;
        int maxExpandEdgeCount;
        boolean unidirectional;

        ShiftLocaleThread(Node n, int r, int maec, int meec, boolean unid) {
            focusNode = n;
            radius = r;
            maxAddEdgeCount = maec;
            maxExpandEdgeCount = meec;
            unidirectional = unid;
            start();

        }

        public void run() {
            synchronized (LocalityUtils.this) {
            //Make sure node hasn't been deleted
                if (!locality.getCompleteEltSet().contains(focusNode)) return;
                tgPanel.stopDamper();
                distHash = GESUtils.calculateDistances(
                             locality.getCompleteEltSet(),focusNode,radius,maxAddEdgeCount,maxExpandEdgeCount,unidirectional);
                try {
                  resetNodeAnimation();
                  markDistantNodes(distHash.keySet());
                  addNearNodes(distHash,radius);
                  removeThirdLevelEdge(distHash);
                  tgPanel.tgLayout.calPos();
                  for (int i=0;i<4&&!fastFinishShift;i++) {
                       Thread.currentThread().sleep(200);
                       markNodeAnimation();
                  }
                  resetNodeAnimation();
                  unmarkNewAdditions();
                  resetNodeAnimation();
                  removeMarkedNodes();
                  for (int i=0;i<4&&!fastFinishShift;i++) {
                      Thread.currentThread().sleep(150);
                  }
                } catch ( TGException tge ) {
                    System.err.println("TGException: " + tge.getMessage());
                } catch (InterruptedException ex) {}
                tgPanel.resetDamper();
            }
        }
    }

    public void setLocale(Node n, final int radius, final int maxAddEdgeCount, final int maxExpandEdgeCount,
                          final boolean unidirectional) throws TGException {
        if (n==null || radius<0) return;
        if(shiftLocaleThread!=null && shiftLocaleThread.isAlive()) {
            fastFinishShift=true; //This should cause last locale shift to finish quickly
            while(shiftLocaleThread.isAlive())
                try { Thread.currentThread().sleep(100); }
                catch (InterruptedException ex) {}
        }
        if (radius == INFINITE_LOCALITY_RADIUS || n==null) {
            addAllGraphElts();
            tgPanel.resetDamper();
            return;
        }

        fastFinishShift=false;
        shiftLocaleThread=new ShiftLocaleThread(n, radius, maxAddEdgeCount, maxExpandEdgeCount, unidirectional);
    }

    public void setLocale(Node n, final int radius) throws TGException {
        setLocale(n,radius,1000,1000, false);
    }

    public synchronized void addAllGraphElts() throws TGException {
        locality.addAll();
    }

   /** Add to locale nodes that are one edge away from a given node.
     * This method does not utilize "fastFinishShift" so it's likely that
     * synchronization errors will occur.
     */
    public void expandNode(final Node n) {
        new Thread() {
            public void run() {
                synchronized (LocalityUtils.this) {
                    if (!locality.getCompleteEltSet().contains(n)) return;
                    tgPanel.stopDamper();
                    for(int i=0;i<n.edgeCount();i++) {
                        Node newNode = n.edgeAt(i).getOtherEndpt(n);
                        if (!locality.contains(newNode)) {
                            newNode.justMadeLocal = true;
                            try {
                                locality.addNodeWithEdges(newNode);
                                Thread.currentThread().sleep(50);
                            } catch ( TGException tge ) {
                                System.err.println("TGException: " + tge.getMessage());
                            } catch ( InterruptedException ex ) {}
                        }
                        else if (!locality.contains(n.edgeAt(i))) {
                            locality.addEdge(n.edgeAt(i));
                        }
                    }
                    try { Thread.currentThread().sleep(200); }
                    catch (InterruptedException ex) {}
                    unmarkNewAdditions();
                    tgPanel.resetDamper();
                }
            }
        }.start();
    }

   /** Hides a node, and all the nodes attached to it. */
    public synchronized void hideNode( final Node hideNode ) {
        if (hideNode==null) return;
        new Thread() {
            public void run() {
                synchronized(LocalityUtils.this) {
                    if (!locality.getCompleteEltSet().contains(hideNode)) return;

                    locality.removeNode(hideNode); //Necessary so that node is ignored in distances calculation.
                    if (hideNode==tgPanel.getSelect()) {
                        tgPanel.clearSelect();
                    }


                    Collection subgraph = GESUtils.getLargestConnectedSubgraph(locality);
                    markDistantNodes(subgraph);
                    tgPanel.repaint();
                    try { Thread.currentThread().sleep(200); }
                    catch (InterruptedException ex) {}
                    removeMarkedNodes();

                    tgPanel.resetDamper();
                }
            }
        }.start();
    }

   /** Opposite of expand node, works like hide node except that the selected node is not hidden.*/
    public synchronized void collapseNode( final Node collapseNode ) {
        if (collapseNode==null) return;
        new Thread() {
            public void run() {
                synchronized(LocalityUtils.this) {
                    if (!locality.getCompleteEltSet().contains(collapseNode)) return;

                    locality.removeNode(collapseNode); //Necessary so that node is ignored in distances calculation.
                    Collection subgraph = GESUtils.getLargestConnectedSubgraph(locality);
                    markDistantNodes(subgraph);
                    try {
                        locality.addNodeWithEdges(collapseNode); // Add the collapsed node back in.
                    }
                    catch (TGException tge) { tge.printStackTrace(); }
                    tgPanel.repaint();
                    try { Thread.currentThread().sleep(200); }
                    catch (InterruptedException ex) {}
                    removeMarkedNodes();

                    tgPanel.resetDamper();
                }
            }
        }.start();
    }
} // end com.compass.conceptmap.LocalityUtils
