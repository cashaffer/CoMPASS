package com.compass.conceptmap.interaction;

import java.awt.event.MouseEvent;
import java.awt.event.MouseMotionAdapter;

import com.compass.conceptmap.TGPanel;

/** TGAbstractMouseMotionUI allows one to write user interfaces that handle
  * what happends when a mouse is moved over the screen
  */
public abstract class TGAbstractMouseMotionUI extends TGUserInterface{

    TGPanel tgPanel;

    private AMMUIMouseMotionListener mml;

  // ............

   /** Constructor with TGPanel <tt>tgp</tt>.
     */
    public TGAbstractMouseMotionUI( TGPanel tgp ) {
        tgPanel=tgp;
        mml=new AMMUIMouseMotionListener();
    }

     public final void activate() {
        tgPanel.addMouseMotionListener(mml);
     }

    public final void deactivate() {
        tgPanel.removeMouseMotionListener(mml);
        super.deactivate(); //To activate parentUI from TGUserInterface
    }

    public abstract void mouseMoved(MouseEvent e);

    public abstract void mouseDragged(MouseEvent e);

    private class AMMUIMouseMotionListener extends MouseMotionAdapter {
        public void mouseMoved(MouseEvent e) {
              TGAbstractMouseMotionUI.this.mouseMoved(e);
        }

        public void mouseDragged(MouseEvent e) {
              TGAbstractMouseMotionUI.this.mouseMoved(e);
        }
    }

} // end com.compass.conceptmap.interaction.TGAbstractMouseMotionUI
