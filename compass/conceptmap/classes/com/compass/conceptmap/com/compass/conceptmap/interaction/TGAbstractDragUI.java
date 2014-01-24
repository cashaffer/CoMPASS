package com.compass.conceptmap.interaction;

import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;

import com.compass.conceptmap.TGPanel;

/** TGAbstractDragUI allows one to write user interfaces that handle
  * what happends when a mouse is pressed, dragged, and released.
  *
  * @author   Alexander Shapiro
  * @version  1.21  $Id: TGAbstractDragUI.java,v 1.11 2002/04/01 05:52:38 x_ander Exp $
  */
public abstract class TGAbstractDragUI extends TGSelfDeactivatingUI {

    public TGPanel tgPanel;

    private ADUIMouseListener ml;
    private ADUIMouseMotionListener mml;
    public boolean mouseWasDragged; //To differentiate between mouse pressed+dragged, and mouseClicked

  // ............

   /** Constructor with TGPanel <tt>tgp</tt>.
     */
    public TGAbstractDragUI(TGPanel tgp) {
        tgPanel=tgp;
        ml =new ADUIMouseListener();
        mml=new ADUIMouseMotionListener();
    }

     public final void activate() {
        preActivate();
        tgPanel.addMouseListener(ml);
        tgPanel.addMouseMotionListener(mml);
        mouseWasDragged=false;
     }

    public final void activate(MouseEvent e) {
        activate();
        mousePressed(e);
    }

    public final void deactivate() {
        preDeactivate();
        tgPanel.removeMouseListener(ml);
        tgPanel.removeMouseMotionListener(mml);
        super.deactivate(); //To activate parentUI from TGUserInterface
    }

    public abstract void preActivate();
    public abstract void preDeactivate();

    public abstract void mousePressed( MouseEvent e );
    public abstract void mouseDragged( MouseEvent e );
    public abstract void mouseReleased( MouseEvent e );


    private class ADUIMouseListener extends MouseAdapter {
        public void mousePressed(MouseEvent e) {
            TGAbstractDragUI.this.mousePressed(e);
        }

        public void mouseReleased(MouseEvent e) {
            TGAbstractDragUI.this.mouseReleased(e);
            if (selfDeactivate) deactivate();
        }
    }

    private class ADUIMouseMotionListener extends MouseMotionAdapter {
        public void mouseDragged(MouseEvent e) {
            mouseWasDragged=true;
              TGAbstractDragUI.this.mouseDragged(e);
        }
    }

} // end com.compass.conceptmap.interaction.TGAbstractDragUI
