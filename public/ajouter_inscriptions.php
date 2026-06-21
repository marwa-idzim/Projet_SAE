<?php
require "../config/db.php";

$idSeance = $_GET["id_seance"] ?? null;

if ($idSeance === null) {
    die("Aucune séance sélectionnée.");
}
$sql = "SELECT 
            s.id_seance,
            s.date_seance,
            s.heure_debut,
            s.heure_fin,
            s.niveau,
            co.nom AS commune,
            cl.nom AS club,
            e.nom AS equipement,
            sp.nom AS sport,
            d.adresse AS adresse
        FROM Seances s, Communes co, Clubs cl, Sports sp, Equipements e, Details_club d
        WHERE s.id_seance= '$idSeance'
        AND s.id_club=cl.id_club
        AND d.id_club=s.id_club
        AND s.id_equipement=e.id_equipement
        AND cl.id_sport=sp.id_sport
        AND cl.id_commune=co.id_commune
        ";

$stmt = $pdo->query($sql);

$info_seance = $stmt->fetch(PDO::FETCH_ASSOC);

$messageSucces = "";
$messageErreur = "";
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
        <a href="index.php" class="site-name">BoojToi</a>
        <span class="nav-indicator"></span>
    </nav>

    <h1>Inscription à la séance:</h1>
    <ul>
        <li> date: <?=htmlspecialchars($info_seance['date_seance'])?> </li>
        <li> de: <?=htmlspecialchars($info_seance['heure_debut'])?></li>
        <li> à: <?=htmlspecialchars($info_seance['heure_fin'])?></li>
        <li> Club: <?=htmlspecialchars($info_seance['club'])?></li>
        <li> Sport: <?=htmlspecialchars($info_seance['sport'])?></li>
        <li> Niveau: <?=htmlspecialchars($info_seance['niveau'])?></li>
        <li> Commune: <?=htmlspecialchars($info_seance['commune'])?></li>
        <li> Adresse: <?=htmlspecialchars($info_seance['adresse'])?></li>
        <li> Equipement: <?=htmlspecialchars($info_seance['equipement'])?></li>
    </ul>
    
    <h2>Veuillez remplir le formulaire:</h2>
    
    <form id="formulaire" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="NOM" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" placeholder="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="pseudo@email.com" required>

        <button type="submit" data-id-seance-inscr="<?=$info_seance['id_seance']?>">Envoyer</button>
    </form>


    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];

            $sql = "SELECT COUNT(*) 
                    FROM Licencies
                    WHERE nom='$nom'
                    AND prenom='$prenom'
                    AND email='$email'
                    ";
            $stmt = $pdo->query($sql);
            $est_licencie=$stmt->fetchColumn();
            $id_licencies=0;
            if((int)$est_licencie===0){
                
                $sql = "SELECT MAX(id_licencies) FROM Licencies";
                $stmt = $pdo->query($sql);
                $id_licencies=($stmt->fetchColumn()?? 300) + 1;
                $sql = "INSERT INTO Licencies 
                        VALUES(:id_licencies, :nom, :prenom, :email)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    "id_licencies"=>$id_licencies,
                    "nom"=>$nom,
                    "prenom"=>$prenom,
                    "email"=>$email,
                ]);
            }
            else{
                $sql = "SELECT id_licencies
                        FROM Licencies
                        WHERE nom = :nom
                        AND prenom = :prenom
                        AND email = :email";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "email" => $email
                ]);

                $id_licencies = $stmt->fetchColumn();
            }
                

            $sql = "SELECT COUNT(id_inscription)
                    FROM Inscriptions
                    WHERE id_seance = :id_seance
                    AND id_licencies = :id_licencies";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                "id_seance" => $info_seance["id_seance"],
                "id_licencies" => $id_licencies
            ]);

            $deja_inscrit = $stmt->fetchColumn();

            if((int)$deja_inscrit===0){
                $messageSucces="Votre inscription à la séance a bien été prise en compte. Le mot de passe pour accéder aux inscrits est : azul";

                $date_inscription=date("Y-m-d");
                $sql = "SELECT MAX(id_inscription) FROM Inscriptions";
                $stmt = $pdo->query($sql);
                $id_inscription = ($stmt->fetchColumn()?? 500)+1;

                $sql = "INSERT INTO Inscriptions 
                        VALUES(
                            :id_inscription, 
                            :date_inscription,
                            :id_licencies, 
                            :id_seance
                            )
                        ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    "id_inscription"=>$id_inscription,
                    "date_inscription"=>$date_inscription,
                    "id_licencies"=>$id_licencies,
                    "id_seance"=>$info_seance['id_seance'],
                ]);
    
            }
            else
                $messageErreur = "Cette personne est déjà inscrite à cette séance.";
        }

    ?>
    
    <?php if (!empty($messageSucces)): ?>
        <div class="message-succes">
            <?= htmlspecialchars($messageSucces) ?>
            <br>
            <a href="inscriptions.php?id_seance=<?= htmlspecialchars($info_seance['id_seance']) ?>">
                Voir les inscriptions de cette séance
            </a>
        </div>
    <?php endif; ?>

    <?php if (!empty($messageErreur)): ?>
        <div class="message-erreur">
            <?= htmlspecialchars($messageErreur) ?>
        </div>
    <?php endif; ?>
    
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