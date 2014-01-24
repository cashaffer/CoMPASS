package com.compass.conceptmap.parser;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

public class Example {
  private String id;
  private String label;
  private Concepts concepts;

  public Example() {
    concepts=new Concepts();
  }

  public Concepts getConcepts(){
    return concepts;
  }

}