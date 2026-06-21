<?php
require "../config/db.php";

$sql = "SELECT 
            s.id_seance,
            s.date_seance,
            s.heure_debut,
            s.heure_fin,
            s.niveau,
            club.nom AS club,
            equip.nom AS equipement,
            co.nom AS commune,
            sp.nom AS sport,
            COUNT(i.id_inscription) AS nb_inscrits
        FROM Seances s
        LEFT JOIN Clubs club ON s.id_club = club.id_club
        LEFT JOIN Equipements equip ON s.id_equipement = equip.id_equipement
        LEFT JOIN Communes co ON club.id_commune = co.id_commune
        LEFT JOIN Sports sp ON club.id_sport = sp.id_sport
        LEFT JOIN Inscriptions i ON s.id_seance = i.id_seance
        GROUP BY 
            s.id_seance,
            s.date_seance,
            s.heure_debut,
            s.heure_fin,
            s.niveau,
            club.nom,
            equip.nom,
            co.nom,
            sp.nom
        ORDER BY s.date_seance ASC";
$stmt = $pdo->query($sql);

$seances = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <a href="sports.php" class="nav-item" data-active-color="#00cca3" data-target="Sports">Sports</a>
        <a href="equipements.php" class="nav-item" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item is-active" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>
        <a href="index.php" class="site-name">BoojToi</a>
        <span class="nav-indicator"></span>
    </nav>

    <h1>Seances prévues autour de vous !</h1>
    <p>Consultez les informations des seances sportives prévues dans vos clubs favoris !</p>

    <table border="1">
    <tr>
        <th>Sport</th>
        <th>Commune</th>
        <th>Date</th>
        <th>Heure début</th>
        <th>Heure fin</th>
        <th>Niveau</th>
        <th>Club</th>
        <th>Equipement</th>
        <th>Nombres d'inscriptions</th>
    </tr>

    <?php foreach($seances as $seance): ?>
    <tr>
        <td><?= $seance['sport'] ?></td>
        <td><?= $seance['commune'] ?></td>
        <td><?= $seance['date_seance'] ?></td>
        <td><?= $seance['heure_debut'] ?></td>
        <td><?= $seance['heure_fin'] ?></td>
        <td><?= $seance['niveau'] ?></td>
        <td><?= $seance['club'] ?></td>
        <td><?= $seance['equipement'] ?></td>
        <td><?= $seance['nb_inscrits'] ?></td>
        <td><button type ="button" class="btn-inscription" data-id-seance="<?=$seance['id_seance']?>"> S'inscrire </button></td>

    </tr>
    <?php endforeach; ?>
    </table>
   
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/inscriptions.js"></script>
</body>
<footer class="footer">
    <hr>
    <p>© 2026 - Projet SAE Programmation WEB - Association sportive</p>
    <p>Réalisé par Marwa Idzim et Ramy ELHOSARY - Sup Galilée</p>
</footer>
</html>