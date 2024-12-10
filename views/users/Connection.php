<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Connexion</title>
    <link rel="stylesheet" href="asset/style.css">
    <!--    <link rel="icon" href="./favicon.ico" type="image/x-icon">-->
</head>
<body>
<main>
    <h1>Se connecter à Game Collection</h1>
    <form action="" method="POST">
        <label> Email :
            <input type="email" name="email">
        </label>
        <label> Mot de passe :
            <input type="password" name="password">
        </label>
        <input type="button" name="submit" value="Se connecter">
    </form>
    <button name="signup" onclick="window.location.href='Signup.php'">S'inscrire</button>
</main>
<?php include 'footer.php'; ?>
</body>
</html>

