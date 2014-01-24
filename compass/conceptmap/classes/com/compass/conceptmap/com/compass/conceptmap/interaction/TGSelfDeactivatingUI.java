package com.compass.conceptmap.interaction;


/**  TGSelfDeactivatingUI:  A UI that can deactivate itself once its
  *     task is performed.  For instance a dragUI can deactivate itself after
  *  the mouse is released.
  */
public abstract class TGSelfDeactivatingUI extends TGUserInterface {

    boolean selfDeactivate;

  // ............

    /** Default constructor.
      */
    public TGSelfDeactivatingUI() {
        selfDeactivate = true;
    }

    public void setSelfDeactivate( boolean sd ) {
        selfDeactivate = sd;
    }

} // end com.compass.conceptmap.interaction.TGSelfDeactivatingUI
