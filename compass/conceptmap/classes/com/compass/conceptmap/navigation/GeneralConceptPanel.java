package com.compass.conceptmap.navigation;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.util.Enumeration;
import java.util.Hashtable;

import javax.swing.Box;
import javax.swing.JLabel;
import javax.swing.JPanel;

import com.compass.conceptmap.SharedData;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2005</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class GeneralConceptPanel extends JPanel {
  protected SharedData shareddata;
//  SpringLayout layout = new SpringLayout();
//  Spring s = Spring.constant(0, 10, 10);
//  Spring s1 = Spring.constant(0, 1, 1);
  protected FlowLayout flowLayout = new FlowLayout(FlowLayout.LEFT,0,0);
  protected JLabel label;
  protected JPanel panel,panel1,panel2,panel3;
  protected LinkButton tlink;
  protected NaviBarApplet applet;
  protected Box b;

  public GeneralConceptPanel(NaviBarApplet applet) {
    this.applet = applet;
    shareddata = SharedData.instance();
//    setPreferredSize(NavigationBar.size);
    jbInit();
  }
  protected void jbInit() {
    this.setLayout(new BorderLayout());
      b = Box.createVerticalBox();

      panel = new JPanel();
      panel.setBackground(NavigationBar.bgColor);
      panel.setLayout(flowLayout);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("General Definition of CONCEPT ");
      panel.add(label);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 1, 12));
      label.setForeground(Color.RED);
      label.setText(shareddata.focusConcept.getLabel());
      panel.add(label);
      b.add(panel);

      panel1 = new JPanel();
      panel1.setBackground(NavigationBar.bgColor);
      panel1.setLayout(flowLayout);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("To read more about ");
      panel1.add(label);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 1, 12));
      label.setForeground(Color.RED);
      label.setText(shareddata.focusConcept.getLabel());
      panel1.add(label);
      panel1.setBackground(NavigationBar.bgColor);
      b.add(panel1);

      panel2 = new JPanel();
      panel2.setBackground(NavigationBar.bgColor);
      panel2.setLayout(flowLayout);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("In topics: ");
      panel2.add(label);
      Hashtable topics = shareddata.focusConcept.getTopics();
      Enumeration tids = topics.keys();
      String tid, tname, uid;
      int i=0;
      while (tids.hasMoreElements()) {
        tid = (String) tids.nextElement();
        uid = shareddata.units.getUnit( (String) topics.get(tid)).getId();
        tname = shareddata.units.getUnit( (String) topics.get(tid)).getTopics().
            getTopic(tid).getLabel();
        tlink = new LinkButton(tname);
        tlink.setFont(new java.awt.Font("SansSerif", 0, 12));
        tlink.addActionListener(new TCAction(uid, tid,
                                             shareddata.focusConcept.getId()));
        panel2.add(tlink);
        i++;
      }
      if(i==0){
        label = new JLabel();
        label.setFont(new java.awt.Font("SansSerif", 0, 12));
        label.setText("No topic is related to this concept.");
        panel2.add(label);
      }
      if(i>3)
        panel2.setPreferredSize(new Dimension(applet.getWidth(),60));
      b.add(panel2);

      panel3 = new JPanel();
      panel3.setBackground(NavigationBar.bgColor);
      panel3.setLayout(flowLayout);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("Related Examples: ");
      panel3.add(label);
      Hashtable examples = shareddata.focusConcept.getExamples();
      Enumeration eids = examples.keys();
      String eid, ename;
      i=0;
      while(eids.hasMoreElements()){
        eid = (String) eids.nextElement();
        ename = (String) examples.get(eid);
        tlink = new LinkButton(ename);
        tlink.setFont(new java.awt.Font("SansSerif", 0, 12));
        tlink.addActionListener(new ExampleAction(eid,applet));
        panel3.add(tlink);
        i++;
      }
      if(i==0){
        label = new JLabel();
        label.setFont(new java.awt.Font("SansSerif", 0, 12));
        label.setText("No example is related to this concept.");
        panel3.add(label);
      }
      b.add(panel3);
      b.setBackground(NavigationBar.bgColor);
      this.add(b,BorderLayout.WEST);

      /*
           layout.putConstraint(SpringLayout.NORTH, b, s1,SpringLayout.NORTH, this);
           layout.putConstraint(SpringLayout.NORTH, panel2, s,SpringLayout.SOUTH, b);
           layout.putConstraint(SpringLayout.NORTH, panel3, s,SpringLayout.SOUTH, panel2);
           layout.putConstraint(SpringLayout.SOUTH, this, s1,SpringLayout.SOUTH, panel3);
          setLayout(layout);
       */
      this.setBackground(NavigationBar.bgColor);
  }

}

class TCAction implements java.awt.event.ActionListener {

  String uid,tid,cid;

  TCAction(String uid,String tid,String cid) {
    this.uid = uid;
    this.tid = tid;
    this.cid = cid;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.mapLevel=1;
    shareddata.focusExampleId = null;
    shareddata.setMap(uid,tid,cid,"1");
  }

}

class ExampleAction implements java.awt.event.ActionListener {

  String eid;
  NaviBarApplet applet;

  ExampleAction(String eid, NaviBarApplet applet) {
    this.eid = eid;
    this.applet=applet;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.focusExampleId=eid;
    String subURL = "eid="+shareddata.focusExampleId;
    applet.showDocument(subURL);
    applet.nbar.redraw(applet.getBarType());
  }

}
