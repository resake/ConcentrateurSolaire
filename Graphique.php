<!-- Page de la représentation spacial (du stockage) ainsi que du graphqiue du four ------>

<?php 

// Connexion BDD via PDO (programmation par objet)
 try
{
    $bdd = new PDO("mysql:host=localhost; dbname=Concentrateur_solaire; charset=utf8", "root", ""); 
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// gestion des érreurs
catch (Exception $e){
die ($e->getMessage()) ;
}

// requette sql qui permet de prendre les données voulues via la bdd  UNIQUEMENT pour les capteurs avec pour ID 25 à 33  (évolution prendre en ccompte plustôt la table zone)
  $donnee= $bdd->prepare("SELECT valeur , idCapteur , date_heure FROM releve3 WHERE idCapteur BETWEEN 25 AND 33 ORDER BY date_heure DESC, idCapteur ASC LIMIT 9   ");
  $donnee->execute(); 
  
  $json=[];
  $date_t = [];
  while ($row=$donnee->fetch(PDO::FETCH_ASSOC)) { // boucle while qui fait en sorte que tant qu'il y a des valeurs dans la bdd alors il les prends suivant la requette sql
    extract($row);

    $json[]= (float)$valeur;
    $date_t[] = $date_heure;
  }

// on récupère l'instant t, ce qui peermettra de calculer les instant t-1, t-2, ...  
$instant_t = $date_t[0] ;
//var_dump($instant_t);

$requete_t1= "(SELECT valeur, idCapteur, date_heure FROM releve3 WHERE ((idCapteur BETWEEN 25 AND 33) AND TIMEDIFF('".$instant_t."', date_heure) > '00:01:00') ORDER BY date_heure DESC  LIMIT 9)  ORDER BY idCapteur ASC";
 //t-1-------------------------------------------------------------------------------------------------
//$donneeT1= $bdd->prepare(" SELECT valeur, idCapteur, date_heure FROM releve3 WHERE idCapteur BETWEEN 25 AND 33 ORDER BY date_heure, idCapteur LIMIT 9 OFFSET 9   ");
$donneeT1 = $bdd->query($requete_t1);  

//$donneeT1->execute(); // requette sql qui permet de prendre se que l'on veux 
  $jsonT1=[];
  while ($row=$donneeT1->fetch(PDO::FETCH_ASSOC)) { // boucle while qui fait en sorte que tant qu'il y a des valeurs dans la bdd alors il les prends suivant la requette sql
    extract($row);
    $jsonT1[] = (float)$valeur;
  }

  //t-2-----------------------------------------------------------------------------------------------
  $requete_t2= "(SELECT valeur, idCapteur, date_heure FROM releve3 WHERE ((idCapteur BETWEEN 25 AND 33) AND TIMEDIFF('".$instant_t."', date_heure) > '00:02:00') ORDER BY date_heure DESC  LIMIT 9)  ORDER BY idCapteur ASC";
//echo $requete_t1;

  //t-2-------------------------------------------------------------------------------------------------
 
$donneeT2 = $bdd->query($requete_t2);  
  $jsonT2=[];
  while ($row=$donneeT2->fetch(PDO::FETCH_ASSOC)) { // boucle while qui fait en sorte que tant qu'il y a des valeurs dans la bdd alors il les prends suivant la requette sql
    extract($row);
    $jsonT2[]= (float)$valeur;
  }
   //t-3-----------------------------------------------------------------------------------------------
$requete_t3= "(SELECT valeur, idCapteur, date_heure FROM releve3 WHERE ((idCapteur BETWEEN 25 AND 33) AND TIMEDIFF('".$instant_t."', date_heure) > '00:03:00') ORDER BY date_heure DESC  LIMIT 9)  ORDER BY idCapteur ASC";
//echo $requete_t1;
  //t-1-------------------------------------------------------------------------------------------------

$donneeT3 = $bdd->query($requete_t3); 
  $jsonT3=[];
  while ($row=$donneeT3->fetch(PDO::FETCH_ASSOC)) { // boucle while qui fait en sorte que tant qu'il y a des valeurs dans la bdd alors il les prends suivant la requette sql
    extract($row);
    $jsonT3[]= (float)$valeur;
  }


?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>--  Concentrateur Solaire --</title>

    <!-- Bootstrap  CSS via leurs lien https qui sert à la mise en place de la bande noir du menu, ainsi qu'a la disposition -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    
    <div class="container">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="accueil.php">Accueil
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Historique.php">Historique</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Graphique.php">Representation spatiale</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="CapteurGraph.php">Graphique Capteur</a>
          </li>
          <li class="nav-item">
          <?php if (isset($_SESSION['id'])) { ?>
              <a class="btn btn-outline-primary" href="index.php?deconnexion=true"> Déconnexion</a>   
          <?php } ?>
        </li>
        </ul>
      </div>
    </div>
  </nav>
</nav>
  <!-- Page Content -->

 <!--  Bootstrap core JavaScript -->
 <!-- <script src="vendor/jquery/jquery.slim.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-------------------------------------------------- choix des différents graphiques ------------------------------------------------------------------------------------------------------------------------>
<form  class="form-inline" method="post">
<div class="col-md-7 mb-6">
  <label for="validationCustom04">Choix du grapique voulu:</label>
  </div>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="test" onChange="window.location.href=this.value" >
    <div class="col-md-3 mb-3">
    <option selected disabled hidden >Choisir...</option>
    <option  value ="Graphique.php"> T-stockage</option>
    <option  value ="Graphique2.php"> Les Fours</option>
    </div>
  </select>
</form>
  
  <!-------------------------------------------------- graphique en place  ------------------------------------------------------------------------------------------------------------------------> 
   <!-- utilisation du la bibliothèque chart.js           documentation de chart.js     https://www.chartjs.org/docs/latest/  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
   <div style="position: relative; height:70vh; width:80vw">
        <canvas id="myChart"></canvas>
   </div>     

<!-- Add jQuery lib here pour les animations ainsi que le rafraichissement de la page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<!-- Créé une instance de chart( le graphqiue) via la balise canvas avec L'id Mychart -->
<script> 
    const ctx = document.getElementById('myChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels:["T1_stockage", "T2_stockage", "T3_stockage", "T4_stockage", "T5_stockage", "T6_stockage", "T7_stockage", "T8_stockage", "T9_stockage"],

            datasets: [{
                label: "instant-T",
                borderColor: 'rgba(100, 30, 22, 0.9)', // couleur du traits 
                data: <?php  echo json_encode($json); ?>, // la data qui vient de la BDD
                borderDash: [10, 5],// ceci sont les traits avec les pointillier
                fill : false,
                borderWidth: 2,
                lineTension: 0.1 // pour des lignes quasi droites

            }, {
                label: "T-1",
                borderColor: 'rgba(21, 67, 96, 0.9)',// couleur du traits 
                data: <?php echo json_encode($jsonT1); ?>,// la data qui vient de la BDD
                hidden: true,
                borderDash: [10, 5],// ceci sont les traits avec les pointillier
                fill : false ,
                borderWidth: 2,
                lineTension: 0.1 // pour des lignes quasi droites
                
            }, {
                label: "T-2",
                borderColor: 'rgba( 23, 32, 42 , 0.9)',// couleur du traits 
                data:  <?php echo json_encode($jsonT2); ?>,// la data qui vient de la BDD
                hidden: true,
                borderDash: [10, 5],// ceci sont les traits avec les pointillier
                fill : false,
                borderWidth: 2,
                lineTension: 0.1 // pour des lignes quasi droites
            }, {
                label: "T-3",
                borderColor: 'rgba(250, 100, 96, 0.9)',// couleur du traits 
                data: <?php echo json_encode($jsonT3); ?>,// la data qui vient de la BDD
                hidden: true,
                borderDash: [10, 5],// ceci sont les traits avec les pointillier
                fill : false,
                borderWidth: 2 ,
                lineTension: 0.1
            }]

        },
        
        options: {
            animation: {duration: 0 },
            responsive : true,
            maintainAspectRatio: false,
            legend: {
                labels:{boxWidth: 120
                    //padding: 10 valeur par défaut pour vertical
                },
                display: true,
                position: 'bottom'
                },
            title: {
                display: true,
                position: "top",
                text: "instant T : " + <?php  echo json_encode($instant_t); ?>,
                fontSize: 10,
                fontColor: "darkblue"
            }, 
                scales: {
                    // demarrage axes de y à 0          
                    yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Température(°C)'
                            },

                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 250
                            }
                        }],

                    // suppression de l'espacement entre les barres
                    xAxes: [{
                            categoryPercentage: 1.0,
                            barPercentage: 1.0
                        }]
                }             
        }
       
       
    });
</script>
</body>

</html>
