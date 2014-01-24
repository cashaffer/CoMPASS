package com.compass.conceptmap.graphelements;

import java.util.Vector;

import com.compass.conceptmap.Node;

/** TGNodeQueue: a very simple queue implementation for doing a breadth
  * first search.  Should probably be implemented with linked lists.
  */
public class TGNodeQueue {

    Vector queue;

    public TGNodeQueue() {
        queue=new Vector();
    }

    public void push( Node n ) {
        queue.addElement(n);
    }

    public Node pop() {
        Node n = (Node)queue.elementAt(0);
        queue.removeElementAt(0);
        return n;
    }

    public boolean isEmpty() {
        return queue.size() == 0;
    }

    public boolean contains( Node n ) {
        return queue.contains(n);
    }

} // end com.compass.conceptmap.graphelements.TGNodeQueue
