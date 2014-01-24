package com.compass.conceptmap;

import java.awt.Container;
import java.awt.HeadlessException;
import java.net.URL;
import java.util.Observable;
import java.util.Observer;

import javax.swing.JApplet;

/**
 * <p>Title: </p>
 * <p>Description: Draw CoMPASS concept map and send update requests to navigation bar and text part</p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class CompassApplet extends JApplet implements  Observer{
  public String[] dataSource;
  public String focusUnit=null;
  public String focusSubUnit=null;
  public String focusTopic=null;
  public String focusConcept=null;
  public String searchId;
  public String homePic;
  public String urlPrefix;
  public SharedData shareddata;
  public GLPanel glPanel;
  public CompassApplet() throws HeadlessException {
    shareddata = SharedData.instance();
    shareddata.deleteObservers();
  }

  public void init() {
    dataSource = new String[3];
    dataSource[0] = getParameter("concepts");//the url of concepts.xml
    dataSource[1] = getParameter("relations");//the url of relations.xml
    dataSource[2] = getParameter("examples");//the url of examples.xml
    focusUnit = getParameter("focusUnit");
    focusSubUnit = getParameter("focusSubUnit");
    focusTopic = getParameter("focusTopic");
    focusConcept = getParameter("focusConcept");
    searchId = getParameter("searchId");
    urlPrefix = getParameter("urlPrefix");
    shareddata.parseXml(dataSource);

    Container contentPane = getContentPane();
    if(focusUnit != null)
      if(focusUnit.equals(""))
        focusUnit = null;
    if(focusSubUnit != null)
        if(focusSubUnit.equals(""))
          focusSubUnit = null;
    if(focusTopic != null)
      if(focusTopic.equals(""))
        focusTopic = null;
    if(focusConcept != null)
      if(focusConcept.equals(""))
        focusConcept = null;
    
    if (focusSubUnit != null) {
    	shareddata.setMap(focusUnit, focusSubUnit, "1");
    } else {
    	shareddata.setMap(focusUnit,focusTopic,focusConcept,"1");
    }
    String subURL="";
    if(focusUnit != null)
      subURL += "uid="+focusUnit+"&";
    if(focusSubUnit != null)
      subURL += "suid="+focusSubUnit+"&";
    if(shareddata.focusTopic != null)
      subURL += "tid="+focusTopic+"&";
    if(focusConcept != null)
      subURL += "cid="+focusConcept+"&";
    subURL += "source=1&";
    if(subURL.length()>1 && subURL.endsWith("&"))
      subURL=subURL.substring(0,subURL.length()-1);
    showDocument(subURL);
    glPanel = new GLPanel();
    contentPane.add(glPanel);
    shareddata.addObserver(this);
  }

  public void showDocument(String subURL){
    String ContentURL = urlPrefix+"content.php?" + subURL;
    String NavURL = urlPrefix+"nav.php?" + subURL;
    try{
      URL url = new URL(NavURL);
      this.getAppletContext().showDocument(url,"nav");
      url = new URL(ContentURL);
      this.getAppletContext().showDocument(url,"content");
    } catch(Exception exception){
    }
  }

  public synchronized void update(Observable obs, Object ob) {
	  System.out.println("new!");
    String subURL="";
    if(shareddata.focusUnit != null)
      subURL += "uid="+shareddata.focusUnit.getId()+"&";
    if (shareddata.focusOnSubUnit) {
    	subURL += "suid="+shareddata.focusSubUnit.getId() + "&";
    }
    if(shareddata.focusTopic != null)
      subURL += "tid="+shareddata.focusTopic.getId()+"&";
    if(shareddata.focusConcept != null)
      subURL += "cid="+shareddata.focusConcept.getId()+"&";
    if(shareddata.source != null)
      subURL += "source="+shareddata.source+"&";
    if(subURL.length()>1 && subURL.endsWith("&"))
      subURL=subURL.substring(0,subURL.length()-1);
    showDocument(subURL);
    System.out.println(subURL);
    if(shareddata.mapLevel!=2)
      if(shareddata.mapLevel!=4) {    	  
        glPanel.tgPanel.redrawmap();
      }
      else{
        glPanel.tgPanel.changeFocusFromLink(shareddata.focusConcept.getId());
      }
  }

}
