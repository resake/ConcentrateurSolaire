
<?php
header('Content-type: application/json');

// connexion BDD
$pdo = new PDO('mysql:host=localhost;dbname=concentrateur_solaire;charset=utf8', 'root', '');


/*
 * affichage sur une journée. à partir de minuit  jusqu'au lendemain minuit
 */
// récupération de la date du jour
$date = date("Y-m-d");
// le lendemain
$datePlus1jour = date('Y-m-d',strtotime('+1 day'));

// minuit
$dateHeureDebut = $date." 00:00:00";
// minuit du lendemain
$dateHeureFin = $datePlus1jour." 00:00:00";


/*
 * affichage sur une journée. à partir de 5H du matin jusqu'à 5H du matin le lendemain
 */


//*****************************************************************************************************
// capteur Tfour1
$req = "SELECT  valeur, date_heure FROM releve2 WHERE (idCapteur = 54 AND (date_heure BETWEEN \"" .$dateHeureDebut."\" AND \"".$dateHeureFin."\")) ORDER BY `date_heure` ASC";
//echo $req;
// exécution de la requete
$Obj1 = $pdo->query($req);
$tab_four1 = $Obj1->fetchAll(PDO::FETCH_ASSOC);
//var_dump($tab_four1);

     for ($i = 0; $i < sizeof($tab_four1); $i++) {       
        $json_four1[$i] = array("x"=>$tab_four1[$i]['date_heure'], 
                                "y"=>doubleval($tab_four1[$i]['valeur']));
                                              
      }

      
 //*****************************************************************************************************     
// capteur T entre four1
$req = "SELECT  valeur, date_heure FROM releve2 WHERE (idCapteur = 55 AND (date_heure BETWEEN \"" .$dateHeureDebut."\" AND \"".$dateHeureFin."\")) ORDER BY `date_heure` ASC";
// exécution de la requete
$Obj2 = $pdo->query($req);
$tab_entree_four1 = $Obj2->fetchAll(PDO::FETCH_ASSOC);
//var_dump($tab_entree_four1);

     for ($i = 0; $i < sizeof($tab_entree_four1); $i++) {       
        $json_entree_four1[$i] = array("x"=>$tab_entree_four1[$i]['date_heure'], 
                                        "y"=>doubleval($tab_entree_four1[$i]['valeur']));                                   
      }      

//*****************************************************************************************************
// on cherche à calculer la puissance fossile : 43* Veilleuse + 93.7 * torche      
// capteur veilleuse four1 : 52
$req = "SELECT  valeur FROM releve2 WHERE (idCapteur = 52 AND (date_heure BETWEEN \"" .$dateHeureDebut."\" AND \"".$dateHeureFin."\")) ORDER BY `date_heure` ASC";
//echo $req;
// exécution de la requete
$Obj = $pdo->query($req);
$tab_ass_veilleuse_four1 = $Obj->fetchAll(PDO::FETCH_ASSOC);
//var_dump($tab_ass_veilleuse_four1); on obtient un tableu de tableau associatif !

// on le change en simple tableau et on en profite par multiplier par 43 ...
$tab_veilleuse_four1 = array();
foreach ($tab_ass_veilleuse_four1 as $value) {
    $tab_veilleuse_four1[] = 43 * $value['valeur'];
}
//var_dump($tab_veilleuse_four1);


// capteur torche four1 : 53
$req = "SELECT  valeur FROM releve2 WHERE (idCapteur = 53 AND (date_heure BETWEEN \"" .$dateHeureDebut."\" AND \"".$dateHeureFin."\")) ORDER BY `date_heure` ASC";
//echo $RequeteSELECT;
// exécution de la requete
$Obj = $pdo->query($req);
$tab_ass_torche_four1 = $Obj->fetchAll(PDO::FETCH_ASSOC);
$tab_torche_four1 = array();
foreach ($tab_ass_torche_four1 as $value) {
    $tab_torche_four1[] = 93.7* $value['valeur'];
}
//var_dump($tab_torche_four1);


// date commune
$req = "SELECT  date_heure FROM releve2 WHERE (idCapteur = 52 AND (date_heure BETWEEN \"" .$dateHeureDebut."\" AND \"".$dateHeureFin."\")) ORDER BY `date_heure` ASC";
//echo $RequeteSELECT;
// exécution de la requete
$Obj = $pdo->query($req);
$tab_ass_date_four1 = $Obj->fetchAll(PDO::FETCH_ASSOC);
$tab_date_four1 = array();
foreach ($tab_ass_date_four1 as $value) {
    $tab_date_four1[] = $value['date_heure'];
}
//var_dump($tab_date_four1);

// puissance fossile = somme des deux tableaux
for ($i = 0; $i < sizeof($tab_torche_four1); $i++) {       
   $json_puissance_fossile[$i] = array("x"=>$tab_date_four1[$i], 
                                        "y"=>$tab_torche_four1[$i] + $tab_veilleuse_four1[$i] );

 }
//var_dump($json_puissance_fossile);

// donnee est un tableau de dimension 3 contenant 3 tablaux, à terme il faut rajouter la puissance solaire     
$donnee['four1'] = $json_four1;
$donnee['entree_four1'] = $json_entree_four1;
$donnee['puissance_fossile'] = $json_puissance_fossile;
//var_dump($donnee);

print(json_encode($donnee));
?>