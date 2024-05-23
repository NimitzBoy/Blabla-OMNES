<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>BlablaOMNES.com</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BlablaOmnes.css">
</head>
<body>
    <div class="container">
        <div class="Header">
            <a href="Login.php" class="buttonMenu">Menu</a>
            <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom']); ?>!</p>
        </div>
        <div class="body">
            <div class="FormulaireRecherche">
                <form action="AfficherTrajet.php" method="post">
                    <input type="text" name="Lieu_Départ" placeholder="Lieu de Départ" required>
                    <input type="text" name="destination" placeholder="Destination" required>
                    <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" required>
                    <input type="date" name="date_départ" placeholder="Date de départ" required>
                    <button type="submit">Rechercher</button>
                </form>
                <form action="publiTrajet.php" method="post">
                    <button type="submit">Créer un trajet</button>
                </form>
                <form method="post" action="deconnexion.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        </div> 
        <div class="feetpage"></div>
    </div>
    <script>
        function checkLoginStatus() {
            <?php if (!isset($_SESSION['user_id'])): ?>
                alert("Vous devez être connecté pour rechercher un trajet.");
                window.location.href = "choixUtilisateur.php";
                return false;
            <?php else: ?>
                return true;
            <?php endif; ?>
        }
    </script>
</body>
</html>
