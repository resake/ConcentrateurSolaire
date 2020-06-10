   
<!DOCTYPE html> 
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIMULATEUR</title>
  
</head>

<body>
    <p> Simulateur four1, insère des données dans la BDD toutes les secondes, équivalent miutes </p>  
    <?php
    // récupération de l'heure initiale de lancement du simulateur, pour faire le décalage
    date_default_timezone_set('Europe/paris');
    $heure_actuelle = date('H:i:s');
    
    // vidange de la table relevé 2
    try {
         $pdo = new PDO('mysql:host=localhost;dbname=concentrateur_solaire;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }    
    
    $RequeteTruncate = 'TRUNCATE releve2';
    $pdo->exec($RequeteTruncate)    
    
    ?>

 <!-- <script src="vendor/jquery/jquery.slim.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
 
 <!-- moment JS , pour les dates chart JS necessite moment js-->
<!-- Moment.js is an open source library that allows you to parse, validate, manipulate and display dates in JavaScript. -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/fr.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/fr.js"></script>

  <script>
  $(document).ready(function () {
      
      //var heure_actuelle = moment().format(' YYYY-M-Do H:mm:ss ');
      //console.log($heure_actuelle);
      simu_four1();
      setInterval(simu_four1, 1000);
  });

  function simu_four1()
  {
      $.ajax({
          url: 'simu_four_decale_accelere.php',
          type : 'GET',
          data : 'heure_init=' + '<?php echo $heure_actuelle ?>',
          timeout: 3000
      });
   }
   </script>