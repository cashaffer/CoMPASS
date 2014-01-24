package com.compass.conceptmap;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.FontMetrics;
import java.awt.Graphics;
import java.awt.Point;
import java.util.Iterator;
import java.util.Vector;

public class Node {

   /** This Node's type is a Rectangle. */
    public final static int TYPE_RECTANGLE = 1;

   /** This Node's type is a Round Rectangle. */
    public final static int TYPE_ROUNDRECT = 2;

   /** This Node's type is an Ellipse. */
    public final static int TYPE_ELLIPSE   = 3;

   /** This Node's type is a Circle. */
    public final static int TYPE_CIRCLE    = 4;

    public static final Font SMALL_TAG_FONT = new Font("Courier",Font.PLAIN,9);

   // Variables that store default values for colors + fonts + node type
    public static Color BACK_FIXED_COLOR        = Color.red;
    public static Color BACK_SELECT_COLOR       = new Color(55, 155, 255);
    public static Color BACK_DEFAULT_COLOR      = new Color(231, 243, 255);
    public static Color BACK_SECONDLEVEL_COLOR    = new Color(160, 208, 255);
    public static Color BACK_HILIGHT_COLOR      = Color.decode("#ffb200"); // altheim: new

    public static Color BORDER_DRAG_COLOR       = Color.pink;
    public static Color BORDER_MOUSE_OVER_COLOR = Color.blue;
    public static Color BORDER_RELATED_COLOR = Color.orange;
    public static Color BORDER_INACTIVE_COLOR   = new Color(80,80,80);

    public static Color TEXT_COLOR              = Color.black;

    public static Font TEXT_FONT_SMALL = new Font("Arial Narrow",Font.PLAIN,9);
    public static Font TEXT_FONT_MIDDLE = new Font("Arial Narrow",Font.BOLD,10);
    public static Font TEXT_FONT_LARGE = new Font("Arial",Font.BOLD,11);

    public static int DEFAULT_TYPE = 1;
    public int animationColorLevel;

   /** an int indicating the Node type.
     * @see TYPE_RECTANGLE
     * @see TYPE_ROUNDRECT
     * @see TYPE_ELLIPSE
     */
    protected int typ = TYPE_RECTANGLE;
    private String id;

    public double drawx;
    public double drawy;
    public int depth;

    protected FontMetrics fontMetrics;
    protected Font font;

    protected String lbl;
    protected Color backColor = BACK_DEFAULT_COLOR;
    protected Color textColor = TEXT_COLOR;

    public double x;
    public double y;
    public double targetx;
    public double targety;

    protected double dx; //Used by layout
    protected double dy; //Used by layout

    protected boolean fixed;
    protected int repulsion; //Used by layout

    public boolean justMadeLocal = false;
    public boolean markedForRemoval = false;

    public int visibleEdgeCnt; //Should only be modified by graphelements.VisibleLocality
    protected boolean visible;

    private Vector edges;


  // ............

   /** Minimal constructor which will generate an ID value from Java's Date class.
     * Defaults will be used for type and color. The label will be taken from the ID value.
     */
    public Node()
    {
        initialize(null);
        lbl = id;
    }

   /** Constructor with the required ID <tt>id</tt>, using defaults
     * for type (rectangle), color (a static variable from TGPanel).
     * The Node's label will be taken from the ID value.
     */
    public Node( String id )
    {
        initialize(id);
        lbl = id;
    }

   /** Constructor with Strings for ID <tt>id</tt> and <tt>label</tt>, using defaults
     * for type (rectangle) and color (a static variable from TGPanel).
     * If the label is null, it will be taken from the ID value.
     */
    public Node( String id, String label )
    {
        initialize(id);
        if ( label == null ) lbl = id;
        else lbl = label;
    }

