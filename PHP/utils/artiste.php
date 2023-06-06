<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// Fonction d'affichage des artistes

function show_artists() {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM artiste');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// Fonction d'affichage d'un artiste par son id

function show_artist_per_id($id) {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM artiste WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}

// FONCTION D'AFFICHAGE DES ALBUMS D'UN ARTISTE PAR SON ID

function show_albums_of_artist($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT album.titre, album.date_parution, album.image FROM a_compose JOIN album USING (id) JOIN artiste ON artiste.id = a_compose.id_artiste WHERE artiste.id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// FONCTION D'AFFICHAGE DES MORCEAUX D'UN ARTISTE PAR SON ID

function show_musics_of_artist($id_artist) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = 'SELECT morceau.titre, morceau.duree, artiste.nom AS artiste, album.image FROM cree_par JOIN artiste USING (id) JOIN morceau ON morceau.id = cree_par.id_morceau JOIN album ON album.id = morceau.id_album WHERE artiste.id = :id';
        $stmt = $conn->prepare($stmt);
        $stmt->bindParam(':id', $id_artist);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// FONCTON D'AFFICHAGE DU TYPE D'UN ARTISTE PAR SON ID

function show_type_of_artist($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = 'SELECT type, nom FROM type_artiste, artiste WHERE type_artiste.id = artiste.id_type_artiste AND artiste.id = :id';  
        $stmt = $conn->prepare($stmt);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// AFFICHAGE DE TOUS LES ARTISTES CORRESPONDANT A UN TYPE (Chanteur, groupe, etc...)

function show_artist_from_a_type($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = 'SELECT artiste.nom, type_artiste.type FROM artiste, type_artiste WHERE artiste.id_type_artiste = type_artiste.id AND type_artiste.id = :id';
        $stmt = $conn->prepare($stmt);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// AFFICHAGE DES ARTISTES TRIES PAR LEUR TYPE (Chanteur, Groupe)

function show_type_of_artist_ordered_by_type() {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = 'SELECT type, nom FROM type_artiste, artiste WHERE type_artiste.id = artiste.id_type_artiste ORDER BY type_artiste.type;';  
        $stmt = $conn->prepare($stmt);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// Fonction d'affichage des artistes par ordre alphabetique

function show_artists_alphabetic_order() {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT * FROM artiste ORDER BY nom ASC');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }

    return $result;

}





