package com.compass.conceptmap;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.FontMetrics;
import java.awt.Graphics;
import java.awt.Polygon;

public class Edge {

    public static Color DEFAULT_COLOR = Color.decode("#0000B0");
    public static Color MOUSE_OVER_COLOR = Color.red;
    public static Color MOUSE_OVER_NODE_RELATE_EDGE=Color.orange;
    public static int DEFAULT_LENGTH = 80;

    public Node from; //Should be private, changing from effects "from" Node
    public Node to;   //Should be private, changing from effects "to" Node
    protected Color col;
    protected int length;
    protected boolean visible;
    protected String id = null;
    protected String label=null;
    protected String comments=null;
    protected int fromx,fromy,tox,toy;

    /** Constructor with two Nodes and a length. and a label
      */
    public Edge(Node f, Node t, int len, String label, String comments) {
        from = f;
        to = t;
        length = len;
        col = DEFAULT_COLOR;
        visible = false;
        this.label = label;
        if (this.label == null){
          this.label = "";
          comments = null;
        }
        else
          this.comments=comments;
    }
    public Edge(Node f, Node t, int len, String label) {
        from = f;
        to = t;
        length = len;
        col = DEFAULT_COLOR;
        visible = false;
        this.label = label;
        if (this.label == null){
          this.label = "";
        }
    }

  // ............

    /** Constructor with two Nodes and a length.
      */
    public Edge(Node f, Node t, int len) {
        from = f;
        to = t;
        length = len;
        col = DEFAULT_COLOR;
        visible = false;
        label = "";
    }

    /** Constructor with two Nodes, which uses a default length.
      */
    public Edge(Node f, Node t) {
        this(f, t, DEFAULT_LENGTH);
    }

   // setters and getters ...............

    public static void setEdgeDefaultColor( Color color ) { DEFAULT_COLOR = color; }
    public static void setEdgeMouseOverColor( Color color ) { MOUSE_OVER_COLOR = color; }
    public static void setEdgeDefaultLength( int length ) { DEFAULT_LENGTH = length; }

   /** Returns the starting "from" node of this edge as Node. */
    public Node getFrom() { return from; }

   /** Returns the terminating "to" node of this edge as Node. */
    public Node getTo() { return to; }

   /** Returns the color of this edge as Color. */
    public Color getColor() {
        return col;
    }

   /** Set the color of this Edge to the Color <tt>color</tt>. */
    public void setColor( Color color ) {
        col = color;
    }

   /** Returns the ID of this Edge as a String. */
    public String getID()
    {
        return id;
    }

   /** Set the ID of this Edge to the String <tt>id</tt>. */
    public void setID( String id )
    {
        this.id=id;
    }

   /** Returns the length of this Edge as a double. */
    public int getLength() {
        return length;
    }

   /** Set the length of this Edge to the int <tt>len</tt>. */
    public void setLength(int len) {
        length=len;
    }

   /** Set the visibility of this Edge to the boolean <tt>v</tt>. */
    public void setVisible( boolean v) {
        visible = v;
    }

   /** Return the visibility of this Edge as a boolean. */
    public boolean isVisible() {
        return visible;
    }

    public Node getOtherEndpt(Node n) { //yields false results if Node n is not an endpoint
        if (to != n) return to;
        else return from;
    }

    /** Switches the endpoints of the edge */
    public void reverse() {
        Node temp = to;
        to = from;
        from = temp;
    }

    public boolean intersects(Dimension d) {
        int x1 = (int) from.drawx;
        int y1 = (int) from.drawy;
        int x2 = (int) to.drawx;
        int y2 = (int) to.drawy;

        return (((x1>0 || x2>0) && (x1<d.width  || x2<d.width)) &&
                  ((y1>0 || y2>0) && (y1<d.height || y2<d.height) ));

    }

    public double distFromPoint(double px, double py) {
        double x1= from.drawx;
        double y1= from.drawy;
        double x2= to.drawx;
        double y2= to.drawy;

        if (px<Math.min(x1, x2)-8 || px>Math.max(x1, x2)+8 ||
            py<Math.min(y1, y2)-8 || py>Math.max(y1, y2)+8)
            return 1000;

        double dist = 1000;
        if (x1-x2!=0) dist = Math.abs((y2-y1)/(x2-x1)*(px - x1) + (y1 - py));
        if (y1-y2!=0) dist = Math.min(dist, Math.abs((x2-x1)/(y2-y1)*(py - y1) + (x1 - px)));

        return dist;
    }

    public boolean containsPoint(double px, double py) {
        return distFromPoint(px,py)<10;
    }

