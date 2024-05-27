<?php
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionPassager.php");
    exit();
}

// Vérifier si un trajet a été sélectionné
if (isset($_GET["id_trajet"])) {
    $id_trajet = $_GET["id_trajet"];

    try {
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE id_trajet = :id_trajet");
        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->execute();

        $trajet_details = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error_message = 'ERREUR : ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex flex-col min-h-screen">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">
        <h1 class="text-2xl font-bold text-purple-700">Détails du Trajet</h1>
    </div>

    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-4xl">
            <?php if (isset($trajet_details)): ?>
                <p><strong>Adresse de départ:</strong> <?php echo htmlspecialchars($trajet_details['lieu_depart']); ?></p>
                <p><strong>Adresse d'arrivée:</strong> <?php echo htmlspecialchars($trajet_details['lieu_arrivee']); ?></p>
                <p><strong>Date de départ:</strong> <?php echo htmlspecialchars($trajet_details['date_depart']); ?></p>
                <p><strong>Prix du trajet par personne:</strong> <?php echo htmlspecialchars($trajet_details['prix']); ?>€</p>
                <p><strong>Photo du véhicule:</strong> <img src="<?php echo htmlspecialchars($trajet_details['photo_vehicule']); ?>" alt="Modèle du véhicule"></p>
                <p><strong>Les préférences du conducteur:</strong> <?php echo htmlspecialchars($trajet_details['preference_conducteur']); ?></p>
                <a href="BlablaOmnesConnectePassager.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Retour à la liste des trajets</a>
            <?php else: ?>
                <p class="text-red-500"><?php echo $error_message ?? 'Aucun détail trouvé pour ce trajet.'; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="feetpage w-full bg-purple-700 flex justify-between items-center p-5 mt-auto">
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

