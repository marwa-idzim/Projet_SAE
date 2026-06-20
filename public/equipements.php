<?php
require "../config/db.php";
echo "Connexion réussie";
$sql = "SELECT 
            equip.nom AS nom_equipement,
            equip.type_equip,
            co.nom AS commune,
            COUNT(s.id_seance) AS nb_seances

        FROM Equipements equip

        LEFT JOIN Communes co 
            ON equip.id_commune = co.id_commune

        LEFT JOIN Seances s 
            ON equip.id_equipement = s.id_equipement

        GROUP BY equip.id_equipement, equip.nom, equip.type_equip, co.nom

        ORDER BY co.nom, equip.nom
        ";

$stmt = $pdo->query($sql);

$equipements = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <a href="equipements.php" class="nav-item is-active" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>

    
    <h1>Equipements mis à disposition pour vos clubs !</h1>
    <p>Trouvez tous les infos qui concernent les emprunts d'équipements de chaque commune !</p>
    
    <table >
        <tr >
            <th> Nom </th>
            <th> Type de l'equipement </th>
            <th> Commune qui utilise l'équipement </th>
            <th> Equipements utilisés pour </th>
        </tr>
        
        <?php foreach($equipements as $equipement): ?>
        <tr>
            <td> <?= htmlspecialchars($equipement['nom_equipement']) ?> </td>
            <td> <?= htmlspecialchars($equipement['type_equip']) ?> </td>
            <td> <?= htmlspecialchars($equipement['commune']) ?> </td>
            <td> <?= htmlspecialchars($equipement['nb_seances']) ?> séances </td>
        </tr>
        <?php endforeach; ?>
    </table >
   
     <script src="../assets/js/script.js"></script>
</body>
</html>