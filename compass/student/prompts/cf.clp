;;;
;;;Certainty Factors
;;;

(provide oav)


(deftemplate oav 
    "object attribute value cf"
    (slot o)
    (slot a)
    (slot v)
    (slot cf))

;combine positive or zero certainty facts
(defrule combine-positive-cf
  (declare (salience -1))
  ?f1 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf1&:(>= ?cf1 0)))
  ?f2 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf2&:(>= ?cf2 0)))
  (test (neq ?f1 ?f2))
  =>
  (retract ?f1 ?f2)
  (assert (oav (o ?o) (a ?a) (v ?v) 
               (cf (+ ?cf2 (/ (* ?cf1 (- 100 ?cf2)) 100))))))


;combine negative cf
(defrule combine-neg-cf
  (declare (salience -1))
  ?f1 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf1&:(<= ?cf1 0)))
  ?f2 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf2&:(<= ?cf2 0)))
  (test (neq ?f1 ?f2))
  =>
  (retract ?f1 ?f2)
  (assert (oav (o ?o) (a ?a) (v ?v) 
               (cf (+ ?cf2 (/ (* ?cf1 (+ 100 ?cf2)) 100))))))

;combine one positive and one negative cf whose sum is positive
(defrule neg-pos-cf
  (declare (salience -1))
  ?f1 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf1))
  ?f2 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf2))
  (test (neq ?f1 ?f2))
  (test (< (* ?cf1 ?cf2) 0))
  (test (>= (+ ?cf1 ?cf2) 0))
  (test (>= (abs ?cf1) (abs ?cf2)))
  =>
  (retract ?f1 ?f2)
  (assert (oav (o ?o) (a ?a) (v ?v) 
               (cf (/ (- (* (+ ?cf1 ?cf2) 100) (/ (- 100 (abs ?cf2)) 2))
  			          (- 100 (abs ?cf2)))))))

(defrule neg-neg-cf
  (declare (salience -1))
  ?f1 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf1))
  ?f2 <- (oav (o ?o) (a ?a) (v ?v) (cf ?cf2))
  (test (neq ?f1 ?f2))
  (test (< (* ?cf1 ?cf2) 0))
  (test (<= (+ ?cf1 ?cf2) 0))
  (test (>= (abs ?cf1)(abs ?cf2)))
  =>
  (retract ?f1 ?f2)
  (assert (oav (o ?o) (a ?a) (v ?v) 
               (cf (/ (+ (* (+ ?cf1 ?cf2) 100) (/ (- 100 ?cf2) 2)) 
			          (- 100 ?cf2))))))

