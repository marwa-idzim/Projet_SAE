<?php
require "../config/db.php";

$sql = "SELECT  cl.nom AS nom, 
                cl.nb_licencies AS cl.nb_licencies, 
                co.nom AS commune, 
                s.nom AS sport 
        FROM Clubs cl, Communes co, Sports s
        WHERE cl.id_commune=co.id_commune
        AND cl.id_sport=s.id_sport
        ";
$stmt = $pdo->query($sql);
$clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <a href="clubs.php" class="nav-item is-active" data-active-color="#ccc900" data-target="Clubs">Clubs</a>
        <a href="sports.php" class="nav-item" data-active-color="#00cca3" data-target="Sports">Sports</a>
        <a href="equipements.php" class="nav-item" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>

    <h1>Titre</h1>
    <p>Description</p>
    
    <section class="clubs">
        <?php foreach($clubs as $club):?>
        <div class="club-card">
            <h2><?= htmlspecialchars($club['nom']) ?></h2>
            <p> Commune: <?= htmlspecialchars($club['commune']) ?></p>
            <p> Sport: <?= htmlspecialchars($club['sport']) ?></p>
            <p> Nombre de licenciés: <?= htmlspecialchars($club['nb_licencies']) ?></p>
        </div>
        <?php endforeach; ?>

        
    </section>

    <script src="../assets/js/script.js"></script>
</body>
</html>