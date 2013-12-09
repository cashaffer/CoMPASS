package com.compass.conceptmap.navigation;

import java.awt.BorderLayout;
import java.awt.Color;

import javax.swing.JLabel;
import javax.swing.JPanel;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2005</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class NavigationBar extends JPanel {

  static Color bgColor = new Color (215,215,255);
  static Color fontColor = new Color (0,0,0);
  BorderLayout borderLayout1 = new BorderLayout();
  NaviBarApplet applet;

  public NavigationBar(NaviBarApplet applet) {
    this.applet = applet;
    setBackground(bgColor);
    setLayout(borderLayout1);
  }

  public void redraw( int barType){
    removeAll();

    if(barType == 1)
      add(new UnitPanel());
    else if(barType == 2)
      add(new TopicPanel());
    else if(barType == 3)
      add(new ConceptPanel(applet));
    else if(barType == 5)
      add(new ExamplePanel());
    else if(barType == 4)
      add(new GeneralConceptPanel(applet));
    else
      add(new JLabel(Integer.toString(barType)));
    paintAll(getGraphics());
  }
}