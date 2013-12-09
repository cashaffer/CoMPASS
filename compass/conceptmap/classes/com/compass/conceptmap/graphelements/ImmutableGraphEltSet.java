package com.compass.conceptmap.graphelements;

import java.util.Collection;
import java.util.Iterator;

import com.compass.conceptmap.Edge;
import com.compass.conceptmap.Node;

/** ImmutableGraphEltSet provides access to the elements of GraphElementSet
  * that does not allow for addition or deletion of nodes or edges.
  */
public interface ImmutableGraphEltSet {

    /** Return the number of Nodes in the cumulative Vector. */
    public int nodeCount();

    /** Return the current Node count.
      * @deprecated        this method has been replaced by the <tt>nodeCount()</tt> method.
      */
    public int nodeNum();

    /** Return an iterator over the Nodes in the cumulative Vector, null if it is empty. */
    public Iterator getNodes();

    /** Return the number of Edges in the cumulative Vector. */
    public int edgeCount();

    /** Return the current Edge count.
      * @deprecated        this method has been replaced by the <tt>edgeCount()</tt> method.
      */
    public int edgeNum();

    /** Return an iterator over the Edges in the cumulative Vector, null if it is empty. */
    public Iterator getEdges();

    /** Return the Node whose ID matches the String <tt>id</tt>, null if no match is found. */
    public Node findNode( String id );

    /** Return a Collection of all Nodes whose label matches the String <tt>label</tt>,
      * null if no match is found. */
    public Collection findNodesByLabel( String label );

   /** Return the first Nodes whose label contains the String <tt>substring</tt>,
     * null if no match is found. */
    public Node findNodeLabelContaining( String substring );

    /** Return an Edge spanning Node <tt>from</tt> to Node <tt>to</tt>. */
    public Edge findEdge( Node from, Node to );

    /** Returns a random node, or null if none exist (for making random graphs). */
    public Node getRandomNode();

    /** Return the first Node, null if none exist. */
    public Node getFirstNode();

    /** iterates through all the nodes. */
    public void forAllNodes( TGForEachNode fen );

    /** iterates through pairs of Nodes. */
    public void forAllNodePairs( TGForEachNodePair fenp );

    /** iterates through Edges. */
    public void forAllEdges( TGForEachEdge fee );

} // end com.compass.conceptmap.graphelements.ImmutableGraphEltSet
