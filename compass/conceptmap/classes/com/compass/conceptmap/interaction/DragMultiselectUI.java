package com.compass.conceptmap.interaction;

import java.awt.Color;
import java.awt.Graphics;
import java.awt.event.MouseEvent;

import com.compass.conceptmap.TGPaintListener;
import com.compass.conceptmap.TGPanel;
import com.compass.conceptmap.TGPoint2D;

/** DragMultiselectUI contains code for selecting a group on nodes
  * by enclosing them in a dotted box.
  *
  */
public class DragMultiselectUI extends TGAbstractDragUI implements TGPaintListener {

    TGPoint2D mousePos=null;
    TGPoint2D startPos = null;

    DragMultiselectUI( TGPanel tgp ) {
        super(tgp);
    }

    public void preActivate() {
        startPos = null;
        mousePos = null;
        tgPanel.addPaintListener(this);
    }

    public void preDeactivate() {
        tgPanel.removePaintListener(this);
        tgPanel.repaint();
    };


    public void mousePressed(MouseEvent e) {
        startPos = new TGPoint2D(e.getX(), e.getY());
        mousePos = new TGPoint2D(startPos);
    }


    public void mouseReleased(MouseEvent e) {}

    public void mouseDragged(MouseEvent e) {
        mousePos.setLocation(e.getX(), e.getY());
        tgPanel.multiSelect(startPos,mousePos);
        tgPanel.repaint();
    }



    public void paintFirst(Graphics g) {};
    public void paintAfterEdges(Graphics g) {};

    public void paintLast(Graphics g) {

        if(mousePos==null) return;

        g.setColor(Color.black);

        int x,y,w,h;

        if (startPos.x<mousePos.x) {
            x=(int) startPos.x;
            w=(int) (mousePos.x-startPos.x);
        }
        else {
            x=(int) mousePos.x;
            w=(int) (startPos.x-mousePos.x);
        }

        if (startPos.y<mousePos.y) {
            y=(int) startPos.y;
            h=(int) (mousePos.y-startPos.y);
        }
        else {
            y=(int) mousePos.y;
            h=(int) (startPos.y-mousePos.y);
        }

        //God, where are the line styles when you need them
        for(int horiz = x;horiz<x+w;horiz+=2){
            g.drawLine(horiz,y,horiz,y);      //Drawing lines because there is no way
            g.drawLine(horiz,y+h,horiz,y+h);  //to draw a single pixel.
        }
        for(int vert = y;vert<y+h;vert+=2){
            g.drawLine(x,vert,x,vert);
            g.drawLine(x+w,vert,x+w,vert);
        }

    }

} // end
