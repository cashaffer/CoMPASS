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

public class TopicPanel extends JPanel {
  public SharedData shareddata;
  BorderLayout borderLayout1 = new BorderLayout();
  FlowLayout flowLayout = new FlowLayout(FlowLayout.LEFT);
  Box b = Box.createVerticalBox();
  JLabel label;
  JPanel panel;

  public TopicPanel() {
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
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 15));
    label.setText("Current UNIT: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 18));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusUnit.getLabel());
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 15));
    label.setText("    Current TOPIC: ");
    panel.add(label);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 1, 18));
    label.setForeground(Color.RED);
    label.setText(shareddata.focusTopic.getLabel());
    panel.add(label);
    b.add(panel);

    panel= new JPanel();
    panel.setBackground(NavigationBar.bgColor);
    panel.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 15));
    label.setText("Your can select other topics in this unit:");
    panel.add(label);

    Enumeration tids = shareddata.topics.getTopicIds();
    String tid,tname;
    LinkButton tlink;
    while(tids.hasMoreElements()){
      tid = (String) tids.nextElement();
      tname = shareddata.topics.getTopic(tid).getLabel();
      tlink = new LinkButton(tname);
      tlink.setFont(new java.awt.Font("SansSerif", 0, 15));
      tlink.addActionListener(new TopicAction(tid));
      panel.add(tlink);
    }
    b.add(panel);
    b.add(Box.createGlue());
    this.setBackground(NavigationBar.bgColor);
    this.setLayout(borderLayout1);
    this.add(b);
  }

}

class TopicAction implements java.awt.event.ActionListener {

  String tid;

  TopicAction(String tid) {
    this.tid = tid;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.focusExampleId = null;
    shareddata.setMap(shareddata.focusUnit.getId(),tid,null,"1");
  }

}
