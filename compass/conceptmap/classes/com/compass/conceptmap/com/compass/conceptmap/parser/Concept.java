/*
 * Concept.java
 *
 * Created on October 29, 2004, 1:20 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */
import java.util.Hashtable;

public class Concept {

    private String id;
    private String label;
    private String comments;
    private Hashtable topics;
    private Hashtable examples;

    /** Creates a new instance of Concept */
    public Concept() {
      topics = new Hashtable();
      examples = new Hashtable();
    }

    public void setId(String id){
        this.id=id;
    };

    public void setLabel(String label){
        this.label=label;
    };

    public void setComments(String comments){
        this.comments=comments;
    };

    public String getId(){
        return id;
    };

    public String getLabel(){
        return label;
    };

    public String getComments(){
        return comments;
    };

    public void addTopic(String id, String unitId){
      topics.put(id,unitId);
    }

    public void removeTopic(String id){
      topics.remove(id);
    }

    public Hashtable getTopics(){
      return topics;
    }
    public void addExample(String id, String label){
      examples.put(id,label);
    }

    public void removeExample(String id){
      examples.remove(id);
    }

    public Hashtable getExamples(){
      return examples;
    }
}
