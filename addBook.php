<?php
include "model/category.php";
include "model/book.php";
include "utils/tool.php";



function addBook() {
        $message  = "";
        $categories = findAllCategory();
        $userId = $_SESSION["id"];
        if( isset($_POST["add"])) {
            
            if( !empty($_POST["title"]) && !empty($_POST["description"]) && !empty($_POST["publication_date"]) && !empty($_POST["author"])) {
                $publication_date = $_POST["publication_date"];
                $title = sanitize($_POST["title"]);
                $description = sanitize($_POST["description"]);
                $author = sanitize($_POST["author"]);

                //récupération des categories
                $categories = $_POST["categories"];

                foreach ($categories as $category) {
                    $cat = ($category);
    
                }
                saveBook();
                
                $message = "La livre a été ajouté";

            } else {
                $message = "Veuillez remplir tous les champs du formulaire";
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
    <title>Ajouter livre</title>
</head>
<body>
    <header class="container-fluid">
        <?php include "components/navbar.php"; ?>
    </header>
    <main class="container-fluid">
        <form action="" method="post">
            <h2>Ajouter un livre</h2>
            <input type="text" name="title" placeholder="Sasir le titre du livre">
            <textarea name="description" rows="4" cols="50" placeholder="Sasir la description du livre"></textarea>
            <label for="publication_date">date publication</label>
            <input type="datetime-local" name="publication_date">
            <input type="text" name="author" placeholder="Sasir l'auteur du livre">
            <label for="categories">Choisir la categorie :</label>
            <select multiple="true" name="categories[]">
                <optgroup label="Category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->getIdCategory() ?>"><?= $category->getName() ?></option>
                    <?php endforeach ?>
                </optgroup>
            </select>
            <input type="submit" value="Ajouter" name="add">
        </form>
        <p><?= $message ?? "" ?></p>
    </main>
</body>
</html>