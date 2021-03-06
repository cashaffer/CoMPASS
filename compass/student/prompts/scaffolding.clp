;(clear) -- Java applet will pass some values, we dont want to clear them.

;certainty factors
(require oav cf.clp)

;domain model: the concept map
(require concept cmap.clp)

; for rounding the cf
(import java.math.*)

; send back strings to Java applet code
; works only with signed applets because of use of java.lang.Reflection
(deffunction sendback (?v)
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store O ((fetch O) concat ?str) ) 
    )

;; for java and php to know what prompts were triggered.
(deffunction prompts-triggered (?v)
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store P ((fetch P) concat ?str) )
    (store P ((fetch P) concat ". ") ) 
    )

;; THE FOLLOWING IS NEW: (GWS)
;; for java and php to know what cluster CF values are
(defrule store-cluster-1
    (oav (o pattern) (a cluster) (v 1) (cf ?v))
    =>
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store C1 ((fetch C1) concat ?str) )
    (store C1 ((fetch C1) concat ". ") ) 
    )

(defrule store-cluster-2
    (oav (o pattern) (a cluster) (v 2) (cf ?v))
    =>
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store C2 ((fetch C2) concat ?str) )
    (store C2 ((fetch C2) concat ". ") ) 
    )

(defrule store-cluster-3
    (oav (o pattern) (a cluster) (v 3) (cf ?v))
    =>
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store C3 ((fetch C3) concat ?str) )
    (store C3 ((fetch C3) concat ". ") ) 
    )

(defrule store-cluster-4
    (oav (o pattern) (a cluster) (v 4) (cf ?v))
    =>
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store C4 ((fetch C4) concat ?str) )
    (store C4 ((fetch C4) concat ". ") ) 
    )

(defrule store-cluster-5
    (oav (o pattern) (a cluster) (v 5) (cf ?v))
    =>
    (bind ?str (?v toString)) ; convert any other data type to string first
    (store C5 ((fetch C5) concat ?str) )
    (store C5 ((fetch C5) concat ". ") ) 
    )


;; BACK TO OLD STUFF (GWS)

(deftemplate move
    (slot from-topic) (slot from-concept)
    (slot to-topic) (slot to-concept)
    (slot delta-time)
    (slot timestamp (default 10000)) ; not used as of now, but might be useful in future
    )

(deffacts goal-not-set 
	(goalset false)
)
;;;
;;;Switching to Next Phase
;;;

;;all rules are associated with a phase; all rules in a phase
;;are executed and then we switch to the next phase, etc.
;;
;;First phase: categorization
;;  we categorize the navigation pattern to one of five clusters
;;
;;Second phase: student-to-treatment
;;  there is a heuristic match from category and other student characterization to
;;  the most appropriate treatment type (e.g., what kind of thing to say, how to say it)
;;
;;Third phase: treatment-to-prompt
;;  we convert the type of treatment to the concrete text prompt and display type
;;
;;Fourth phase: display-prompt
;;  in the test phase, display the prompt; later, select the actual prompt in case several
;;  are suggested and clean up things

;we keep it simple with ordered facts

(deffacts phase-sequence
    (time 0)
    (next-phase categorization student-to-treatment)
    (next-phase student-to-treatment treatment-to-prompt)
    (next-phase treatment-to-prompt display-prompt))


;the following rules take care of the phase switching

(defrule first-phase
    "start with a phase ?x that has no predecessor"
    (next-phase ?x ?)
    (not (next-phase ? ?x))
    =>
    (assert (phase ?x))
    (printout t "=== Starting with " ?x " phase. ===" crlf))


(defrule next-phase
    ;nothing else should have a lower salience so that this rule only
    ;fires if every other rules has fired (exception is next rule)
    (declare (salience -10))
    ?f <- (phase ?x)
    (next-phase ?x ?y)
    =>
    (retract ?f)
    (assert (phase ?y))
    (printout t "=== Switching to " ?y " phase. ===" crlf))


;;;
;;;Categorization Phase
;;;====================
;;;
;;;Assign students to navigation patterns
;;;


;;Cluster 1: all moves are within the goal topic


(defrule categorization-cluster-1a
    "we move to somewhere in the goal topic"
    (phase categorization)
    (move (to-topic ?t2) (to-concept ?c2))
    (topic (name ?t2) (goal true))
    =>
    (printout t "cluster1a " ?t2  " " ?c2 crlf)   
    (assert (oav (o pattern) (a cluster) (v 1) (cf +50)))
    (assert (oav (o pattern) (a cluster) (v 4) (cf +50))))

