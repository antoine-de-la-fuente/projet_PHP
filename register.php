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
        <title>Créer un compte</title>
    </head>
    <body>
        <h1>Créez votre compte entraîneur</h1>

        <form action="register.php" method="post">
        prénom <input type="text" name="prenom"></br>
            nom <input type="text" name="nom"></br>
            email <input type="text" name="email"></br>
            mot de passe <input type="password" name="password"></br>
            confirmation mot de passe <input type="password" name="passwordConfirm"></br>
            <input type="submit" value="Créer mon compte">
            <a href="index.php">
                <input type="button" value="Se connecter">
            </a>
        </form>

        <?php
            // TODO: erreur si rien n'est écrit dans email et mot de passe
            // TODO: afficher erreur seulement après submit
            if(isset($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password'])) {
                $verifEmail = $connexion->prepare('SELECT * FROM entraineurs WHERE Email = ? ;'); 
                $verifEmail->execute(array(str_replace(' ', '', $_POST['email'])));

                if($verifEmail->rowCount() == 0) {
                    if(($_POST['password'] == $_POST['passwordConfirm']) && strlen($_POST['password']) != 0) {
                        $addUser = $connexion->prepare('INSERT INTO entraineurs VALUES(DEFAULT, :prenom, :nom, :email, :password, NULL);');
                        $addUser->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'email' => $_POST['email'], 'password' => $_POST['password']));
                        
                        $verifEmail->execute(array(str_replace(' ', '', $_POST['email'])));
                        $row = $verifEmail->fetch();
                        $_SESSION['accountID'] = $row['ID_Entraineur'];
                        $_SESSION['prenom'] = $row['Prenom'];
                        $_SESSION['nom'] = $row['Nom'];
                        $_SESSION['IDEquipe'] = $rom['ID_Equipe'];
                        header("Location: accueil.php");

                    } else {
                        echo "Les mots de passe ne sont pas les mêmes veuillez réessayer";
                    }

                } else {
                    echo "L'adresse email est déjà utilisée, veuillez réessayer";
                }
            }

            $connexion = null;
         ?>

    </body>
</html>
