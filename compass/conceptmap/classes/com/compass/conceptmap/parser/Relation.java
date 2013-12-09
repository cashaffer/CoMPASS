/*
 * Relation.java
 *
 * Created on October 29, 2004, 2:12 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */
public class Relation {

    private String source;

    private String target;

    private String label = null;

    private String comments;

    /** Creates a new instance of Edge */
    public Relation() {
    }

    public void setSource(String source){
        this.source=source;
    };

    public void setTarget(String target){
        this.target=target;
    };

    public void setLabel(String label){
        this.label=label;
    };

    public void setComments(String comments){
        this.comments=comments;
    };

    public String getSource(){
        return source;
    };

    public String getTarget(){
        return target;
    };

    public String getLabel(){
        return label;
    };

    public String getComments(){
        return comments;
    };
}
