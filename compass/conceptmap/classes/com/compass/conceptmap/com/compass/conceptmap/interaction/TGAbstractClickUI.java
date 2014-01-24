package com.compass.conceptmap.interaction;

import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

import com.compass.conceptmap.TGPanel;

/** TGAbstractClickUI allows one to write interfaces that deal with
  * mouse clicks.
  */
public abstract class TGAbstractClickUI extends TGSelfDeactivatingUI {

     private ACUIMouseListener ml;
     private TGPanel tgPanel;

     public TGAbstractClickUI() { // Instantiate this way if you want to finish after one click
         tgPanel=null;
         ml= null;
     }

     public TGAbstractClickUI(TGPanel tgp) { // Instantiate this way to keep listening for clicks until
                                             // deactivate is called
          tgPanel=tgp;
          ml = new ACUIMouseListener();
      }

     public final void activate() {
         if (tgPanel!=null && ml!=null) tgPanel.addMouseListener(ml);
     }

    public final void activate(MouseEvent e) {
        mouseClicked(e);
    }

    public final void deactivate() {
        if (tgPanel!=null && ml!=null) tgPanel.removeMouseListener(ml);
        super.deactivate(); //To activate parentUI from TGUserInterface
    }

    public abstract void mouseClicked(MouseEvent e);

    private class ACUIMouseListener extends MouseAdapter {
        public void mouseClicked(MouseEvent e) {
            TGAbstractClickUI.this.mouseClicked(e);
            if (selfDeactivate) deactivate();
        }
    }

} // end com.compass.conceptmap.interaction.TGAbstractClickUI
