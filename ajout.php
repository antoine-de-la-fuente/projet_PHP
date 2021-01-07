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
        <title>Ajout</title>
    </head>
    <body>
        <h1>Ajouter un joueur ou un match</h1>
        <form action="ajout.php" method="post" enctype="multipart/form-data">
            Prénom <input type="text" name="prenom"></br>
            Nom <input type="text" name="nom"></br>
            Poste préféré <select name="poste">
                <option value="attaquant">Attaquant</option>
                <option value="défenseur central">Défenseur central</option>
                <option value="défenseur latéral droit">Défenseur latéral droit</option>
                <option value="défenseur latéral gauche">Défenseur latéral gauche</option>
                <option value="milieu droit">Milieu droit</option>
                <option value="milieu gauche">Milieu gauche</option>
                <option value="gardien">Gardien</option>
            </select></br>
            Photo <input type="file" accept=".jpg" name="photo"></br>
            <input type="submit" value="Envoyer">
            <a href="gestionJoueurs.php"><input type="button" value="Retour à la gestion d'équipe"></a>
        </form>
        <?php
            // TODO: annuler si le joueur existe déjà dans la base
            if(isset($_POST['prenom'], $_POST['nom'], $_POST['poste'])) {
                $targetDir = "photos/";
                $newfilename = $targetDir.$_POST['nom'].".".pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photo']['tmp_name'], $newfilename);
                $joueur = $connexion->prepare("INSERT INTO joueurs VALUES(DEFAULT, :prenom, :nom, 0, 0, 0, 0, 0, 0, :IDEquipe, :cheminPhoto, :poste) ;");
                $joueur->execute(array('prenom' => $_POST['prenom'], 'nom' => $_POST['nom'], 'IDEquipe' => $_SESSION['IDEquipe'], 'poste' => $_POST['poste'], 'cheminPhoto' => $newfilename));

                echo "Le joueur a bien été ajouté à la base";
            }
         ?>
    </body>
</html>
