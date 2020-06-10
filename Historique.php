<?php /*
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

 <!-- historique des capteurs affichage sous forme de tableaux avec possibilité de choix de la zone -->
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
 

<?php // on ouvre une balise pour écrire du php dans du html
// Connexion BDD via PDO (programmation par objet)
 try
{
    $bdd = new PDO("mysql:host=localhost; dbname=Concentrateur_solaire; charset=utf8", "root", "");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Gestion des erreurs 
catch (Exception $e){
die ($e->getMessage()) ;
}

// RequÃªte SQL on SELECTIONNE se que l'on souhaite dans la base de donnée DES tables voulu  OU les id des cpateurs  correspondent au id des résultats ET l'id de la zone corresponde au idzone TRIER PAR  la date DESCENDANT avec une LIMITE de 65 résultats
$req = $bdd->prepare("SELECT Capteur.nom, Releve.valeur, Releve.date_heure, Zone.nom, Capteur.nom, Capteur.type_capteur, Releve.idReleve, Zone.idZone FROM Releve,Capteur,Zone WHERE Capteur.idCapteur=Releve.idCapteur AND Zone.idZone = Capteur.idZone ORDER BY Date_heure DESC LIMIT 65  ");
$req->execute();
?>

<form action="exec_zone.php" class="form-inline" method="post"> <!-- on ouvre une formulaire  -->
<div class="col-md-7 mb-6">
  <label for="validationCustom04">Choix de la zone a selectionner :</label> <!-- le label est la pour écrire des seque l'on veux pour donnée un nom au formulaire  --> 
  </div>

  <!-- le select est la pour crée un menue déroulant pour selection une option -->
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
<table class="table table-striped"> <!-- un créé un tableau pour mettre les donnée de la requette sql -->
  <thead>
    <tr>
      <th scope="col">IdReleve</th> <!-- les titre de chaque catégorie du tableau qui ne changeront jamais. -->
      <th scope="col">Type de capteur</th>
      <th scope="col">Nom</th>
      <th scope="col">IdZone</th>
      <th scope="col">Valeur</th>
      <th scope="col">Date_heure</th>
    </tr>
  </thead>

<?php
// Afficher les donnÃ©es de la requette sql juste en haut 
  echo"<tbody>";
  while ($donnee = $req->fetch()) // on crée un while donc une boucle qui prend toute les données que l'on a voulu prendre avec la requette sql 
  {
      echo "<tr>"; 
          echo "<td>" .$donnee['idReleve']. "</td>"; //on écrie des echo pour affichier les données voulues 
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
