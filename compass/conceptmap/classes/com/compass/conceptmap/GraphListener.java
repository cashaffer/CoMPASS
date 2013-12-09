package com.compass.conceptmap;
import java.util.EventListener;

public interface GraphListener extends EventListener{

    void graphMoved();
    void graphReset();

} // end com.compass.conceptmap.GraphListener
