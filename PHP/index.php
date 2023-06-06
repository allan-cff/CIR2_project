<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <!-- On importe le fichier de style google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/common.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="../CSS/index.css" media="screen" type="text/css" class="current-media-style" />

    <!-- On importe le JS -->
    <script src="../JS/ajaxRequest.js" defer></script>
    <script src="../JS/requests.js" defer></script>
    <script src="../JS/pagesChange.js" defer></script>
    <script src="../JS/utils.js" defer></script>
    <script src="../JS/index.js" defer></script>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="../Ressources/Logo.png" alt="Logo" />
    </div>

    <img src="../Ressources/profiles/default.png" alt="user" />

    <button id="go-to-profile" type="button">Username</button>

    <button id="go-to-settings" type="button">Réglages</button>

    <ul class="list-group" id="waitingList">
        <li class="list-group-item">File d'attente</li>
    </ul>
</div>

<nav class="navbar navbar-expand-lg fixed-top "> <!--bg-body-tertiary-->
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <button id="liked-titles">Titres Likes</button>
            </li>
            <li class="nav-item">
                <button id="playlist-list">Vos Playlists</button>
            </li>
        </ul>
        <form class="d-flex" role="search" id="main-search">
            <div class="input-group dropdown">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn dropdown-toggle helper-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-filter"></i></button>
                <button id="search-button" class="btn helper-btn" type="submit"><i class="fas fa-search"></i></button>
                <ul class="dropdown-menu">
                    <li class="dropdown-iteml"></li>
                        <input id="search-artist" class="form-check-input pl-2" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Artiste</label>
                    <li class="dropdown-iteml">
                        <input id="search-album" class="form-check-input pl-2" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Album</label>
                    </li>
                    <li class="dropdown-iteml">
                        <input id="search-song" class="form-check-input pl-2" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Morceau</label>
                    </li>
                    <li class="dropdown-iteml">
                        <input id="search-playlist" class="form-check-input pl-2" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Playlist</label>
                    </li>
                    <li class="dropdown-iteml">
                        <input id="search-user" class="form-check-input pl-2" type="checkbox" value="" id="flexCheckDefault" checked>
                        <label class="form-check-label" for="flexCheckDefault">Utilisateur</label>
                    </li>
                </ul>
            </div>
        </form>
        <a id="disconnect" href="disconnect.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
</nav>

<div id="main-content">
    <h2 id="lastListenedTitle">Dernières écoutes</h2>


    <div id="lastListened" class="carousel carousel-white slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="cards-wrapper">
                </div>
            </div>
            <div class="carousel-item">
                <div class="cards-wrapper">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#lastListened" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#lastListened" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <h2>Dernières sorties</h2>

    <div id="recentAlbums" class="carousel carousel-white slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="cards-wrapper">
                </div>
            </div>
            <div class="carousel-item">
                <div class="cards-wrapper">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#recentAlbums" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#recentAlbums" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<footer>
    <div class="music-player">
        <div class="song-bar">
            <div class="song-infos">
                <div class="image-container">
                    <img src="../Ressources/cascade.png" alt="" />
                </div>
                <div class="song-description">
                    <p class="title"></p>
                    <div class="artists-list"></div>
                </div>
            </div>
            <div class="icons">
                <button class="like-button"><i class="far fa-heart heart-icon"></i></button>
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
                <span class="current-time"></span>
                <input id="musicProgress" type="range" value="0" min="0" max="100" step="1" style="width: 50%;">
                <span class="total-time"></span>
            </div>
        </div>
        <div class="other-features">
            <div class="volume-bar">
                <i class="fas fa-volume-down"></i>
                <input id="musicVolume" type="range" min="0" max="1" step="0.01" style="width: 80%;">
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4e06933d63.js" crossorigin="anonymous"></script>
</body>
</html>

<template id="affichage-index">
    <div id="main-content">
        <h2 id="lastListenedTitle">Dernières écoutes</h2>


        <div id="lastListened" class="carousel carousel-white slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="cards-wrapper">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="cards-wrapper">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#lastListened" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#lastListened" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <h2>Dernières sorties</h2>

        <div id="recentAlbums" class="carousel carousel-white slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="cards-wrapper">
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="cards-wrapper">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#recentAlbums" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#recentAlbums" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>    
    </div>
    
</template>

