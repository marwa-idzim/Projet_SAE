<?php
require "../config/db.php";

/* On récupère l'identifiant du club envoyé dans l'URL.
   Exemple : detail_club.php?id_club=101 */
$idClub = $_GET["id_club"] ?? null;

/* Si aucun club n'est sélectionné, on arrête la page. */
if ($idClub === null) {
    $messageErreur="Aucun club sélectionné.";
}

/* On récupère les informations principales du club :
   - nom du club
   - commune
   - sport
   - détails du club : adresse, site web, email, téléphone, description
   - nombre de licenciés inscrits à au moins une séance du club */
$sql = "SELECT 
            cl.id_club,
            cl.nom AS nom_club,
            co.nom AS commune,
            sp.nom AS sport,
            d.adresse,
            d.site_web,
            d.email,
            d.num_tel,
            d.desc_club,
            COUNT(DISTINCT i.id_licencies) AS nb_licencies
        FROM Clubs cl
        JOIN Communes co ON cl.id_commune = co.id_commune
        JOIN Sports sp ON cl.id_sport = sp.id_sport
        LEFT JOIN Details_Club d ON cl.id_club = d.id_club
        LEFT JOIN Seances s ON cl.id_club = s.id_club
        LEFT JOIN Inscriptions i ON s.id_seance = i.id_seance
        WHERE cl.id_club = :id_club
        GROUP BY 
            cl.id_club,
            cl.nom,
            co.nom,
            sp.nom,
            d.adresse,
            d.site_web,
            d.email,
            d.num_tel,
            d.desc_club";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    "id_club" => $idClub
]);

$club = $stmt->fetch(PDO::FETCH_ASSOC);

/* Si l'id ne correspond à aucun club, on affiche une erreur. */
if (!$club) {
    die("Club introuvable.");
}

/* On récupère aussi les séances organisées par ce club. */
$sql = "SELECT 
            s.id_seance,
            s.date_seance,
            s.heure_debut,
            s.heure_fin,
            s.niveau,
            e.nom AS equipement,
            COUNT(i.id_inscription) AS nb_inscrits
        FROM Seances s
        LEFT JOIN Equipements e ON s.id_equipement = e.id_equipement
        LEFT JOIN Inscriptions i ON s.id_seance = i.id_seance
        WHERE s.id_club = :id_club
        GROUP BY 
            s.id_seance,
            s.date_seance,
            s.heure_debut,
            s.heure_fin,
            s.niveau,
            e.nom
        ORDER BY s.date_seance, s.heure_debut";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    "id_club" => $idClub
]);

$seances = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail du club</title>
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

    <section class="detail-club">
        <a href="clubs.php" class="retour">← Retour aux clubs</a>

        <div class="detail-card">
            <h1><?= htmlspecialchars($club['nom_club']) ?></h1>

            <p><strong>Sport :</strong> <?= htmlspecialchars($club['sport']) ?></p>
            <p><strong>Commune :</strong> <?= htmlspecialchars($club['commune']) ?></p>
            <p><strong>Nombre de licenciés inscrits aux séances :</strong> <?= htmlspecialchars($club['nb_licencies']) ?></p>

            <hr>

            <p><strong>Adresse :</strong> <?= htmlspecialchars($club['adresse'] ?? "Non renseignée") ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($club['email'] ?? "Non renseigné") ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($club['num_tel'] ?? "Non renseigné") ?></p>

            <?php if (!empty($club['site_web'])): ?>
                <p>
                    <strong>Site web :</strong>
                    <a href="https://<?= htmlspecialchars($club['site_web']) ?>" target="_blank">
                        <?= htmlspecialchars($club['site_web']) ?>
                    </a>
                </p>
            <?php endif; ?>

            <p><strong>Description :</strong> <?= htmlspecialchars($club['desc_club'] ?? "Aucune description disponible.") ?></p>
        </div>
    </section>

    <section class="detail-club">
        <h2>Séances proposées par ce club</h2>

        <?php if (count($seances) === 0): ?>
            <p>Aucune séance prévue pour ce club.</p>
        <?php else: ?>
            <table border="1">
                <tr>
                    <th>Date</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Niveau</th>
                    <th>Équipement</th>
                    <th>Nombre d'inscrits</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($seances as $seance): ?>
                    <tr>
                        <td><?= htmlspecialchars($seance['date_seance']) ?></td>
                        <td><?= htmlspecialchars($seance['heure_debut']) ?></td>
                        <td><?= htmlspecialchars($seance['heure_fin']) ?></td>
                        <td><?= htmlspecialchars($seance['niveau']) ?></td>
                        <td><?= htmlspecialchars($seance['equipement']) ?></td>
                        <td><?= htmlspecialchars($seance['nb_inscrits']) ?></td>
                        <td>
                            <a class="btn-link" href="ajouter_inscriptions.php?id_seance=<?= htmlspecialchars($seance['id_seance']) ?>">
                                S'inscrire
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>

    <footer class="footer">
        <hr>
        <p>© 2026 - Projet SAE Programmation WEB - Association sportive</p>
        <p>Réalisé par Marwa Idzim et Ramy ELHOSARY - Sup Galilée</p>
    </footer>

    <script src="../assets/js/script.js"></script>
</body>
</html>