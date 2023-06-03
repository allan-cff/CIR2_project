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
        $sql = 'SELECT p.id, p.nom, p.date_creation, p.image, p.description, (SELECT COUNT(*) FROM contenu_dans WHERE contenu_dans.id_playlist = p.id) AS nb_morceaux, (SELECT SUM(m.duree) FROM contenu_dans c JOIN morceau m USING (id) WHERE c.id_playlist = p.id) AS duree_totale FROM a_creer a JOIN playlist p ON a.id_playlist = p.id WHERE a.id = :id AND is_historique = FALSE AND is_liste_attente = FALSE
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


session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rythmic - Accueil</title>

    <!-- On importe les icones fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- On importe le fichier de style Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- On importe le fichier de style google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/playlist.css" media="screen" type="text/css"/>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <a href="lindex.php">
            <img src="../Ressources/Logo.png" alt="Logo"/>
        </a>
    </div>

    <img src="../Ressources/user2.png" alt="user"/>

    <button type="button">Username</button>

    <button type="button">Réglages</button>
    <!-- utliser le php pour que les files d'attentes corresponde à celle en vrai -->
    <ul class="list-group">
        <li class="list-group-item">File d'attente</li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique avec un nom long</p>
            <p class="attente_info">Imagine Dragons<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
        <li class="list-group-item">
            <img src="../Ressources/album.png">
            <p class="attente_title">Musique</p>
            <p class="attente_info">Greg<br>3:31</p>
        </li>
    </ul>
</div>

<div class="main-container">
    <nav class="navbar navbar-expand-lg fixed-top bg-body-tertiary">
        <div class="container-fluid">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button>Titres Likes</button>
                </li>
                <li class="nav-item">
                    <button>Vos Playlists</button>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <div class="input-group dropdown">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn dropdown-toggle helper-btn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-filter"></i></button>
                    <button id="search-button" class="btn helper-btn" type="submit"><i class="fas fa-search"></i>
                    </button>
                    <div class="dropdown-menu">
                        <select class="dropdown-item form-select" aria-label="Default select example">
                            <option value="artiste" selected>Artiste</option>
                            <option value="album">Album</option>
                            <option value="song">Morceau</option>
                            <option value="playlist">Playlist</option>
                            <option value="user">Utilisateur</option>
                        </select>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </div>
                </div>
            </form>
            <a id="disconnect" href="disconnect.php"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>

    <div class="devanture">
        <div class="card">
            <div class="card-body">
                <b>vos playlists</b>
            </div>
        </div>
    </div>

</div>

<div id="carouselExample" class="carousel carousel-white slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/alpha.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>

                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/j.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/jos.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/naps.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de dtail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/nek.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/pat.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>

                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/spot.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/naps.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/jos.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/j.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/nek.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/cascade.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="artist">
    <div class="card">
<h5><b>Les playlistes de la semaine</b></h5>
    </div>
</div>

<div id="pablo" class="carousel carousel-white slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/alpha.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>

                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/j.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/jos.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/naps.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de dtail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/nek.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/pat.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>

                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/spot.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/naps.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/jos.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/j.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="cards-wrapper">
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/nek.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button">plus de detail</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/cascade.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
                <div class="card">
                    <div class="image-wrapper">
                        <img src="../Ressources/album.png" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Artiste</p>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                        <button class="play-pause-button">...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#pablo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#pablo" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<footer>
    <div class="music-player">
        <div class="song-bar">
            <div class="song-infos">
                <div class="image-container">
                    <img src="../Ressources/cascade.png" alt=""/>
                </div>
                <div class="song-description">
                    <p class="title">
                        CASCADE
                    </p>
                    <p class="artist">Alpha Wann</p>
                </div>
            </div>
            <div class="icons">
                <button class="play-pause-button"><i class="far fa-heart heart-icon"></i></button>
            </div>
        </div>
        <div class="progress-controller">
            <div class="control-buttons">
                <!--   <i class="fas fa-random"></i> -->
                <button class="backward-button"><i class="fas fa-step-backward"></i></button>
                <button class="play-pause-button"><i class="fas fa-play"></i></button>
                <button class="forward-button"><i class="fas fa-step-forward"></i></button>
            </div>
            <div class="progress-container">
                <span class="current-time">0:49</span>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                <span class="total-time">3:15</span>
            </div>
        </div>
        <div class="other-features">
            <div class="volume-bar">
                <i class="fas fa-volume-down"></i>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4e06933d63.js" crossorigin="anonymous"></script>
</body>
</html>