<template id="affichage-album">
    <div id="main-content">
        <div class="main-container">
            <div class="placement">
                <div class="placement">
                    <div class="container">
                        <img id="album-cover" src="../Ressources/playlist.png">
                        <div class="info-sup">
                            <b></b>
                        </div>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                    </div>
                    <div class="container">
                        <div class="card">
                            <div class="card-content">
                                <p id="album-artist-name"></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <p id="album-duration"></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <p id="album-tracks-count"></p>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th class="th4">#</th>
                <th>Titre</th>
                <th class="th4">Artiste(s)</th>
                <th>Détails</th>
                <th class="th4">Durée</th>
            </tr>
            </thead>
            <tbody>
            <template id="album-row-template">
                <tr>
                    <td>
                        <button class="play-button"><i class="fa fa-play"></i></button>
                    </td>
                    <td>Titre 1</td>
                    <td><button>Artiste 1</button></td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-toggle">&#9776;</span>
                            <div class="dropdown-menu">
                                <!-- possibilité de mettre un select mais dans le cas présent pas forcément utile -->
                                <a href="#">Ajouter à une playlist</a>
                                <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                <a href="#">Ajouter à la file d'attente</a>
                            </div>
                        </div>
                    </td>
                    <td>3:31</td>
                </tr>
            </template>    
            <!-- Ajouter d'autres lignes de tableau ici -->
            </tbody>
        </table>
    </div>
</template>

<template id="affichage-artiste">
    <div id="main-content">
        <div class="main-container">
            <div class="placement">
                <div class="container">
                    <img src="../Ressources/alpha.png">
                    <div class="info-sup">
                        <b>nom de l'artiste</b>
                    </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-content">
                            <p>Description :</p>
                        </div>
                    </div>
                    <div class="playlist-details">
                        <span class="total-duration">Nombre d'auditeur par mois :</span> <!-- la duré sera à modifié plus tard via du php -->
                    </div>
                </div>
            </div>

            <div class="artist">
                <div class="card">
                    <b>populaire : </b>
                </div>
            </div>

            <table>
                <thead>
                <tr>
                    <th class="th4">#</th>
                    <th>Album</th>
                    <th>Titre</th>
                    <th class="th4">Artiste</th>
                    <th>Détail</th>
                    <th class="th4">Time</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1
                        <button class="play-button"><i class="fa fa-play"></i></button>
                    </td>
                    <td><img src="../Ressources/album.png" alt="Album 1"></td>
                    <td>Titre 1</td>
                    <td><button>Artiste 1</button></td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-toggle">&#9776;</span>
                            <div class="dropdown-menu">
                                <!-- possibilité de mettre un select mais dans le cas présent pas forcément utile -->
                                <a href="#">Ajouter à une playlist</a>
                                <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                <a href="#">Ajouter à la file d'attente</a>
                            </div>
                        </div>
                    </td>
                    <td>3:31</td>
                </tr>
                <tr>
                    <td>2
                        <button class="play-button"><i class="fa fa-play"></i></button>
                    </td>
                    <td><img src="../Ressources/cascade.png" alt="Album 2"></td>
                    <td>Titre 2</td>
                    <td class="bi-text-left"><button>Artiste 2</button></td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-toggle">&#9776;</span>
                            <div class="dropdown-menu">
                                <a href="#">Ajouter à une playlist</a>
                                <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                <a href="#">Ajouter à la file d'attente</a>
                            </div>
                        </div>
                    </td>
                    <td>3:31</td>
                </tr>
                <!-- Ajouter d'autres lignes de tableau ici -->
                </tbody>
            </table>
        </div>
    </div>
</template>

