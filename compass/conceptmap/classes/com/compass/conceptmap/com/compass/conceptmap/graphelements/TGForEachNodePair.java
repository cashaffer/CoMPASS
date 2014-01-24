package com.compass.conceptmap.graphelements;

import com.compass.conceptmap.Node;

/** TGForEachNodePair: A dummy object for iterating through pairs of nodes
  */
public abstract class TGForEachNodePair {

    public void beforeInnerLoop( Node n1 ) {};

    public void afterInnerLoop( Node n1 ) {};

    public abstract void forEachNodePair( Node n1, Node n2 );

} // end com.compass.conceptmap.graphelements.TGForEachNodePair