   /** Constructor with a String ID <tt>id</tt>, an int <tt>type</tt>, Background Color <tt>bgColor</tt>,
     * and a String <tt>label</tt>. If the label is null, it will be taken from the ID value.
     * @see TYPE_RECTANGLE
     * @see TYPE_ROUNDRECT
     */
    public Node( String id, int type, Color color, String label )
    {
        initialize(id);
        typ = type;
        backColor = color;
        if ( label == null ) lbl = id;
        else lbl = label;
    }

    private void initialize( String identifier ) {
        this.id = identifier;
        edges = new Vector();
        x = Math.random()*2-1; // If multiple nodes are added without repositioning,
        y = Math.random()*2-1; // randomizing starting location causes them to spread out nicely.
        repulsion = 100;
        font = TEXT_FONT_MIDDLE;
        fixed = false;
        typ = DEFAULT_TYPE;
        visibleEdgeCnt=0;
        visible = false;
    }


   // setters and getters ...............

    public static void setNodeBackFixedColor( Color color ) { BACK_FIXED_COLOR = color; }
    public static void setNodeBackSelectColor( Color color ) { BACK_SELECT_COLOR = color; }
    public static void setNodeBackDefaultColor( Color color ) { BACK_DEFAULT_COLOR = color; }
    public static void setNodeBackHilightColor( Color color ) { BACK_HILIGHT_COLOR = color; }
    public static void setNodeBorderDragColor( Color color ) { BORDER_DRAG_COLOR = color; }
    public static void setNodeBorderMouseOverColor( Color color ) { BORDER_MOUSE_OVER_COLOR = color; }
    public static void setNodeBorderInactiveColor( Color color ) { BORDER_INACTIVE_COLOR = color; }
    public static void setNodeTextColor( Color color ) { TEXT_COLOR = color; }
//    public static void setNodeTextFont( Font font ) { TEXT_FONT = font; }
    public static void setNodeType( int type ) { DEFAULT_TYPE = type; }

    /** Set the ID of this Node to the String <tt>id</tt>.
      */
    public void setID( String id ) {
        this.id = id;
    }

    /** Return the ID of this Node as a String.
     */
    public String getID() {
        return id;
    }

    /** Set the location of this Node provided the Point <tt>p</tt>.
      */
    public void setLocation( Point p ) {
        this.x = p.x;
        this.y = p.y;
    }


    /** Return the location of this Node as a Point.
      */
    public Point getLocation() {
        return new Point((int)x,(int)y);
    }

    /** Set the visibility of this Node to the boolean <tt>v</tt>.
      */
    public void setVisible( boolean v) {
        visible = v;
    }

    /** Return the visibility of this Node as a boolean.
      */
    public boolean isVisible() {
        return visible;
    }

    /** Set the type of this Node to the int <tt>type</tt>.
      * @see TYPE_RECTANGLE
      * @see TYPE_ROUNDRECT
      * @see TYPE_ELLIPSE
      * @see TYPE_CIRCLE
      */

    public void setType( int type ) {
        typ = type;
    }

    /** Return the type of this Node as an int.
      * @see TYPE_RECTANGLE
      * @see TYPE_ROUNDRECT
      * @see TYPE_ELLIPSE
      * @see TYPE_CIRCLE
      */
    public int getType() {
        return typ;
    }

    /** Set the font of this Node to the Font <tt>font</tt>. */
    public void setFont( Font font ) {
        this.font = font;
    }

    /** Returns the font of this Node as a Font*/
    public Font getFont() {
        return font;
    }

    /** Set the background color of this Node to the Color <tt>bgColor</tt>. */
    public void setBackColor( Color bgColor ) {
        backColor = bgColor;
    }

   /** Return the background color of this Node as a Color.
     */
    public Color getBackColor() {
        return backColor;
    }

    /** Set the text color of this Node to the Color <tt>txtColor</tt>. */
    public void setTextColor( Color txtColor ) {
        textColor = txtColor;
    }


   /** Return the text color of this Node as a Color.
     */
    public Color getTextColor() {
        return textColor;
    }