<template id="affichage-profil">
    <div id="main-content">
        <div class="main-container">
            <div class="placement">
                <div class="container">
                    <img src="../Ressources/playlist.png">
                    <div class="info-sup">
                        <b id="username">Votre username</b>
                        <br>
                        <br>
                        <b id="surname">Votre prenom</b>
                        <br>
                        <br>
                        <b id="name">Votre nom</b>
                        <br>
                        <br>
                        <b id="mail">Votre email</b>
                        <br>
                        <br>
                        <b id="birth">Votre date de naissance</b>
                    </div>

                </div>
                <div class="container">
                    <b><span style="text-decoration: underline">Titres likés :</span></b>
                    <p>nombre de titre likés :</p>

                    <table>
                        <thead>
                        <tr>
                            <th class="th4">#</th>
                            <th>Album</th>
                            <th>Titre</th>
                            <th class="th4">Artiste</th>
                            <th>Détail</th>
                            <th class="th4">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1
                                <button class="play-button"><i class="fa fa-play"></i></button>
                            </td>
                            <td><img src="../Ressources/album.png" alt="Album 1"></td>
                            <td>Titre 1</td>
                            <td><button>Artiste 1</button></td>
                            <td>
                                <div class="dropdown">
                                    <span class="dropdown-toggle">&#9776;</span>
                                    <div class="dropdown-menu">
                                        <!-- possibilité de mettre un select mais dans le cas présent pas forcément utile -->
                                        <a href="#">Ajouter à une playlist</a>
                                        <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                        <a href="#">Ajouter à la file d'attente</a>
                                    </div>
                                </div>
                            </td>
                            <td><button><i class="fa fa-trash"></i></button></td>
                        </tr>
                        <tr>
                            <td>2
                                <button class="play-button"><i class="fa fa-play"></i></button>
                            </td>
                            <td><img src="../Ressources/cascade.png" alt="Album 2"></td>
                            <td>Titre 2</td>
                            <td class="bi-text-left"><button>Artiste 2</button></td>
                            <td>
                                <div class="dropdown">
                                    <span class="dropdown-toggle">&#9776;</span>
                                    <div class="dropdown-menu">
                                        <a href="#">Ajouter à une playlist</a>
                                        <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                        <a href="#">Ajouter à la file d'attente</a>
                                    </div>
                                </div>
                            </td>
                            <td><button><i class="fa fa-trash"></i></button></td>
                        </tr>
                        <!-- Ajouter d'autres lignes de tableau ici -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!--
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        Trier par :
                        <div class="dropdown">
                            <button class="dropdown-btn">Morceaux</button>
                            <div class="dropdown-content">
                                <a href="#">Ordre alphabétique morceaux</a>
                                <a href="#">Ordre alphabétique titre</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        -->


        </div>
    </div>
</template>

<template id="affichage-recherche">
    <div id="main-content">
        <div id="main-container">
            <div class="devanture">
                <div class="card">
                    <div class="card-body">
                        <b>votre recherche :</b>
                    </div>
                </div>
            </div>

        </div>

        <div class="artist">
            <div class="card">
                <b>album :</b>
            </div>
        </div>
        <br>
        <br>

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
                                <button class="play-pause-button"><i class="fas fa-play"></i></button>
                                <button class="play-pause-button">...</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/pat.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/spot.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
                <b>morceaux :</b>
            </div>
        </div>
        <br>
        <br>

        <div id="hello" class="carousel carousel-white slide">
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
                                <button class="play-pause-button"><i class="fas fa-play"></i></button>
                                <button class="play-pause-button">...</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/pat.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/spot.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#hello" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hello" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



        <div class="artist">
            <div class="card">
                <b>artistes :</b>
            </div>
        </div>
        <br>
        <br>

        <div id="hola" class="carousel carousel-white slide">
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
                                <button class="play-pause-button"><i class="fas fa-play"></i></button>
                                <button class="play-pause-button">...</button>
                            </div>
                        </div>
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/pat.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/spot.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/naps.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/jos.png" class="card-img-top" alt="...">
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
                                <img src="../Ressources/j.png" class="card-img-top" alt="...">
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
                <div class="carousel-item">
                    <div class="cards-wrapper">
                        <div class="card">
                            <div class="image-wrapper">
                                <img src="../Ressources/nek.png" class="card-img-top" alt="...">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#hola" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hola" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>    
</template>

