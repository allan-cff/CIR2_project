<?php
    
    //-------------Connexion à la database


    require_once("album.php");
    require_once("user.php");
    require_once("playlist.php");
    require_once("artiste.php");
    require_once("morceau.php");
    require_once("fonctions_recherche.php");
    $database = database::connexionBD();

    //-------------On récupère le type de requête puis on agit en fonction

    // ALBUMS
    
    /*if($_SERVER['REQUEST_METHOD'] == "GET") {
        $albums = show_albums();
        echo json_encode($albums);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $album = show_album_per_id(3);
        echo json_encode($album);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
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

    // USERS

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $options = array(
            'mail' => 'modified@a.a',
            'username' => 'modified'
        );
        $tracks = modify_infos_user(2, $options);
        echo json_encode($tracks);
    }

    // PLAYLISTS

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = show_playlists();
        echo json_encode($playlists);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlist = show_playlist_per_id(2);
        echo json_encode($playlist);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = show_playlists_of_user(1);
        echo json_encode($playlists);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_favorite(1);
        echo json_encode($tracks);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_liste_attente(1);
        echo json_encode($tracks);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_historique(1);
        echo json_encode($tracks);
    }

    // ALBUMS

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $authors = show_authors_of_album(4);
        echo json_encode($authors);
    }

    // ARTISTES

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artists = show_artists();
        echo json_encode($artists);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artist = show_artist_per_id(1);
        echo json_encode($artist);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $albums = show_albums_of_artist(1);
        echo json_encode($albums);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_musics_of_artist(1);
        echo json_encode($tracks);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $type = show_type_of_artist(1);
        echo json_encode($type);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artist = show_artist_from_a_type(2);
        echo json_encode($artist);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artists = show_type_of_artist_ordered_by_type();
        echo json_encode($artists);
    }

    // PLAYLISTS

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = add_album_on_a_playlist(9 , 2);
        echo json_encode($bool);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $options = array(
            'nom' => 'TEST-Playlist',
            'image' => 'AOAOAOAO',
            'description' => 'Elle est super cette playlist',
        );
        $id = create_playlist($options, 1);
        echo json_encode($id);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = delete_playlist(9);
        echo json_encode($bool);
    }

    // MORCEAUX

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks();
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = add_track_to_favorite(1, 13);
        echo json_encode($bool);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = remove_track_from_favorite(1, 13);
        echo json_encode($bool);
    }*/
/*
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = add_track_to_liste_attente(1, 13);
        echo json_encode($bool);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = remove_track_from_liste_attente(1, 13);
        echo json_encode($bool);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = add_track_to_historical(1, 13);
        echo json_encode($bool);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = remove_track_from_historical(1, 13);
        echo json_encode($bool);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_a_playlist_random_order(4);
        echo json_encode($tracks);
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_morceaux_by_research('no');
        echo json_encode($tracks);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $artists = show_artists_by_research('o');
        echo json_encode($artists);
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $albums = show_albums_by_research('o');
        echo json_encode($albums);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = music_playing(1);
        echo json_encode($playlists);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $playlists = change_music_playing(1, 2);
        echo json_encode($playlists);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        next_track(1);
        $music = music_playing(1);
    //    echo json_encode($music);
        $musics_from_historical = show_musics_from_historical(1);
        echo json_encode($musics_from_historical);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $bool = remove_track_from_liste_attente(1, 2);
        echo json_encode($bool);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_nb_tracks_per_album(2);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_liste_attente(1);
        echo json_encode($tracks);
    }*/

    /*if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $albums = show_newest_albums();
        echo json_encode($albums);
    }*/

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $tracks = show_tracks_of_album(1);
        echo json_encode($tracks);
    }
    

    