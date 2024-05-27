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
    $stmt_publies->bindParam(':conducteur_id', $id_utilisateur);
    $stmt_publies->execute();
    $trajets_publies = $stmt_publies->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERREUR : ' . $e->getMessage();
}

// Rechercher les trajets en fonction des critères de recherche
$trajets_recherche = [];
if (isset($_POST["Lieu_Départ"], $_POST["destination"], $_POST["date_départ"], $_POST["places_demandees"])) {
    $lieu_depart = $_POST["Lieu_Départ"];
    $lieu_arrivee = $_POST["destination"];
    $date_depart = $_POST["date_départ"];
    $places_demandees = (int)$_POST["places_demandees"];

    try {
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE lieu_depart = :lieu_depart AND lieu_arrivee = :lieu_arrivee AND date_depart = :date_depart AND places_disponibles >= :places_demandees");
        $stmt->bindParam(':lieu_depart', $lieu_depart);
        $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
        $stmt->bindParam(':date_depart', $date_depart);
        $stmt->bindParam(':places_demandees', $places_demandees);
        $stmt->execute();

        $trajets_recherche = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }
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
<body class="flex flex-col min-h-screen">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">
        <h1 class="text-2xl font-bold text-purple-700">Liste des Trajets</h1>
    </div>

    <div class="flex-grow flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-4xl">
            <?php if (count($trajets_recherche) > 0): ?>
                <?php foreach ($trajets_recherche as $row): ?>
                    <div class="trajet p-4 mb-4 border border-gray-200 rounded-lg shadow-sm">
                        <p><strong>Adresse de départ:</strong> <?php echo htmlspecialchars($row['lieu_depart']); ?></p>
                        <p><strong>Adresse d'arrivée:</strong> <?php echo htmlspecialchars($row['lieu_arrivee']); ?></p>
                        <p><strong>Date de départ:</strong> <?php echo htmlspecialchars($row['date_depart']); ?></p>
                        <p><strong>Prix du trajet par personne:</strong> <?php echo htmlspecialchars($row['prix']); ?>€</p>
                        <p><strong>Nombre de places disponibles:</strong> <?php echo htmlspecialchars($row['places_disponibles']); ?></p>
                        <form method="get" action="detailsTrajet.php" class="inline-block mr-2">
                            <input type="hidden" name="id_trajet" value="<?php echo htmlspecialchars($row['id_trajet']); ?>">
                            <button type="submit" class="bg-blue-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Détails du trajet</button>
                        </form>
                        <form method="post" action="reserverTrajet.php" class="inline-block">
                            <input type="hidden" name="id_trajet" value="<?php echo htmlspecialchars($row['id_trajet']); ?>">
                            <input type="hidden" name="places_demandees" value="<?php echo htmlspecialchars($places_demandees); ?>">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Réserver</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-red-500">Aucun trajet trouvé avec ces lieux de départ, d'arrivée, cette date et ce nombre de places.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="feetpage h-25 w-full bg-purple-700 flex justify-between items-center p-5 box-border mt-auto">
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


