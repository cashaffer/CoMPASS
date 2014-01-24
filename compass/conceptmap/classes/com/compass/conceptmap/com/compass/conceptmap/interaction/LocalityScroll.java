package com.compass.conceptmap.interaction;

import java.awt.event.AdjustmentEvent;
import java.awt.event.AdjustmentListener;

import javax.swing.JScrollBar;

import com.compass.conceptmap.GraphListener;
import com.compass.conceptmap.LocalityUtils;
import com.compass.conceptmap.Node;
import com.compass.conceptmap.TGException;
import com.compass.conceptmap.TGPanel;

public class LocalityScroll implements GraphListener {

    private JScrollBar localitySB;

    private TGPanel tgPanel;

    public LocalityScroll(TGPanel tgp) {
        tgPanel=tgp;
        localitySB = new JScrollBar(JScrollBar.HORIZONTAL, 2, 1, 0, 7);
        localitySB.setBlockIncrement(1);
        localitySB.setUnitIncrement(1);
        localitySB.addAdjustmentListener(new localityAdjustmentListener());
        tgPanel.addGraphListener(this);
    }

    public JScrollBar getLocalitySB() {
        return localitySB;
    }

    public int getLocalityRadius() {
        int locVal = localitySB.getValue();
        if(locVal>=6) return LocalityUtils.INFINITE_LOCALITY_RADIUS;
        else return locVal;
    }

    public void setLocalityRadius(int radius) {
        if (radius <= 0 )
            localitySB.setValue(0);
        else if (radius <= 5) //and > 0
            localitySB.setValue(radius);
        else // radius > 5
            localitySB.setValue(6);
    }

    public void graphMoved() {} //From GraphListener interface
    public void graphReset() { localitySB.setValue(2); } //From GraphListener interface

    private class localityAdjustmentListener implements AdjustmentListener {
        public void adjustmentValueChanged(AdjustmentEvent e) {
            Node select = tgPanel.getSelect();
            if (select!=null || getLocalityRadius() == LocalityUtils.INFINITE_LOCALITY_RADIUS)
                try {
                    tgPanel.setLocale(select, getLocalityRadius());
                }
                catch (TGException ex) {
                    System.out.println("Error setting locale");
                    ex.printStackTrace();
                }
        }
    }

} // end com.compass.conceptmap.interaction.LocalityScroll
