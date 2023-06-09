<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// Fonction de selection d'un morceau trié par son nom (si il commence par un a par exemple), par recherche en gros

function show_morceaux_by_research($string) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $string = '%'.$string.'%';
        $sql = "SELECT morceau.id, morceau.titre, morceau.duree, album.image FROM morceau JOIN album ON morceau.id_album = album.id WHERE LOWER(morceau.titre) LIKE LOWER(:string) ORDER BY titre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':string', $string);
        $stmt->execute();
        $morceaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $morceaux;
}

function show_artists_by_research($string) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $string = '%'.$string.'%';
        $sql = "SELECT * FROM artiste WHERE LOWER(nom) LIKE LOWER(:string) ORDER BY nom";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':string', $string);
        $stmt->execute();
        $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $artistes;
}

function show_albums_by_research($string) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $string = '%'.$string.'%';
        $sql = "SELECT album.id, album.titre, album.date_parution, album.image, style_musique.type_musique FROM album JOIN appartient_a ON album.id = appartient_a.id_album JOIN style_musique ON style_musique.id = appartient_a.id WHERE LOWER(titre) LIKE LOWER(:string) ORDER BY titre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':string', $string, PDO::PARAM_STR);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $albums;
}

