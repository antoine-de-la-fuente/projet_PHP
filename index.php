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
        <meta charset = "utf-8">
        <title>Connexion</title>
    </head>
    <body>
        <h1>Connectez vous à votre compte</h1>

        <form action="index.php" method="post">
            email <input type="text" name="email"></br>
            mot de passe <input type="password" name="password"></br>
            <input type="submit" value="Se connecter">
            <a href="register.php">
                <input type="button" value="Créer un compte">
            </a>
        </form>

        <?php
            // TODO: erreur si rien n'est écrit dans email et mot de passe
            // TODO: afficher erreur seulement après submit
            if(isset($_POST['email'])) {
                $verifEmail = $connexion->prepare('SELECT * FROM entraineurs WHERE Email = ? ;'); 
                $verifEmail->execute(array(str_replace(' ', '', $_POST['email'])));

                if($verifEmail->rowCount() == 1) {
                    $verifMDP = $connexion->prepare('SELECT * FROM entraineurs WHERE Email = ? AND Motdepasse = ? ;');
                    $verifMDP->execute(array($_POST['email'], $_POST['password']));

                    if($verifMDP->rowCount() == 1) {
                        $row = $verifMDP->fetch();
                        $_SESSION['accountID'] = $row['ID_Entraineur'];
                        $_SESSION['prenom'] = $row['Prenom'];
                        $_SESSION['nom'] = $row['Nom'];
                        $_SESSION['IDEquipe'] = $row['ID_Equipe'];
                        header("Location: accueil.php");

                    } else {
                        echo "Mot de passe incorrect, veuilles réessayer";
                    }

                } else {
                    echo "L'email spécifié n'est pas valide, veuillez réessayer";
                }
            }

            $connexion = null;
         ?>

    </body>
</html>
