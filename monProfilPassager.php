<?php
require_once("config.php");

// on vérifie que l'utilisateur soit bien connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionPassager.php");
    exit();
}

$id_utilisateur = $_SESSION['user_id'];

// on récupère les infos de l'utilisateur
try {
    $stmt_profil = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur");
    $stmt_profil->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt_profil->execute();
    $profil = $stmt_profil->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'ERREUR : ' . $e->getMessage();
}

//affichage de l'image
function afficherImage($data) {
    if ($data) {
        $base64 = base64_encode($data);
        return 'data:image/jpeg;base64,' . $base64;
    } else {
        //si pas d'image:
        return 'aucune image';
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<!-- style haut de page + photo -->
<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">
        <h1 class="text-2xl font-bold text-purple-700">Mon Profil</h1>
    </div>

    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-4xl">
            <h2 class="text-xl font-bold mb-4">Profil de l'utilisateur</h2>
            <div class="mb-8">
                <?php if (isset($profil)): ?>
                    <!-- infos utilisateur -->
                    <p><strong>Nom:</strong> <?php echo htmlspecialchars($profil['nom']); ?></p>
                    <p><strong>Prénom:</strong> <?php echo htmlspecialchars($profil['prenom']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($profil['email']); ?></p>
                    <p><strong>Numéro:</strong> <?php echo htmlspecialchars($profil['numero']); ?></p>

                    <!-- affichage de la photo -->
                    <div class="mt-4">
                        <h3 class="text-lg font-bold">Photo de Profil</h3>
                        <img src="<?php echo afficherImage($profil['photo']); ?>" alt="Photo" class="w-32 h-32 object-cover rounded-full">
                    </div>
                <?php else: ?>

                    <p>Informations de profil non disponibles.</p>
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