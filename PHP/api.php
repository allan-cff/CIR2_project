<?php
    require_once 'utils/database.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $path = explode('/', $_SERVER['PATH_INFO']);

    
    require_once 'utils/playlist.php';
    require_once 'utils/user.php';
    require_once 'utils/morceau.php';

    session_start();

    # POST /users
    # GET /users/loggedId
    # GET /users/:id
    # PUT /users/:id
    # DELETE /users/:id 
    # GET /users/:id/nowlistening
    # POST /users/:id/nowlistening
    # GET /users/:id/nextsong
    # GET /users/:id/recents
    # POST /users/:id/recents
    # DELETE /users/:id/recents/:id                 // TODO (suppression d'une musique écoutée récemment) // plus tard pas forcement obligatory
    # GET /users/:id/waitlist
    # PUT /users/:id/waitlist                       // TODO (ajout d'un son à la liste d'attente)
    # DELETE /users/:id/waitlist/:id
    # GET /users/:id/favorites
    # PUT /users/:id/favorites                      // TODO (ajout d'un son aux favorits)
    # DELETE /users/:id/favorites/:id               // TODO (suppression d'un favori)
    # GET /users/:id/playlists
    # POST /users/:id/playlists                     // TODO (ajout d'une nouvelle playlist)
    # GET /users/:id/playlists/:id                  // TODO (info détaillées et liste des sons d'une playlist)
    # POST /users/:id/playlists/:id/tracks          // TODO (ajout d'un son dans une playlist)
    # DELETE /users/:id/playlists/:id/tracks/:id    // TODO (suppression d'une musique d'une playlist)


    if($path[1] === 'users'){
// ID DE UTILISATEUR CONNECTE ==> OK
        if(count($path) === 3 && $path[2] === 'loggedId' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            if (isset($_SESSION['id'])) {
                $res = array("id" => $_SESSION['id']);
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// TITRE ACTUELLEMENT JOUE ==> OK
        if(count($path) === 4 && $path[3] === 'nowlistening' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = music_playing($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// JOUER UN TITRE IMMEDIATEMENT ==> OK
        if(count($path) === 5 && $path[3] === 'listen' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $id_morceau = $path[4];
            change_music_playing($id, $id_morceau);
            $res = music_playing($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// PROCHAIN TITRE A JOUER ==> OK
        if(count($path) === 4 && $path[3] === 'nextsong' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            next_track($id);
            $res = music_playing($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// PRECEDENT TITRE A JOUER
        if(count($path) === 4 && $path[3] === 'prevsong' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            previous_track($id);
            $res = music_playing($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }


// MONTRE LES DERNIER TITRE ECOUTE PAR L USER (HISTORIQUE) => OK

        if(count($path) === 4 && $path[3] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_historique($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// AJOUTE UN TITRE DANS L HISTORIQUE DES TITRES ECOUTE

        if(count($path) === 5 && $path[3] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = add_track_to_historical($id, $id_morceau); //METTRE LA FONCTION QUI PERMET D AJOUTER UN SONS A 10 DERNIER MORCEAUX 2COUTER
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//  SUPPRIME UN TITRE DE L HISTORIQUE DES ECOUTE // faire peut être demain

        if(count($path) === 5 && $path[3] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = remove_track_from_historical($id, $id_morceau);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// MONTRE LES TITRES DANS LA FILE D ATTENTE
        if(count($path) === 4 && $path[3] === 'waitlist' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_liste_attente($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// RETIRE UN TITRE DE LA FILE D ATTENTE
        if(count($path) === 5 && $path[3] === 'waitlist' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = remove_track_from_liste_attente($id, $id_morceau);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//  AJOUT D UN TITRE DANS LA LISTE D ATTENTE
        if(count($path) === 4 && $path[3] === 'waitlist' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_morceau = $_POST['id'];
            $res = add_track_to_liste_attente($id, $id_morceau); //AJOUT D UN SON A LA LISTE D ATTENTE
            if($res){
                echo '{}';
                http_response_code(200);
                exit;
            }
        }

// MONTRE LES TITRES FAVORIS DE LUTILISATEUR
        if(count($path) === 4 && $path[3] === 'favorites' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $favorite_id = get_favorite_id($id)['id_playlist'];
            $res = show_infos_of_playlist($favorite_id);
            $res["tracks"] = show_tracks_of_playlist($favorite_id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// AJOUT D UN TITRE AUX FAVORI
        if(count($path) === 4 && $path[3] === 'favorites' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_morceau = $_POST['id'];
            $res = add_track_to_favorite($id, $id_morceau);
            if($res){
                echo '{}';
                http_response_code(200);
                exit;
            }
        }

// SUPPRESSION D UN TITRE FAVORI

        if(count($path) === 5 && $path[3] === 'favorites' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = remove_track_from_favorite($id, $id_morceau);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }


//AJOUT D UNE NOUVELLE PLAYLIST
        if(count($path) === 4 && $path[3] === 'playlists' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $titre = NULL;
            $description = NULL;
            $image = NULL;
            $option = array(
                $titre => $_POST["titre"],
                $description => $_POST["description"],
                $image => $_POST["image"],
            );
            $id = $path[2];
            $res = create_playlist($id, $option);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//AFFICHE LES PLAYLISTS DE L UTILISATEUR
        if(count($path) === 4 && $path[3] === 'playlists' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_playlists_of_user($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//AFFICHE LES INFO D UNE PLAYLIST x LES TITRES DE LA PLAYLIST
        if(count($path) === 5 && $path[3] === 'playlists' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $id_playlist = $path[4];
            $res = show_infos_of_playlist($id);
            $res["tracks"] = show_tracks_of_playlist($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }


// AJOUTE DES MUSIQUE A UNE PLAYLIST

        if(count($path) === 6 && $path[3] === 'playlists' && $path[5] === 'tracks' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_playlist = $path[4];
            $id_morceau = $_POST["musique"];
            $res = add_track_to_playlist($id, $id_morceau, $id_playlist);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//DELETE TITRE DANS LA PLAYLIST

        if(count($path) === 7 && $path[3] === 'playlists' && $path[5] === 'tracks' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_playlist = $path[4];
            $id_morceau = $path[6];
            $res = remove_track_from_playlist($id, $id_morceau, $id_playlist);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }


//DELETE UNE PLAYLIST DE L UTILISATEUR
        if(count($path) === 5 && $path[3] === 'playlists' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_play = $path[4];
            $res = delete_playlist($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// MODIFIE LES INFO DE L UTILISATEUR
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'PUT'){
            $id = $path[2];
            parse_str(file_get_contents("php://input"),$input_var);
            modify_infos_user($id, $input_var);
            echo json_encode($input_var);
            http_response_code(200);
            exit;
        }

//DONNE LES INFO DE L UTILISATEUR
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_user_per_id($id);
            if($res){
                echo json_encode(array(
                    "name" => $res["nom"],
                    "surname" => $res["prenom"],
                    "mail" => $res["mail"],
                    "image" => $res["image"],
                    "birth" => $res["age"],
                    "username" => $res["username"],
                ));
                http_response_code(200);
                exit;
            }
        }

    }


    require_once 'utils/artiste.php';

    # GET /artists
    # GET /artists/:id              // TODO : artist info
    # GET /artists/:id/albums
    # GET /artist/:id/best

    if($path[1] === 'artists'){
        if(count($path) === 4 && $path[3] === 'albums' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_albums_of_artist($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
           $res = show_artist_per_id($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 4 && $path[3] === 'best' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_musics_of_artist($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
    }


    require_once 'utils/album.php';

    # GET /albums/recents
    # GET /albums/:id

    if($path[1] === 'albums'){
        if(count($path) === 3 && $path[2] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_newest_albums();
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_album_per_id($id);
            $res["tracks"] = show_tracks_of_album($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
    }

    require_once 'utils/fonctions_recherche.php';


    # GET /search

    if(count($path) === 2 && $path[1] === 'search' && $_SERVER['REQUEST_METHOD'] === 'GET'){
        $query = $_GET["query"];
        $include = $_GET["include"];
        $res = array();
        if (strpos($include, "artist") !== false) {
            $res["artists"] = show_artists_by_research($query);
        }
        if (strpos($include, "album") !== false) {
            $res["albums"] = show_albums_by_research($query);
        }
        if (strpos($include, "music") !== false) {
            $res["musics"] = show_morceaux_by_research($query);
        }
        echo json_encode($res);
        http_response_code(200);
        exit;
    }

    
?>