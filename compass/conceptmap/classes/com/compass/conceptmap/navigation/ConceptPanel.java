package com.compass.conceptmap.navigation;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2005</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */
import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.util.Enumeration;
import java.util.Hashtable;

import javax.swing.Box;
import javax.swing.JLabel;
import javax.swing.JPanel;

import com.compass.conceptmap.SharedData;

public class ConceptPanel extends GeneralConceptPanel {
  public ConceptPanel(NaviBarApplet applet) {
    super(applet);
  }

  public void jbInit() {
    this.setLayout(new BorderLayout());
    b = Box.createVerticalBox();

    panel= new JPanel();
    panel.setBackground(NavigationBar.bgColor);
    panel.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("Current UNIT: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 12));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusUnit.getLabel());
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("    Current TOPIC: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 12));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusTopic.getLabel());
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("    Current CONCEPT: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 12));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusConcept.getLabel());
    panel.add(label);
    b.add(panel);

    panel1= new JPanel();
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
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText(", refer to the ");
    panel1.add(label);
    tlink = new LinkButton("General Definition");
    tlink.setFont(new java.awt.Font("SansSerif", 0, 12));
    tlink.addActionListener(new GDAction(shareddata.focusConcept.getId()));
    panel1.add(tlink);
    b.add(panel1);

    panel2= new JPanel();
    panel2.setBackground(NavigationBar.bgColor);
    panel2.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("In other topics: ");
    panel2.add(label);
    Hashtable topics = shareddata.focusConcept.getTopics();
    Enumeration tids = topics.keys();
    String tid,tname,uid;
    int i=0;
    while(tids.hasMoreElements()){
      tid = (String) tids.nextElement();
      uid = shareddata.units.getUnit((String) topics.get(tid)).getId();
      tname = shareddata.units.getUnit((String) topics.get(tid)).getTopics().getTopic(tid).getLabel();
      if(!tid.equals(shareddata.focusTopic.getId())){
         tlink = new LinkButton(tname);
         tlink.setFont(new java.awt.Font("SansSerif", 0, 12));
         tlink.addActionListener(new TCAction(uid,tid,shareddata.focusConcept.getId()));
         panel2.add(tlink);
         i++;
      }
    }
    if(i==0){
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("No other topic is related to this concept except the current one.");
      panel2.add(label);
    }
    if(i>3)
      panel2.setPreferredSize(new Dimension(applet.getWidth(),60));
    b.add(panel2);

    panel3= new JPanel();
    panel3.setBackground(NavigationBar.bgColor);
    panel3.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("Related Examples: ");
    panel3.add(label);
    Hashtable examples = shareddata.focusConcept.getExamples();
    Enumeration eids = examples.keys();
    String eid,ename;
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

class GDAction implements java.awt.event.ActionListener {

  String cid;

  GDAction(String cid) {
    this.cid = cid;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.focusExampleId = null;
    shareddata.setMap(null,null,cid,"1");
  }

}
