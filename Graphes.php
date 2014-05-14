<?php
include_once 'Graphe.php';
include_once 'Kruskal.php';

$n = array();
$i = 0; $n[$i] = new Noeud($i, 'A'); 
$i = 1; $n[$i] = new Noeud($i, 'B'); 
$i = 2; $n[$i] = new Noeud($i, 'C'); 
$i = 3; $n[$i] = new Noeud($i, 'D'); 
$i = 4; $n[$i] = new Noeud($i, 'E'); 
$i = 5; $n[$i] = new Noeud($i, 'F'); 
$i = 6; $n[$i] = new Noeud($i, 'G'); 
$i = 7; $n[$i] = new Noeud($i, 'H'); 
$i = 8; $n[$i] = new Noeud($i, 'I'); 
$i = 9; $n[$i] = new Noeud($i, 'J'); 
$i = 10; $n[$i] = new Noeud($i, 'K'); 

$tab_arc = array(
    // A (0) vers Autres
    new Arc($n[0], $n[1], 420), // A -> B
    new Arc($n[0], $n[2], 230), // A -> C
    new Arc($n[0], $n[6], 150), // A -> G
    new Arc($n[0], $n[5], 300), // A -> F
    
    // B (1) vers Autres
    new Arc($n[1], $n[0], 420), // B -> A
    new Arc($n[1], $n[2], 130), // B -> C
    
    // C (2) vers Autres
    new Arc($n[2], $n[1], 130), // C -> B
    new Arc($n[2], $n[0], 230), // C -> A
    new Arc($n[2], $n[6], 110), // C -> G
    new Arc($n[2], $n[7], 150), // C -> H
    
    // D (3) vers Autres
    new Arc($n[3], $n[2], 450), // D -> C
    new Arc($n[3], $n[6], 160), // D -> G
    new Arc($n[3], $n[4], 160), // D -> E
    
    // E (4) vers Autres
    new Arc($n[4], $n[3], 160), // E -> D
    new Arc($n[4], $n[8], 200), // E -> I
    new Arc($n[4], $n[10], 100), // E -> K
    
    // F (5) vers Autres
    new Arc($n[5], $n[0], 300), // F -> A 
    new Arc($n[5], $n[6], 320), // F -> G
    
    // G (6) vers Autres
    new Arc($n[6], $n[5], 320), // G -> F
    new Arc($n[6], $n[0], 150), // G -> A
    new Arc($n[6], $n[2], 110), // G -> C
    new Arc($n[6], $n[3], 160), // G -> D
    new Arc($n[6], $n[7], 250), // G -> H
    
    // H (7) vers Autres
    new Arc($n[7], $n[6], 250), // H -> G
    new Arc($n[7], $n[2], 150), // H -> C
    new Arc($n[7], $n[8], 120), // H -> I
    
    // I (8) vers Autres
    new Arc($n[8], $n[7], 120), // I -> H
    new Arc($n[8], $n[4], 200), // I -> E
    new Arc($n[8], $n[10], 400), // I -> K
    new Arc($n[8], $n[9], 70), // I -> J
    
    // J (9) vers Autres
    new Arc($n[9], $n[8], 70), // J -> I
    new Arc($n[9], $n[10], 150), // J -> K
    
    // K (10) vers Autres
    new Arc($n[10], $n[8], 400), // K -> I
    new Arc($n[10], $n[9], 150), // K -> J
    new Arc($n[10], $n[4], 100) // K -> E
    );

$graphe = new Graphe($n, $tab_arc);
$dij = new Dijkstra($graphe);

$k = new Kruskal($graphe->getArcsAsArray());
$min_arcs = $k->findMinimum();
$min_cost = $k->calculateMinimumCost();

?>
