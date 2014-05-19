<?php

function multiplierMatrice($matriceA, $matriceB)
{
    $tabRes = array();
    
    for ($i = 0; $i < count($matriceA); $i++) 
    {
        $tabRes[$i] = array();
        for ($j = 0; $j < count($matriceB); $j++) 
        {
            $tabRes[$i][$j] = 0;
            for ($k = 0; $k < count($matriceA); $k++) 
            {
                $tabRes[$i][$j] += $matriceA[$i][$k] * $matriceB[$k][$j];
            }
        }
    }
    return $tabRes;
}

function getLettres($indice)
{
    $lettres = array ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K');
    
    return $lettres[$indice];
}

?>