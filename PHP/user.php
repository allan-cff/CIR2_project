<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// FONCTION DE VERIFICATION DES INFORMATIONS DE CONNEXION D'UN UTILISATEUR

function verify_user($mail, $password) {
   
    $conn = database::connexionBD();
    if(!$conn) {
        return false;
    }

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

function add_new_user($prenom, $nom, $age, $mail, $password) {

    $conn = Database::connexionBD();
            if (!$conn) {
                return false;
            }

            for ($i = 0; $i <= strlen($prenom)-1; $i++) {
                if(is_numeric($prenom[$i]))  {
                   return "Erreur, prenom non valide";
                }
            }

            for ($i = 0; $i <= strlen($nom)-1; $i++) {
                if(is_numeric($nom[$i]))  {
                   return "Erreur, nom non valide";
                }
            }

            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                
                try {
                    $sql = 'INSERT INTO utilisateur (prenom, nom, age, mail, password, username, is_admin) 
                            VALUES ( :prenom, :nom, :age, :mail, :password, :username, FALSE) RETURNING id';
                    $stmt = $conn->prepare($sql);
    
                    $pwd = password_hash($password, PASSWORD_BCRYPT);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':mail', $mail);
                    $stmt->bindParam(':password', $pwd);
                    $stmt->bindParam(':age', $age);
                    $stmt->bindParam(':username', $mail);
                
                    $valid = $stmt->execute();
                    $id_user_created = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

                } catch (PDOException $exception) {
                    error_log('Connection error: ' . $exception->getMessage());
                    return false;
                }

                if($valid) {
                    create_playlists($id_user_created);
                }

                header('Location: login.php');
                return "Succès ! Vous avez bien été inscris !";
            }
            
}



function create_playlists($id_user_created) {

    $conn = Database::connexionBD();

    // CREATION PLAYLIST FAVORIS
    $sql = 'INSERT INTO playlist (nom, date_creation, description) VALUES (:nom, current_timestamp, :description) RETURNING id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nom', "FAVORIS");
    $stmt->bindValue(':description', "Vos titres favoris");
    $stmt->execute();
    $id_playlist_creee = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    // ASSIGNATION AU USER
    $sql = 'INSERT INTO a_creer (id, id_playlist, is_favorite, is_liste_attente, is_historique) VALUES (:id, :id_playlist, TRUE, FALSE, FALSE)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_user_created);
    $stmt->bindParam(':id_playlist', $id_playlist_creee);
    $stmt->execute();


    //CREATION PLAYLIST LISTE D'ATTENTE
    $sql = 'INSERT INTO playlist (nom, date_creation, description) VALUES (:nom, current_timestamp, :description) RETURNING id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nom', "LISTE D'ATTENTE");
    $stmt->bindValue(':description', "");
    $stmt->execute();
    $id_playlist_creee = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    // ASSIGNATION AU USER
    $sql = 'INSERT INTO a_creer (id, id_playlist, is_favorite, is_liste_attente, is_historique) VALUES (:id, :id_playlist, FALSE, TRUE, FALSE)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_user_created);
    $stmt->bindParam(':id_playlist', $id_playlist_creee);
    $stmt->execute();


    //CREATION PLAYLIST HISTORIQUE
    $sql = 'INSERT INTO playlist (nom, date_creation, description) VALUES (:nom, current_timestamp, :description) RETURNING id';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nom', "HISTORIQUE");
    $stmt->bindValue(':description', "");
    $stmt->execute();
    $id_playlist_creee = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    // ASSIGNATION AU USER
    $sql = 'INSERT INTO a_creer (id, id_playlist, is_favorite, is_liste_attente, is_historique) VALUES (:id, :id_playlist, FALSE, FALSE, TRUE)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_user_created);
    $stmt->bindParam(':id_playlist', $id_playlist_creee);
    $stmt->execute();
}

?>