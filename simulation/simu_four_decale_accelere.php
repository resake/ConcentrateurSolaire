<?php
/*
 * en acceleré, les heures deviennent des minutes et les secondes deviennet des minutes
 */
$heure_initiale= $_GET['heure_init'];
//$heure_initiale = "10:28:00";
var_dump($heure_initiale);

date_default_timezone_set('Europe/paris');
$heure_actuelle = date('H:i:s');
var_dump($heure_actuelle);


// transformations des strings en dates, objets datetime pour être plus précis
$heure_initiale = date_create($heure_initiale);
$heure_actuelle = date_create($heure_actuelle);

// $decalage est un objet
$decalage = date_diff($heure_initiale, $heure_actuelle);
var_dump($decalage);

// formatage pour BDD de l'heure décalée, en preant les minutes et les secondes
$heure_decalee = $decalage->format("%I:%S");
var_dump($heure_decalee);

//$val2 = $interval->format("H:I:S"); MARCHE PAS !!!
//var_dump($val2);

// minutes --> heures, et secondes --> minutes
$heures = $decalage->format('%I') ;
var_dump($heures);
$minutes = $decalage->format('%S') ;
var_dump($minutes);


// transformations de la durée en minutes qui correspondent à des secondes
$time = 60*$heures + $minutes ;
var_dump($time);

//
////
// formatage de la date pour BDD
$date = date("Y-m-d");
var_dump($date);
//
// formatage finale pour BDD , secondes à 0
$date_heure = "'".$date." ".$heure_decalee.":00'";
var_dump($date_heure);
//
//
// calcul des modélisations en pseudo gaussiennes sur 1440 min, soit 24H
$temp_four1 = 150*exp(-($time-720)*($time-720)/(8*10000)) + 50 + rand(-3, 3) ;  
// une variation pour l'entrée du four
$temp_four1_entree = 200*exp(-($time-680)*($time-680)/(8*10000)) + 50 + rand(-5, 5) ; 
echo $temp_four1_entree;
echo "</br>";
echo $temp_four1;


if ($time < 1440){
        try {
             $pdo = new PDO('mysql:host=localhost;dbname=concentrateur_solaire;charset=utf8', 'root', '');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        //four1
        $RequeteInsert = 'INSERT INTO releve2(idReleve, idCapteur, valeur, date_heure) VALUES (NULL, 54,'.$temp_four1.','.$date_heure.')';
        $pdo->exec($RequeteInsert);

        //entree four1
        $RequeteInsert = 'INSERT INTO releve2(idReleve, idCapteur, valeur, date_heure) VALUES (NULL, 55,'.$temp_four1_entree.', '.$date_heure.')';
        $pdo->exec($RequeteInsert);

        // modèle de simulation inconnu ...
        if ($time <= 360) {
            $veilleuse = 1;
            $torche = 0;
        } elseif ($time > 360 and $time <= 720) {
            $veilleuse = 1;
            $torche = 1;
        } elseif ($time > 720 and $time <= 1080) {
             $veilleuse = 1;
            $torche = 0;   
        } elseif ($time > 1080 and $time <= 1440) {
             $veilleuse = 0;
            $torche = 0; 
        }


        //veilleuse four1

             $RequeteInsert = 'INSERT INTO releve2(idReleve, idCapteur, valeur, date_heure) VALUES (NULL, 52,'.$veilleuse.', '.$date_heure.')';
             $pdo->exec($RequeteInsert);
        //torche four1

             $RequeteInsert = 'INSERT INTO releve2(idReleve, idCapteur, valeur, date_heure) VALUES (NULL, 53,'.$torche.', '.$date_heure.')';
             $pdo->exec($RequeteInsert);

}   