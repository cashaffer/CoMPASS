package com.compass.conceptmap.interaction;

import java.awt.event.AdjustmentEvent;
import java.awt.event.AdjustmentListener;
import java.awt.event.MouseEvent;

import javax.swing.JScrollBar;

import com.compass.conceptmap.GraphListener;
import com.compass.conceptmap.TGAbstractLens;
import com.compass.conceptmap.TGPanel;
import com.compass.conceptmap.TGPoint2D;

/** RotateScroll.  Allows one to rotate the graph by clicking+dragging
  * The rotate lens won't work properly unless it's the top lens, because it
  * does not account for distortion from above lenses.  Methods for getting
  * lenses above the current one need to be added to TGLensSet to solve this problem.
  */
public class RotateScroll implements GraphListener {

    RotateLens rotateLens;
    double rotateAngle;
    RotateDragUI rotateDragUI;
    private DScrollBar rotateSB;
    boolean adjustmentIsInternal;
    private TGPanel tgPanel;

  // ............

    /** Constructor with TGPanel <tt>tgp</tt>.
      */
    public RotateScroll(TGPanel tgp) {
        tgPanel=tgp;
        rotateAngle=0;
        rotateLens=new RotateLens();
         rotateDragUI = new RotateDragUI();
         rotateSB = new DScrollBar(JScrollBar.HORIZONTAL, 0, 4, -314, 318);
         rotateSB.addAdjustmentListener(new rotateAdjustmentListener());
         adjustmentIsInternal=false;
         tgPanel.addGraphListener(this);
    }

    public RotateLens getLens() { return rotateLens; }

    public JScrollBar getRotateSB() { return rotateSB; }

    public RotateDragUI getRotateDragUI() { return rotateDragUI; }

    public int getRotationAngle() {
        double orientedValue = rotateSB.getValue()-rotateSB.getMinimum();
        double range = rotateSB.getMaximum()-rotateSB.getMinimum()-rotateSB.getVisibleAmount();
        return (int) ((orientedValue/range)*359);
    }

    public void setRotationAngle(int angle) {
        double range = rotateSB.getMaximum()-rotateSB.getMinimum()-rotateSB.getVisibleAmount();
        rotateSB.setValue((int) (angle/359.0 * range+0.5)+rotateSB.getMinimum());
    }

    public void graphMoved() {} //From GraphListener interface

    public void graphReset() { rotateAngle=0; rotateSB.setValue(0); } //From GraphListener interface

    private class rotateAdjustmentListener implements AdjustmentListener {
        public void adjustmentValueChanged(AdjustmentEvent e) {
            if(!adjustmentIsInternal) {
                rotateAngle = rotateSB.getDValue()/100.0;
                tgPanel.repaintAfterMove();
            }
        }
    }

    class DScrollBar extends JScrollBar {
        private double doubleValue;

        DScrollBar(int orient, int val, int vis, int min, int max){
            super(orient, val, vis, min, max);
            doubleValue=val;
        }
        public void setValue(int v) { doubleValue = v; super.setValue(v); }
        public void setIValue(int v) { super.setValue(v); }
        public void setDValue(double v) {
            doubleValue = Math.max(getMinimum(),Math.min(getMaximum(),v));
            setIValue((int) v);
        }
        public double getDValue() { return doubleValue;}
    }


    double computeAngle( double x, double y ) {
        double angle=Math.atan(y/x);

        if (x==0)  //There is probably a better way of hangling boundary conditions, but whatever
            if(y>0) angle=Math.PI/2;
            else angle=-Math.PI/2;

        if (x<0) angle+=Math.PI;

        return angle;
    }

    class RotateLens extends TGAbstractLens {
        protected void applyLens(TGPoint2D p) {
            double currentAngle=computeAngle(p.x,p.y);
            double dist=Math.sqrt((p.x*p.x)+(p.y*p.y));

            p.x=dist*Math.cos(currentAngle+rotateAngle);
            p.y=dist*Math.sin(currentAngle+rotateAngle);
        }

        protected void undoLens(TGPoint2D p) {
            double currentAngle=computeAngle(p.x,p.y);
            double dist=Math.sqrt((p.x*p.x)+(p.y*p.y));

            p.x=dist*Math.cos(currentAngle-rotateAngle);
            p.y=dist*Math.sin(currentAngle-rotateAngle);
        }
    }

    public void incrementRotateAngle(double inc) {
        rotateAngle+=inc;
        if (rotateAngle>Math.PI) rotateAngle-=Math.PI*2;
        if (rotateAngle<-Math.PI) rotateAngle+=Math.PI*2;
        adjustmentIsInternal=true;
            rotateSB.setDValue(rotateAngle*100);
        adjustmentIsInternal=false;
    }

    class RotateDragUI extends TGAbstractDragUI { // Will work best if rotate lens is top lens

        RotateDragUI() {
            super(RotateScroll.this.tgPanel);
        }

        double lastAngle;

        double getMouseAngle(double x, double y) {
            return computeAngle(x-this.tgPanel.getDrawCenter().x,
                                y-this.tgPanel.getDrawCenter().y);
        }

        public void preActivate() {}
        public void preDeactivate() {}

        public void mousePressed( MouseEvent e ) {
            lastAngle = getMouseAngle(e.getX(), e.getY());
        }

        public void mouseReleased( MouseEvent e ) {}

        public void mouseDragged( MouseEvent e ) {
            double currentAngle = getMouseAngle(e.getX(), e.getY());
            incrementRotateAngle(currentAngle-lastAngle);
            lastAngle=currentAngle;
            this.tgPanel.repaintAfterMove();
        }
    }

} // end com.compass.conceptmap.interaction.RotateScroll
