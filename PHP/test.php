<?php
    
    //-------------Connexion à la database


    require_once("album.php");
    require_once("user.php");
    require_once("playlist.php");
    $database = database::connexionBD();

    //-------------On récupère le type de requête puis on agit en fonction
    
    /*if($_SERVER['REQUEST_METHOD'] == "GET") {
        $albums = show_albums();
        echo json_encode($albums);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $album = show_album_per_id(3);
        echo json_encode($album);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $nb_tracks = show_nb_tracks_per_album(1);
        echo json_encode($nb_tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_album(2);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_album_alphabetic_order(2);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_album_default_order(2);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $options = array(
            'mail' => 'modified@a.a',
            'username' => 'modified'
        );
        $tracks = modify_infos_user(2, $options);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = show_playlists();
        echo json_encode($playlists);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlist = show_playlist_per_id(2);
        echo json_encode($playlist);
    }*/

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = show_playlists_of_user(1);
        echo json_encode($playlists);
    }

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_favorite(1);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_liste_attente(1);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_historique(1);
        echo json_encode($tracks);
    }*/
    