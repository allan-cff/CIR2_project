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

// FONCTION D'AFFICHAGE DU NOMBRE DE TITRES D'UN ALBUM ET DE LA DUREE TOTALE DE L'ALBUM

function show_nb_tracks_per_album($id) {

    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }

    try {
        $stmt = $conn->prepare('SELECT COUNT(morceau.id) AS nombre_morceaux, SUM(morceau.duree) AS duree_totale FROM morceau, album WHERE album.id = morceau.id_album AND album.id = :id;');
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
        $stmt = $conn->prepare('SELECT morceau.titre, morceau.duree, albm.image, a.nom FROM morceau JOIN album albm on albm.id = morceau.id_album JOIN cree_par cp on morceau.id = cp.id_morceau join artiste a on a.id = cp.id WHERE id_album = :id');
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

// AFFICHAGE DES MUSIQUES D'UN ALBUM AVEC LEURS INFOS GRÂCE A SON ID

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




// Fonction qui montre les artistes présents dans un album

function show_authors_of_album($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT artiste.nom FROM a_compose JOIN album using (id) JOIN artiste ON artiste.id = a_compose.id_artiste WHERE a_compose.id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// Fonction qui ajoute un album à une playlist

function add_album_on_a_playlist($id_playlist, $id_album) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $tracks = show_tracks_of_album($id_album);
        echo json_encode($tracks);
        foreach ($tracks as $track) {
            $stmt = $conn->prepare('INSERT INTO contenu_dans (id_playlist, id, date_ajout) VALUES (:id_playlist, :id_morceau, current_timestamp)');
            $stmt->bindParam(':id_playlist', $id_playlist);
            $stmt->bindParam(':id_morceau', $track['id']);
            $stmt->execute();
        }
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
    
}

// Fonction qui montre les albums les plus récents

function show_newest_albums() {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare("SELECT album,id, album.titre, album.image, album.date_parution FROM album JOIN a_compose ac on album.id = ac.id JOIN artiste a on ac.id_artiste = a.id ORDER BY date_parution DESC LIMIT 10");
        $stmt->execute();
        $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // ON RECUPERE LES ARTISTES POUR CHAQUE ALBUM
        foreach($albums as $album) {
            $stmt = $conn->prepare("SELECT artiste.nom FROM a_compose JOIN album using (id) JOIN artiste ON artiste.id = a_compose.id_artiste WHERE album.id = :id");
            $stmt->bindParam(':id', $album['id']);
            $stmt->execute();
            $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $album['artistes'] = $artistes;
        }
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

function show_type_of_album($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare("SELECT album.titre, style_musique.type_musique FROM appartient_a JOIN style_musique USING (id) JOIN album ON album.id = appartient_a.album_id WHERE appartient_a.album_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

function show_album_by_type($id_type) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare("SELECT album.titre, style_musique.type_musique FROM appartient_a JOIN style_musique USING (id) JOIN album ON album.id = appartient_a.album_id WHERE appartient_a.id = :id");
        $stmt->bindParam(':id', $id_type);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

?>

