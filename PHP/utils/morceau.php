<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("config.php");
require_once("database.php");

// FONCTION QUI AFFICHE LE MORCEAU ACTUELLEMENT JOUE

function music_playing($id_user) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // ON CHOPPE L'ID DU MORCEAU EN SAH
        $id = $conn->prepare("SELECT id_morceau from utilisateur WHERE id = :id");
        $id->bindParam(':id', $id_user);
        $id->execute();
        $id_du_morceau = $id->fetch(PDO::FETCH_ASSOC);
        // On convertit l'ID en int
        $id_track = $id_du_morceau['id_morceau'];


        // ON RECUP LE TITRE ET LA DUREE DU MORCEAU
        $stmt = $conn->prepare("SELECT morceau.titre, morceau.duree, artiste.nom, album.image AS album FROM morceau JOIN cree_par ON morceau.id = cree_par.id_morceau JOIN artiste ON artiste.id = cree_par.id JOIN appartient_a ON morceau.id = appartient_a.id JOIN album ON appartient_a.id_album = album.id WHERE morceau.id = :id");
        $stmt->bindParam(':id', $id_track);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // ON RECUPERE LE NOM DES ARTISTES DU MORCEAU
        $stmt = $conn->prepare("SELECT artiste.nom FROM morceau JOIN cree_par ON morceau.id = cree_par.id_morceau JOIN artiste ON artiste.id = cree_par.id WHERE morceau.id = :id");
        $stmt->bindParam(':id', $id_track);
        $stmt->execute();
        // ON ASSOCIE LE NOM DES ARTISTES A LA VARIABLE $ARTISTES
        $artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // ON AJOUTE LA VARIABLE ARTISTES A LA VARIABLE RESULT
        $result['artistes'] = $artistes;


    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    add_track_to_historical($id_user, $id_track);


    return $result;
}

function show_musics_from_historical($id_user) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On choppe l'ID de la playlist hitorique de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_historique = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On choppe les morceaux de la playlist historique de l'utilisateur
        $stmt = $conn->prepare('SELECT morceau.titre, contenu_dans.id from contenu_dans JOIN morceau using (id) where id_playlist = :id_playlist ORDER BY contenu_dans.date_ajout DESC');
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;

}




// FONCTION QUI PERMET DE CHANGER LE MORCEAU ACTUELLEMENT JOUE

