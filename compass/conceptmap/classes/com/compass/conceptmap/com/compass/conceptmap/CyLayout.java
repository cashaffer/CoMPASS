package com.compass.conceptmap;

import java.awt.Point;
import java.util.Vector;

import com.compass.conceptmap.graphelements.TGForEachEdge;
import com.compass.conceptmap.graphelements.TGForEachNode;
import com.compass.conceptmap.graphelements.TGForEachNodePair;

public class CyLayout implements Runnable {

    //private ImmutableGraphEltSet graphEltSet;
    private TGPanel tgPanel;
    private Thread relaxer;
    private double damper=0.0;      // A low damper value causes the graph to move slowly
    private double maxMotion=0;     // Keep an eye on the fastest moving node to see if the graph is stabilizing
    private double lastMaxMotion=0;
    private double motionRatio = 0; // It's sort of a ratio, equal to lastMaxMotion/maxMotion-1
    private boolean damping = true; // When damping is true, the damper value decreases

    private double rigidity = 1;    // Rigidity has the same effect as the damper, except that it's a constant
                                    // a low rigidity value causes things to go slowly.
                                    // a value that's too high will cause oscillation
    private double newRigidity = 1;
    private Point center;
    private double radius, defaultRadius = 80;
    private double alfa,belta,delta,deltax,deltay;
    private Vector sameDepthNodes,visableEdges;
    private int depth;
    private int A_OFFSET = 10;
    private double R_OFFSET = 110;
    private double R1_OFFSET = 80;


    Node dragNode=null;

  // ............

  /** Constructor with a supplied TGPanel
    */
    public CyLayout( TGPanel tgp ) {
        tgPanel = tgp;
      //graphEltSet = tgPanel.getGES();
        relaxer = null;
        center = new Point(tgPanel.getWidth(),tgPanel.getHeight());
    }

    void setRigidity(double r) {
        newRigidity = r;  //update rigidity at the end of the relax() thread
    }

    void setDragNode(Node n) {
        dragNode = n;
    }

    void findSameDepthNodes(int d){
      sameDepthNodes = new Vector();
      depth = d;
      TGForEachNode fen = new TGForEachNode() {
          public void forEachNode(Node node) {
            if(depth == node.depth )
              sameDepthNodes.add(node);
          }
      };
      tgPanel.getGES().forAllNodes(fen);
    }

    //relaxEdges is more like tense edges up.  All edges pull nodes closes together;



    private synchronized void relaxEdges() {
      TGForEachNode fen = new TGForEachNode() {
        public void forEachNode(Node n) {

          if (n.depth == 0) {
            n.dx = (center.x - n.x)/200;
            n.dy = (center.y - n.y)/200 ;
          }
          else {
            double vx = n.targetx - n.x;
            double vy = n.targety - n.y;
            n.dx = vx/200 ;
            n.dy = vy/200 ;
          }
        }
      };

      tgPanel.getGES().forAllNodes(fen);
    }


