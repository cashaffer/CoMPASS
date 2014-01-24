package com.compass.conceptmap.navigation;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2005</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

import java.awt.Color;
import java.awt.FontMetrics;
import java.awt.Graphics;
import java.awt.Rectangle;

import javax.swing.ButtonModel;
import javax.swing.JComponent;
import javax.swing.plaf.ComponentUI;
import javax.swing.plaf.metal.MetalButtonUI;

public class BasicLinkButtonUI extends MetalButtonUI
{

    private static final BasicLinkButtonUI A = new BasicLinkButtonUI();

    public BasicLinkButtonUI()
    {
    }

    public static ComponentUI createUI(JComponent jcomponent)
    {
        return A;
    }

    protected void paintText(Graphics g, JComponent jcomponent, Rectangle rectangle, String s)
    {
        LinkButton jlinkbutton = (LinkButton)jcomponent;
        ButtonModel buttonmodel = jlinkbutton.getModel();
        Color color = jlinkbutton.getForeground();
        Object obj = null;
        if(buttonmodel.isEnabled())
        {
            Color color1;
            if(buttonmodel.isPressed())
                color1 = jlinkbutton.getActiveLinkColor();
            else
            if(jlinkbutton.isLinkVisited())
                color1 = jlinkbutton.getVisitedLinkColor();
            else
                color1 = jlinkbutton.getLinkColor();
            if(color1 != null)
                jlinkbutton.setForeground(color1);
        } else
        {
            Color color2 = jlinkbutton.getDisabledLinkColor();
            if(color2 != null)
                jlinkbutton.setForeground(color2);
        }
        super.paintText(g, jcomponent, rectangle, s);
        int i = jlinkbutton.getLinkBehavior();
        boolean flag = false;
        if(i == 1)
        {
            if(buttonmodel.isRollover())
                flag = true;
        } else
        if(i == 0 || i == 3)
            flag = true;
        if(!flag)
            return;
        FontMetrics fontmetrics = g.getFontMetrics();
        int j = rectangle.x + getTextShiftOffset();
        int k = (rectangle.y + fontmetrics.getAscent() + fontmetrics.getDescent() + getTextShiftOffset()) - 1;
        if(buttonmodel.isEnabled())
        {
            g.setColor(jlinkbutton.getForeground());
            g.drawLine(j, k, (j + rectangle.width) - 1, k);
        } else
        {
            g.setColor(jlinkbutton.getBackground().brighter());
            g.drawLine(j, k, (j + rectangle.width) - 1, k);
        }
    }

}
