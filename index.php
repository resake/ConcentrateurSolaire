<?php/*  
session_start();
if ($_GET['deconnexion'] == true) {
  unset($_SESSION['id']);
}
*/?>
<!-------------------------------------------------------- Page de connexion ---------------------->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Concentrateur Solaire</title>

  <!-- Bootstrap  CSS via leurs lien https qui sert à la mise en place de la bande noir du menu, ainsi qu'a la disposition, et le bouton -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
  
  <!-- Page de connexion  -->
  <div class="mx-auto" style="width: 18rem">
    <div class="card p-4 align-middle">
      <img src="images/u6.png" class="card-img-top " alt="...">      <!-- on ouvre une balise <img> pour mettre une image avec un lien vers la source de l'image  -->
      <div class="row">
        <div class="col-lg-12 text-center">
          <form action="exec_connexion.php" method="POST" class="form-signin"> <!-- début du formulaire  qui nous redirige vers une autre page php avec comme méthode POST se qui permet utiliser les informations que l'on rentre en bas  -->
          	<!--nous mettons 2 balises input pour créé des cases sur le quelle nous évrivons et envoyions des informations grâce au boutton d'envoie  -->
            <input class="form-control my-2 " name="email" type="email" placeholder="adresse mail"> 
            <input class="form-control" name="password" type="password" placeholder="mot de passe">
            <div class="action">
              <input class="btn btn-primary signup" type="submit" value="Connexion"><!-- on créé un boutton connexion  -->
            </div>
          </form>
         </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.slim.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
