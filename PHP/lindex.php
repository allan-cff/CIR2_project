<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Rythmic - Accueil</title>

    <!-- On importe les icones fontawesome -->
    <script src="https://kit.fontawesome.com/4e06933d63.js" crossorigin="anonymous"></script>

    <!-- On importe le fichier de style Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- On importe le fichier de style google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/style_index.css" media="screen" type="text/css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
            <a class="nav-link" href="#">Titres Likes</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Vos Playlists</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
        </form>
        </div>
    </div>
    </nav>

<div class="sidebar">
    <div class="logo">
        <a href="#">
            <img src="../Ressources/Logo.png" alt="Logo" />
        </a>
    </div>
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <img src="../Ressources/user2.png" alt="user" />
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="rectangle">username</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="rectangle">réglages</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="rectangle">prochains titres</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="main-container">
</div>

<!-- <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script> -->

</body>
</html>