    /** Calculate designate position for each node.
      */
    public void calPos()
    {

         //number of nodes

         Node select = tgPanel.getSelect();
         Node from, to;
         Edge edge;
         if (select != null) {
           select.targetx=center.x;
           select.targety=center.y;
         }
         visableEdges = new Vector();
         // the left-up-most position of the center
         TGForEachEdge fee = new TGForEachEdge() {
             public void forEachEdge(Edge e) {
               if(!e.from.markedForRemoval && !e.to.markedForRemoval)
                 visableEdges.add(e);
             }

         };
         tgPanel.getGES().forAllEdges(fee);
         Node[][] m_fromto = new Node[visableEdges.size()][2];
         int m_conceptNumber=0;
         for(int i=0;i<visableEdges.size();i++){
           if(((Edge) visableEdges.elementAt(i)).from.depth<=((Edge) visableEdges.elementAt(i)).to.depth){
             m_fromto[i][0] = ( (Edge) visableEdges.elementAt(i)).from;
             m_fromto[i][1] = ( (Edge) visableEdges.elementAt(i)).to;
           }
           else{
             m_fromto[i][0] = ( (Edge) visableEdges.elementAt(i)).to;
             m_fromto[i][1] = ( (Edge) visableEdges.elementAt(i)).from;
           }
           if(m_fromto[i][0].depth == 0)
             m_conceptNumber++;
         }

         //order m_fromto
         for(int i=0;i<m_fromto.length-1;i++){
           for(int j=i+1;j<m_fromto.length;j++){
             if(m_fromto[i][0].depth>m_fromto[j][0].depth){
               from=m_fromto[j][0];
               m_fromto[j][0]=m_fromto[i][0];
               m_fromto[i][0]=from;
               to=m_fromto[j][1];
               m_fromto[j][1]=m_fromto[i][1];
               m_fromto[i][1]=to;
             }
             else if(m_fromto[i][0].depth == m_fromto[j][0].depth){
               if(m_fromto[i][0].getID().compareTo(m_fromto[j][0].getID()) < 0){
                  from=m_fromto[j][0];
                  m_fromto[j][0]=m_fromto[i][0];
                  m_fromto[i][0]=from;
                  to=m_fromto[j][1];
                  m_fromto[j][1]=m_fromto[i][1];
                  m_fromto[i][1]=to;
               }
               else if(m_fromto[i][0].getID().compareTo(m_fromto[j][0].getID()) ==0){
                 if(m_fromto[i][1].depth > m_fromto[j][1].depth){
                   to=m_fromto[j][1];
                   m_fromto[j][1]=m_fromto[i][1];
                   m_fromto[i][1]=to;
                 }
                 else if(m_fromto[i][1].depth == m_fromto[j][1].depth){
                   if(m_fromto[i][1].getID().compareTo(m_fromto[j][1].getID()) < 0){
                     to=m_fromto[j][1];
                     m_fromto[j][1]=m_fromto[i][1];
                     m_fromto[i][1]=to;
                   }
                 }
               }
             }
           }
         }

     /**
      * reorganize level 1 node
      */
     int t = 0;
     while (t < m_conceptNumber)
   // for (int i = 2; i <= m_conceptNumber; i++)
     {
      // t = t + 1;
      int j = m_conceptNumber;
      boolean found = false;
      while ( (j < m_fromto.length) && (found == false)) {
        int ii;
        // find the one that is related to this concept and put them adjacent
        if ( (m_fromto[j][0] == m_fromto[t][1]) && (m_fromto[j][1].depth == 1)) {
          for (ii=0; ii < m_conceptNumber; ii++) {
            if (m_fromto[ii][1] == m_fromto[j][1])
              break;
          }
          if (ii > t) {
            t = t + 1;
            to = m_fromto[t][1];
            m_fromto[t][1] = m_fromto[ii][1];
            m_fromto[ii][1] = to;
            found = true;
            break;
          }
        }

        if ( (m_fromto[j][1] == m_fromto[t][1]) && (m_fromto[j][0].depth == 1)) {
          for (ii=0; ii < m_conceptNumber; ii++) {
            if (m_fromto[ii][1] == m_fromto[j][0])
              break;
          }
          if (ii > t) {
            t = t + 1;
            to = m_fromto[t][1];
            m_fromto[t][1] = m_fromto[ii][1];
            m_fromto[ii][1] = to;
            found = true;
            break;
          }
        }

        if ( (m_fromto[j][0] == m_fromto[t][1]) && (m_fromto[j][1].depth > 1)) {
          for (int k = m_conceptNumber; k < m_fromto.length; k++) {
            if (m_fromto[k][1] == m_fromto[j][1] && k != j) {
              for (ii=0; ii < m_conceptNumber; ii++) {
                if (m_fromto[ii][1] == m_fromto[k][0])
                  break;
              }
              if (ii > t) {
                t = t + 1;
                to = m_fromto[t][1];
                m_fromto[t][1] = m_fromto[ii][1];
                m_fromto[ii][1] = to;
                found = true;
                break;
              }
            }
          }
        }

        j = j + 1;
      } // continue j = j + 1

      if (!found)
            t = t + 1;
           //}
     }// continue t = t + 1

         /**
          * calculate the node positions for level 1 node
          *
          */
         double startAngle = Math.toRadians(A_OFFSET);
         double ad = 2.0 * Math.PI/m_conceptNumber;
         if (m_conceptNumber < 6)
           ad = 2.0 * Math.PI/m_conceptNumber;

         if (m_conceptNumber <= 3)
         {
         // qi 80 to 120
           startAngle = Math.toRadians(120);
           ad = 2.0 * Math.PI/3.0;
         }

         Point[] nodepos = new Point[m_conceptNumber + 1];
         for (int i = 0; i < m_conceptNumber; i++)
         {
             Point p1 = new Point();
             p1 = getCNodeLocation(this.getRadius(1),startAngle);
             // center position
             m_fromto[i][1].targetx = p1.x + center.x;
             m_fromto[i][1].targety = center.y - p1.y;
             startAngle = startAngle + ad;
         }


       // add other nodes
       Vector[] level_1_nodes = new Vector[m_conceptNumber];
       for(int i=0;i<m_conceptNumber;i++){
         Node level_1_node = m_fromto[i][1];
         level_1_nodes[i]=new Vector();
         Node clockwise_node = smallNode(m_fromto, i, m_conceptNumber);
         Node anticlockwise_node = largeNode(m_fromto, i, m_conceptNumber);
         for(int j=m_conceptNumber;j<m_fromto.length;j++){
           if(m_fromto[j][0]==level_1_node && m_fromto[j][1].depth==2){
             if(m_conceptNumber==1)
               level_1_nodes[i].add(m_fromto[j][1]);
             else if(m_conceptNumber==2){
               if(isRelated(clockwise_node, m_fromto[j][1],m_fromto,m_conceptNumber)&&i==0)
                 level_1_nodes[i].add(m_fromto[j][1]);
               else if(!isRelated(clockwise_node, m_fromto[j][1],m_fromto,m_conceptNumber))
                 level_1_nodes[i].add(m_fromto[j][1]);
               else
                 ;
             }
             else if(!isRelated(clockwise_node, m_fromto[j][1],m_fromto,m_conceptNumber))
               level_1_nodes[i].add(m_fromto[j][1]);
             else
               ;
           }
         }
         for(int k=0;k<level_1_nodes[i].size();k++){
           Node level_2_node = (Node) level_1_nodes[i].get(k);
           if(isRelated(anticlockwise_node, level_2_node,m_fromto,m_conceptNumber)){
             level_1_nodes[i].add(level_2_node);
             level_1_nodes[i].remove(k);
           }
         }
       }
       for(int i=0;i<level_1_nodes.length;i++){
         double leftAngle,rightAngle;
         double baseangle=nodeRadianAngle(m_fromto[i][1]);
         if(level_1_nodes.length<3){
           leftAngle=baseangle+Math.acos(R_OFFSET/(R_OFFSET+R1_OFFSET));
           rightAngle=baseangle-Math.acos(R_OFFSET/(R_OFFSET+R1_OFFSET));
         }
         else{
           leftAngle=baseangle+ad/2.0;
           rightAngle=baseangle-ad/2.0;
        }

         for(int j=level_1_nodes[i].size()-1;j>=0;j--){
           double alfa = leftAngle-(leftAngle-rightAngle)*(level_1_nodes[i].size()-j)/(level_1_nodes[i].size()+2)*1.0;
           Point p1 = new Point();
           // p1 = getCNodeLocation(getRadius(2),nodeRadianAngle(nv) + wt);
           p1 = getCNodeLocation(R_OFFSET + R1_OFFSET,alfa);
           // change to screen coordinates
           p1.x = p1.x + center.x;
           p1.y = center.y - p1.y;
           to=((Node) level_1_nodes[i].get(j));
           to.targetx=p1.x;
           to.targety=p1.y;
         }
       }
     }

