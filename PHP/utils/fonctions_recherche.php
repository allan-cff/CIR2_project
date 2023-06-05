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
        $sql = "SELECT * FROM morceau WHERE titre ILIKE '%' || :string || '%' ORDER BY titre";
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
        $sql = "SELECT * FROM artiste WHERE nom ILIKE '%' || :string || '%' ORDER BY nom";
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
        $sql = "SELECT * FROM album WHERE titre ILIKE '%' || :string || '%' ORDER BY titre";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':string', $string);
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $albums;
}

