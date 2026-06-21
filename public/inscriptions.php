<?php
require "../config/db.php";

$motDePasseCorrect = "sport2026";
$accesAutorise = false;
$messageErreur = "";

$idSeance = $_GET["id_seance"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $motDePasse = $_POST["mot_de_passe"] ?? "";

    if ($motDePasse === $motDePasseCorrect) {
        $accesAutorise = true;
    } else {
        $messageErreur = "Mot de passe incorrect.";
    }
}

if ($idSeance === null) {
    $sql = "SELECT 
                i.id_inscription,
                l.nom AS nom_licencie,
                l.prenom AS prenom_licencie,
                l.email,
                i.date_inscription,
                s.date_seance,
                s.heure_debut,
                s.heure_fin,
                cl.nom AS club,
                sp.nom AS sport
            FROM Inscriptions i
            JOIN Licencies l ON i.id_licencies = l.id_licencies
            JOIN Seances s ON i.id_seance = s.id_seance
            JOIN Clubs cl ON s.id_club = cl.id_club
            JOIN Sports sp ON cl.id_sport = sp.id_sport
            ORDER BY s.date_seance, s.heure_debut";

    $stmt = $pdo->query($sql);
} 
else {
    $sql = "SELECT 
                i.id_inscription,
                l.nom AS nom_licencie,
                l.prenom AS prenom_licencie,
                l.email,
                i.date_inscription,
                s.date_seance,
                s.heure_debut,
                s.heure_fin,
                cl.nom AS club,
                sp.nom AS sport
            FROM Inscriptions i
            JOIN Licencies l ON i.id_licencies = l.id_licencies
            JOIN Seances s ON i.id_seance = s.id_seance
            JOIN Clubs cl ON s.id_club = cl.id_club
            JOIN Sports sp ON cl.id_sport = sp.id_sport
            WHERE s.id_seance = :id_seance
            ORDER BY i.date_inscription DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "id_seance" => $idSeance
    ]);
}

$inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <?php if (!$accesAutorise): ?>

        <h1>Accès aux inscriptions</h1>
        <p>Veuillez entrer le mot de passe pour voir les inscriptions.</p>

        <?php if (!empty($messageErreur)): ?>
            <div class="message-erreur">
                <?= htmlspecialchars($messageErreur) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>

            <button type="submit">Valider</button>
        </form>

    <?php else: ?>

        <h1>Titre</h1>
        <p>Description</p>
        <table border="1">
            <tr >
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date inscription</th>
                <th>Sport</th>
                <th>Club</th>
                <th>Date séance</th>
                <th>Heure début</th>
                <th>Heure fin</th>
            </tr>
            
            <?php foreach ($inscriptions as $inscription): ?>
            <tr>
                <td><?= htmlspecialchars($inscription['nom_licencie']) ?></td>
                <td><?= htmlspecialchars($inscription['prenom_licencie']) ?></td>
                <td><?= htmlspecialchars($inscription['email']) ?></td>
                <td><?= htmlspecialchars($inscription['date_inscription']) ?></td>
                <td><?= htmlspecialchars($inscription['sport']) ?></td>
                <td><?= htmlspecialchars($inscription['club']) ?></td>
                <td><?= htmlspecialchars($inscription['date_seance']) ?></td>
                <td><?= htmlspecialchars($inscription['heure_debut']) ?></td>
                <td><?= htmlspecialchars($inscription['heure_fin']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table >
     <?php endif; ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>