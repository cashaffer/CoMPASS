package com.compass.conceptmap.parser;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */
import java.util.Enumeration;
import java.util.Hashtable;

public class Units {
  private Hashtable units;


  public void addUnit(Unit u){
      units.put(u.getId(),u);
  }

  public void removeUnit(String id){
      units.remove(id);
  }

  public Unit getUnit(String id){
      return (Unit) units.get(id);
  }
  public Enumeration getUnitIds(){
    return units.keys();
  }
  public Units() {
    units=new Hashtable();
  }

}