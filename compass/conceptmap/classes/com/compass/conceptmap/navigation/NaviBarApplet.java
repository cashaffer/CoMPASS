package com.compass.conceptmap.navigation;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

import java.awt.Container;
import java.awt.HeadlessException;
import java.net.URL;
import java.util.Observable;
import java.util.Observer;

import javax.swing.JApplet;

import com.compass.conceptmap.SharedData;


public class NaviBarApplet extends JApplet implements  Observer{
  public String urlPrefix;
  public SharedData shareddata;
  public NavigationBar nbar;

  public NaviBarApplet() throws HeadlessException {
  }

  public void init() {
    urlPrefix = getParameter("urlPrefix");
    shareddata = SharedData.instance();
    Container contentPane = getContentPane();
    nbar = new NavigationBar(this);
    contentPane.add(nbar);
  }

  public synchronized void update(Observable obs, Object ob) {
    String subURL="";
    if(shareddata.focusUnit != null)
      subURL += "uid="+shareddata.focusUnit.getId()+"&";
    if(shareddata.focusTopic != null)
      subURL += "tid="+shareddata.focusTopic.getId()+"&";
    if(shareddata.focusConcept != null)
      subURL += "cid="+shareddata.focusConcept.getId()+"&";
    if(shareddata.focusExampleId != null)
      subURL += "eid="+shareddata.focusExampleId+"&";
    if(subURL.length()>1 && subURL.endsWith("&"))
      subURL=subURL.substring(0,subURL.length()-1);
    showDocument(subURL);
    nbar.redraw(getBarType());
  }
  public void showDocument(String subURL){
    String URLString = urlPrefix + subURL;
    try{
      URL url = new URL(URLString);
      this.getAppletContext().showDocument(url,"content");
    } catch(Exception exception){
    }
  }

  public int getBarType(){
    int barType=0;
    if(shareddata.focusExampleId != null)
      barType = 5;                  //to show example level bar
    else if(shareddata.focusUnit != null && shareddata.focusTopic==null && shareddata.focusConcept==null)
      barType = 1;                  //to show unit level bar
    else if(shareddata.focusUnit != null && shareddata.focusTopic!=null && shareddata.focusConcept==null)
      barType = 2;                  //to show topic level bar
    else if(shareddata.focusUnit != null && shareddata.focusTopic!=null && shareddata.focusConcept!=null)
      barType = 3;                  //to show concept level bar
    else if(shareddata.focusUnit == null && shareddata.focusTopic==null && shareddata.focusConcept!=null)
      barType = 4;                  //to show general concept level bar
    return barType;
  }
}
