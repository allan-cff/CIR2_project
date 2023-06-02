<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

function show_playlists() {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT * FROM playlist';
        $stmt = $database->prepare($sql);
        $stmt->execute();
        $playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $playlists;
}

function show_playlist_per_id($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT * FROM playlist WHERE id = :id';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $playlist = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $playlist;
}

function show_playlists_of_user($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT p.id, p.nom, p.date_creation, p.image, p.description, (SELECT COUNT(*) FROM contenu_dans WHERE contenu_dans.id_playlist = p.id) AS nb_morceaux, (SELECT SUM(m.duree) FROM contenu_dans c JOIN morceau m USING (id) WHERE c.id_playlist = p.id) AS duree_totale FROM a_creer a JOIN playlist p ON a.id_playlist = p.id WHERE a.id = :id AND is_historique = FALSE AND is_liste_attente = FALSE
        ';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $playlist = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $playlist;
}

function show_tracks_of_favorite($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT morceau.titre, contenu_dans.id from contenu_dans JOIN morceau using (id) where id_playlist = (SELECT id_playlist FROM a_creer WHERE id = :id AND is_favorite)';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $tracks;
}

function show_tracks_of_liste_attente($id) {

    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT morceau.titre, contenu_dans.id from contenu_dans JOIN morceau using (id) where id_playlist = (SELECT id_playlist FROM a_creer WHERE id = :id AND is_liste_attente)';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $tracks;
}


function show_tracks_of_historique($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT morceau.titre, contenu_dans.id from contenu_dans JOIN morceau using (id) where id_playlist = (SELECT id_playlist FROM a_creer WHERE id = :id AND is_historique)';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $tracks;

}