function change_music_playing($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // ON CHANGE L'ID DU MORCEAU EN SAH
        $stmt = $conn->prepare("UPDATE utilisateur SET id_morceau = :id_track WHERE id = :id_user");
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// POUR AVOIR LE MORCEAU SUIVANT DE LA FILE D'ATTENTE D'UN UTILISATEUR

function next_track($id_user) {
    $conn = database::connexionBD();
    if(!$conn) {
        return false;
    }
    // On récupère l'ID de la playlist liste d'attente de l'utilisateur
    try {
        $sql = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id_user AND a_creer.is_liste_attente = TRUE');
        $sql->bindParam(':id_user', $id_user);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    // On récupère l'ID du morceau suivant dans la file d'attente par sa date d'ajout
    try {
        $sql = $conn->prepare('SELECT contenu_dans.id FROM contenu_dans JOIN playlist ON contenu_dans.id_playlist = playlist.id WHERE contenu_dans.id_playlist = :id_playlist ORDER BY date_ajout ASC LIMIT 1');
        $sql->bindParam(':id_playlist', $id_playlist);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);

        // Si y'a plus de morceaux dans la liste d'attente, on choisit un morceau random
        if(!$result) {
            
            $sql_random = $conn->prepare('SELECT id FROM morceau ORDER BY random() LIMIT 1');
            $sql_random->execute();
            $result = $sql_random->fetch(PDO::FETCH_ASSOC);
            
            $id_track = $result['id'];

            // On change le morceau actuellement joué par le morceau choisit aleatoirement
            try {
                $sql = $conn->prepare('UPDATE utilisateur SET id_morceau = :id_track WHERE id = :id_user');
                $sql->bindParam(':id_track', $id_track);
                $sql->bindParam(':id_user', $id_user);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

        } 
        
        else {
            
            $id_track = $result['id'];



            // On change le morceau actuellement joué par le morceau suivant
            try {
                $sql = $conn->prepare('UPDATE utilisateur SET id_morceau = :id_track WHERE id = :id_user');
                $sql->bindParam(':id_track', $id_track);
                $sql->bindParam(':id_user', $id_user);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }
            // On supprime le morceau de la file d'attente
            try {
                $sql = $conn->prepare('DELETE FROM contenu_dans WHERE id = :id_track AND id_playlist = :id_playlist');
                $sql->bindParam(':id_track', $id_track);
                $sql->bindParam(':id_playlist', $id_playlist);
                $sql->execute();
                $result = $sql->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

        }
    }
    catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
}






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
    return $result;
}

// Affichage des morceaux de la BDD par ordre alphabétique

function show_tracks_alphabetic_order() {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT * FROM morceau ORDER BY titre ASC');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// AJOUT D'UN MORCEAU DANS LES FAVORIS D'UN UTILISATEUR

function add_track_to_favorite($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_favorite = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On ajoute le morceau à la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('INSERT INTO contenu_dans (id, id_playlist, date_ajout) VALUES (:id_track, :id_playlist, current_timestamp)');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// SUPPRESSION D'UN MORCEAU DES FAVORIS D'UN UTILISATEUR

function remove_track_from_favorite($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_favorite = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On supprime le morceau de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('DELETE FROM contenu_dans WHERE id = :id_track AND id_playlist = :id_playlist');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// AJOUT D'UN MORCEAU DANS LA LISTE D'ATTENTE D'UN UTILISATEUR

function add_track_to_liste_attente($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_liste_attente = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On ajoute le morceau à la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('INSERT INTO contenu_dans (id, id_playlist, date_ajout) VALUES (:id_track, :id_playlist, current_timestamp)');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// SUPPRESSION D'UN MORCEAU DE LA LISTE D'ATTENTE D'UN UTILISATEUR

function remove_track_from_liste_attente($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist liste d'attente de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_liste_attente = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On supprime le morceau de la playlist liste d'attente de l'utilisateur
        $stmt = $conn->prepare('DELETE FROM contenu_dans WHERE id = :id_track AND id_playlist = :id_playlist');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// FONCTION QUI AJOUTE LA MUSIQUE EN COURS D'ECOUTE DANS LES DERNIERS MORCEAUX ECOUTES

function add_track_to_historical($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist historique de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_historique = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On ajoute le morceau à la playlist historique de l'utilisateur
        $stmt = $conn->prepare('INSERT INTO contenu_dans (id, id_playlist, date_ajout) VALUES (:id_track, :id_playlist, current_timestamp)');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// SUPPRESSION D'UN MORCEAU DE LA LISTE DES DERNIERS MORCEAUX ECOUTES D'UN UTILISATEUR

function remove_track_from_historical($id_user, $id_track) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On récupère l'ID de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('SELECT playlist.id FROM a_creer JOIN utilisateur USING (id) JOIN playlist ON a_creer.id_playlist = playlist.id WHERE utilisateur.id = :id AND a_creer.is_historique = TRUE');
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_playlist = $result['id'];

        // On supprime le morceau de la playlist favorite de l'utilisateur
        $stmt = $conn->prepare('DELETE FROM contenu_dans WHERE id = :id_track AND id_playlist = :id_playlist');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// SELECTION D'UN MORCEAU PAR SON ID

function show_track_per_id($id) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT * FROM morceau WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// SELECTION D'UN MORCEAU ALEATOIREMENT

function show_random_track() {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        $stmt = $conn->prepare('SELECT * FROM morceau ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];
        $stmt = $conn->prepare('SELECT * FROM morceau WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return $result;
}

// AJOUT D'UN MORCEAU DANS UNE PLAYLIST D'UN UTILISATEUR

function add_track_to_playlist($id_user, $id_track, $id_playlist) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On ajoute le morceau à la playlist de l'utilisateur
        $stmt = $conn->prepare('INSERT INTO contenu_dans (id, id_playlist, date_ajout) VALUES (:id_track, :id_playlist, current_timestamp)');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}

// SUPPRESSION D'UN MORCEAU D'UNE PLAYLIST D'UN UTILISATEUR

function remove_track_from_playlist($id_user, $id_track, $id_playlist) {
    $conn = database::connexionBD();
    if (!$conn) {
        return false;
    }
    try {
        // On supprime le morceau de la playlist de l'utilisateur
        $stmt = $conn->prepare('DELETE FROM contenu_dans WHERE id = :id_track AND id_playlist = :id_playlist');
        $stmt->bindParam(':id_track', $id_track);
        $stmt->bindParam(':id_playlist', $id_playlist);
        $stmt->execute();
    } catch (PDOException $exception) {
        error_log('Connection error: ' . $exception->getMessage());
        return false;
    }
    return true;
}





