<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rythmic - Connexion</title>

    <!-- On importe le fichier de style Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/style.css" media="screen" type="text/css" />
</head>
<body>

<!-- entête de la page -->

<div id="header">
    <span><img class="ryt" src="../Ressources/Logo.png"> </span>
</div>

<!-- formulaire de connexion -->
<?php
    require_once("utils/user.php");
    session_start();

    // Si l'utilisateur est deja connecte, on le redirige vers la page d'accueil
    if (isset($_SESSION['id'])) {
        header('Location: index.php');
    }

    // Si le formulaire de connexion a ete soumis, on verifie les informations de connexion
    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $result = verify_user($mail, $password);
        if(!$result){
            echo '
            <div class="container">
              <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
                &nbsp;Erreur base de données !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
            ';
        } else {
            echo '
            <div class="container">
              <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
                &nbsp;Nom d\'utilisateur ou mot de passe incorrects !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
            ';
        }
    }
 ?>     

<div id="container">
    <form action="login.php" method="POST">

        <!-- titre du formulaire -->
        <h1>J'ai déjà un compte Rythmic</h1>

        <label for="main" class="form-label"><b>Email utilisateur</b></label>
        <input type="text" id="main" placeholder="Entrer l'email de l'utilisateur" name="mail" required>

        <!-- champ de saisie pour le mot de passe -->
        <label for="password"><b>Mot de passe</b></label>
        <input type="password" id="password" placeholder="Entrer le mot de passe" name="password" required>
        <!--<button class="btn btn-outline-secondary" type="button" id="togglePassword">
            <i class="bi bi-eye"></i>
        </button>-->

        <!-- bouton de soumission du formulaire -->
        <div id="submitButton">
            <button type="submit">Entrer</button>
        </div>

        <!-- lien vers page enregistrement -->
        <p class="text-center mt-3 mb-0">Vous n'avez pas de compte ? <br><a href="register.php" class="d-inline">Inscrivez-vous ici</a></p>

    </form>
</div>
</div>


<!-- On importe les scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjFcF1pII3ZbJ+1B+IqOi/veUcibwlqTlYlMLevdvht+GqBnhHhU9i3zMfO2b8v"
        crossorigin="anonymous"></script>
</body>

