<?php
include "utils/tool.php";
include "model/user.php";
$message  = "";




function connexion()
{
    $message = "";
    if (isset($_POST["submit"])) {
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {       
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            // Test si le compte existe
            if (isUserByEmailExist($email)) { 
                // Récupération du compte en BDD
                $userConnected = findUserByEmail($email);
                
                // Vérification du mot de passe
                if (password_verify($password, $userConnected["password"])) {
                    
                    //initialiser les super gobale de la SESSION
                    $_SESSION["connected"] = true;
                    $_SESSION["email"]     = $userConnected["email"];
                    $_SESSION["id"]        = $userConnected["id_users"];
                    session_start();
                    header("Location: /evaluation_php_florival_julien/index.php");
                    
            } else {
                $message = "Les informations de connexion ne sont pas correctes";
                header("Refresh:2; url=/evaluation_php_florival_julien/connexion.php");
            }
        } else {
            $message = "Les informations de connexion ne sont pas correctes";
            header("Refresh:2; url=/evaluation_php_florival_julien/connexion.php");         
        }
    } else {
        $message = "Veuillez remplir les champs";
        header("Refresh:2; url=/evaluation_php_florival_julien/connexion.php");   
    }
    }   
}    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/pico.min.css">
    <title>Connexion</title>
</head>
<body>
    <header class="container-fluid">
        <?php include "components/navbar.php"; ?>
    </header>
    <main>
        <form action="" method="post">
            <h2>Se connecter</h2>
            <input type="email" name="email" placeholder="saisir le mail">
            <input type="password" name="password" placeholder="saisir le mot de passe">
            <input type="submit" value="connexion" name="submit">
            <p class="error"><?= $message ?></p>
            </form>
    </main>
</body>
</html>