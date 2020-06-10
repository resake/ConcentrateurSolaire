<!-- Page créant le graphqiue journalier, appelée par la page CapteurGraph.php -->

<?php
// Connexion BDD via PDO (programmation par objet)
 try
{
    $bdd = new PDO("mysql:host=localhost; dbname=Concentrateur_solaire; charset=utf8", "root", ""); // connexion a la bdd
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Test connexionn BDD
catch (Exception $e){
die ($e->getMessage()) ;
}
 
// selection des param de la page capteurGraph 

$capteurSelectionner =  $_POST['choix'];
$param = array($capteurSelectionner);

// choix du capteur et heure ( a modifier )
 $donnee= $bdd->prepare("SELECT valeur, time(date_heure) AS timeH FROM releve2  INNER JOIN capteur ON capteur.idCapteur = releve2.idCapteur   WHERE capteur.nom = ?  AND DATE( date_heure) = ' 2020-05-30'");

 $donnee->execute($param);


  $temp=[];
  $heure=[];
  while ($row=$donnee->fetch(PDO::FETCH_ASSOC)) { // boucle while qui fait en sorte que temt qu'il y a des valeurs dans la bdd alors il les prends suivant la requette sql
    extract($row);


    $temp[]= (int)$valeur;
   $heure[]= (string)$timeH;

  }


?>

 
<!DOCTYPE html>
<html lang="en">

 <head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Concetrateur Solaire</title>

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

<!-------------------------------------------------- choix des différent graphique ------------------------------------------------------------------------------------------------------------------------>
 <div class="col-md-7 mb-6">
<form  class="form-inline" method="post" action="CapteurGraph2.php">

 <label for="validationCustom04">Choix du capteur voulu:</label>

<select name="choix">

<?php
$bdd = new PDO("mysql:host=localhost; dbname=concentrateur_solaire; charset=utf8", "root", "");
       $requete = 'SELECT * FROM capteur WHERE 1';
  $Obj = $bdd->query($requete);
while ($capteur = $Obj->fetch()) {
echo '<option value="' . $capteur['nom'] . '">' . $capteur['nom'].'</option>';
   }
?>
</select>
  <button type="submit" class="btn btn-primary my-1">Valider</button>
 </form>
 </div>
 <!-------------------------------------------------------- calandrier --------------------------------------------------------------------------------------------------------->

 <form action="CapteurGraph.php" class="form-inline" method="post">
  <label for="start">Sélenctionner une date de visionage:</label>

  <input type="date" id="start" name="trip-start"
       value=""
       min="900-01-01" max="3000-12-31">

  <button type="submit" class="btn btn-primary my-1">Valider</button> 
 </form>

  <!-------------------------------------------------- tableau du capteur selectionner--------------------------------------------------------------------------------------------------------------------> 
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
   <div style="position: relative; height:70vh; width:80vw">
        <canvas id="myChart"></canvas>
   </div>   

<!-- Add jQuery lib here -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels:<?php  echo json_encode($heure); ?>, // on recupere les parametre de heure en haut 

            datasets: [{
                label: "instant-T",
                borderColor: 'rgba(100, 30, 22, 0.9)', // couleur du traits 
                data: <?php  echo json_encode($temp); ?>, // la data qui vient de la BDD
                borderDash: [10, 5], // ceci sont les traits avec les pointillier

            }],

        },
    });

</script>

<!-- Add jQuery lib here -->

</body>

</html>