     private double nodeRadianAngle(Node tt)
     {
       double rs;
       double x,y;
       x = tt.targetx - center.x;
       y = center.y- tt.targety;
       rs = Math.atan((double)(y/x));
       if (x < 0)
         rs =  Math.atan((double)(y/x)) + Math.PI;
       return rs;
     }

     private Point getCNodeLocation(double rad,double dista)
     {
         int xc,yc;
         xc = (int)(Math.cos(dista) * rad);
         yc = (int)(Math.sin(dista) * rad);
         return new Point(xc,yc);
     }

     private int nodeIndex(Node[][] fromto,Node t, int m_conceptNumber)
     {
        int index=0;
        for (int i = 0; i< m_conceptNumber; i++)
        {
          if (fromto[i][1] == t) {
            index = i;
            break;
          }
        }
         return index;
     }

     private Node largeNode(Node[][] fromto,int index, int m_conceptNumber)
     {
        Node rs = null;
        if(index < m_conceptNumber-1)
          rs = fromto[index+1][1];
        else
          rs = fromto[0][1];
         return rs;
     }

     private Node smallNode(Node[][] fromto,int index, int m_conceptNumber)
     {
        Node rs = null;
        if(index == 0)
          rs = fromto[m_conceptNumber-1][1];
        else
          rs = fromto[index-1][1];
         return rs;
     }



