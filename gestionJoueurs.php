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

    if(!isset($_SESSION['accountID'])) {
        header("Location: index.php");
    }

 ?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Gestion d'équipe</title>
    </head>
    <body>
        <h1>Gérez votre équipe</h1>
        <?php
            $equipe = $connexion->prepare("SELECT * FROM joueurs WHERE ID_Equipe = :IDEquipe ;");
            $equipe->execute(array('IDEquipe' => $_SESSION['IDEquipe']));

            $joueurs = $equipe->fetchAll();
            echo "<table>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th>Prénom</th>";
            echo "<th>Nom</th>";
            echo "<th>Poste préféré</th>";
            echo "</tr>";
            foreach($joueurs as $joueur) {
                echo "<tr>";
                echo "<td><img src=\"".$joueur['Photo']."\" width=\"75\"></td>";
                echo "<td>".$joueur['Prenom']."</td>";
                echo "<td>".$joueur['Nom']."</td>";
                echo "<td>".$joueur['PostePrefere']."</td>";
                echo "<td><a href=\"modification.php?id=".$joueur['ID_Joueur']."\"><button>Modifier</button></a></td>";
                echo "<td><a href=\"suppression.php?id=".$joueur['ID_Joueur']."\"><button>Supprimer</button></a></td>";
                echo "</tr>";
            }
            echo "</table>";
         ?>
        <a href="ajout.php"><input type="button" value="Ajouter un joueur"></a>
        <a href="accueil.php"><input type="button" value="Retour à l'accueil"></a>
    </body>
</html>
