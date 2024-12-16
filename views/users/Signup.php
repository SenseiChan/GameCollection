<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Inscription</title>
    <link rel="stylesheet" href="assets/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
</head>
<body>
<main>
    <h1>Inscription</h1>
    <form action="/signup" method="POST">
        <label>Nom :
            <input type="text" name="name">
        </label>
        <label>Prénom :
            <input type="text" name="first_name">
        </label>
        <label>Email :
            <input type="email" name="email">
        </label>
        <label>Mot de passe :
            <input type="password" name="password">
        </label>
        <label>Confirmation du mot de passe :
            <input type="password" name="confirmation_password">
        </label>
        <input type="button" name="submit" value="S'inscrire">
    </form>
    <button name="login" onclick="window.location.href='index.php?url=connection'">Se connecter</button>
</main>
<?php include 'views/tools/footer.php'; ?>
</body>
</html>

