
package com.compass.conceptmap;

import java.awt.Point;

import com.compass.conceptmap.interaction.HVScroll;
import com.compass.conceptmap.interaction.HyperScroll;
import com.compass.conceptmap.interaction.LocalityScroll;
import com.compass.conceptmap.interaction.RotateScroll;
import com.compass.conceptmap.interaction.ZoomScroll;

public interface TGScrollPane {

    /** Return the TGPanel used with this TGScrollPane. */
    public TGPanel getTGPanel();

  // navigation .................

    /** Return the HVScroll used with this TGScrollPane. */
    public HVScroll getHVScroll();

    /** Return the HyperScroll used with this TGScrollPane. */
    public HyperScroll getHyperScroll();

    /** Sets the horizontal offset to p.x, and the vertical offset to p.y
      * given a Point <tt>p<tt>.
      */
    public void setOffset( Point p );

    /** Return the horizontal and vertical offset position as a Point. */
    public Point getOffset();

  // rotation ...................

    /** Return the RotateScroll used with this TGScrollPane. */
    public RotateScroll getRotateScroll();

    /** Set the rotation angle of this TGScrollPane (allowable values between 0 to 359). */
     public void setRotationAngle( int angle );

    /** Return the rotation angle of this TGScrollPane. */
    public int getRotationAngle();

  // locality ...................

    /** Return the LocalityScroll used with this TGScrollPane. */
    public LocalityScroll getLocalityScroll();

    /** Set the locality radius of this TGScrollPane
      * (allowable values between 0 to 4, or LocalityUtils.INFINITE_LOCALITY_RADIUS).
      */
    public void setLocalityRadius( int radius );

    /** Return the locality radius of this TGScrollPane. */
    public int getLocalityRadius();

  // zoom .......................

    /** Return the ZoomScroll used with this TGScrollPane. */
    public ZoomScroll getZoomScroll();

    /** Set the zoom value of this TGScrollPane (allowable values between -100 to 100). */
    public void setZoomValue( int zoomValue );

    /** Return the zoom value of this TGScrollPane. */
    public int getZoomValue();

} // end com.compass.conceptmap.TGScrollPane
