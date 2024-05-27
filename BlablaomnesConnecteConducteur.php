<?php
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionConducteur.php");
    exit();
}

// Vérifier si l'alerte n'a pas déjà été affichée
if (isset($_SESSION['nouveau_passager_alerte_affichee']) && $_SESSION['nouveau_passager_alerte_affichee']) {
    try {
        // Récupérer les informations sur le trajet
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE conducteur_id = :id_conducteur");
        $stmt->bindParam(':id_conducteur', $_SESSION['user_id']);
        $stmt->execute();
        $trajet_details = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si les détails du trajet ont été récupérés avec succès
        if ($trajet_details) {
            // Construire le message de l'alerte
            $message_alerte = "Nouveau passager pour votre trajet de " . $trajet_details['lieu_depart'] . " à " . $trajet_details['lieu_arrivee'] . " le " . $trajet_details['date_depart'];

            // Récupérer les informations sur le passager
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_passager");
            $stmt->bindParam(':id_passager', $trajet_details['passager_id']);
            $stmt->execute();
            $passager_details = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si les détails du passager ont été récupérés avec succès
            if ($passager_details) {
                $nom_prenom_passager = $passager_details['prenom'] . " " . $passager_details['nom'];
                $numero_passager = $passager_details['numero'];

                // Afficher l'alerte
                echo "<script>alert('$message_alerte \\n Nom et prénom du passager : $nom_prenom_passager \\n Numéro de téléphone du passager : $numero_passager');</script>";

                // Réinitialiser la variable de session pour ne pas réafficher l'alerte
                $_SESSION['nouveau_passager_alerte_affichee'] = false;
            } else {
                
            }
        } else {
            
        }
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }
}
?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlablaOMNES.com</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dropdown-content {
            display: none;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .notification-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        .notification-popup a {
            margin: 5px;
        }
    </style>
</head>
<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-between items-center h-24 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-1">
        <div class="dropdown relative">
            <button class="buttonMenu bg-purple-700 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Menu</button>
            <div class="dropdown-content absolute left-0 mt-1 w-48 bg-white shadow-lg rounded-lg flex flex-col items-center">
                <a href="monProfilConducteur.php" class="py-2 px-4 hover:bg-purple-700 hover:text-white text-center ">Mon profil</a>
                <a href="affichageMesTrajets.php" class="py-2 px-4 hover:bg-purple-700 hover:text-white text-center ">Mes Trajets</a>
            </div>
        </div>
        
        <a class="buttonLogin bg-white-700  text-purple-700 rounded-lg"><p><strong>Bienvenue,</strong> <strong><?php echo htmlspecialchars($_SESSION['prenom']); ?></strong> !</p></a>
        <a href="blablaOmnes.php" class="buttonLogin bg-purple-700 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Déconnexion</a>
    </div>
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="formulaire-recherche p-9 bg-white shadow-lg rounded-lg flex flex-col w-full max-w-lg md:max-w-2xl lg:max-w-2xl">
            <form action="Affichertrajet.php" method="post" class="flex flex-col space-y-3" onsubmit="return checkLoginStatus();">
                <input type="text" name="Lieu_Départ" placeholder="Lieu de Départ" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="text" name="destination" placeholder="Destination" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="date" name="date_départ" placeholder="Date de départ" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <button type="submit" class="bg-purple-700 text-white p-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Rechercher</button>
            </form>
            <form action="publiTrajet.php" method="post" class="mt-4">
                <button type="submit" class="bg-purple-700 text-white p-3 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Publier un trajet</button>
            </form>    
        </div>
    </div>
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

    <!-- JS pour vérifier que l'utilisateur est bien connecté pour rechercher un trajet -->
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








