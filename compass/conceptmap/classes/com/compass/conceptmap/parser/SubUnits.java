package com.compass.conceptmap.parser;

import java.util.Enumeration;
import java.util.Hashtable;

public class SubUnits {
  private Hashtable subUnits;


  public void addSubUnit(SubUnit u){
      subUnits.put(u.getId(),u);
  }

  public void removeSubUnit(String id){
      subUnits.remove(id);
  }

  public SubUnit getSubUnit(String id){
      return (SubUnit) subUnits.get(id);
  }
  public Enumeration getSubUnitIds(){
    return subUnits.keys();
  }
  public boolean HasSubUnits() {
	  return !subUnits.isEmpty();
  }
  public SubUnits() {
    subUnits=new Hashtable();
  }

}