   /** Set the label of this Node to the String <tt>label</tt>. */
    public void setLabel( String label ) {
        lbl = label;
    }

   /** Return the label of this Node as a String.
     */
    public String getLabel() {
        return lbl;
    }

   /** Set the fixed status of this Node to the boolean <tt>fixed</tt>. */
    public void setFixed( boolean fixed ) {
        this.fixed = fixed;
    }


   /** Returns true if this Node is fixed (in place).
     */
    public boolean getFixed() {
        return fixed;
    }

    // ....

    /** Return the number of Edges in the cumulative Vector.
      * @deprecated        this method has been replaced by the <tt>edgeCount()</tt> method.
      */
    public int edgeNum() {
        return edges.size();
    }

    /** Return the number of Edges in the cumulative Vector. */
    public int edgeCount() {
        return edges.size();
    }

    /** Return an iterator over the Edges in the cumulative Vector, null if it is empty. */
    public Iterator getEdges() {
        if ( edges.size() == 0 ) return null;
        else return edges.iterator();
    }

    /** Returns the local Edge count. */
    public int visibleEdgeCount() {
        return visibleEdgeCnt;
    }

    /** Return the Edge at int <tt>index</tt>. */
    public Edge edgeAt( int index ) {
        return (Edge)edges.elementAt(index);
    }

    /** Add the Edge <tt>edge</tt> to the graph. */
    public void addEdge( Edge edge ) {
        if ( edge == null ) return;
        edges.addElement(edge);
    }

    /** Remove the Edge <tt>edge</tt> from the graph. */
    public void removeEdge( Edge edge ) {
        edges.removeElement(edge);
    }

    /** Return the width of this Node. */
    public int getWidth() {
        if ( fontMetrics != null && lbl != null ) {
//          return fontMetrics.stringWidth(lbl) + 12;
          if(depth==0)
            return 72;
          else if(depth == 1)
            return 55;
          else
            return 52;
        } else {
            return 10;
        }
    }

    /** Return the height of this Node. */
    public int getHeight() {
      if (fontMetrics != null) {
        /*
                      return fontMetrics.getHeight() + 6;
                  return  2*fontMetrics.getHeight() + 2;
                } else {
                    return 6;
         */
        if (depth == 0)
          return 55;
        else if (depth == 1)
          return 38;
        else
          return 23;
      }
      else {
        return 10;

      }
    }

    /** Returns true if this Node intersects Dimension <tt>d</tt>. */
    public boolean intersects( Dimension d ) {
        return ( drawx > 0 && drawx < d.width && drawy>0 && drawy < d.height );
    }

    /** Returns true if this Node contains the Point <tt>px,py</tt>. */
    public boolean containsPoint( double px, double py ) {
        return (( px > drawx-getWidth()/2) && ( px < drawx+getWidth()/2)
                && ( py > drawy-getHeight()/2) && ( py < drawy+getHeight()/2));
    }

    /** Returns true if this Node contains the Point <tt>p</tt>. */
    public boolean containsPoint( Point p ) {
        return (( p.x > drawx-getWidth()/2) && ( p.x < drawx+getWidth()/2)
                && ( p.y > drawy-getHeight()/2) && ( p.y < drawy+getHeight()/2));
    }

    /** Paints the Node. */
    public void paint( Graphics g, TGPanel tgPanel ) {
        if (!intersects(tgPanel.getSize()) ) return;
        paintNodeBody(g, tgPanel);
/*
        if ( visibleEdgeCount()<edgeCount() ) {
            int ix = (int)drawx;
            int iy = (int)drawy;
            int h = getHeight();
            int w = getWidth();
            int tagX = ix+(w-7)/2-2+w%2;
            int tagY = iy-h/2-2;
            char character;
            int hiddenEdgeCount = edgeCount()-visibleEdgeCount();
            character = (hiddenEdgeCount<9) ? (char) ('0' + hiddenEdgeCount) : '*';
            paintSmallTag(g, tgPanel, tagX, tagY, Color.red, Color.white, character);
        }
 */
    }

