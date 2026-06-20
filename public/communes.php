<?php
require "../config/db.php";
echo "Connexion réussie";

$sql = "SELECT 
            co.nom,
            co.departement,
            COUNT(DISTINCT cl.id_club) AS nb_clubs,
            COUNT(DISTINCT e.id_equipement) AS nb_equipements
        FROM Communes co
        LEFT JOIN Clubs cl ON co.id_commune = cl.id_commune
        LEFT JOIN Equipements e ON co.id_commune = e.id_commune
        GROUP BY co.id_commune, co.nom, co.departement
        ORDER BY co.departement, co.nom
        ";
$stmt = $pdo->query($sql);
$communes = $stmt->fetchAll(PDO::FETCH_ASSOC);


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
        <a href="communes.php" class="nav-item is-active" data-active-color="#cc7700" data-target="Communes">Communes</a>
        <a href="clubs.php" class="nav-item" data-active-color="#ccc900" data-target="Clubs">Clubs</a>
        <a href="sports.php" class="nav-item" data-active-color="#00cca3" data-target="Sports">Sports</a>
        <a href="equipements.php" class="nav-item" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>

    <h1>Titre</h1>
    <p>Description</p>
    
    <table >
        <tr >
            <th> Nom de la commune </th>
            <th> Département </th>
            <th> Nombre de Clubs </th>
            <th> Nombre d'équipements </th>
        </tr>
        <?php foreach($communes as $commune):?>
        <tr>
            <td> <?= htmlspecialchars($commune['co.nom']) ?> </td>
            <td> <?= htmlspecialchars($commune['co.Departement']) ?> </td>
            <td> <?= htmlspecialchars($commune['COUNT(cl.id_club)']) ?> </td>
            <td> <?= htmlspecialchars($commune['COUNT(e.id_equipement)']) ?> </td>
        </tr>
        <?php endforeach; ?>
    </table >


    <script src="../assets/js/script.js"></script>
</body>
</html>
