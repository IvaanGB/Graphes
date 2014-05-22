<?php

/**
 * Arc d'un Graphe
 *
 * @author Guitouzid
 */
class Arc {

    private $noeud_depart;
    private $noeud_arrivee;
    private $valeur;

    function __construct(Noeud $d, Noeud $a, $valeur) {
        $this->noeud_depart = $d;
        $this->noeud_arrivee = $a;
        $this->valeur = $valeur;
    }

    function __toString() {
        return "<span class='badge'>" . $this->noeud_depart->getNom() . "</span> <i class='fa fa-arrow-right'></i> <span class='badge'>" . $this->noeud_arrivee->getNom() . "</span>" . " <span class='label label-primary'>" . $this->valeur . "</span>";
    }

    function getNoeud_depart() {
        return $this->noeud_depart;
    }

    function getNoeud_arrivee() {
        return $this->noeud_arrivee;
    }

    function getValeur() {
        return $this->valeur;
    }

    function setNoeud_depart(Noeud $n) {
        $this->noeud_depart = $n;
    }

    function setNoeud_arrivee(Noeud $n) {
        $this->noeud_arrivee = $n;
    }

    function setValeur($v) {
        $this->valeur = $v;
    }
    
    static function cmp(Arc $a, Arc $b) {
        if ($a->valeur == $b->valeur) {
            return 0;
        }
        return ($a->valeur < $b->valeur) ? -1 : 1;
    }
}

?>
