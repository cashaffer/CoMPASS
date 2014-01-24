/*
 * Situations.java
 *
 * Created on October 29, 2004, 2:41 PM
 */

package com.compass.conceptmap.parser;

import java.util.Enumeration;
import java.util.Hashtable;
/**
 *
 * @author  cao2
 */
public class Topics {

    private Hashtable topics;

    /** Creates a new instance of Situations */
    public Topics() {
        topics=new Hashtable();

    }

    public void addTopic(Topic t){
        topics.put(t.getId(),t);
    }

    public void removeTopic(String id){
        topics.remove(id);
    }

    public Topic getTopic(String id){
        return (Topic) topics.get(id);
    }
    public Enumeration getTopicIds(){
      return topics.keys();
    }
}
