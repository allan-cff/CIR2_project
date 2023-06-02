<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// FONCTION D'AFFICHAGE DES ALBUMS

function show_albums() {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM album');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// FONCTION D'AFFICHAGE D'UN ALBUM PAR SON ID

function show_album_per_id($id) {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM album WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// FONCTION D'AFFICHAGE DU NOMBRE DE TITRES D'UN ALBUM

function show_nb_tracks_per_album($id) {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT COUNT(morceau.id) AS nombre_morceaux FROM morceau, album WHERE album.id = morceau.id_album AND album.id = :id;');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// AFFICHAGE DES MUSIQUES D'UN ALBUM AVEC LEURS INFOS

function show_tracks_of_album($id) {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM morceau WHERE id_album = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// AFFICHAGE DES MUSIQUES D'UN ALBUM PAR ORDRE ALPHABETIQUE

function show_tracks_of_album_alphabetic_order($id) {
    
        $conn = database::connexionBD();
        if (!$conn) {
            return false;
        }
    
        try {
            $stmt = $conn->prepare('SELECT * FROM morceau WHERE id_album = :id ORDER BY titre');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    
        return $result;
    
}

// AFFICHAGE DES MUSIQUES D'UN ALBUM AVEC LEURS INFOS

function show_tracks_of_album_default_order($id) {
    
        $conn = database::connexionBD();
        if (!$conn) {
            return false;
        }
    
        try {
            $stmt = $conn->prepare('SELECT * FROM morceau WHERE id_album = :id ORDER BY id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
        }
    
        return $result;
    
}

?>