(defrule categorization-cluster-1b
    "we move to somewhere outside the goal topic"
    (phase categorization)
    (move (to-topic ?t2) (to-concept ?c2))
    (topic (name ?t2) (goal false))
    =>
    (printout t "cluster1b " ?t2  " " ?c2 crlf)       
    (assert (oav (o pattern) (a cluster) (v 1) (cf -80)))
    (assert (oav (o pattern) (a cluster) (v 4) (cf -80))))



;add rules for each cluster, a rule may also assert some oav fact with a negative cf
;for another cluster; however, we should avoid redundancies


;;Cluster 2: Lateral moves in topics of the same family as the goal topic

(defrule categorization-cluster-2a
    "we move to a topic in the same family as the goal topic; the concept does not change"
    (phase categorization)
    (move (to-topic ?top) (from-concept ?c) (to-concept ?c))
    (topic (family ?fam) (goal true))
    (topic (name ?top)(family ?fam))
    =>
    (printout t "cluster2a " ?top  " " ?c crlf)
    (assert (oav (o pattern) (a cluster) (v 2) (cf +50)))
    (assert (oav (o pattern) (a cluster) (v 4) (cf +50))))

(defrule categorization-cluster-2b
    "we move to a different topic NOT in the same family as the goal topic;"
    (phase categorization)
    (move (from-topic ?t1) (to-topic ?t2))
    (test (<> ?t1 ?t2)) ; jump between topics
    (topic (name ?t2)(family ?f2))
    (topic (family ?fg) (goal true))
    (test (<> ?f2 ?fg)) ; landed in a topic not in goal family 
    =>
    (printout t "cluster2b " ?t1 "-->" ?t2  crlf)
    (assert (oav (o pattern) (a cluster) (v 2) (cf -80)))
    (assert (oav (o pattern) (a cluster) (v 4) (cf -80))))

(defrule categorization-cluster-2c
    "we move to a different concept;"
    (phase categorization)
    (move (from-concept ?c1) (to-concept ?c2))
    (test (<> ?c1 ?c2)) ; not a lateral jump  
    =>
    (printout t "cluster2c " ?c1 "-->" ?c2  crlf)
    (assert (oav (o pattern) (a cluster) (v 2) (cf -80)))
 )

;;Cluster 3: Random moves including any topic and concept. Basically, visits multiple concepts
;;           in multiple topics including outside of goal topic's family.

(defrule categorization-cluster-3a
    "find locations in different topics with different concepts"
    (phase categorization)
    (move (from-topic ?t1) (from-concept ?c1) (to-topic ?t2) (to-concept ?c2))
    (topic (name ?tg) (goal true))
    (test (and (<> ?t1 ?tg) (<> ?t2 ?tg))) ; jump between non-goal topics
    =>
    ;since the condition is not that strong evidence, we use a relatively low cf
    (printout t "cluster3a " ?t1 "," ?c1 ", -- " ?t2 "," ?c2 crlf)
    (assert (oav (o pattern) (a cluster) (v 3) (cf +50))))


;;Cluster 4: Lateral moves within topics of the same family as the goal topic
;;           plus moves within Tg are allowed.

;this is a combination of clusters 1 and 2, so we add the asserts into those rules

;(defrule categorization-cluster-4a
 ;   "evidence for cluster 4, is evidence against cluster 1 and 2 and slight evidence against cluster 3"
  ;  (phase categorization)
   ; (oav (o pattern) (a cluster) (v 4) (cf ?cf))
;    (test (> ?cf 20))
 ;   =>
  ;  (assert (oav (o pattern) (a cluster) (v 1) (cf (- 0 ?cf))))
   ; (assert (oav (o pattern) (a cluster) (v 2) (cf (- 0 ?cf))))
    ;(assert (oav (o pattern) (a cluster) (v 3) (cf (/ ?cf -2)))))


;;Cluster 5: Within goal topic with very strong focus on one or two concepts with minimal
;;           other concepts.


;next we count the number a node has been visited 
;as ordered fact (node-visits topic concept number-of-visits)
(defquery find-nodes
    "finds destination concepts for a concept in a topic"
    (declare (variables ?topic ?concept))
    (move (to-topic ?topic) (to-concept ?concept)))

