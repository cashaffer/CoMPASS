(provide family)
(provide topic)
(provide concept)


(deftemplate family
    "A topic belongs to exactly one family."
    (slot name)
    (multislot concepts)) 

(deftemplate topic
    "A specific topic."
    (slot name)
    (slot family)
    (slot goal (default false)))

(deftemplate concept
    "A specific concept. Could be in any topic."
    (slot name))


;;;Facts describing the concept map
(deffacts about-families
    (family 
        (name ip) 
        (concepts Power Work Distance Efficiency Energy Force Friction Gravity Kinetic-energy Ma Potential-energy )) 
    (family 
        (name lever) 
        (concepts Power Work Distance Efficiency Energy Force Friction Gravity Kinetic-energy Ma Potential-energy )) 
)
(deffacts about-topics
    (topic
        (name Inclined-Plane)
        (family ip))
    (topic
        (name Wedge)
        (family ip))
    (topic
        (name Screw)
        (family ip))
    (topic
        (name Lever)
        (family lever))
    (topic
        (name Pulley)
        (family lever))
    (topic
        (name Wheel-and-Axle)
        (family lever))       
    )


(deffacts about-concepts
    (concept (name Power))
    (concept (name Work))
    (concept (name Distance))
    (concept (name Efficiency))
    (concept (name Energy))
    (concept (name Force))
    (concept (name Friction))
    (concept (name Gravity))
    (concept (name Kinetic-energy))
    (concept (name Ma))
    (concept (name Potential-energy))        
    ) ; and more
    

