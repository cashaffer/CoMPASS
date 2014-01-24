package com.compass.conceptmap.navigation;

/**
 * <p>Title: </p>
 * <p>Description: </p>
 * <p>Copyright: Copyright (c) 2005</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */

// Decompiled by Jad v1.5.7g. Copyright 2000 Pavel Kouznetsov.
// Jad home page: http://www.geocities.com/SiliconValley/Bridge/8617/jad.html
// Decompiler options: packimports(3) fieldsfirst ansi


import java.awt.Color;
import java.awt.Cursor;
import java.net.URL;

import javax.swing.Action;
import javax.swing.JButton;
import javax.swing.UIManager;

// Referenced classes of package com.zfqjava.swing:
//            A

public class LinkButton extends JButton
{

    private static final String C = "LinkButtonUI";
    public static final int ALWAYS_UNDERLINE = 0;
    public static final int HOVER_UNDERLINE = 1;
    public static final int NEVER_UNDERLINE = 2;
    public static final int SYSTEM_DEFAULT = 3;
    private int B;
    private Color D;
    private Color H;
    private Color E;
    private Color F;
    private URL A;
    private Action G;
    private boolean I;


    public LinkButton(String s)
    {
        super(s);
        B = 3;
        D = Color.blue;
        H = Color.red;
        E = new Color(128, 0, 128);
        setCursor(Cursor.getPredefinedCursor(12));
        setBorderPainted(false);
        setContentAreaFilled(false);
        setRolloverEnabled(true);
    }

    public void updateUI()
    {
        setUI(BasicLinkButtonUI.createUI(this));
    }

    private void A()
    {
        UIManager.getDefaults().put("LinkButtonUI", "com.compass.conceptmap.navigation.BasicLinkButtonUI");
    }

    public String getUIClassID()
    {
        return "LinkButtonUI";
    }

    protected void setupToolTipText()
    {
        String s = null;
        if(A != null)
            s = A.toExternalForm();
        setToolTipText(s);
    }

    public void setLinkBehavior(int i)
    {
        A(i);
        int j = B;
        B = i;
        firePropertyChange("linkBehavior", j, i);
        repaint();
    }

    private void A(int i)
    {
        if(i != 0 && i != 1 && i != 2 && i != 3)
            throw new IllegalArgumentException("Not a legal LinkBehavior");
        else
            return;
    }

    public int getLinkBehavior()
    {
        return B;
    }

    public void setLinkColor(Color color)
    {
        Color color1 = D;
        D = color;
        firePropertyChange("linkColor", color1, color);
        repaint();
    }

    public Color getLinkColor()
    {
        return D;
    }

    public void setActiveLinkColor(Color color)
    {
        Color color1 = H;
        H = color;
        firePropertyChange("activeLinkColor", color1, color);
        repaint();
    }

    public Color getActiveLinkColor()
    {
        return H;
    }

    public void setDisabledLinkColor(Color color)
    {
        Color color1 = F;
        F = color;
        firePropertyChange("disabledLinkColor", color1, color);
        if(!isEnabled())
            repaint();
    }

    public Color getDisabledLinkColor()
    {
        return F;
    }

    public void setVisitedLinkColor(Color color)
    {
        Color color1 = E;
        E = color;
        firePropertyChange("visitedLinkColor", color1, color);
        repaint();
    }

    public Color getVisitedLinkColor()
    {
        return E;
    }

    public URL getLinkURL()
    {
        return A;
    }

    public void setLinkURL(URL url)
    {
        URL url1 = A;
        A = url;
        setupToolTipText();
        firePropertyChange("linkURL", url1, url);
        revalidate();
        repaint();
    }

    public void setLinkVisited(boolean flag)
    {
        boolean flag1 = I;
        I = flag;
        firePropertyChange("linkVisited", flag1, flag);
        repaint();
    }

    public boolean isLinkVisited()
    {
        return I;
    }

    public void setDefaultAction(Action action)
    {
        Action action1 = G;
        G = action;
        firePropertyChange("defaultAction", action1, action);
    }

    public Action getDefaultAction()
    {
        return G;
    }


    protected String paramString()
    {
        String s;
        if(B == 0)
            s = "ALWAYS_UNDERLINE";
        else
        if(B == 1)
            s = "HOVER_UNDERLINE";
        else
        if(B == 2)
            s = "NEVER_UNDERLINE";
        else
            s = "SYSTEM_DEFAULT";
        String s1 = D == null ? "" : D.toString();
        String s2 = H == null ? "" : H.toString();
        String s3 = F == null ? "" : F.toString();
        String s4 = E == null ? "" : E.toString();
        String s5 = A == null ? "" : A.toString();
        String s6 = I ? "true" : "false";
        return super.paramString() + ",linkBehavior=" + s + ",linkURL=" + s5 + ",linkColor=" + s1 + ",activeLinkColor=" + s2 + ",disabledLinkColor=" + s3 + ",visitedLinkColor=" + s4 + ",linkvisitedString=" + s6;
    }

}
