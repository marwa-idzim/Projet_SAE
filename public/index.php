<?php
require "../config/db.php";

$sql = "SELECT COUNT(*) FROM Communes";
// Exécution directe de la requête SQL via l'objet PDO.
// La méthode query() est utilisée pour les requêtes simples sans paramètres.
$stmt = $pdo->query($sql);
$nbCommunes = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Clubs";
$stmt = $pdo->query($sql);
$nbClubs = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Sports";
$stmt = $pdo->query($sql);
$nbSports = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Equipements";
$stmt = $pdo->query($sql);
$nbEquipements = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Seances";
$stmt = $pdo->query($sql);
$nbSeances = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Inscriptions";
$stmt = $pdo->query($sql);
$nbInscriptions = $stmt->fetchColumn();

$sql = "SELECT COUNT(*) FROM Licencies";
$stmt = $pdo->query($sql);
$nbLicencies = $stmt->fetchColumn();

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
        <a href="index.php" class="nav-item is-active" data-active-color="#cc0000" data-target="Accueil">Accueil</a>
        <a href="communes.php" class="nav-item" data-active-color="#cc7700" data-target="Communes">Communes</a>
        <a href="clubs.php" class="nav-item" data-active-color="#ccc900" data-target="Clubs">Clubs</a>
        <a href="sports.php" class="nav-item" data-active-color="#00cca3" data-target="Sports">Sports</a>
        <a href="equipements.php" class="nav-item" data-active-color="#0022cc" data-target="Equipements">Équipements</a>
        <a href="seances.php" class="nav-item" data-active-color="#c200cc" data-target="Seances">Séances</a>
        <a href="inscriptions.php" class="nav-item" data-active-color="#cc007e" data-target="Inscriptions">Inscriptions</a>

        <span class="nav-indicator"></span>
    </nav>

    <section class="hero">
        <div class="hero-text">
            <h1>Trouvez une activité sportive près de chez vous avec BoojToi !</h1>
            <p>Consultez les clubs, équipements et séances sportives disponibles dans votre commune.</p>
        </div>
    </section>

    <section class="stats">

        <a href="communes.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbCommunes; ?></h2>
                <p>Communes</p>
            </div>
        </a>

        <a href="clubs.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbClubs; ?></h2>
                <p>Clubs</p>
            </div>
        </a>

        <a href="sports.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbSports; ?></h2>
                <p>Sports</p>
            </div>
        </a>

        <a href="equipements.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbEquipements; ?></h2>
                <p>Équipements</p>
            </div>
        </a>

        <a href="seances.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbSeances; ?></h2>
                <p>Séances</p>
            </div>
        </a>

        <a href="inscriptions.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbInscriptions; ?></h2>
                <p>Inscriptions</p>
            </div>
        </a>

        <a href="inscriptions.php" class="stat-link">
            <div class="stat-card">
                <h2><?php echo $nbLicencies; ?></h2>
                <p>Licenciés</p>
            </div>
        </a>

    </section>
    <script src="../assets/js/script.js"></script>
</body>
<footer class="footer">
    <hr>
    <p>© 2026 - Projet SAE Programmation WEB - Association sportive</p>
    <p>Réalisé par Ramy ELHOSARY et Marwa Idzim - Sup Galilée</p>
</footer>
</html>