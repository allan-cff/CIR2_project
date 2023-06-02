<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// FONCTION DE VERIFICATION DES INFORMATIONS DE CONNEXION D'UN UTILISATEUR

function verify_user($mail, $password) {
   
    $conn = database::connexionBD();
        try {
            $stmt = $conn->prepare('SELECT id, password FROM utilisateur WHERE mail = :email');
            $stmt->bindParam(':email', $mail);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            print_r($result);

        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }

        // Si les informations de connexion sont correctes, on connecte l'utilisateur et on le redirige vers la page d'accueil
        if (!empty($result) && password_verify($password, $result['password'])) {
            $_SESSION['id'] = $result['id'];
            header('Location: lindex.php'); // On redirige l'utilisateur vers la page d'accueil
        } else {
            header('Location: login.php');
        }
    }


// FONCTION D'INSCRIPTION D'UN UTILISATEUR APRES VERIFICATION DES INFORMATIONS

function add_new_user() {

    $conn = Database::connexionBD();

            if (!$conn) {
                return false;
            }
            try {

                $sql = 'INSERT INTO utilisateur (prenom, nom, age, mail, password) 
                        VALUES ( :prenom, :nom, :age, :username, :password)';
                $stmt = $conn->prepare($sql);

                $pwd = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bindParam(':nom', $nom_client);
                $stmt->bindParam(':prenom', $prenom_client);
                $stmt->bindParam(':username', $mail);
                $stmt->bindParam(':password', $pwd);
                $stmt->bindParam(':age', $age);
            
                $stmt->execute();


                header('Location: login.php');
                exit();
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

}


function disconnect() {

    unset($_SESSION['ID']);

    header('Location: login.php');
}

?>