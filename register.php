<?php
include "utils/tool.php";
include "model/user.php";
$message = "";


function addUser(){
    $message = "";

        //Test si le formulaire est submit
        if (isset($_POST["submit"])) {
            if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

                $firstname = sanitize($_POST["firstname"]);
                $lastname = sanitize($_POST["lastname"]);
                $email = sanitize($_POST["email"]);
                $password = sanitize($_POST["password"]);
                if (!isUserByEmailExist($email)) {
                    
                    //hash du mot de passe
                   
                    $hashedPassword = hashPassword($password);
                    //ajoute le compte en BDD
                    saveUser($firstname, $lastname,$email,$hashedPassword);
                    $message = "Le compte a été ajouté en BDD";
                    header("Refresh:2; url=/evaluation_php_florival_julien/index.php");
                } else {

                    $message = "Le compte existe déja";
                    header("Refresh:2; url=/evaluation_php_florival_julien/register.php");
                }
            } else {
                $message = "Veuillez remplir tous les champs";
                header("Refresh:2; url=/evaluation_php_florival_julien/register.php");
            }
        }      
    }
    addUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/pico.min.css">
    <title>s'inscrire</title>
</head>
<body>
    <header class="container-fluid">
        <?php include "components/navbar.php"; ?>
    </header>

    <main class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>S'inscrire</h2>
            <p class="error"><?= $message ?></p>
            <input type="text" name="firstname" placeholder="saisir le prénom">
            <input type="text" name="lastname" placeholder="saisir le nom">
            <input type="email" name="email" placeholder="saisir le mail">
            <input type="password" name="password" placeholder="saisir le password">
            <input type="submit" value="inscription" name="submit">
        </form>

    </main>
</body>
</html>