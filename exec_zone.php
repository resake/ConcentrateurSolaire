<?php/*   code pour la sécuritée (non abouti)
session_start();
if ($_GET['deconnexion'] == true) {
  unset($_SESSION['id']);
}
if (!isset($_SESSION['id'])) {
    echo "Attention : vous n'avez pas accès à cette page, vous devez être connecté";
    echo '<br/>';
    echo '<a href="index.php">Se connecter</a>';
    die();
}
*/?>

<!-- Page qui permet d'afficher les données des capteurs par zone -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Concetrateur Solaire</title> <!-- titre de la page en haut de la page-->

    <!-- Bootstrap  CSS via leurs lien https qui sert à la mise en place de la bande noir du menu, ainsi qu'a la disposition -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>

  <!-- la barre menu  -->
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
 
<?php
// Connexion BDD via PDO (programmation par objet)
 try
{
    $bdd = new PDO("mysql:host=localhost; dbname=Concentrateur_solaire; charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Test connexionn BDD
catch (Exception $e){
die ($e->getMessage()) ;
}

// Récup des paramètres
$nom = $_POST["zoneExcat"];

// Recherche la zone sélectionné par l'utilisateur, en récupérant tous les éléments affichés.

$req = $bdd->prepare("SELECT Capteur.nom, Releve.valeur, Releve.date_heure, Zone.nom, Capteur.nom, Capteur.type_capteur, Releve.idReleve, Zone.idZone FROM Releve,Capteur,Zone WHERE Capteur.idCapteur=Releve.idCapteur AND Zone.idZone = Capteur.idZone AND Zone.nom= :zoneExcat;  ");
$req->bindParam(':zoneExcat', $nom);
$req->execute();
?>

<form action="exec_zone.php" class="form-inline" method="post">
<div class="col-md-7 mb-6">
  <label for="validationCustom04">Choix de la zone a selectionner :</label>
  </div>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="zoneExcat" >
    <div class="col-md-3 mb-3">
    <option selected>Choisir...</option>
    <option value="meteo_exterieur">1</option>
    <option value="recepteur_metal">2</option>
    <option value="recepteur_air">3</option>
    </div>
  </select>
  <button type="submit" class="btn btn-primary my-1">Valider</button>
</form>

<div class="container"> 
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">IdReleve</th>
      <th scope="col">Type de capteur</th>
      <th scope="col">Nom</th>
      <th scope="col">IdZone</th>
      <th scope="col">Valeur</th>
      <th scope="col">Date_heure</th>
    </tr>
  </thead>

<?php
// Afficher les données de la table
  echo"<tbody>";
  while ($donnee = $req->fetch())
  {
      echo "<tr>";
          echo "<td>" .$donnee['idReleve']. "</td>";
          echo "<td>" .$donnee['type_capteur']. "</td>";
          echo "<td>" .$donnee['nom']. "</td>";
          echo "<td>" .$donnee['idZone']. "</td>";
          echo "<td>" .$donnee['valeur']. "</td>";
          echo "<td>" .$donnee['date_heure']. "</td>";
      echo "</tr>";
  }
  echo"</tbody>";
echo "</table>";
 ?>
</div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>