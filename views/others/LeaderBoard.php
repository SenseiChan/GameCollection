<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Collection | Classement</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'views/tools/header.php'; ?>
<h1 id="title-leaderboard">Classement des temps passés</h1>
<table>
    <thead>
        <tr>
            <th>Joueur</th>
            <th>Temps passés</th>
            <th>Jeu favori</th>
        </tr>
    </thead>
    <tbody >
<?php if (!empty($leaderboard)) : ?>
    <?php foreach ($leaderboard as $entry) : ?>
        <tr>
            <td><?php echo htmlspecialchars($entry['user']); ?></td>
            <td><?php echo htmlspecialchars($entry['total_time_played']); ?> h</td>
            <td><?php echo htmlspecialchars($entry['most_played_game']); ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="3">Aucun résultat trouvé.</td>
    </tr>
<?php endif; ?>
    </tbody>
</table>

<?php include 'views/tools/footer.php'; ?>
</body>