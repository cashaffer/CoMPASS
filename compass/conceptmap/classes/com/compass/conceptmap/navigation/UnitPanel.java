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

public class UnitPanel extends JPanel {
  public SharedData shareddata;
  BorderLayout borderLayout1 = new BorderLayout();
  FlowLayout flowLayout = new FlowLayout(FlowLayout.LEFT);
  Box b = Box.createVerticalBox();
  JLabel label;
  JPanel panel;

  public UnitPanel() {
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
    b.add(panel);

    panel= new JPanel();
    panel.setBackground(NavigationBar.bgColor);
    panel.setLayout(flowLayout);
    label = new JLabel();
    label.setFont(new java.awt.Font("SansSerif", 0, 15));
    label.setText("Your can select other units:");
    panel.add(label);

    Enumeration uids = shareddata.units.getUnitIds();
    String uid,uname;
    LinkButton ulink;
    while(uids.hasMoreElements()){
      uid = (String) uids.nextElement();
      uname = shareddata.units.getUnit(uid).getLabel();
      ulink = new LinkButton(uname);
      ulink.setFont(new java.awt.Font("SansSerif", 0, 15));
      ulink.addActionListener(new UnitAction(uid));
      panel.add(ulink);
    }
    b.add(panel);
    this.setBackground(NavigationBar.bgColor);
    this.setLayout(borderLayout1);
    this.add(b);
  }

}

class UnitAction implements java.awt.event.ActionListener {

  String uid;

  UnitAction(String uid) {
    this.uid = uid;
  }

  public void actionPerformed(ActionEvent e) {
    SharedData shareddata = SharedData.instance();
    shareddata.focusExampleId = null;
    shareddata.setMap(uid,null,null,"1");
  }

}
