package com.compass.conceptmap.parser;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class Unit {
  private String id;

  private String label;

  private Topics topics;
  
  private SubUnits subUnits;

  public void setId(String id){
      this.id=id;
  };

  public void setLabel(String label){
      this.label=label;
  };

  public String getId(){
      return id;
  };

  public String getLabel(){
      return label;
  };

  public void setTopics(Topics topics){
      this.topics = topics;
  }

  public Topics getTopics(){
      return topics;
  }
  
  public void addSubUnit(SubUnit s) {
	  subUnits.addSubUnit(s);
  }
  public boolean HasSubUnits() {
	  return subUnits.HasSubUnits();
  }
  public SubUnits getSubUnits() {
	  return subUnits;
  }
  public Unit() {
	  subUnits = new SubUnits();
  }

}