    public Color getPaintBorderColor(TGPanel tgPanel) {
        Color thisColor;
        if (markedForRemoval){
          if(animationColorLevel==1)
            return new Color(110,110,110);
          else if(animationColorLevel==2)
            return new Color(140,140,140);
          else if(animationColorLevel==3)
            return new Color(180,180,180);
          else
            return new Color(220,220,220);
        }
        if (justMadeLocal){
          if(animationColorLevel==4)
            return new Color(110,110,110);
          else if(animationColorLevel==3)
            return new Color(140,140,140);
          else if(animationColorLevel==2)
            return new Color(180,180,180);
          else
            return new Color(220,220,220);
        }
        Node mouseOverN = tgPanel.getMouseOverN();
        Edge mouseOverE = tgPanel.getMouseOverE();
        if (this == tgPanel.getDragNode())
          thisColor = BORDER_DRAG_COLOR;
        else if (this == mouseOverN)
         return BORDER_MOUSE_OVER_COLOR;
        else if( isRelated(tgPanel, mouseOverN, mouseOverE))
          return BORDER_RELATED_COLOR;
        else
          thisColor = BORDER_INACTIVE_COLOR;
        return thisColor;
    }

    private boolean isRelated(TGPanel tgPanel, Node mouseOverN, Edge mouseOverE) {
      boolean rtn = false;
      Edge relatedEdge;
      if(edges != null){
        for(int i=0;i<edges.size();i++){
          if(mouseOverE != null){
            if (mouseOverE.from == this || mouseOverE.to == this) {
              rtn = true;
              break;
            }
          }
          if(mouseOverN != null){
            relatedEdge = (Edge) edges.get(i);
            if (mouseOverN == relatedEdge.from || mouseOverN == relatedEdge.to) {
              rtn = true;
              break;
            }
          }
        }
      }
      return rtn;
    }

    public Color getPaintBackColor(TGPanel tgPanel) {
        Color thisColor = backColor;
        if ( this == tgPanel.getSelect() ) {
            thisColor = BACK_SELECT_COLOR;
        } else {
            if(isRelated(tgPanel,tgPanel.getSelect(),null))
                  thisColor = BACK_SECONDLEVEL_COLOR;
            if (fixed) thisColor = BACK_FIXED_COLOR;
        }
        if (markedForRemoval){
          if(animationColorLevel==1)
            thisColor = new Color(235,245,255);
          else if(animationColorLevel==2)
            thisColor = new Color(239,247,255);
          else if(animationColorLevel==3)
            thisColor = new Color(247,251,255);
          else
            thisColor = new Color(251,253,255);
       }

       if (justMadeLocal){

          if(isRelated(tgPanel,tgPanel.getSelect(),null)){
            if(animationColorLevel==4)
              thisColor = new Color(177,216,235);
            else if(animationColorLevel==3)
              thisColor = new Color(197,226,255);
            else if(animationColorLevel==2)
              thisColor = new Color(217,236,255);
            else
              thisColor = new Color(235,245,255);

          }
          else{
            if(animationColorLevel==4)
              thisColor = new Color(235,245,255);
            else if(animationColorLevel==3)
              thisColor = new Color(239,247,255);
            else if(animationColorLevel==2)
              thisColor = new Color(247,251,255);
            else
              thisColor = new Color(251,253,255);
          }
        }
        return thisColor;
    }

    public Color getPaintTextColor(TGPanel tgPanel) {
      if(markedForRemoval)
        return new Color(125,125,125);
      else
        return textColor;
    }

    public Font getFont(TGPanel tgPanel){
      Font thisFont;
      if ( this == tgPanel.getSelect() )
        thisFont = TEXT_FONT_LARGE;
      else if(isRelated(tgPanel,tgPanel.getSelect(),null))
        thisFont = TEXT_FONT_MIDDLE;
      else
        thisFont = TEXT_FONT_SMALL;
      return thisFont;
    }

