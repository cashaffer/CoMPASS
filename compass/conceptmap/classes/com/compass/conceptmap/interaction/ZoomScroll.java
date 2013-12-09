package com.compass.conceptmap.interaction;

import java.awt.event.AdjustmentEvent;
import java.awt.event.AdjustmentListener;

import javax.swing.JScrollBar;

import com.compass.conceptmap.GraphListener;
import com.compass.conceptmap.TGAbstractLens;
import com.compass.conceptmap.TGPanel;
import com.compass.conceptmap.TGPoint2D;

/** ZoomScroll:  Contains code for enlarging the graph by zooming in.
  */
public class ZoomScroll implements GraphListener {

    protected ZoomLens zoomLens;
    private JScrollBar zoomSB;
    private TGPanel tgPanel;

  // ............

   /** Constructor with TGPanel <tt>tgp</tt>.
     */
    public ZoomScroll( TGPanel tgp ) {
        tgPanel=tgp;
        zoomSB = new JScrollBar(JScrollBar.HORIZONTAL, -10, 4, -31, 19);
        zoomSB.addAdjustmentListener(new zoomAdjustmentListener());
        zoomLens=new ZoomLens();
        tgPanel.addGraphListener(this);
    }

    public JScrollBar getZoomSB() { return zoomSB; }

    public ZoomLens getLens() { return zoomLens; }

    public void graphMoved() {} //From GraphListener interface
    public void graphReset() { zoomSB.setValue(-10); } //From GraphListener interface

    public int getZoomValue() {
        double orientedValue = zoomSB.getValue()-zoomSB.getMinimum();
        double range = zoomSB.getMaximum()-zoomSB.getMinimum()-zoomSB.getVisibleAmount();
        return (int) ((orientedValue/range)*200-100);
    }

    public void setZoomValue(int value) {
        double range = zoomSB.getMaximum()-zoomSB.getMinimum()-zoomSB.getVisibleAmount();
        zoomSB.setValue((int) ((value+100)/200.0 * range+0.5)+zoomSB.getMinimum());
    }

    private class zoomAdjustmentListener implements AdjustmentListener {
        public void adjustmentValueChanged(AdjustmentEvent e) {
        tgPanel.repaintAfterMove();
        }
    }

    class ZoomLens extends TGAbstractLens {
        protected void applyLens(TGPoint2D p) {
            p.x=p.x*Math.pow(2,zoomSB.getValue()/10.0);
            p.y=p.y*Math.pow(2,zoomSB.getValue()/10.0);

        }

        protected void undoLens(TGPoint2D p) {
            p.x=p.x/Math.pow(2,zoomSB.getValue()/10.0);
            p.y=p.y/Math.pow(2,zoomSB.getValue()/10.0);
        }
    }

} // end com.compass.conceptmap.interaction.ZoomScroll
