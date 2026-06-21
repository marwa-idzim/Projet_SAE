<?php
require "../config/db.php";

$acces = false;
$erreur = "";

// Vérifie si le formulaire a été envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $motdepasse = $_POST["motdepasse"];

    // mot de passe choisi
    if ($motdepasse == "mercipourlestravaux") {

        $acces = true;

    } else {

        $erreur = "Mot de passe incorrect";
    }
}
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
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item is-active" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>

    <h1>Listes de personnes inscrites</h1>
    <p>Veuillez entrer le mot de passe pour avoir accès aux personnes inscrites aux séances</p>
    <?php if (!$acces): ?>

    <p>Entrez le mot de passe pour accéder aux inscriptions :</p>

    <form method="POST">

        <input type="password" name="motdepasse" required>

        <button type="submit">Valider</button>

    </form>

    <p style="color:red;">
        <?= $erreur ?>
    </p>

    <?php else: ?> 
    
    <?php
    $sql = "SELECT 
            lic.nom,
            lic.prenom,

            s.date_seance,
            s.heure_debut,
            s.heure_fin,

            c.nom AS club,

            i.date_inscription

        FROM Inscriptions i

        LEFT JOIN Licencies lic
            ON i.id_licencies = lic.id_licencies

        LEFT JOIN Seances s
            ON i.id_seance = s.id_seance

        LEFT JOIN Clubs c
            ON s.id_club = c.id_club

        ORDER BY i.date_inscription DESC";

    $stmt = $pdo->query($sql);
    $inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Liste des inscrits</h2>

    <table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date séance</th>
        <th>Heure début</th>
        <th>Heure fin</th>
        <th>Club</th>
        <th>Date inscription</th>
    </tr>
    <?php foreach($inscriptions as $inscription): ?>
    <tr>
        <td><?= htmlspecialchars($inscription['nom']) ?></td>
        <td><?= htmlspecialchars($inscription['prenom']) ?></td>
        <td><?= htmlspecialchars($inscription['date_seance']) ?></td>
        <td><?= htmlspecialchars($inscription['heure_debut']) ?></td>
        <td><?= htmlspecialchars($inscription['heure_fin']) ?></td>
        <td><?= htmlspecialchars($inscription['club']) ?></td>
        <td><?= htmlspecialchars($inscription['date_inscription']) ?></td>
    </tr>
    <?php endforeach; ?>

    </table>
    <?php endif; ?>

     <script src="../assets/js/script.js"></script>
</body>
</html>