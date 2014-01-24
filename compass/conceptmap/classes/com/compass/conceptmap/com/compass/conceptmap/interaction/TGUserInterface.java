package com.compass.conceptmap.interaction;


/** TGUserInterface.  A user interface that can be activated or deactivated,
  * much like a listener can be added or removed.
  *
  * If a parent UI is specified as a parameter to activate() then the parent UI
  * is temporarily disabled while the current UI is active.  Classes that extend
  * TGUserInterface must call super.deactivate() if they override this method.
  */
public abstract class TGUserInterface {

    private TGUserInterface parentUI;

    public abstract void activate();

    /** Each user interface is responsible for properly setting this variable. */
    boolean active;

    public boolean isActive() {
        return active;
    }

    public void activate( TGUserInterface parent ) {
        parentUI = parent;
        parentUI.deactivate();
        activate();
    }

    public void deactivate() {
        if (parentUI!=null) parentUI.activate();
        parentUI = null;
    }

} // end com.compass.conceptmap.interaction.TGUserInterface
