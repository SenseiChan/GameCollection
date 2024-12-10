<?php
session_start();

$host = 'localhost';
$dbname = 'game-collection';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

try {
    // Préparer la requête SQL
    $sql = "SELECT FirstName_user, Email_user, LastName_user FROM users WHERE id_user = :id";
    $stmt = $pdo->prepare($sql);

    // Associer des valeurs aux paramètres de la requête
    $id = $_SESSION['user_id']; // ID utilisateur récupéré depuis la session
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer les données
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Conserver les données dans des variables
    $Prenom = $result['FirstName_user'];
    $Email = $result['Email_user'];
    $Nom = $result['LastName_user'];
} catch (PDOException $e) {
    die("Erreur lors de la requête : " . $e->getMessage());
}

// Gestion de la déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php"); // Rediriger vers la page de connexion
    exit;
}

// Gestion de la suppression de compte
if (isset($_POST['delete_account'])) {
    try {
        $deleteSql = "DELETE FROM users WHERE id_user = :id";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $deleteStmt->execute();

        session_destroy();
        header("Location: signup.php"); // Rediriger vers la page d'inscription
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
<main>
    <h1>Mon Profil</h1>
    <form action="" method="POST">
        <label> Prénom :
            <input type="text" name="prenom" value="<?php echo htmlspecialchars($Prenom); ?>">
        </label>
        <br>
        <label> Nom :
            <input type="text" name="nom" value="<?php echo htmlspecialchars($Nom); ?>">
        </label>
        <br>
        <label> Email :
            <input type="email" name="email" value="<?php echo htmlspecialchars($Email); ?>">
        </label>
        <br>
        <label> Mot de passe :
            <input type="password" name="password">
        </label>
        <br>
        <input type="submit" name="submit" value="Mettre à jour">
    </form>
    <form action="" method="POST">
        <!-- Bouton pour supprimer le compte -->
        <button type="submit" name="delete_account" style="background-color: red; color: white;">Supprimer le compte</button>
    </form>
    <form action="" method="POST">
        <!-- Bouton pour se déconnecter -->
        <button type="submit" name="logout" style="background-color: blue; color: white;">Se déconnecter</button>
    </form>
</main>
</body>
</html>
