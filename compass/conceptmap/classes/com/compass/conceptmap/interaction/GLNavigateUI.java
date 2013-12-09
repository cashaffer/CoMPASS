package com.compass.conceptmap.interaction;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

import javax.swing.JMenuItem;
import javax.swing.JPopupMenu;
import javax.swing.event.PopupMenuEvent;
import javax.swing.event.PopupMenuListener;

import com.compass.conceptmap.Edge;
import com.compass.conceptmap.GLPanel;
import com.compass.conceptmap.Node;
import com.compass.conceptmap.TGPanel;

/**
 *
 * <p>Title: </p>
 * <p>Description: Add mouse listener to capture the click on non-centered node</p>
 * <p>Copyright: Copyright (c) 2006</p>
 * <p>Company: </p>
 * @author not attributable
 * @version 1.0
 */
public class GLNavigateUI extends TGUserInterface {

    GLPanel glPanel;
    TGPanel tgPanel;

    GLNavigateMouseListener ml;

    TGAbstractDragUI hvDragUI;
    TGAbstractDragUI rotateDragUI;
    //TGAbstractDragUI hvRotateDragUI;

    TGAbstractClickUI hvScrollToCenterUI;
    DragNodeUI dragNodeUI;
    LocalityScroll localityScroll;
    JPopupMenu nodePopup;
    JPopupMenu edgePopup;
    Node popupNode;
    Edge popupEdge;

    public GLNavigateUI( GLPanel glp ) {
        glPanel = glp;
        tgPanel = glPanel.getTGPanel();

//        localityScroll = glPanel.getLocalityScroll();
//        hvDragUI = glPanel.getHVScroll().getHVDragUI();
//        rotateDragUI = glPanel.getRotateScroll().getRotateDragUI();
        //hvRotateDragUI = new HVRotateDragUI(tgPanel,
        //        glPanel.getHVScroll(), glPanel.getRotateScroll());
//        hvScrollToCenterUI = glPanel.getHVScroll().getHVScrollToCenterUI();
        dragNodeUI = new DragNodeUI(tgPanel);

        ml = new GLNavigateMouseListener();
//        setUpNodePopup();
//        setUpEdgePopup();
    }

    public void activate() {
        tgPanel.addMouseListener(ml);
    }

    public void deactivate() {
        tgPanel.removeMouseListener(ml);
    }

    class GLNavigateMouseListener extends MouseAdapter {


       public void mouseClicked(MouseEvent e) {
            Node mouseOverN = tgPanel.getMouseOverN();
            if (e.getModifiers() == MouseEvent.BUTTON1_MASK) {
                if ( mouseOverN != null) {
                  tgPanel.remap(mouseOverN);
                }
            }
        }

    }

    private void setUpNodePopup() {
        nodePopup = new JPopupMenu();
        JMenuItem menuItem;

        menuItem = new JMenuItem("Expand Node");
        ActionListener expandAction = new ActionListener() {
                public void actionPerformed(ActionEvent e) {
                    if(popupNode!=null) {
                        tgPanel.expandNode(popupNode);
                    }
                }
            };

        menuItem.addActionListener(expandAction);
        nodePopup.add(menuItem);

        menuItem = new JMenuItem("Collapse Node");
        ActionListener collapseAction = new ActionListener() {
                public void actionPerformed(ActionEvent e) {
                    if(popupNode!=null) {
                        tgPanel.collapseNode(popupNode );
                    }
                }
            };

        menuItem.addActionListener(collapseAction);
        nodePopup.add(menuItem);

        menuItem = new JMenuItem("Hide Node");
        ActionListener hideAction = new ActionListener() {
                public void actionPerformed(ActionEvent e) {
                    if(popupNode!=null) {
                        tgPanel.hideNode(popupNode );
                    }
                }
            };

        menuItem.addActionListener(hideAction);
        nodePopup.add(menuItem);

        nodePopup.addPopupMenuListener(new PopupMenuListener() {
            public void popupMenuCanceled(PopupMenuEvent e) {}
            public void popupMenuWillBecomeInvisible(PopupMenuEvent e) {
                tgPanel.setMaintainMouseOver(false);
                tgPanel.setMouseOverN(null);
                tgPanel.repaint();
            }
            public void popupMenuWillBecomeVisible(PopupMenuEvent e) {}
        });

    }

    private void setUpEdgePopup() {
        edgePopup = new JPopupMenu();
        JMenuItem menuItem;

        menuItem = new JMenuItem("Hide Edge");
        ActionListener hideAction = new ActionListener() {
                public void actionPerformed(ActionEvent e) {
                    if(popupEdge!=null) {
                        tgPanel.hideEdge(popupEdge);
                    }
                }
            };

        menuItem.addActionListener(hideAction);
        edgePopup.add(menuItem);

        edgePopup.addPopupMenuListener(new PopupMenuListener() {
            public void popupMenuCanceled(PopupMenuEvent e) {}
            public void popupMenuWillBecomeInvisible(PopupMenuEvent e) {
                tgPanel.setMaintainMouseOver(false);
                tgPanel.setMouseOverE(null);
                tgPanel.repaint();
            }
            public void popupMenuWillBecomeVisible(PopupMenuEvent e) {}
        });
    }

} // end com.compass.conceptmap.interaction.GLNavigateUI
