package com.compass.conceptmap.interaction;

import java.util.Vector;

/** TGUIManager switches between major user interfaces, and allows
  * them to be referred to by name.  This will probably come in handy
  * when switching user interfaces from menus.
  */
public class TGUIManager {

    Vector userInterfaces;

  // ............

   /** Default constructor.
     */
    public TGUIManager() {
        userInterfaces = new Vector();
    }

    class NamedUI {
        TGUserInterface ui;
        String name;

        NamedUI( TGUserInterface ui, String n ) {
            this.ui = ui;
            name = n;
        }
    }

    public void addUI( TGUserInterface ui, String name ) {
        userInterfaces.addElement(new NamedUI(ui,name));
    }

    public void addUI( TGUserInterface ui ) {
        addUI(ui,null);
    }

    public void removeUI( String name ) {
        for (int i=0;i<userInterfaces.size();i++)
            if (((NamedUI) userInterfaces.elementAt(i)).name.equals(name)) userInterfaces.removeElementAt(i);

    }

    public void removeUI( TGUserInterface ui ) {
        for (int i=0;i<userInterfaces.size();i++)
            if (((NamedUI) userInterfaces.elementAt(i)).ui==ui) userInterfaces.removeElementAt(i);

    }

    public void activate( String name ) {
        for (int i=0;i<userInterfaces.size();i++) {
            NamedUI namedInterf = (NamedUI) userInterfaces.elementAt(i);
            TGUserInterface ui=namedInterf.ui;
            if (((NamedUI) userInterfaces.elementAt(i)).name.equals(name)) ui.activate();
            else ui.deactivate();
        }
    }

    public void activate( TGUserInterface ui ) {
        for (int i=0;i<userInterfaces.size();i++) {
            if (((NamedUI) userInterfaces.elementAt(i)).ui==ui) ui.activate();
            else ui.deactivate();
        }
    }

} // end com.compass.conceptmap.interaction.TGUIManager
