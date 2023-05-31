<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rythmic - Connexion</title>

    <!-- On importe le fichier de style Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- On importe le fichier style.css -->
    <link rel="stylesheet" href="/CSS/style.css" media="screen" type="text/css" />
</head>
<body>

<!-- entête de la page -->
<div id="header">
    <h1><span>Rythmic - image</span></h1>

</div>

<!-- formulaire de connexion -->
<div id="container">
    <form action="#" method="POST">

        <!-- titre du formulaire -->
        <h1>Connexion j'ai déjà un compte Rythmic</h1>


        <label for="username"><b>Email utilisateur</b></label>
        <input type="text" placeholder="Entrer l'email de l'utilisateur" name="username" required>

        <!-- champ de saisie pour le mot de passe -->
        <label for="password"><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <!-- bouton de soumission du formulaire -->
        <button type="submit" id='submit'>LOGIN</button>

        <!-- lien vers page enregistrement -->
        <a href="#" id="inconnue">Devenir membre</a>

    </form>
</div>
</body>
</html>