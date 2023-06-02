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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- On importe le fichier de style google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/style_index.css" media="screen" type="text/css" />
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
    <div class="topbar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
    </div>

    <div class="card">
        <div class="card-body">
           <b>Les 10 derniers sons que vous venez d'écouter</b>
        </div>
    </div>

    <div class="center">
        <div class="wrapper">
            <div class="inner">
                <div class="card">
                    <img src="../Ressources/alpha.png">
                    <div class="content">
                        <h1>Product Design</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/j.png">
                    <div class="content">
                        <h1>Custom Website</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/jos.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/luth.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/magic.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/naps.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/nek.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/pat.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
                <div class="card">
                    <img src="../Ressources/spot.png">
                    <div class="content">
                        <h1>Digital Marketing</h1>
                        <h3>UI/UX, Design</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="map">
            <button class="active first"></button>
            <button class="second"></button>
            <button class="third"></button>
        </div>
    </div>
</div>

<footer>
    <div class="music_player">
        <div class="song_bar">
            <div class="song_infos">
                <div class="image_container">
                    <img src="../Ressources/cascade.png" alt="" />
                </div>
                <div class="song_description">
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
        <div class="progress_controller">
            <div class="control_buttons">
                <!--   <i class="fas fa-random"></i> -->
                <button class="backward-button"><i class="fas fa-step-backward"></i></button>
                <button class="play-pause-button"><i class="fas fa-play"></i></button>
                <button class="forward-button"><i class="fas fa-step-forward"></i></button>
            </div>
            <div class="progress_container">
                <span class="current_time">0:49</span>
                <div class="progress_bar">
                    <div class="progress"></div>
                </div>
                <span class="total_time">3:15</span>
            </div>
        </div>
        <div class="other_features">
            <div class="volume_bar">
                <i class="fas fa-volume-down"></i>
                <div class="progress_bar">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="https://kit.fontawesome.com/4e06933d63.js" crossorigin="anonymous"></script>
</body>
</html>