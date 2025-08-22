<?php

include "utils/bdd.php";

function saveBook(string $title, string $description, string $publication_date, string $author, int $userId, array $categories): void
    {
        try {
       
            $request = "INSERT INTO book(title, description, publication_date, author, category, idUser) 
            VALUE (?,?,?,?,?)";
            //Préparation de la requête
            $req = connectBDD()->prepare($request);
            //Bind des paramètres (Task)
            $req->bindParam(1, $title, \PDO::PARAM_STR);
            $req->bindParam(2, $description, \PDO::PARAM_STR);
            $req->bindParam(3, $publication_date, \PDO::PARAM_STR);
            $req->bindParam(4, $author, \PDO::PARAM_STR);
            $req->bindParam(5, $category, \PDO::PARAM_BOOL);
            $req->bindParam(6, $idUser, \PDO::PARAM_INT);
            //Exécution de la requête principale
            $req->execute();


        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