     private boolean isRelated(Node from,Node to,Node[][] fromto, int m_conceptNumber)
     {
       boolean rs = false;
       if(from ==null || to == null)
         return false;
       for (int i = m_conceptNumber ; i <fromto.length; i++)
       {
         if (fromto[i][0] == from && fromto[i][1] == to)
         {
           rs = true;
           break;
         }
       }
       return rs;
     }

     private double getRadius(int i)
     {
         double r = 0.0;

         for (int j = 1;j <= i;j++)
         {
           r = r + R_OFFSET * (double)(1.0/j);
         }
         return r;
     }

/*
    private synchronized void avoidLabels() {
        for (int i = 0 ; i < graphEltSet.nodeNum() ; i++) {
            Node n1 = graphEltSet.nodeAt(i);
            double dx = 0;
            double dy = 0;

            for (int j = 0 ; j < graphEltSet.nodeNum() ; j++) {
                if (i == j) {
                    continue; // It's kind of dumb to do things this way. j should go from i+1 to nodeNum.
                }
                Node n2 = graphEltSet.nodeAt(j);
                double vx = n1.x - n2.x;
                double vy = n1.y - n2.y;
                double len = vx * vx + vy * vy; // so it's length squared
                if (len == 0) {
                    dx += Math.random(); // If two nodes are right on top of each other, randomly separate
                    dy += Math.random();
                } else if (len <600*600) { //600, because we don't want deleted nodes to fly too far away
                    dx += vx / len;  // If it was sqrt(len) then a single node surrounded by many others will
                    dy += vy / len;  // always look like a circle.  This might look good at first, but I think
                                     // it makes large graphs look ugly + it contributes to oscillation.  A
                                     // linear function does not fall off fast enough, so you get rough edges
                                     // in the 'force field'

                }
            }
            n1.dx += dx*100*rigidity;  // rigidity makes nodes avoid each other more.
            n1.dy += dy*100*rigidity;  // I was surprised to see that this exactly balances multiplying edge tensions
                                       // by the rigidity, and thus has the effect of slowing the graph down, while
                                       // keeping it looking identical.

        }
    }
*/

    private synchronized void avoidLabels() {
        TGForEachNodePair fenp = new TGForEachNodePair() {
            public void forEachNodePair(Node n1, Node n2) {
                double dx=0;
                double dy=0;
                double vx = n1.x - n2.x;
                double vy = n1.y - n2.y;
                double len = vx * vx + vy * vy; //so it's length squared
                if (len == 0) {
                    dx = Math.random(); //If two nodes are right on top of each other, randomly separate
                    dy = Math.random();
                } else if (len <600*600) { //600, because we don't want deleted nodes to fly too far away
                    dx = vx / len;  // If it was sqrt(len) then a single node surrounded by many others will
                    dy = vy / len;  // always look like a circle.  This might look good at first, but I think
                                    // it makes large graphs look ugly + it contributes to oscillation.  A
                                    // linear function does not fall off fast enough, so you get rough edges
                                    // in the 'force field'
                }

                int repSum = n1.repulsion * n2.repulsion/100;

                if(n1.justMadeLocal || !n2.justMadeLocal) {
                    n1.dx += dx*repSum*rigidity;
                    n1.dy += dy*repSum*rigidity;
                }
                else {
                    n1.dx += dx*repSum*rigidity/10;
                    n1.dy += dy*repSum*rigidity/10;
                }
                if (n2.justMadeLocal || !n1.justMadeLocal) {
                    n2.dx -= dx*repSum*rigidity;
                    n2.dy -= dy*repSum*rigidity;
                }
                else {
                    n2.dx -= dx*repSum*rigidity/10;
                    n2.dy -= dy*repSum*rigidity/10;
                }
            }
        };

        tgPanel.getGES().forAllNodePairs(fenp);
    }

