package com.compass.conceptmap;

import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.util.Enumeration;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;

import com.compass.conceptmap.parser.Concept;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class SearchPanel extends JPanel {
  JTextField keyword = new JTextField();
  JButton searchButton = new JButton();
  JLabel searchLabel = new JLabel();
  JLabel notFoundLabel = new JLabel();
  TGPanel tgPanel;
  SharedData shareddata = SharedData.instance();
  public SearchPanel(TGPanel tgPanel) {
    super();
    this.tgPanel = tgPanel;
    try {
      jbInit();
    }
    catch(Exception e) {
      e.printStackTrace();
    }
  }
  private void jbInit() throws Exception {
    searchButton.setText("Go!");
    searchButton.addActionListener(new SearchPanel_jButton1_actionAdapter(this));
    searchLabel.setText("Concept Search");
    notFoundLabel.setText("");
    keyword.setPreferredSize(new Dimension(100, 22));
    keyword.setText("");
    this.add(searchLabel, null);
    this.add(keyword, null);
    this.add(searchButton, null);
    this.add(notFoundLabel, null);
  }

  void actionPerformed(ActionEvent e) {
    String conceptId, conceptName;
    Concept c;
    String searchKey =  keyword.getText().trim();
    Enumeration conceptIds = shareddata.cs.getAllConcepts();
    boolean isFound = false;
    while (conceptIds.hasMoreElements()) {
      conceptId = (String) conceptIds.nextElement();
      c = shareddata.cs.getConcept(conceptId);
      conceptName = c.getLabel();
      if (searchKey.compareToIgnoreCase(conceptName) == 0) {
        shareddata.focusUnit = null;
        shareddata.topics = null;
        shareddata.focusTopic = null;
        shareddata.focusExampleId = null;
        shareddata.focusConcept = c;
        try {
          tgPanel.createMap(null, conceptId);
        }
        catch (TGException except) {
        }
        isFound = true;
        break;
      }
    }
    if(!isFound){
      keyword.setText("");
      notFoundLabel.setText("Concept \""+searchKey+"\" isn't found");
      paintAll(getGraphics());
    }

  }

}

class SearchPanel_jButton1_actionAdapter implements java.awt.event.ActionListener {
  SearchPanel adaptee;

  SearchPanel_jButton1_actionAdapter(SearchPanel adaptee) {
    this.adaptee = adaptee;
  }
  public void actionPerformed(ActionEvent e) {
    adaptee.actionPerformed(e);
  }
}
