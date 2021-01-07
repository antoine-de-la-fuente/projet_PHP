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

    $joueur = $connexion->prepare("SELECT Prenom, Nom, PostePrefere FROM joueurs WHERE ID_Joueur = :idJoueur");
    $joueur->execute(array('idJoueur' => $_GET['id']));

    $row = $joueur->fetch();
    $prenom = $row['Prenom'];
    $nom = $row['Nom'];
    $poste = $row['PostePrefere'];
 ?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Modification</title>
    </head>
    <body>
        <h1>Modifier le joueur</h1>
        <form action="modification.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
            Prénom <input type="text" name="prenom" value="<?php echo $prenom; ?>"></br>
            Nom <input type="text" name="nom" value="<?php echo $nom; ?>"></br>
            Poste préféré <select name="poste" value="<?php echo $poste; ?>">
                <option value="attaquant">Attaquant</option>
                <option value="défenseur central">Défenseur central</option>
                <option value="défenseur latéral droit">Défenseur latéral droit</option>
                <option value="défenseur latéral gauche">Défenseur latéral gauche</option>
                <option value="milieu droit">Milieu droit</option>
                <option value="milieu gauche">Milieu gauche</option>
                <option value="gardien">Gardien</option>
            </select></br>
            Photo <input type="file" name="photo" accept=".jpg">
            <input type="submit" value="Envoyer">
            <a href="gestionJoueurs.php"><input type="button" value="Retour à la gestion d'équipe"></a>
        </form>
        <?php
            if(isset($_POST['prenom'], $_POST['nom'], $_POST['poste'])) {
                $targetDir = "photos/";
                $newfilename = $targetDir.$_POST['nom'].".".pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['photo']['tmp_name'], $newfilename);
                $joueur = $connexion->prepare("UPDATE joueurs SET Nom = :nom , Prenom = :prenom , PostePrefere = :poste, Photo = :cheminPhoto WHERE ID_Joueur = :idJoueur ;");
                $joueur->execute(array('prenom' => $_POST['prenom'], 'nom' => $_POST['nom'], 'idJoueur' => $_GET['id'], 'poste' => $_POST['poste'], 'cheminPhoto' => $newfilename));
            }
            
            if(isset($_POST['submit'])) {
                header("Location: gestionJoueurs.php");
            }

         ?>
    </body>
</html>
