<?php
include_once 'Dijkstra.php';
include_once 'Graphes.php';
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
                  <li><a href="#dijkstra">Dijkstra</a></li>
                  <li><a href="#kruskal">Kruskal</a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <span class="badge"></span>
        <div class="row">
            <div class="col-xs-12 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-beer"></i> Chemin le plus court entre chaque point <i class="close fa fa-minus" data-target="#dijkstra" data-toggle="collapse" title="Réduire"></i></h3>
                    </div>
                    <div id="dijkstra" class="collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-md-12">
                                    <div class="alert alert-warning alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        Utilisation de l'algorithme de <strong>Dijkstra</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <?php
                                    $mod=0;
                                    foreach($graphe->getTab_noeud() as $noeud_depart) {
                                        if ($mod === 4 || $mod ===8 || $mod == 12) {
                                            echo('</div><div class="row">');
                                        }
                                        
                                        if ($mod != 0) echo ('</div><div class="col-xs-12 col-md-3">');
                                        
                                        foreach($graphe->getTab_noeud() as $noeud_arrivee) {
                                            $rc = $dij->setDepart($noeud_depart);
                                            $rc = $dij->setArrivee($noeud_arrivee);
                                            ?>
                                            
                                            <?php
                                            if ($dij->recherche() && $dij->getDistance_minimale() != 0 ) {
                                                    $chemin_str = $dij->get_string_chemin();
                                                    ?><div><h2><?php echo($dij->getDepart()); ?> vers <?php echo($dij->getArrivee()); ?> <span class="label label-success"><?php echo($dij->getDistance_minimale()); ?></span></h2><?php
                                                    ?><p><?php echo($chemin_str); ?></p></div><?php
                                            }
                                        }
                                        $mod++;
                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-beer"></i> Arbre couvrant minimal <i class="close fa fa-minus" data-target="#kruskal" data-toggle="collapse" title="Réduire"></i></h3>
                    </div>
                    <div id="kruskal" class="collapse in">
                        <div class="panel-body">
                            <div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Informations</strong> Utilisation de l'algorithme de <strong>Kruskal</strong>
                            </div>
                            <div>
                                <?php                            
                                    foreach ($min_arcs as $arc => $cost) 
                                    {
                                        echo($arc." ");
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-question-circle"></i> Informations sur le Graphe</h3>
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
