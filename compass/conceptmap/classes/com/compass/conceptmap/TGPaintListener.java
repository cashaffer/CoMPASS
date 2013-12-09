
package com.compass.conceptmap;

import java.awt.Graphics;
import java.util.EventListener;

public interface TGPaintListener extends EventListener{

    void paintFirst(Graphics g);
    void paintAfterEdges(Graphics g);
    void paintLast(Graphics g);

} // end com.compass.conceptmap.TGPaintListener
