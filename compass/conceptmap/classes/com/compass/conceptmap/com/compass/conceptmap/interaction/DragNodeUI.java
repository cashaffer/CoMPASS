package com.compass.conceptmap.interaction;

import java.awt.Point;
import java.awt.event.MouseEvent;

import com.compass.conceptmap.Node;
import com.compass.conceptmap.TGPanel;

/** DragNodeUI contains code for dragging nodes.
  *
  * <p><b>
  * Parts of this code build upon Sun's Graph Layout example.
  * http://java.sun.com/applets/jdk/1.1/demo/GraphLayout/Graph.java
  * </b></p>
  *
  */
public class DragNodeUI extends TGAbstractDragUI{

   /** Stores the distance between the cursor and the center of the node
     * when dragging occurs so that the cursor remains at the same position
     * on the node otherwise, the cursor jumps to the center of the node.
     */
    public Point dragOffs;

  // ............

    /** Constructor with TGPanel <tt>tgp</tt>.
      */
    public DragNodeUI( TGPanel tgp ) {
        super(tgp);
    }

    public void preActivate() {
        if (dragOffs ==null) dragOffs=new Point(0,0);
    }

    public void preDeactivate() {};

    public void mousePressed( MouseEvent e ) {
        Node mouseOverN = tgPanel.getMouseOverN();
        Point mousePos;

        if (e!=null) mousePos = e.getPoint(); //e can be null if the wrong activate() method was used
        else mousePos= new Point((int) mouseOverN.drawx,(int) mouseOverN.drawy);

        if ( mouseOverN != null) { //Should never be null if TGUIManager works properly
            tgPanel.setDragNode(mouseOverN);

            dragOffs.setLocation((int) (mouseOverN.drawx-mousePos.x), //For when you click to the side of
                    (int)(mouseOverN.drawy-mousePos.y));//the node, but you still want to drag it
        }
    }

    public void mouseReleased( MouseEvent e ) {
        tgPanel.setDragNode(null);
        tgPanel.repaintAfterMove();
        tgPanel.startDamper();
    }


    public void mouseDragged( MouseEvent e ) {
        Node dragNode = tgPanel.getDragNode();
        dragNode.drawx = e.getX()+dragOffs.x;
        dragNode.drawy = e.getY()+dragOffs.y;
        tgPanel.updatePosFromDraw(dragNode);
        tgPanel.repaintAfterMove();
        tgPanel.stopDamper(); //Keep the graph alive while dragging.
    }

} // end com.compass.conceptmap.interaction.DragNodeUI