<template id="affichage-playlist">
    <div id="main-content">
        <div class="main-container">
            <div class="placement">
                <div class="container">
                    <img src="../Ressources/playlist.png">
                    <div class="info-sup">
                        <b id="playlist-title"></b>
                    </div>
                    <button class="play-pause-button"><i class="fas fa-play"></i></button>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-content">
                            <p id="playlist-description"></p>
                        </div>
                    </div>
                    <div class="playlist-details">
                        <span class="total-duration"></span> <!-- la duré sera à modifié plus tard via du php -->
                        <span class="track-count"></span>
                    </div>
                </div>
            </div>
            <!--
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        Trier par :
                        <div class="dropdown">
                            <button class="dropdown-btn">Morceaux</button>
                            <div class="dropdown-content">
                                <a href="#">Ordre alphabétique morceaux</a>
                                <a href="#">Ordre alphabétique titre</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        -->
            <table>
                <thead>
                <tr>
                    <th class="th4">#</th>
                    <th>Album</th>
                    <th>Titre</th>
                    <th class="th4">Artiste</th>
                    <th>Détail</th>
                    <th class="th4">Delete</th>
                </tr>
                </thead>
                <tbody>
                    <template id="playlist-row-template">
                        <tr>
                            <td>
                                <button class="play-button"><i class="fa fa-play"></i></button>
                            </td>
                            <td><img src="../Ressources/album.png" alt="Album 1"></td>
                            <td>Titre 1</td>
                            <td><button>Artiste 1</button></td>
                            <td>
                                <div class="dropdown">
                                    <span class="dropdown-toggle">&#9776;</span>
                                    <div class="dropdown-menu">
                                        <!-- possibilité de mettre un select mais dans le cas présent pas forcément utile -->
                                        <a href="#">Ajouter à une playlist</a>
                                        <a href="#"><i class="fa fa-heart"></i> J'aime</a>
                                        <a href="#">Ajouter à la file d'attente</a>
                                    </div>
                                </div>
                            </td>
                            <td><button><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </template>
                <!-- Ajouter d'autres lignes de tableau ici -->
                </tbody>
            </table>
        </div>
    </div>
</template>

<template id="affichage-liste-playlists">
    <div id="main-content">
        <div class="main-container">

            <div class="devanture">
                <div class="card">
                    <div class="card-body">
                        <b>Vos playlists</b>
                    </div>
                </div>
            </div>

        <!-- Button trigger modal -->
            <div class="plae">
            <button type="button" class="btn btn-primary mo" data-bs-toggle="modal" data-bs-target="#exampleModal">
            ajouter une playlist
            </button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ajouter playlist</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" accept="image/*">
                                </div>
                                <div class="mb-3">
                                    <label for="nomplaylist" class="form-label">Nom playlist</label>
                                    <input type="text" class="form-control" id="nomplaylist" placeholder="Nom playlist">
                                </div>
                                <div class="mb-3">
                                    <label for="description_playlist" class="form-label">Description playlist</label>
                                    <input type="text" class="form-control" id="description_playlist" placeholder="Description playlist">
                                </div>
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
        </div>



        <div id="playlistsCarousel" class="carousel carousel-white slide">
            <div class="carousel-inner">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#playlistsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#playlistsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="artist">
            <div class="card">
        <b>Les playlistes de la semaine</b>
            </div>
        </div>

        <br>
        <br>

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


    </div>
</template>

<template id="affichage-reglages">
    <div id="main-content">
        <div class="main-container">
            <form action="profil.php" method="POST">
                <div class="container">
                    <div class="profile-icon">
                    <!-- <img src="..." alt="Profile Icon"> -->
                        <div class="edit-icon">&#9998;</div>
                    </div>
                    <!-- Champ de modif pour le PSEUDO -->
                    <div class="username center">
                        <input type="text" id="username" placeholder="username" name="username">
                    </div>
                    <div class="info">
                        <!-- Champ de modif pour le prenom -->
                        <div class="edit-input">
                            <input type="text" placeholder="Prénom" name="prenom">
                            <div class="edit-icon-text">&#9998;</div>
                        </div>
                        <!-- Champ de modif pour le nom -->
                        <div class="edit-input">
                            <input type="text" placeholder="Nom" name="nom">
                            <div class="edit-icon-text">&#9998;</div>
                        </div>
                    </div>
                    <!-- Champ de modif de l'âge -->
                    <div class="center">
                        <input type="date" placeholder="Date de naissance" name="age">
                    </div>
                    <!-- Champ de modif pour le mail -->
                    <div class="info">
                        <div class="edit-input">
                            <div class="edit-icon-text">&#9998;</div>
                                <input type="email" placeholder="Email" name="mail">
                            </div>
                    <!-- Champ de modif pour le mot de passe -->
                        <div class="edit-input">
                            <input type="password" placeholder="Mot de passe" id="password" name="password">
                        </div>
                    </div>
                    <!-- Bouton de confirmation -->
                    <button class="confirm-button">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</template>