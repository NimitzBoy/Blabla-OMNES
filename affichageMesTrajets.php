<?php
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionPassager.php");
    exit();
}

$id_utilisateur = $_SESSION['user_id'];

// Récupérer les trajets publiés par l'utilisateur
try {
    $stmt_publies = $bdd->prepare("SELECT * FROM trajet WHERE conducteur_id = :conducteur_id");
    $stmt_publies->bindParam(':conducteur_id', $id_utilisateur); // Correction ici
    $stmt_publies->execute();
    $trajets_publies = $stmt_publies->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer les trajets réservés par l'utilisateur
    $stmt_reserves = $bdd->prepare("SELECT * FROM trajet WHERE passager_id = :passager_id");
    $stmt_reserves->bindParam(':passager_id', $id_utilisateur);
    $stmt_reserves->execute();
    $trajets_reserves = $stmt_reserves->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERREUR : ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">
        <h1 class="text-2xl font-bold text-purple-700">Mes Trajets</h1>
    </div>

    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-4xl">
            <h2 class="text-xl font-bold mb-4">Trajets publiés</h2>
            <div class="mb-8">
                <!-- on vérifie si trajets publies est défini -->
                <?php if (isset($trajets_publies) && count($trajets_publies) > 0): ?> 
                    <ul class="list-disc pl-5">
                        <?php foreach ($trajets_publies as $trajet): ?>
                            <li class="mb-2">
                                <!-- affichage des trajets avec toutes les caractéristiques -->
                                <p>Adresse de départ: <?php echo htmlspecialchars($trajet['lieu_depart']); ?></p>
                                <p>Adresse d'arrivée: <?php echo htmlspecialchars($trajet['lieu_arrivee']); ?></p>
                                <p>Date de départ: <?php echo htmlspecialchars($trajet['date_depart']); ?></p>
                                <p>Prix du trajet par personne: <?php echo htmlspecialchars($trajet['prix']); ?> €</p>
                                <p>Type: <?php echo htmlspecialchars($trajet['type_trajet']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun trajet publié.</p>
                <?php endif; ?>
            </div>

            <!-- Section des trajets réservés -->
            <h2 class="text-xl font-bold mb-4">Trajets réservés</h2>
            <div class="mb-8">
                <?php if (isset($trajets_reserves) && count($trajets_reserves) > 0): ?> 
                    <ul class="list-disc pl-5">
                        <?php foreach ($trajets_reserves as $trajet): ?>
                            <li class="mb-2">
                                <!-- affichage des trajets réservés avec toutes les caractéristiques -->
                                <p>Adresse de départ: <?php echo htmlspecialchars($trajet['lieu_depart']); ?></p>
                                <p>Adresse d'arrivée: <?php echo htmlspecialchars($trajet['lieu_arrivee']); ?></p>
                                <p>Date de départ: <?php echo htmlspecialchars($trajet['date_depart']); ?></p>
                                <p>Prix du trajet par personne: <?php echo htmlspecialchars($trajet['prix']); ?> €</p>
                                <p>Type: <?php echo htmlspecialchars($trajet['type_trajet']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun trajet réservé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- bas de page -->
    <div class="feetpage h-25 w-full bg-purple-700 flex justify-between items-center p-5 box-border">
        <div class="feetpage-links flex space-x-5">
            <a href="QuiSommesNous.php" class="text-white">Qui sommes-nous ?</a>
            <a href="InformationsLegales.php" class="text-white">Informations légales</a>
            <a href="#" class="text-white">Paramètres des cookies</a>
        </div>

        <div class="feetpage-Blablalogo flex items-center space-x-2">
            <span class="text-white text-sm">BlablaOmnes 2024 &copy;</span>
            <img src="Preview.png" alt="Logo" class="h-12">
        </div>
    </div>
</body>
</html>


