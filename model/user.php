<?php

include "utils/bdd.php";


    function hashPassword(String $password):string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function saveUser(string $firstname,string $lastname, string $email, string $hashedPassword):void
    {
        try {
            //Récupération des données de l'utilisateur
            // $firstname = $_POST["firstname"];
            // $lastname = $_POST["lastname"];
            // $email = $_POST["email"];
            // $password = $_POST["password"];
            $request = "INSERT INTO users(firstname, lastname, email, password) VALUES (?,?,?,?)";

            //prépararation de la requête
            $req = connectBDD()->prepare($request);
            //bind param
            $req->bindParam(1, $firstname, \PDO::PARAM_STR);
            $req->bindParam(2, $lastname, \PDO::PARAM_STR);
            $req->bindParam(3, $email, \PDO::PARAM_STR);
            $req->bindParam(4, $password, \PDO::PARAM_STR);
            //éxécution de la requête
            $req->execute();
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    function isUserByEmailExist($email): bool
    {
        try {
            $request = "SELECT u.id_users FROM users AS u WHERE u.email = ?";
            //préparer la requête
            $req = connectBDD()->prepare($request);
            //assigner le paramètre
            $req->bindParam(1, $email, \PDO::PARAM_STR);
            //exécuter la requête
            $req->execute();
            //récupérer le resultat
            $data = $req->fetch(\PDO::FETCH_ASSOC);
            //Test si l'enrgistrement est vide
            if (empty($data)) {
                return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

function findUserByEmail(string $email)
{
    try {
        $request = "SELECT u.id_users AS idUser, u.firstname, u.lastname, u.password, u.img, u.email FROM users AS u WHERE u.email = ?";
        $req = connectBDD()->prepare($request);
        $req -> bindParam(1,$email,\PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch(\PDO::FETCH_ASSOC);

        return $user;
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
}
