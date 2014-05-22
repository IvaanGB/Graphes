<?php

function multiplierMatrice($matriceA, $matriceB) {
    $tabRes = array();

    for ($i = 0; $i < count($matriceA); $i++) {
        $tabRes[$i] = array();
        for ($j = 0; $j < count($matriceB); $j++) {
            $tabRes[$i][$j] = 0;
            for ($k = 0; $k < count($matriceA); $k++) {
                $tabRes[$i][$j] += $matriceA[$i][$k] * $matriceB[$k][$j];
            }
        }
    }
    return $tabRes;
}

function matriceIdentite($taille) {
    $tabRes = array();

    for ($i = 0; $i < $taille; $i++) {
        $tabRes[$i] = array();
        for ($j = 0; $j < $taille; $j++) {
            if ($i == $j)
                $tabRes[$i][$j] = 1;
            else
                $tabRes[$i][$j] = 0;
        }
    }

    return $tabRes;
}

function multiplierMatriceBoolean($matriceA, $matriceB) {
    $tabRes = array();

    for ($i = 0; $i < count($matriceA); $i++) {
        $tabRes[$i] = array();
        for ($j = 0; $j < count($matriceB); $j++) {
            $tabRes[$i][$j] = 0;
            for ($k = 0; $k < count($matriceA) && $tabRes[$i][$j] != 1; $k++) {
                $tabRes[$i][$j] += $matriceA[$i][$k] * $matriceB[$k][$j];
            }
        }
    }
    return $tabRes;
}

function additionnerMatriceBoolean($matriceA, $matriceB) {
    $tabRes = array();

    for ($i = 0; $i < count($matriceA); $i++) {
        $tabRes[$i] = array();
        for ($j = 0; $j < count($matriceB); $j++) {
            if ($matriceA[$i][$j] + $matriceB[$i][$j] > 0)
                $tabRes[$i][$j] = 1;
            else
                $tabRes[$i][$j] = 0;
        }
    }
    return $tabRes;
}

function afficherMatrice($matrice, $noeuds) {
    ?>
    <table class="table table-striped">  
        <thead>  
            <tr>  
                <th></th>  
                <?php
                foreach ($noeuds as $noeud) {
                    echo '<th>' . $noeud->getNom() . '</th>';
                }
                ?>
            </tr>  
        </thead>  
        <tbody>
            <?php
            for ($i = 0; $i < count($matrice); $i++) {
                echo '<tr>';
                echo '<th>'.$noeuds[$i]->getNom().'</th>';
                for ($j = 0; $j < count($matrice[0]); $j++) {
                    echo '<td>'.$matrice[$i][$j].'</td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>  
    </table>
    <?php
}

function getLettres($indice) {
    $lettres = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K');

    return $lettres[$indice];
}
?>