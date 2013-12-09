/*
 * Relations.java
 *
 * Created on October 29, 2004, 2:27 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */

import java.util.ArrayList;

public class Relations {

    private ArrayList relations;

    /** Creates a new instance of Edges */
    public Relations() {
        relations = new ArrayList();
    }

    public void addRelation(Relation relation){
        relations.add(relation);
    }

    public int size(){
        return relations.size();
    }

    public Relation get(int i){
        return (Relation) relations.get(i);
    }
}
