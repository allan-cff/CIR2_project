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
    <div class="topbar">
        <div class="navbar">
            <ul>
                <li>
                    <a href="#" class="rectangle">Titres Likes</a>
                </li>
                <li>
                    <a href="#" class="rectangle">vos Playlists</a>
                </li>
                <li>
                    <a href="#">
                        <img src="../Ressources/filtre.png" alt="filtre" />
                    </a>
                </li>
                <li>
                    <form action="#" method="POST">
                        <!-- champ de saisie pour le nom de l'utilisateur -->
                        <input type="text" placeholder="Recherche" name="recherhce" required>
                        <!-- mettre une icone de recherche (une loupe) -->
                    </form>
                </li>

            </ul>
            <!-- mettre une icone de recherche (une loupe) pour plus tard c du bonus chef -->
            <button type="button">log out</button>
        </div>
        </div>

</div>

<!-- <script src="https://kit.fontawesome.com/23cecef777.js" crossorigin="anonymous"></script> -->

</body>
</html>