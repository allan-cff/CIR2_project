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

<!-- à faire plus tard image cliquante qui permet de ramener a la connexion-->

<div id="header">
    <span><img class="ryt" src="../Ressources/Logo.png"> </span>
</div>

<!-- formulaire de connexion -->
<div id="container">
    <form action="#" method="POST">

        <!-- titre du formulaire -->
        <h1>Inscription à Rythmic</h1>

        <!-- champ de saisie pour le nom de l'utilisateur -->
        <label for="lastname"><b>Votre nom :</b></label>
        <input type="text" placeholder="Dupont" name="lastname" required>

        <!-- champ de saisie pour le prenom de l'utilisateur-->
        <label for="firstname"><b>Votre prenom :</b></label>
        <input type="text" placeholder="Jean" name="firstname" required>

        <!-- âge de la personne -->
        <label for="birthdate"><b>Date de naissance :</b></label><br>
        <input type="date" name="birthdate" required ><br>

        <!-- champ de saisie pour l'email de l'utilisateur-->
        <label for="new_email"><b>Votre email :</b></label>
        <input type="email" placeholder="jean.dupont@mymail.com" name="new_email" required>

        <!-- champ de saisie pour le mot de passe de l'utilisateur-->
        <label for="new_mdp"><b>Votre mot de passe :</b></label>
        <input type="password" id="new_mdp" placeholder="•••••••••••••" name="new_mdp" style="border-style:none; background-color:white; color:black;" tabindex="1">


        <!-- bouton de soumission du formulaire -->
        <div id="submitButton">
            <button type="submit" id='submit'>S'INSCRIRE</button>
        </div>    

    </form>

    <?php
    // Le client devient membre du site

        if(!empty($_POST)) {
            $nom_client = $_POST['lastname'];
            $prenom_client = $_POST['firstname'];
            $age_client = $_POST['birthdate'];
            $mail = $_POST['new_email'];
            $password = $_POST['new_mdp'];



            $conn = Database::connexionBD();

            if (!$conn) {
                return false;
            }
            try {

                $sql = 'INSERT INTO Utilisateur (Prenom, Nom, Age, Mail, Password) 
                        VALUES ( :prenom_client, :nom_client, :age_client, :username, :password)';
                $stmt = $conn->prepare($sql);

                $pwd = password_hash($password, PASSWORD_BCRYPT);


                $stmt->bindParam(':username', $mail);
                $stmt->bindParam(':password', $pwd);
                $stmt->bindParam(':age_client', $age_client);
                $stmt->bindParam(':nom_client', $nom_client);
                $stmt->bindParam(':prenom_client', $prenom_client);
                $stmt->execute();


                header('Location: login.php');
                exit();
            } catch (PDOException $exception) {
                error_log('Connection error: ' . $exception->getMessage());
                return false;
            }
        }


    ?>

<!-- On importe les scripts Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjFcF1pII3ZbJ+1B+IqOi/veUcibwlqTlYlMLevdvht+GqBnhHhU9i3zMfO2b8v"
        crossorigin="anonymous"></script>
</body>
</html>