/*
 * Situation.java
 *
 * Created on October 29, 2004, 2:08 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */


public class Topic {

    private String id;

    private String label;

    private Relations relations;

    private Unit unit;


    /** Creates a new instance of Situation */
    public Topic() {
    }
    public void setId(String id){
        this.id=id;
    };

    public void setUnit(Unit unit){
        this.unit=unit;
    };

    public void setLabel(String label){
        this.label=label;
    };

    public String getId(){
        return id;
    };

    public Unit getUnit(){
        return unit;
    };

    public String getLabel(){
        return label;
    };

    public void setRelations(Relations relations){
        this.relations = relations;
    }

    public Relations getRelations(){
        return relations;
    }
}
