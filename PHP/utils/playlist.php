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
        $sql = 'SELECT p.id, p.nom, p.date_creation, p.image, p.description, (SELECT COUNT(*) FROM contenu_dans WHERE contenu_dans.id_playlist = p.id) AS nb_morceaux, 
        (SELECT SUM(m.duree) FROM contenu_dans c JOIN morceau m USING (id) WHERE c.id_playlist = p.id) AS duree_totale FROM a_creer a JOIN playlist p ON a.id_playlist = p.id WHERE a.id = :id AND is_historique = FALSE AND is_liste_attente = FALSE
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

function show_tracks_of_playlist($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT morceau.titre, contenu_dans.id from contenu_dans JOIN morceau using (id) where id_playlist = :id';
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

// COMME POUR LE USER, L'ARGUMENT PASSE POUR LA CREATION D'UNE PLAYLIST EST UN TABLEAU ASSOCIATIF CLE-VALEUR
// ON CREE LA PLAYLIST POUR L'USER PASSE EN ARGUMENT

function create_playlist($options, $id_user) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $nom = $options['nom'];
        $image = $options['image'];
        $description = $options['description'];

        $sql = 'INSERT INTO playlist (nom, date_creation, image, description) VALUES (:nom, current_timestamp, :image, :description) RETURNING id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        $id_playlist_creee = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

        // ON LIE LA PLAYLIST AU USER QUI L'A CREE

        $sql = 'INSERT INTO a_creer (id, id_playlist, is_favorite, is_historique, is_liste_attente) VALUES (:id, :id_playlist, FALSE, FALSE, FALSE)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id_user);
        $stmt->bindParam(':id_playlist', $id_playlist_creee);
        $stmt->execute();
    } 
    catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
    }
    return $id_playlist_creee;
}

function delete_playlist($id_playlist) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {

        // ON SUPPRIME EN PREMIER LE LIEN AVEC LE USER DANS LA TABLE A_CREER

        $sql = 'DELETE FROM a_creer WHERE id_playlist = :id_playlist';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();

        // ON SUPPRIME ENSUITE LA PLAYLIST DANS LA TABLE PLAYLIST

        $sql = 'DELETE FROM playlist WHERE id = :id_playlist';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();

        
    } 
    catch (PDOException $exception) {
            error_log('Connection error: ' . $exception->getMessage());
            return false;
    }
    return true;
}

// AFFICHAGE DES MORCEAUX D'UNE PLAYLIST D'UN UTILISATEUR PAR ORDRE ALEATOIRE

function show_tracks_of_a_playlist_random_order($id_playlist) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT morceau.id, morceau.titre, morceau.duree FROM contenu_dans JOIN morceau USING (id) JOIN playlist ON contenu_dans.id_playlist = playlist.id WHERE contenu_dans.id_playlist = :id_playlist ORDER BY random() LIMIT 1000');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

