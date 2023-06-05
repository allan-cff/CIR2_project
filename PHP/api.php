<?php
    require_once 'database.php';
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $path = explode('/', $_SERVER['PATH_INFO']);

    
    require_once 'playlist.php';
    require_once 'user.php';

    # POST /users
    # GET /users/:id
    # PUT /users/:id
    # DELETE /users/:id 
    # GET /users/:id/nowlistening                   // TODO (ecoute en cours)
    # GET /users/:id/nextsong                       // TODO (prochaine ecoute)
    # GET /users/:id/recents
    # POST /users/:id/recents                       // TODO (nouvelle ecoute recente)
    # DELETE /users/:id/recents/:id                 // TODO (suppression d'une musique écoutée récemment)
    # GET /users/:id/waitlist
    # PUT /users/:id/waitlist                       // TODO (ajout d'un son à la liste d'attente)
    # GET /users/:id/favorites
    # PUT /users/:id/favorites                      // TODO (ajout d'un son aux favorits)
    # DELETE /users/:id/favorites/:id               // TODO (suppression d'un favori)
    # GET /users/:id/playlists
    # POST /users/:id/playlists                     // TODO (ajout d'une nouvelle playlist)
    # GET /users/:id/playlists/:id                  // TODO (info détaillées et liste des sons d'une playlist)
    # POST /users/:id/playlists/:id/tracks          // TODO (ajout d'un son dans une playlist)
    # DELETE /users/:id/playlists/:id/tracks/:id    // TODO (suppression d'une musique d'une playlist)

    if($path[1] === 'users'){
        if($path[3] === 'nowlistening' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
           // TODO $res = ;  
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if($path[3] === 'recents' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_historique($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if($path[3] === 'waitlist' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_liste_attente($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if($path[3] === 'favorites' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_tracks_of_favorite($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if($path[3] === 'playlists' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $path[2];
         // TODO   $res = ;  
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if($path[3] === 'playlists' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $path[2];
            $res = show_playlists_of_user($id);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'DELETE'){
            $id = $path[2];
           // TODO $res = ;   
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
        if(count($path) === 3 && $_SERVER['REQUEST_METHOD'] === 'PUT'){
            $id = $path[2];
            $res = modify_infos_user($id, $_POST);
            if($res){
                echo json_encode($res);
                http_response_code(200);
                exit;
            }
        }
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


    require_once 'artiste.php';

    # GET /artists
    # GET /artists/:id              // TODO : artist info
    # GET /artists/:id/albums

    if($path[1] === 'artists'){
        if($path[3] === 'albums' && count($path) === 4 && $_SERVER['REQUEST_METHOD'] === 'GET'){
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
           // TODO $res = ;
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


    require_once 'album.php';

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

    require_once 'morceau.php';

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