    public void getPosition(){
      double x1= from.drawx;
      double y1= from.drawy;
      double x2= to.drawx;
      double y2= to.drawy;
      double h1= from.getHeight();
      double w1= from.getWidth();
      double h2= to.getHeight();
      double w2= to.getWidth();
      if(x1 != x2 ){
        double tan=(y2-y1)/(x2-x1);
        if(h1/w1>Math.abs(tan)){
          if(x2>x1)
            fromx=(int)(x1+w1/2.0);
          else
            fromx=(int)(x1-w1/2.0);

            fromy=(int) (y1+(fromx-x1)*tan);
        }
        else{
          if(y2>y1)
           fromy=(int)(y1+h1/2.0);
         else
           fromy=(int)(y1-h1/2.0);

           fromx=(int) (x1+(fromy-y1)/tan);
        }
        if(h2/w2>Math.abs(tan)){
          if(x2>x1)
            tox=(int)(x2-w2/2.0);
          else
            tox=(int)(x2+w2/2.0);

            toy=(int) (y2+(tox-x2)*tan);
        }
        else{
          if(y2>y1)
            toy=(int)(y2-h2/2.0);
          else
            toy=(int)(y2+h2/2.0);

            tox=(int) (x2+(toy-y2)/tan);
        }
      }
      else{
        fromx=(int) x1;
        tox=(int) x2;
        if(y1<y2){
          fromy=(int)(y1+h1/2.0);
          toy=(int) (y2-h2/2.0);
        }
        else{
          fromy=(int)(y1-h1/2.0);
          toy=(int) (y2+h2/2.0);
        }
      }

    }
    public void paintLabel(Graphics g, int x1, int y1, int x2, int y2, Font font, boolean mouseOver) {
      FontMetrics fontMetrics;
      g.setFont(font);
      fontMetrics = g.getFontMetrics();
      int width = fontMetrics.stringWidth(label) ;
      int height = fontMetrics.getHeight();
      int baseX, baseY;
      baseX =(int) (x1+(x2-x1)*0.5-width/2.0);
      baseY =(int) (y1+(y2-y1)*0.5);
      if(x2!=x1){
        if (Math.abs( (y2 - y1) * 1.0 / (x2 - x1)) < Math.tan(Math.PI / 36.0) ) {
          if (y2 <= y1)
              baseY = -height/2 + y2;
          else
              baseY = -height/2 + y1;
        }
        else if (Math.abs( (y2 - y1) * 1.0 / (x2 - x1)) < Math.tan(Math.PI / 18.0) ) {
          if (y2 <= y1)
              baseY = -height/3 + y2;
          else
              baseY = -height/3 + y1;
        }

        else if (Math.abs( (y2 - y1) * 1.0 / (x2 - x1)) < Math.tan(Math.PI / 9.0)) {
          if (y2 < y1)
              baseY = y2;
          else
              baseY = y1;
        }
        else {
          if(from.depth<to.depth){
            if (x2 > x1) {
              baseX = (int) (x1 + (x2 - x1) * 0.6);
              baseY = (int) (y1 + (y2 - y1) * 0.6);
            }
            else{
              baseX = (int) (x1 + (x2 - x1) * 0.6)-width;
              baseY = (int) (y1 + (y2 - y1) * 0.6);
            }
          }
          else if(from.depth == to.depth){
            if((x1+x2)/2>260){
              baseX =(int) (x1+(x2-x1)*0.6);
              baseY =(int) (y1+(y2-y1)*0.6);
            }
            else{
              baseX = (int) (x1 + (x2 - x1) * 0.6)-width;
              baseY = (int) (y1 + (y2 - y1) * 0.6);
            }
          }
          else{
            if (x2 > x1) {
              baseX = (int) (x1 + (x2 - x1) * 0.6)-width;
              baseY = (int) (y1 + (y2 - y1) * 0.6);
            }
            else{
              baseX = (int) (x1 + (x2 - x1) * 0.6);
              baseY = (int) (y1 + (y2 - y1) * 0.6);
            }
          }
        }
      }
      else{
        if((x1+x2)/2>260){
          baseX =(int) (x1+(x2-x1)*0.6);
          baseY =(int) (y1+(y2-y1)*0.6);
        }
        else{
          baseX = (int) (x1 + (x2 - x1) * 0.6)-width;
          baseY = (int) (y1 + (y2 - y1) * 0.6);
        }
      }
     g.setColor(new Color(60,90,40));
     g.drawString(label,baseX,baseY);
     if(mouseOver)
       if(comments != null)
         if(!comments.equals(""))
       paintComments(g,comments,baseX,baseY+height);
    }

