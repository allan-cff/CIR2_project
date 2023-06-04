<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// FONCTION QUI AFFICHE TOUS LES MORCEAUX DE LA BDD

function show_tracks() {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT * FROM morceau');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
}

// Affichage des morceaux d'un style (Rap, Rap US ,etc...)

function show_tracks_of_a_style($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT morceau.titre, style_musique.type_musique FROM appartient_a JOIN style_musique USING (id) JOIN morceau ON appartient_a.id_morceau = morceau.id WHERE style_musique.id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
}