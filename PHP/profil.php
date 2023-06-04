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
    <link rel="stylesheet" href="../CSS/profil.css" media="screen" type="text/css" />
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <a href="lindex.php">
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
    <form action="profil.php" method="POST">
        <div class="container">
            <div class="profile-icon">
            <!-- <img src="..." alt="Profile Icon"> -->
                <div class="edit-icon">&#9998;</div>
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

    <?php 
    require_once("user.php");

    // On récupère les infos du formulaire
    if(!empty($_POST['prenom']) || !empty($_POST['nom']) || !empty($_POST['age']) || !empty($_POST['mail']) || !empty($_POST['password'])) {
        $options = array();
        if(!empty($_POST['prenom'])) {
            $options['prenom'] = $_POST['prenom'];
        }
        if(!empty($_POST['nom'])) {
            $options['nom'] = $_POST['nom'];
        }
        if(!empty($_POST['age'])) {
            $options['age'] = $_POST['age'];
        }
        if(!empty($_POST['mail'])) {
            $options['mail'] = $_POST['mail'];
        }
        if(!empty($_POST['password'])) {
            $options['password'] = $_POST['password'];
        }
        // On modifie les infos de l'utilisateur
        $result = modify_infos_user($_SESSION['id'], $options);
        //print_r($result);
    }
    


    ?>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/4e06933d63.js" crossorigin="anonymous"></script>
</body>
</html>