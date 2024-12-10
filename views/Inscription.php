<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Inscription</title>
    <link rel="stylesheet" href="asset/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
</head>
<body>
<main>
    <h1>Inscription</h1>
    <form action="" method="POST">
        <p>Nom :</p>
        <input type="text" name="name">
        <p>Prénom :</p>
        <input type="text" name="first_name">
        <p>Email :</p>
        <input type="email" name="email">
        <p>Mot de passe :</p>
        <input type="password" name="password">
        <p>Confirmation du mot de passe :</p>
        <input type="password" name="confirmation_password">
        <input type="button" name="submit" value="S'inscrire">
    </form>
    <button name="login">Se connecter</button>
</main>
</body>
</html>

