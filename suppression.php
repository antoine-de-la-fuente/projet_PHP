<?php
    session_start();

    $servername = "localhost";
    $db         = "m3104";
    $username   = "antoine";
    $passwd     = "projetm3104";

    try {
        $connexion = new PDO("mysql:host=$servername;dbname=$db", $username, $passwd);
    } catch(PDOException $e) {
        die("Connection failed ".$e->getMessage());
    }

    $delete = $connexion->prepare("DELETE FROM joueurs WHERE ID_Joueur = :idJoueur ;"); 
    $delete->execute(array('idJoueur' => $_GET['id']));
    $connexion = null;

    header("Location: gestionJoueurs.php");
 ?>
