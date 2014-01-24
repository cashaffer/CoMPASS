package com.compass.conceptmap;

import java.util.Observable;

import com.compass.conceptmap.parser.Concept;
import com.compass.conceptmap.parser.ConceptMapParser;
import com.compass.conceptmap.parser.Concepts;
import com.compass.conceptmap.parser.SubUnit;
import com.compass.conceptmap.parser.Topic;
import com.compass.conceptmap.parser.Topics;
import com.compass.conceptmap.parser.Unit;
import com.compass.conceptmap.parser.Units;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2004</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */


public class SharedData extends Observable {
  protected static SharedData shareddata;
  public  Concepts cs;
  public  Concept focusConcept = null;
  public  String focusExampleId = null;
  public  Topics topics;
  public  Topic focusTopic = null;
  public  Units units;
  public  Unit focusUnit = null;
  public boolean focusOnSubUnit = false; // is the focus on a subunit?
  public SubUnit focusSubUnit = null; // which subunit is focused.
  public int mapLevel = 0;
  public String source = null;

  public SharedData() {
  }

  public synchronized static SharedData instance()
  {
       if (shareddata == null) {
            shareddata = new SharedData();
       }
       return shareddata;
  }

  public void parseXml(String[] URL){
    try{
      ConceptMapParser cmp = new ConceptMapParser(URL);
      cmp.parse();
      cs= cmp.concepts;
      units = cmp.units;
    }
    catch (Exception e) {
      System.out.println(e.toString());
    }
  }

  public synchronized void setMap(String uid, String tid, String cid, String source){
    //source == 0: from map; source==1: from text; source==2 from nav bar
	focusOnSubUnit = false;
	if(uid != null){
      focusUnit = units.getUnit(uid);
      topics = focusUnit.getTopics();
      if(tid != null){
        String oldTid = null;
        if(focusTopic != null)
           oldTid = focusTopic.getId();
        focusTopic = topics.getTopic(tid);
        if(cid != null){
          focusConcept=cs.getConcept(cid);
          if(oldTid !=null){
            if(oldTid.equals(tid) && !source.equals("0") && mapLevel==2)
              mapLevel = 4;    //use outside links to change the focus concept in the same topic
          }
        } else{
          focusConcept = null;
          mapLevel=1;
        }
      } else{
        focusTopic = null;
        focusConcept = null;
        mapLevel=1;
      }
    } else {
      focusUnit = null;
      focusTopic = null;
      mapLevel=3;
      focusConcept=cs.getConcept(cid);
    }
    this.source=source;
    setChanged();
    notifyObservers("mapchanged");
  }
  public synchronized void setMap(String uid, String suid, String source) {
	    this.source=source;
	    focusUnit = units.getUnit(uid);
	    topics = focusUnit.getTopics();
	    focusOnSubUnit = true;
	    focusSubUnit = focusUnit.getSubUnits().getSubUnit(suid);
	    setChanged();
	    notifyObservers("mapchanged");
  }

}