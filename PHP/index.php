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
    <script src="../JS/requests.js" defer></script>
    <script src="../JS/lindex.js" defer></script>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <a href="#">
            <img src="../Ressources/Logo.png" alt="Logo" />
        </a>
    </div>

    <img src="../Ressources/user2.png" alt="user" />

    <button type="button">Username</button>

    <button type="button">Réglages</button>

    <ul class="list-group" id="waitingList">
        <li class="list-group-item">File d'attente</li>
    </ul>
</div>

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
                <button class="btn dropdown-toggle helper-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-filter"></i></button>
                <button id="search-button" class="btn helper-btn" type="submit"><i class="fas fa-search"></i></button>
                <div class="dropdown-menu">
                    <select class="dropdown-item form-select" aria-label="Default select example">
                        <option value="artiste" selected>Artiste</option>
                        <option value="album">Album</option>
                        <option value="song">Morceau</option>
                        <option value="playlist">Playlist</option>
                        <option value="user">Utilisateur</option>
                    </select>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </div>
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
                    <p class="title">
                        CASCADE
                    </p>
                    <p class="artist">Alpha Wann</p>
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
                        <img src="../Ressources/playlist.png">
                        <div class="info-sup">
                            <b>nom de l'album</b>
                        </div>
                        <button class="play-pause-button"><i class="fas fa-play"></i></button>
                    </div>
                    <div class="container">
                        <div class="card">
                            <div class="card-content">
                                <p>nom de l'artiste</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <p>durée totale</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <p>Nombre de titres</p>
                            </div>
                        </div>
                </div>
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
</template>

<template id="affichage-artiste">
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
                        <button class="btn dropdown-toggle helper-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-filter"></i></button>
                        <button id="search-button" class="btn helper-btn" type="submit"><i class="fas fa-search"></i></button>
                        <div class="dropdown-menu">
                            <select class="dropdown-item form-select" aria-label="Default select example">
                                <option value="artiste" selected>Artiste</option>
                                <option value="album">Album</option>
                                <option value="song">Morceau</option>
                                <option value="playlist">Playlist</option>
                                <option value="user">Utilisateur</option>
                            </select>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </div>
                    </div>
                </form>
                <a id="disconnect" href="disconnect.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </nav>

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
        <br>
        <br>
    </div>
    <br>
    <br>
</template>