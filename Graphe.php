<?php
include_once 'Noeud.php';
include_once 'Arc.php';
include_once 'helper.php';

/**
 * Graphe
 *
 * @author Guitouzid
 */
class Graphe {

    private $tab_noeud = array();
    private $tab_arc = array();
    private $matriceCouts;
    private $matriceAdjacence;
    private $matriceChapeau;

    function __construct(Array $n, array $a) {
        $this->tab_noeud = $n;
        $this->tab_arc = $a;
    }
    
    function getTab_adjacence()
    {
        $arcs = $this->getTab_arc();
        $tab_adjacence = array();
        
        foreach ($arcs as $arc) 
        {
            
        }
        
        return $tab_adjacence;
    }

    function getTab_noeud() {
        return $this->tab_noeud;
    }

    function getTab_arc() {
        return $this->tab_arc;
    }

    function setTab_noeud(Array $t) {
        $this->tab_noeud = $t;
    }

    function setTab_arc(Array $t) {
        $this->tab_arc = $t;
    }

    function get_nb_noeuds() {
        return count($this->tab_noeud);
    }

    function get_nb_arcs() {
        return count($this->tab_arc);
    }

    // retourne l'arc éventuel contenant les deux noeuds précisés
    function get_arc(Noeud $d, Noeud $a) {
        foreach ($this->tab_arc as $arc) {
            if ($arc->noeud_depart == $d and $arc->noeud_arrivee == $a)
                return $arc;
        }
        return null;
    }
    
    function getMatriceCouts() {
        return $this->matriceCouts;
    }

    function getMatriceAdjacence() {
        return $this->matriceAdjacence;
    }

    function getMatriceChapeau() {
        return $this->matriceChapeau;
    }

    function print_arcs() {
        $arcs = $this->getTab_arc();
        foreach ($arcs as $arc){
            echo($arc." ");
        }
    }
    
    function print_noeuds() {
        $noeuds = $this->getTab_noeud();
        foreach ($noeuds as $noeud){
            echo($noeud." ");
        }
    }

    // retourne un tableau de noeuds connectés au noeud spécifié par un arc du graphe, avec sa valeur
    // dans toutes ces méthodes il faudrait vérifier que le noeud en paramètre est bien un noeud du graphe...
    public function get_noeuds_suivants(Noeud $n) {
        $liste_noeuds = array();
        $liste_valeurs = array();
        foreach ($this->tab_arc as $arc) {
            if ($arc->getNoeud_depart() == $n) {
                $liste_noeuds[] = $arc->getNoeud_arrivee();
                $liste_valeurs[] = $arc->getValeur();
            }
        }

        return array($liste_noeuds, $liste_valeurs);
    }

    function get_noeuds_valeurs() {
        $resultat = array();
        foreach ($this->tab_noeud as $noeud) {
            $resultat[$noeud->getId()] = $noeud->getValeur();
        }
        return $resultat;
    }

    function get_noeuds_valeurs_par_nom() {
        $resultat = array();
        foreach ($this->tab_noeud as $noeud) {
            $resultat[$noeud->getNom()] = $noeud->getValeur();
        }
        return $resultat;
    }

    # retourne le noeud sélectionné. Il ne doit y en avoir qu'un, ce contrôle n'est pas fait.

    function get_noeud_selectionne() {
        foreach ($this->tab_noeud as $noeud) {
            if ($noeud->getEtat() == "sélectionné")
                return $noeud;
        }
        return null;
    }

    #retourne les noeuds non traités

    function get_noeuds_non_traites() {
        $tab_noeuds_non_traites = array();
        $tab_valeur_noeuds_non_traites = array();

        foreach ($this->tab_noeud as $noeud) {
            if ($noeud->getEtat() == "aucun") {
                $tab_noeuds_non_traites[] = $noeud;
            }
        }
        return $tab_noeuds_non_traites;
    }

    function set_noeud_selectionne(Noeud $n) {
        $ancien_noeud_selection = $this->get_noeud_selectionne();
        if ($ancien_noeud_selection != null)
            $ancien_noeud_selection->setEtat("traité");
        $n->setEtat("sélectionné");
    }

    # retourne les noeuds non marqués qui suivent le noeud sélectionné. 
    # Pour chaque noeud, retourne aussi la valeur de l'arc entre le noeud sélectionné et ce noeud

    function get_noeuds_suivants_non_marques_depuis_noeud_selectionne() {
        $tab_noeud_non_marque = array();
        $tab_valeur_arc = array();

        $selection = $this->get_noeud_selectionne();
        list($noeuds, $valeurs_arcs) = $this->get_noeuds_suivants($selection);
        if ($noeuds !== null) {
            foreach ($noeuds as $cle => $n) {
                if ($n->getEtat() == "aucun") {
                    $tab_noeud_non_marque[] = $n;
                    $tab_valeur_arc[] = $valeurs_arcs[$cle];
                }
            }
            return array($tab_noeud_non_marque, $tab_valeur_arc);
        }
        else
            return array(null, null);
    }

    public function getArcsAsArray() {
        $tab = array();
        foreach ($this->getTab_arc() as $arc) {
            $tab[$arc->getNoeud_depart() . $arc->getNoeud_arrivee()] = $arc->getValeur();
        }
        return $tab;
    }
    
    public function makeMatrices() {
        //Matrice Couts
        $this->matriceCouts = array();
        $nbNoeuds = count($this->tab_noeud);

        for ($i = 0; $i < $nbNoeuds; $i++) {
            $this->matriceCouts[$i] = array();
            for ($j = 0; $j < $nbNoeuds; $j++) {
                $this->matriceCouts[$i][$j] = 0;
            }
        }

        $nbArcs = count($this->tab_arc);
        for ($i = 0; $i < $nbArcs; $i++) {
            $this->matriceCouts[$this->tab_arc[$i]->getNoeud_depart()->getId()][$this->tab_arc[$i]->getNoeud_arrivee()->getId()] = $this->tab_arc[$i]->getValeur();
        }

        //Matrice Adjacence
        $this->matriceAdjacence = array();
        for ($i = 0; $i < $nbNoeuds; $i++) {
            $this->matriceAdjacence[$i] = array();
            for ($j = 0; $j < $nbNoeuds; $j++) {
                if ($this->matriceCouts[$i][$j] > 0)
                    $this->matriceAdjacence[$i][$j] = 1;
                else
                    $this->matriceAdjacence[$i][$j] = 0;
            }
        }

        //Matrice Chapeau
        $this->matriceChapeau = additionnerMatriceBoolean($this->matriceAdjacence, matriceIdentite(count($this->matriceAdjacence)));
        $temp = NULL;

        while ($temp != $this->matriceChapeau) {
            $temp = $this->matriceChapeau;
            $this->matriceChapeau = multiplierMatriceBoolean($this->matriceChapeau, $this->matriceChapeau);
        }
    }

}

?>
