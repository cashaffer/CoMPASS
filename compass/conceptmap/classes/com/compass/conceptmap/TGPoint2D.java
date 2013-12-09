
package com.compass.conceptmap;

public class TGPoint2D {

    public double x,y;

    public TGPoint2D( double xpos, double ypos ) {
        x=xpos;
        y=ypos;
    }

    public TGPoint2D( TGPoint2D p ) {
        x=p.x;
        y=p.y;
    }

    public void setLocation( double xpos,double ypos ) {
        x=xpos;
        y=ypos;
    }

    public void setX( double xpos ) { x=xpos; }
    public void setY( double ypos ) { y=ypos; }

} // end com.compass.conceptmap.TGPoint2D
