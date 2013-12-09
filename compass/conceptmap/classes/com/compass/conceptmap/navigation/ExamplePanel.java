package com.compass.conceptmap.navigation;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.util.Enumeration;

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

public class ExamplePanel extends JPanel {
  public SharedData shareddata;
  BorderLayout borderLayout1 = new BorderLayout();
  FlowLayout flowLayout = new FlowLayout(FlowLayout.LEFT);
  Box b = Box.createVerticalBox();
  JLabel label;
  JPanel panel;

  public ExamplePanel() {
    shareddata = SharedData.instance();
//    setPreferredSize(NavigationBar.size);
    try {
      jbInit();
    }
    catch(Exception e) {
      e.printStackTrace();
    }
  }
  private void jbInit() throws Exception {
    panel= new JPanel();
    panel.setBackground(NavigationBar.bgColor);
    panel.setLayout(flowLayout);
    if(shareddata.focusUnit != null){
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("Current UNIT: ");
      panel.add(label);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 1, 15));
      label.setForeground(Color.RED);
      label.setText(shareddata.focusUnit.getLabel()+"  ");
      panel.add(label);
    }
    if(shareddata.focusTopic != null){
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("Current TOPIC: ");
      panel.add(label);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 1, 15));
      label.setForeground(Color.RED);
      label.setText(shareddata.focusTopic.getLabel()+"  ");
      panel.add(label);
    }

    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("Current CONCEPT: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 15));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusConcept.getLabel() + "  ");
    panel.add(label);

    if (shareddata.focusExampleId != null) {
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 0, 12));
      label.setText("Current EXAMPLE: ");
      panel.add(label);
      label = new JLabel();
      label.setFont(new java.awt.Font("SansSerif", 1, 15));
      label.setForeground(Color.RED);
      label.setText( (String) shareddata.focusConcept.getExamples().get(
          shareddata.focusExampleId));
      panel.add(label);
    }

    b.add(panel);

    panel= new JPanel();
    panel.setBackground(NavigationBar.bgColor);
    panel.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 12));
    label.setText("Concepts related to the example:");
    panel.add(label);

    Enumeration cids = shareddata.cs.getAllConcepts();
    String cid,cname;
    LinkButton clink;
    while(cids.hasMoreElements()){
      cid = (String) cids.nextElement();
      if(shareddata.cs.getConcept(cid).getExamples().get(shareddata.focusExampleId)!=null){
        cname=shareddata.cs.getConcept(cid).getLabel();
        clink = new LinkButton(cname);
        clink.setFont(new java.awt.Font("SansSerif", 0, 12));
        clink.addActionListener(new CptAction(cid));
        panel.add(clink);
      }
    }
    b.add(panel);
    this.setBackground(NavigationBar.bgColor);
    this.setLayout(borderLayout1);
    this.add(b);
  }

}

class CptAction implements java.awt.event.ActionListener {

  String cid;

  CptAction(String cid) {
    this.cid = cid;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.focusExampleId = null;
    shareddata.setMap(null,null,cid,"1");
  }

}
