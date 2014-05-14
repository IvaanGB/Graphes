<?php

include_once("dijkstra.php");

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
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Théorie des Graphes</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Théorie des Graphes</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Théorie des Graphes</a>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Accueil</a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <span class="badge"></span>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-beer"></i> Chemin le plus court entre chaque point</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Informations</strong> Utilisation de l'algorithme de Dijkstra
                        </div>
                        <?php
                        foreach($graphe->getTab_noeud() as $noeud_depart) {
                            foreach($graphe->getTab_noeud() as $noeud_arrivee) {
                                $rc = $dij->setDepart($noeud_depart);
                                $rc = $dij->setArrivee($noeud_arrivee);
                                ?>
                                <div>
                                <?php
                                if ($dij->recherche() && $dij->getDistance_minimale() != 0 ) {
                                        $chemin_str = $dij->get_string_chemin();
                                        ?><h2><?php echo($dij->getDepart()); ?> vers <?php echo($dij->getArrivee()); ?> <span class="label label-success"><?php echo($dij->getDistance_minimale()); ?></span></h2><?php
                                        ?><p><?php echo($chemin_str); ?></p><?php
                                }
                                else 
                                {
                                    //echoln("Il n'y a pas de chemin entre " . $dij->getDepart() . " et " . $dij->getArrivee());
                                }
                                ?>
                                </div>
                                <hr>  
                                <?php
                            }	
                        }?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-beer"></i> Arbre couvrant minimal</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Informations</strong> Utilisation de l'algorithme de Kruskal
                        </div>
                        <div>
                            <?php                            
                                foreach ($min_arcs as $arc => $cost) 
                                {
                                    echoln($arc);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-question-circle"></i> Informations sur le Graphes</h3>
                    </div>
                    <div class="panel-body">
                        <h2>Aperçu</h2>
                        <div>
                            <img src="graphe.png" class="img-responsive" alt="Graphe">
                        </div>
                        <hr>
                        <h2>Sommets</h2>
                        <p></p>
                        <hr>
                        <h2>Arcs</h2>
                        <p><?php $graphe->print_arcs(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>