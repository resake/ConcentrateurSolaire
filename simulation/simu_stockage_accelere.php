<?php

$heure_initiale= $_GET['heure_init'];
//$heure_initiale = "09:39:00";
//var_dump($heure_initiale);

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


function Temp($i,$time)
{
    $temp = 220*(1-exp(-(($time-3*$i)/20))) + 20 ;
    if($temp <= 20 ){ return 20;}
    return $temp;
}
//
try {
     $pdo = new PDO('mysql:host=localhost;dbname=concentrateur_solaire;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$i= 0;
for ($capt = 25; $capt <= 33; $capt++) {
    
    $temp = Temp($i,$time);
    var_dump($temp);
//    $RequeteInsert = $pdo->prepare("INSERT INTO releve3(idReleve, idCapteur, valeur, date_heure) VALUES (NULL , :capteur , :temp , :heure)");
//    $RequeteInsert->bindParam(':capteur', $capt);
//    $RequeteInsert->bindParam(':temp', $temp);
//    $RequeteInsert->bindParam(':heure', $date_heure);  
    //$RequeteInsert->execute();
    $RequeteInsert = "INSERT INTO releve3(idReleve, idCapteur, valeur, date_heure) VALUES (NULL , ".$capt." , " .$temp." ,". $date_heure.")";
    var_dump($RequeteInsert);
    $pdo->exec($RequeteInsert);
    
    
    $i++;
}
?>