    /** Paints the background of the node, along with its label */
    public void paintNodeBody( Graphics g, TGPanel tgPanel) {
        g.setFont( getFont(tgPanel) );
        fontMetrics = g.getFontMetrics();

        int ix = (int)drawx;
        int iy = (int)drawy;
        int h = getHeight();
        int w = getWidth();
        int r = h/2+1; // arc radius

        Color borderCol = getPaintBorderColor(tgPanel);
        g.setColor(borderCol);

        if ( typ == TYPE_ROUNDRECT ) {
            g.fillRoundRect(ix - w/2, iy - h / 2, w, h, r, r);
        } else if ( typ == TYPE_ELLIPSE ) {
            g.fillOval(ix - w/2, iy - h / 2, w, h );
        } else if ( typ == TYPE_CIRCLE ) { // just use width for both dimensions
            g.fillOval(ix - w/2, iy - w / 2, w, w );
        } else { // TYPE_RECTANGLE
            g.fillRect(ix - w/2, iy - h / 2, w, h);
        }

        Color backCol = getPaintBackColor(tgPanel);
        g.setColor(backCol);

        if ( typ == TYPE_ROUNDRECT ) {
            g.fillRoundRect(ix - w/2+2, iy - h / 2+2, w-4, h-4, r, r );
        } else if ( typ == TYPE_ELLIPSE ) {
            g.fillOval(ix - w/2+2, iy - h / 2+2, w-4, h-4 );
        } else if ( typ == TYPE_CIRCLE ) {
            g.fillOval(ix - w/2+2, iy - w / 2+2, w-4, w-4 );
        } else { // TYPE_RECTANGLE
            g.fillRect(ix - w/2+2, iy - h / 2+2, w-4, h-4);
        }

        Color textCol = getPaintTextColor(tgPanel);
        g.setColor(textCol);
        showLabel(g,fontMetrics,ix,iy);
//        g.drawString(lbl, ix - fontMetrics.stringWidth(lbl)/2, iy + fontMetrics.getDescent() +1);
    }

    private void showLabel(Graphics g, FontMetrics fontMetrics, int ix, int iy){
      if(lbl.indexOf(" ") == -1 || lbl.length()<=12)
        g.drawString(lbl, ix - fontMetrics.stringWidth(lbl)/2, iy + fontMetrics.getDescent() +1);
        else{
          int middle=lbl.length()/2,leftpoint,rightpoint,breakpoint;
          String leftPart = lbl.substring(0,middle);
          String rightPart = lbl.substring(middle);
          if(leftPart.lastIndexOf(" ") == -1)
            leftpoint=0;
          else
            leftpoint=leftPart.lastIndexOf(" ") ;
          if(rightPart.indexOf(" ") == -1)
            rightpoint=rightPart.length();
          else
            rightpoint=rightPart.indexOf(" ") ;
          if(middle - leftpoint < rightpoint)
            breakpoint = leftpoint;
          else
            breakpoint = middle+rightpoint;

          g.drawString(lbl.substring(0,breakpoint), ix - fontMetrics.stringWidth(lbl.substring(0,breakpoint))/2, iy - fontMetrics.getHeight()/2+fontMetrics.getDescent() +1);
          g.drawString(lbl.substring(breakpoint+1), ix - fontMetrics.stringWidth(lbl.substring(breakpoint+1))/2, iy + fontMetrics.getHeight()/2+fontMetrics.getDescent() +1);
       }


    }

    /** Paints a tag with containing a character in a small font. */
    public void paintSmallTag(Graphics g, TGPanel tgPanel, int tagX, int tagY,
                              Color backCol, Color textCol, char character) {
        g.setColor(backCol);
        g.fillRect(tagX, tagY, 8, 8);
        g.setColor(textCol);
        g.setFont(SMALL_TAG_FONT);
        g.drawString(""+character, tagX+2, tagY+7);
    }

} // end com.compass.conceptmap.Node
