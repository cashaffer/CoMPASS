package com.compass.conceptmap;

import java.applet.AppletContext;
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.util.Hashtable;

import javax.swing.JPanel;
import javax.swing.JPopupMenu;
import javax.swing.JScrollPane;

import com.compass.conceptmap.interaction.GLNavigateUI;
import com.compass.conceptmap.interaction.TGUIManager;

/** GLPanel contains code for initializing CoMPASS data and adding interfaces to the TGPanel
  * The "GL" prefix indicates that this class is GraphLayout specific, and
  * will probably need to be rewritten for other applications.
  *
  */
public class GLPanel extends JPanel {

    public String zoomLabel = "Zoom"; // label for zoom menu item
    public String rotateLabel = "Rotate"; // label for rotate menu item
    public String localityLabel = "Locality"; // label for locality menu item
    public SharedData shareddata = SharedData.instance();
//    public HVScroll hvScroll;
//    public ZoomScroll zoomScroll;
    //public HyperScroll hyperScroll; // unused
//    public RotateScroll rotateScroll;
//    public LocalityScroll localityScroll;
    public JPopupMenu glPopup;
    public Hashtable scrollBarHash; //= new Hashtable();
    public static String urlPreString = null;
    public static AppletContext context;
    protected TGPanel tgPanel;
    protected TGLensSet tgLensSet;
    protected TGUIManager tgUIManager;

    private Color defaultColor = Color.lightGray;

    public static JPanel navigationPanel;
    protected JScrollPane scrollpane;
  // ............


   /** Constructor.
     */

    public GLPanel() {
        scrollBarHash = new Hashtable();
        tgLensSet = new TGLensSet();
        tgPanel = new TGPanel();
//        navigationPanel = new JPanel();
        initialize();
    }

   /** Initialize panel, lens, and establish the concept map.
     */
    public void initialize() {
        buildPanel();
        buildLens();
        tgPanel.setLensSet(tgLensSet);
        addUIs();
      //tgPanel.addNode();  //Add a starting node.
        try {
          if(shareddata.focusUnit ==null && shareddata.focusTopic==null)
            tgPanel.createMap(null,shareddata.focusConcept.getId());
          else if(shareddata.focusConcept != null && shareddata.focusTopic != null)
            tgPanel.createMap(shareddata.focusTopic.getId(),shareddata.focusConcept.getId());
          else if(shareddata.focusUnit != null && shareddata.focusTopic != null)
            tgPanel.createMap(shareddata.focusTopic.getId());
         else
            tgPanel.createMap();
        } catch ( TGException tge ) {
            System.err.println(tge.getMessage());
            tge.printStackTrace(System.err);
        }
//        tgPanel.setSelect(tgPanel.getGES().getFirstNode()); //Select first node, so hiding works
        setVisible(true);
    }

    /** Return the TGPanel used with this GLPanel. */
    public TGPanel getTGPanel() {
        return tgPanel;
    }


    public JPopupMenu getGLPopup()
    {
        return glPopup;
    }

    public void buildLens() {
//        tgLensSet.addLens(hvScroll.getLens());
//        tgLensSet.addLens(zoomScroll.getLens());
      //tgLensSet.addLens(hyperScroll.getLens());
//        tgLensSet.addLens(rotateScroll.getLens());
        tgLensSet.addLens(tgPanel.getAdjustOriginLens());
    }

    public void buildPanel() {

      setLayout(new BorderLayout());

      tgPanel.setPreferredSize(new Dimension(450, 430));
      this.add(tgPanel);

    }

    public void addUIs() {
        tgUIManager = new TGUIManager();
//        GLEditUI editUI = new GLEditUI(this);
        GLNavigateUI navigateUI = new GLNavigateUI(this);
//        tgUIManager.addUI(editUI,"Edit");
        tgUIManager.addUI(navigateUI,"Navigate");
        tgUIManager.activate("Navigate");
    }




} // end com.compass.conceptmap.GLPanel
