<?php
    require_once 'utils/database.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $path = explode('/', $_SERVER['PATH_INFO']);

    
    require_once 'utils/playlist.php';
    require_once 'utils/user.php';

    session_start();

    # POST /users
    # GET /users/:id
    # PUT /users/:id
    # DELETE /users/:id 
    # GET /users/:id/nowlistening
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
// ID DE UTILISATEUR CONNECTE
        if(count($path) === 3 && $path[2] === 'loggedId' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            if (isset($_SESSION['id'])) {
                $res = array("id" => $_SESSION['id']);
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// TITRE ACTUELLEMENT JOUE
        if(count($path) === 4 && $path[3] === 'nowlistening' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
           $res = music_playing($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// PROCHAIN TITRE A JOUER
        if(count($path) === 4 && $path[3] === 'nextsong' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = next_track($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }


        }


// MONTRE LES DERNIER TITRE ECOUTE PAR L USER (HISTORIQUE)

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

//  SUPRIMME UN TITRE DE L HISTORIQUE DES ECOUTE // faire peut être demain

        if(count($path) === 5 && $path[3] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
            $id_morceau = $path[4];
            //$res = ($id, $id_morceau); //METTRE LA FONCTION QUI PERMET DE SUPP UN DES 10 DERNIER MORCEAUX ECOUTER
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
        if(count($path) === 5 && $path[3] === 'waitlist' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = add_track_to_liste_attente($id, $id_morceau); //AJOUT D UN SON A LA LISTE D ATTENTE
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// MONTRE LES TITRE FAVORIE DE LUTILISATEUR
        if(count($path) === 4 && $path[3] === 'favorites' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_favorite($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

// AJOUT D UN TITRE AUX FAVORI
        if(count($path) === 5 && $path[3] === 'favorites' && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
            $id_morceau = $path[4];
            $res = add_track_to_favorite($id, $id_morceau);
            if($res){
                echo json_encode($res);
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
        if(count($path) === 4 && $path[3] === 'playlists' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_infos_of_playlist($id);
            $res["tracks"] = show_tracks_of_playlist($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }


        # POST /users/:id/playlists/:id/tracks/

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
            $res = modify_infos_user($id, $_POST);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }

//DONNE LES INFO DE L UTILISATEUR
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_user_per_id($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }






        /*if(count($path) === 2 && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $res = add_new_user($_POST['nom'], $_POST['nom'], $_POST['date_naissance'], $_POST['mail'], $_POST['password']);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }*/
    }


    require_once 'utils/artiste.php';

    # GET /artists
    # GET /artists/:id              // TODO : artist info
    # GET /artists/:id/albums
    # nombre d'auditeur GET /artist/:id/auditor

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
        if(count($path) === 2 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $res = show_artists();
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
    }


    require_once 'utils/album.php';

    # GET /albums/recents           // TODO
    # GET /albums/:id       // TODO

    if($path[1] === 'albums'){
        if(count($path) === 3 && $path[2] === 'recents' && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
          // TODO  $res = ;            // TODO : derniers albums sortis par date sans la liste des sons
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
        // TODO    $res = ;            // TODO : album avecv la liste des sons
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
    }

    require_once 'utils/morceau.php';

    # GET /musics           // TODO  renvoie 10 musiques au hasard (top de la semaine)
    # GET /musics/:id       // TODO 

    if($path[1] === 'musics'){
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
         // TODO   $res = ;            
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 2 && $_SERVER['REQUEST_METHOD'] === 'GET'){
          // TODO  $res = ;            
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
    }

    # GET /search PARAMS :
    #                       artist=string
    #                       album=string
    #                       music=string
    #                       user=string
    #                       type=artist,album,music,user
    
?>