    public void startDamper() {
        damping = true;
    }

    public void stopDamper() {
        damping = false;
        damper = 1.0;     //A value of 1.0 means no damping
    }

    public void resetDamper() {  //reset the damper, but don't keep damping.
        damping = true;
        damper = 1.0;
    }

    public void stopMotion() {  // stabilize the graph, but do so gently by setting the damper to a low value
        damping = true;
        if (damper>0.3)
            damper = 0.3;
        else
            damper = 0;
    }

    public void damp() {
        if (damping) {
            if(motionRatio<=0.001) {  //This is important.  Only damp when the graph starts to move faster
                                      //When there is noise, you damp roughly half the time. (Which is a lot)
                                      //
                                      //If things are slowing down, then you can let them do so on their own,
                                      //without damping.

                //If max motion<0.2, damp away
                //If by the time the damper has ticked down to 0.9, maxMotion is still>1, damp away
                //We never want the damper to be negative though
                if ((maxMotion<0.2 || (maxMotion>1 && damper<0.9)) && damper > 0.01) damper -= 0.01;
                //If we've slowed down significanly, damp more aggresively (then the line two below)
                else if (maxMotion<0.4 && damper > 0.003) damper -= 0.003;
                //If max motion is pretty high, and we just started damping, then only damp slightly
                else if(damper>0.0001) damper -=0.0001;
            }
        }
        if(maxMotion<0.001 && damping) {
            damper=0;
        }
    }


    private synchronized void moveNodes() {
        lastMaxMotion = maxMotion;
        final double[] maxMotionA = new double[1];
        maxMotionA[0]=0;

        TGForEachNode fen = new TGForEachNode() {
            public void forEachNode(Node n) {
                double dx = n.dx;
                double dy = n.dy;
                dx*=damper;  //The damper slows things down.  It cuts down jiggling at the last moment, and optimizes
                dy*=damper;  //layout.  As an experiment, get rid of the damper in these lines, and make a
                             //long straight line of nodes.  It wiggles too much and doesn't straighten out.

                n.dx=dx/2;   //Slow down, but don't stop.  Nodes in motion store momentum.  This helps when the force
                  n.dy=dy/2;   //on a node is very low, but you still want to get optimal layout.

                double distMoved = Math.sqrt(dx*dx+dy*dy); //how far did the node actually move?

                 if (!n.fixed && !(n==dragNode) ) {
                      n.x += Math.max(-20, Math.min(20, dx)); //don't move faster then 30 units at a time.
                    n.y += Math.max(-20, Math.min(20, dy)); //I forget when this is important.  Stopping severed nodes from
                                                        //flying away?
                 }
                 maxMotionA[0]=Math.max(distMoved,maxMotionA[0]);
            }
        };

        tgPanel.getGES().forAllNodes(fen);

        maxMotion=maxMotionA[0];
         if (maxMotion>0) motionRatio = lastMaxMotion/maxMotion-1; //subtract 1 to make a positive value mean that
         else motionRatio = 0;                                     //things are moving faster

        damp();

    }

    private synchronized void relax() {
      for (int i=0;i<15;i++) {
        relaxEdges();
//        avoidLabels();
        moveNodes();
      }
        if(rigidity!=newRigidity) rigidity= newRigidity; //update rigidity
        tgPanel.repaintAfterMove();
    }

    private void myWait() { //I think it was Netscape that caused me not to use Wait, or was it java 1.1?
        try {
                Thread.sleep(100);
        } catch (InterruptedException e) {
                //break;
        }
    }

    public void run() {
        Thread me = Thread.currentThread();
        while (relaxer == me) {
            relax();
            try {
                relaxer.sleep(20);  //Delay to wait for the prior repaint command to finish.
                while(damper<0.1 && damping && maxMotion<0.001) myWait();
            } catch (InterruptedException e) {
                break;
            }
        }
    }

    public void start() {
        relaxer = new Thread(this);
        relaxer.start();
    }

    public void stop() {
        relaxer = null;
    }

} // end com.compass.conceptmap.TGLayout
