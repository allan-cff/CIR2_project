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

function get_favorite_id($id) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT id_playlist FROM a_creer WHERE id = :id AND is_favorite';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetch(PDO::FETCH_ASSOC);
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
        $sql = 'SELECT morceau.titre, contenu_dans.id, album.image as image_album, album.id as album_id from contenu_dans JOIN morceau using (id) JOIN album ON album.id = morceau.id_album where id_playlist = (SELECT id_playlist FROM a_creer WHERE id = :id AND is_liste_attente)';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ON RECUPERE LES ARTISTES DE CHAQUE MORCEAU
        for($i=0; $i<count($tracks); $i++){
            $sql = 'SELECT artiste.id, artiste.nom FROM cree_par JOIN artiste USING (id) JOIN morceau ON morceau.id = cree_par.id_morceau WHERE morceau.id = :id_morceau';
            $stmt = $database->prepare($sql);
            $stmt->bindParam(':id_morceau', $tracks[$i]['id']);
            $stmt->execute();
            $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tracks[$i]['artistes'] = $artistes;
        }
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
        $sql = 'SELECT morceau.titre, morceau.id, album.image, morceau.duree, album.id as album_id from contenu_dans JOIN morceau using (id) JOIN album ON album.id = morceau.id_album WHERE id_playlist = (SELECT id_playlist FROM a_creer WHERE id = :id AND is_historique) ORDER BY contenu_dans.date_ajout DESC LIMIT 10';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ON RECUPERE LES ARTISTES DE CHAQUE MORCEAU
        for($i=0; $i<count($tracks); $i++){
            $sql = 'SELECT artiste.id, artiste.nom FROM cree_par JOIN artiste USING (id) JOIN morceau ON morceau.id = cree_par.id_morceau WHERE morceau.id = :id_morceau';
            $stmt = $database->prepare($sql);
            $stmt->bindParam(':id_morceau', $tracks[$i]['id']);
            $stmt->execute();
            $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tracks[$i]['artistes'] = $artistes;
        }
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $tracks;

}

function show_tracks_of_playlist($id_playlist) {
    $database = database::connexionBD();

    if (!$database) {
        return false;
    }
    try {
        $sql = 'SELECT morceau.titre, morceau.duree, morceau.id, album.id AS id_album, album.image from morceau JOIN contenu_dans using (id) JOIN playlist ON contenu_dans.id_playlist = playlist.id JOIN album ON album.id = morceau.id_album WHERE playlist.id = :id';
        $stmt = $database->prepare($sql);
        $stmt->bindParam(':id', $id_playlist);
        $stmt->execute();
        $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for($i=0; $i<count($tracks); $i++){
            $sql = 'SELECT artiste.id, artiste.nom FROM cree_par JOIN artiste USING (id) JOIN morceau ON morceau.id = cree_par.id_morceau WHERE morceau.id = :id_morceau';
            $stmt = $database->prepare($sql);
            $stmt->bindParam(':id_morceau', $tracks[$i]['id']);
            $stmt->execute();
            $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tracks[$i]['artistes'] = $artistes;
        }
        
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

function remove_a_track_from_playlist($id_playlist, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('DELETE FROM contenu_dans WHERE id_playlist = :id_playlist AND id = :id_track');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->bindParam(':id_track', $id_track);
        $stmt->execute();
        
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
   
}

function show_infos_of_playlist($id_playlist) {
    $conn = database::connexionBD();
    if(!$conn) {
        return false;
    }
    try {
        $sql = $conn->prepare('SELECT playlist.id, playlist.nom, playlist.date_creation, playlist.image, playlist.description FROM playlist WHERE playlist.id = :id');
        $sql->bindParam(':id', $id_playlist);
        $sql->execute();
        $infos = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

        $sql2 = $conn->prepare('SELECT SUM(morceau.duree) from contenu_dans JOIN morceau using (id) WHERE id_playlist = :id');
        $sql2->bindParam(':id', $id_playlist);
        $sql2->execute();
        $duree_totale = $sql2->fetch(PDO::FETCH_ASSOC)['sum'];

        // On créé un tableau associatif avec les infos de la playlist et la durée totale
        $infos['duree_totale'] = $duree_totale;

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $infos;

}

// Fonction qui supprime tout dans l'historique des derniers morceaux écoutés

function clear_historique($id_user) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récup en premier l'id de la playlist historique de l'user
        $sql = 'SELECT id_playlist FROM a_creer WHERE id = :id_user AND is_historique = TRUE';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $id_playlist = $stmt->fetch(PDO::FETCH_ASSOC)['id_playlist'];

    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    try {
        // On supprime ensuite tout dans la table contenu_dans
        $sql = 'DELETE FROM contenu_dans WHERE id_playlist = :id_playlist';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
}


