<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rythmic - Connexion</title>

    <!-- On importe le fichier de style Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="../CSS/style.css" media="screen" type="text/css" />
</head>
<body>

<!-- entête de la page -->

<div id="header">
    <span><img class="ryt" src="../Ressources/Logo.png"> </span>
</div>

<!-- formulaire de connexion -->

<div id="container" class="container">
    <div class="row justify-content-center">
        <form action="#" method="POST">

            <!-- titre du formulaire -->
            <p class="rectangle">Connexion j'ai déjà un compte Rythmic</p>

            <div class="mb-3">
                <label for="username" class="form-label"><b>Email utilisateur</b></label>
                <input type="text" class="form-control" id="username" placeholder="Entrer l'email de l'utilisateur" name="username" required>
            </div>

            <!-- champ de saisie pour le mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label"><b>Mot de passe</b></label>
                <input type="password" class="form-control" id="password" placeholder="Entrer le mot de passe" name="password" required>
                <!--<button class="btn btn-outline-secondary" type="button" id="togglePassword">
                    <i class="bi bi-eye"></i>
                </button>-->

            </div>

            <!-- bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>

            <!-- lien vers page enregistrement -->
            <p class="text-center mt-3 mb-0">Vous n'avez pas de compte ? <a href="register.php" class="d-inline">Inscrivez-vous</a></p>

        </form>
    </div>
</div>
</div>

<!-- On importe les scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjFcF1pII3ZbJ+1B+IqOi/veUcibwlqTlYlMLevdvht+GqBnhHhU9i3zMfO2b8v"
        crossorigin="anonymous"></script>
</body>