    private void paintComments(Graphics g, String comments, int x1, int y1){
      Font commentFont = new Font("Arial Narrow", Font.PLAIN, 10);
      g.setFont(commentFont);
      FontMetrics fontMetrics = g.getFontMetrics();
      int width = fontMetrics.stringWidth(comments) + 4;
      int height = fontMetrics.getHeight() + 2;
      g.setColor(new Color(250,250,180));
      g.fillRoundRect(x1-2, y1-height+1, width, height, 2, 2);
      g.setColor(Color.black);
      g.drawRoundRect(x1-2, y1-height+1, width, height, 2, 2);
      g.drawString(comments,x1,y1);
    }

    public static void paintArrow(Graphics g, int x1, int y1, int x2, int y2, Color c) {
        //Forget hyperbolic bending for now

        g.setColor(c);

        double x3=(x2+x1)/2.0;
        double y3=(y2+y1)/2.0;

        int[] trianglex= new int[3];
        int[] triangley= new int[3];
        double angle;

        if(x2!=x1){
          angle=Math.atan((y2-y1)*1.0/(x2-x1));
          if(x2<x1)
            angle+=Math.PI;
        }
        else{
            if (y2 > y1)
              angle = Math.PI / 2;
            else
              angle = Math.PI / -2;
        }

          trianglex[0]=(int)(x3+4.0*Math.cos(angle));
          triangley[0]=(int)(y3+4.0*Math.sin(angle));
          trianglex[1]=(int) (x3+8.0*Math.cos(angle+7.0/8*Math.PI));
          triangley[1]=(int) (y3+8.0*Math.sin(angle+7.0/8*Math.PI));
          trianglex[2]=(int) (x3+8.0*Math.cos(angle+9.0/8*Math.PI));
          triangley[2]=(int) (y3+8.0*Math.sin(angle+9.0/8*Math.PI));

          Polygon p=new Polygon(trianglex,triangley,3);
          g.fillPolygon(p);

        g.drawLine((int)x1,   (int)y1,   (int)x2, (int)y2);

/*
        g.drawLine(x1,   y1,   x3, y3);
        g.drawLine(x1+1, y1,   x3, y3);
        g.drawLine(x1+2, y1,   x3, y3);
        g.drawLine(x1+3, y1,   x3, y3);
        g.drawLine(x1+4, y1,   x3, y3);
        g.drawLine(x1-1, y1,   x3, y3);
        g.drawLine(x1-2, y1,   x3, y3);
        g.drawLine(x1-3, y1,   x3, y3);
        g.drawLine(x1-4, y1,   x3, y3);
        g.drawLine(x1,   y1+1, x3, y3);
        g.drawLine(x1,   y1+2, x3, y3);
        g.drawLine(x1,   y1+3, x3, y3);
        g.drawLine(x1,   y1+4, x3, y3);
        g.drawLine(x1,   y1-1, x3, y3);
        g.drawLine(x1,   y1-2, x3, y3);
        g.drawLine(x1,   y1-3, x3, y3);
        g.drawLine(x1,   y1-4, x3, y3);
*/
  }

    public void paint(Graphics g, TGPanel tgPanel) {
      int fontSize = 9;
      boolean mouseOver = false;
      if(tgPanel.getMouseOverE()==this){
        fontSize += 1;
        mouseOver = true;
      }

        Color c = (mouseOver) ? MOUSE_OVER_COLOR : col;
        Node mouseOverN=tgPanel.getMouseOverN();
        if(mouseOverN==this.from||mouseOverN==this.to){
          c = MOUSE_OVER_NODE_RELATE_EDGE;
          fontSize +=1;
        }
        if (tgPanel.getSelect() == this.from || tgPanel.getSelect() == this.to)
          fontSize += 1;
        Font labelFont = new Font("Arial Narrow", Font.PLAIN, fontSize);
        getPosition();
        if (intersects(tgPanel.getSize())) {
          paintArrow(g, fromx, fromy, tox, toy, c);
          paintLabel(g, fromx, fromy, tox, toy, labelFont, mouseOver);
/*
          g.clearRect(50+200,30+200,80,20);
          g.setColor(new Color(255,255,220));
          g.fillRect(50+200,30+200,80,20);
          g.setColor(Color.black);
         g.drawString("tips",55+200,45+200);
         g.drawRect(50+200,30+200,80,20);
*/
       }
    }

} // end com.compass.conceptmap.Edge