(defrule count-node-visits
    (phase categorization)
    (topic (name ?t) (family ?fam) (goal true))
    (family (name ?fam) (concepts $? ?c $?))
    =>
    (bind ?n (count-query-results find-nodes ?t ?c))
    (assert (node-visits ?t ?c ?n)))

(defrule categorization-5a
    "we have a focus if that node (or two) is visited at least twice as
     frequently as all other visited nodes"
    (phase categorization)
    (node-visits ?t ?c1 ?n1)
    (node-visits ?t ?c2 ?n2)
    ;next we check that there is at least one non-focus
    (node-visits ?t  ?c3x&:(and (neq ?c3x ?c1) (neq ?c3x ?c2)) ?n3x&:(> ?n3x 0))
    ;then we check that ?c1 or ?c2 are indeed foci
    (forall
        (node-visits ?t  ?c3&:(and (neq ?c3 ?c1) (neq ?c3 ?c2)) ?n3)
        (test (> ?n3 0))
        (test (> (/ (min ?n1 ?n2) 2) ?n3)))
    =>
    (printout t "cluster5a " ?t "," ?c1 "," ?n1 crlf)
    (assert (oav (o pattern) (a cluster) (v 5) (cf +80))))


;;;
;;;Student to Treatment Phase
;;;==========================
;;;
;;; Based on the description of the student and the navigation pattern,
;;; come up with a treatment type
;;;

(defquery concepts-visited-in-topic
    "find visited concepts in ?topic"
    (declare (variables ?topic))
    (topic (name ?topic) (family ?family))
    (family (name ?family) (concepts $? ?c $?))
    (node-visits ?topic ?c ?n&:(> ?n 0)))



(defrule stud-to-treat-1
    "RULE 1: 
     Condition: If student has read less than 50% of concepts in goal topic
     Action: Encourage student to read concepts within a topic 
     Example prompt:
     Less-Directive: Reading the concepts within the topic that you are supposed 
         to learn about will help you understand the topic better
     Mid-Directive: ...
     More-Directive: ...
    "
    (phase student-to-treatment)

    (topic (name ?topic) (family ?family) (goal true))
    (family (name ?family) (concepts $?concepts))

    ;visited less than half concepts in goal topic
    (test (< (count-query-results concepts-visited-in-topic ?topic) (/ (length$ ?concepts) 2)))
    =>
    (assert (oav (o prompt) (a type) (v qqread-goal-topics) (cf 100))))





(defrule goal-not-selected
	(phase student-to-treatment)
    (goalset false)
    =>
    (printout t "goal not selected!" crlf)	   
)


;;;
;;;Treatment to Prompt Phase
;;;=========================
;;;
;;; Map treatment type to a specific treatment; this may include doing nothing
;;; or displaying a text prompt in a certain way
;;;

(defrule dont-say-things-twice
    (phase treatment-to-prompt)
    (oav (o prompt) (a text) (v ?text) (cf ?cf))
    (test (> ?cf 20))
    (exists (selected-prompt ? ?text))
	=>
    (assert (oav (o prompt) (a text) (v ?text) (cf -99))))


