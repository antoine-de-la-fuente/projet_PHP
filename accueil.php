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

 ?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
    </head>
    <body>
        <h1>Bienvenue <?php echo ucfirst($_SESSION['prenom']); ?></h1>
        <?php
            if($_SESSION['IDEquipe'] == NULL) {
                echo "Vous n'avez aucune équipe</br>";
         ?>
        <a href="mailto:antoine.de-la-fuente@etu.univ-amu.fr"><input type="button" value="Demander une attribution"></br></a>
        <?php
            }
            $equipe = $connexion->prepare("SELECT * FROM equipes WHERE ID_Equipe = :IDEquipe ;");
            $equipe->execute(array('IDEquipe' => $_SESSION['IDEquipe']));

            $row = $equipe->fetch();
            echo "Vous entraînez l'équipe ".$row['Nom'];
         ?>
        <a href="logout.php"><input type="button" value="Déconnexion"></a>
    </body>
</html>
