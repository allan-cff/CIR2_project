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

<div id="container">
    <form action="#" method="POST">

        <!-- titre du formulaire -->
        <h1>J'ai déjà un compte Rythmic</h1>

        <label for="username" class="form-label"><b>Email utilisateur</b></label>
        <input type="text" id="username" placeholder="Entrer l'email de l'utilisateur" name="username" required>

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

<?php
        require_once("database.php");
        session_start();


        $fileName = explode('/', $_SERVER['PHP_SELF']);
        $fileName = end($fileName);


        // Si l'utilisateur est deja connecte, on le redirige vers la page d'accueil
        if (isset($_SESSION['ID'])) {
            header('Location: lindex.php');
            return $_SESSION['id_client'];
        }

        // Si l'utilisateur n'est pas connecte et qu'il ne se trouve pas deja sur la page d'authentification, on le redirige vers cette page
       /* if (!isset($_SESSION['id_client']) && $fileName != 'auth_client_controller.php') {
            header('Location: auth_client_controller.php');
        }*/
        //pas besoin de ça


        // Si le formulaire de connexion a ete soumis, on verifie les informations de connexion
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            try {
                $conn = database::connexionBD();
                $stmt = $conn->prepare('SELECT ID, Password FROM Utilisateur WHERE Mail = :email');
                $stmt->bindParam(':email', $_POST['username']);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                print_r($result);

            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }

            // Si les informations de connexion sont correctes, on connecte l'utilisateur et on le redirige vers la page d'accueil
            if (!empty($result) && password_verify($_POST['password'], $result['mdp_client'])) {
                $_SESSION['id_client'] = $result['id_client'];
                header('Location: lindex.php');
            } else {
                return "Mot de passe ou email incorrect !";
            }
        }

        return false;
    }


?>

<!-- On importe les scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjFcF1pII3ZbJ+1B+IqOi/veUcibwlqTlYlMLevdvht+GqBnhHhU9i3zMfO2b8v"
        crossorigin="anonymous"></script>
</body>