(defrule read-goal-topics
    "belongs to RULE 1 in Sadhana's file"
    (phase treatment-to-prompt)
    (oav (o prompt) (a type) (v read-goal-topics) (cf ?cf))
    =>
    ;assert different actual texts with appropriate cf
    (assert (oav (o prompt) (a text) 
                 (v "Reading concepts within the topic that you are supposed 
                     to learn about will help you understand the topic better") 
                 (cf ?cf)))
    (prompts-triggered 1)
    )
    ;if we had prompts that are more directive, we could assert them here but with lower cfs each.

(defrule read-related-topics
    "belongs to RULE 2 in Sadhana's file"
    (phase treatment-to-prompt)
    (oav (o prompt) (a type) (v read-related-topics) (cf ?cf))
    =>
    ;assert different actual texts with appropriate cf
    (assert (oav (o prompt) (a text) 
                 (v "Can you think of some concepts that are related to the one you are reading?") 
                 (cf ?cf)))
    (prompts-triggered 2)
    )

(defrule reflect-goal-topics
    (phase treatment-to-prompt)
    (oav (o prompt) (a type) (v reflect-goal-topics) (cf ?cf))
    =>
    ;assert different actual texts with appropriate cf
    (assert (oav (o prompt) (a text) 
                 (v "Can you think of how concepts you just read are related to each other AND are related to you goal for today?") 
                 (cf ?cf)))
    (prompts-triggered 3)
    )

(defrule random-browsing
    (phase treatment-to-prompt)
    (oav (o prompt) (a type) (v random-browsing) (cf ?cf))
    =>
    ;assert different actual texts with appropriate cf
    (assert (oav (o prompt) (a text) 
                 (v "What is your goal for today? What concepts are related to your goal?") 
                 (cf ?cf)))
    (prompts-triggered 5)
    )

(defrule goal-visited-long-back
    (phase treatment-to-prompt)
    (oav (o prompt) (a type) (v goal-visited-long-back) (cf ?cf))
    =>
    ;assert different actual texts with appropriate cf
    (assert (oav (o prompt) (a text) 
                 (v "What is your goal for today? <br/> What concepts are related to your goal?") 
                 (cf ?cf)))
    (prompts-triggered 6)    
    )

;;;
;;;Display Prompt Phase
;;;====================
;;;
;;; Display the prompt to he student if a prompt exists. This allows to
;;; test the rules outside of CoMPASS
;;;



(defrule what-cluster-is-it
    "auxiliary rule during development to print out categorization result"
    (phase display-prompt)
    (oav (o pattern) (a cluster) (v ?v) (cf ?cf))
    =>
    (printout t "Navigation behavior belongs to pattern of cluster " ?v " with a cf of " ?cf crlf)
;    (sendback " Cluster ")
;    (sendback ?v )
;    (sendback " has cf = ")
;    (bind ?cf (round ?cf))
;    (sendback ?cf )
;    (sendback "<br/>")    
)

;(defrule what-prompt-is-it
;    "auxiliary rule during development to show all the prompts with cf"
;    (phase display-prompt)
;    (oav (o prompt) (a text) (v ?text) (cf ?cf))
;    =>
;    (printout t "Prompt [cf = " ?cf "]: " ?text crlf))


(defrule display-prompt
    "this prompt we actually display; there is no other with a higher cf"
    (phase display-prompt)
    (oav (o prompt) (a text) (v ?text) (cf ?cf))
    (forall 
        (oav (o prompt) (a text) (v ?text1) (cf ?cf1))
        (test (<= ?cf ?cf)))
    (time ?time)
    (test (= ?time 0)) ; hack to mute double messages
    ;(test (> ?cf 20))
    =>
    (printout t "Display prompt [" ?time ", cf = " ?cf "]: " ?text crlf)
    (sendback "<u>Prompt:</u><br/>")
    (sendback ?text)
    (sendback "<br/>") 
    (assert (selected-prompt ?time ?text))
)


(defrule incr-time
    "we want to do this at the very end of a cycle and avoid loops caused 
     by the assert of a new time fact"
    (declare (salience -100) (no-loop TRUE))
    (phase display-prompt)
    ?f <- (time ?t)
    =>
    (retract ?f)
    (assert (time (+ ?t 1))))
    

/*
(reset)
(assert (move (to-topic Force) (delta-time 22)))
(run)

(assert (move (from-topic Lever) (from-concept Force) 
              (to-topic Lever) (to-concept Energy)
              (delta-time 34)))
(retract-string "(phase display-prompt)")
(assert (phase categorization))
(run)

(assert (move (from-topic Lever) (from-concept Energy) 
              (to-topic  Pulley) (to-concept Energy)
              (delta-time 17)))
(retract-string "(phase display-prompt)")
(assert (phase categorization))
(run)

(assert (move (from-topic Pulley) (from-concept Energy)  
              (to-topic Wheel-and-Axle) (to-concept Energy)
              (delta-time 21)))
(retract-string "(phase display-prompt)")
(assert (phase categorization))
(run)

(assert (move (from-topic Wheel-and-Axle) (from-concept Energy)
              (to-topic Lever) (to-concept Energy) 
              (delta-time 41)))
(retract-string "(phase display-prompt)")
(assert (phase categorization))
(run)

(assert (move (from-topic Lever) (from-concept Energy) 
              (to-topic Lever) (to-concept Force)             
              (delta-time 16)))
(retract-string "(phase display-prompt)")
(assert (phase categorization))
(run)

*/
;(reset)
;; http://www.jessrules.com/doc/70/rules.html
;(watch all)
;(run)
