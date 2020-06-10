<?php
session_start();
// Connexion BDD
 try
{
    $pdo = new PDO("mysql:host=localhost; dbname=Concentrateur_solaire; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// Test connexionn BDD
catch (Exception $e){
die ($e->getMessage()) ;
}

// Récupération des variables du formulaire
$email = $_POST['email'];
$password = $_POST['password'];
$password_encrypted = md5($password);

// Recherche si l'utilisateur existe
$sql = <<<SQL_STATEMENT
SELECT id FROM Utilisateur WHERE email = :email AND password = :password;
SQL_STATEMENT;
$requete = $pdo->prepare($sql);
$requete->setFetchMode(PDO::FETCH_ASSOC);
$requete->bindParam(':email', $email);
$requete->bindParam(':password', $password_encrypted);
$requete->execute();
$result = $requete->fetchAll();
$requete->closeCursor();

if(count($result) == 1){
    // On a trouvé un user
    $_SESSION['id']=$result[0]['id'];
    header('Location: /projet1/accueil.php');
} else {
    // On a pas trouvé d'user
    header('Location: /');
}
?>