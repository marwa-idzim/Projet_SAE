<?php
require "../config/db.php";

$sql = "SELECT  s.nom, 
                s.Federation, 
                COUNT(DISTINCT(c.id_club)) AS nb_clubs
        FROM Sports s
        LEFT JOIN Clubs c ON s.id_sport=c.id_sport
        GROUP BY s.nom, s.Federation
        ORDER bY s.nom, s.Federation
        ";
$stmt = $pdo->query($sql);
$sports = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Association sportive</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <nav>
        <a href="index.php" class="nav-item" data-active-color="#cc0000" data-target="Accueil">Accueil</a>
        <a href="communes.php" class="nav-item" data-active-color="#cc7700" data-target="Communes">Communes</a>
        <a href="clubs.php" class="nav-item" data-active-color="#ccc900" data-target="Clubs">Clubs</a>
        <a href="sports.php" class="nav-item is-active" data-active-color="#00cca3" data-target="Sports">Sports</a>
        <a href="equipements.php" class="nav-item" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>


    <h1>Titre</h1>
    <p>Description</p>
    
    <section class="sports">
        <?php foreach($sports as $sport):?>
        <div class="sport-card">
            <h2><?= htmlspecialchars($sport['nom']) ?></h2>
            <p> Fédération: <?= htmlspecialchars($sport['Federation']) ?></p>
            <p><?= htmlspecialchars($sport['nb_clubs']) ?> clubs</p>
        </div>
        <?php endforeach; ?>

        
    </section>

     <script src="../assets/js/script.js"></script>
</body>
</html>