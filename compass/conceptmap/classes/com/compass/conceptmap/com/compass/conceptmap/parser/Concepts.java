/*
 * Concepts.java
 *
 * Created on October 29, 2004, 1:26 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */

import java.util.Enumeration;
import java.util.Hashtable;

public class Concepts{

    private Hashtable concepts;

    /** Creates a new instance of ConceptHashtable */
    public Concepts() {
        concepts=new Hashtable();
    }

    public void addConcept(Concept c){
        concepts.put(c.getId(),c);
    }

    public void removeConcept(String id){
        concepts.remove(id);
    }

    public Concept getConcept(String id){
        return (Concept) concepts.get(id);
    }

    public Enumeration getAllConcepts(){
        return concepts.keys();
    }

}
