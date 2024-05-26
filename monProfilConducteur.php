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

    // Si l'utilisateur n'a pas de portefeuille, on initialise à 0
    if ($profil && $profil['wallet'] === null) {
        $profil['wallet'] = 0;
    }

    // Si le formulaire est soumis, on traite l'ajout au solde
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['montant'])) {
        $montant = floatval($_POST['montant']);
        if ($montant > 0) {
            $nouveau_solde = $profil['wallet'] + $montant;
            $stmt_update = $bdd->prepare("UPDATE utilisateur SET wallet = :wallet WHERE id_utilisateur = :id_utilisateur");
            $stmt_update->bindParam(':wallet', $nouveau_solde);
            $stmt_update->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt_update->execute();
            $profil['wallet'] = $nouveau_solde; // Mettre à jour le profil localement
        }
    }
} catch (PDOException $e) {
    echo 'ERREUR : ' . $e->getMessage();
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
                        <?php if (!empty($profil['photo'] && $profil['photo_permis'])): ?>
                            <p><strong>Photo du profil:</strong> <img src="<?php echo htmlspecialchars($profil['photo']); ?>" alt="Photo du Profil" class="w-48 h-48 object-cover rounded"></p>
                            <p><strong>Photo du Permis:</strong> <img src="<?php echo htmlspecialchars($profil['photo_permis']); ?>" alt="Photo du Permis" class="w-48 h-48 object-cover rounded"></p>
                        <?php else: ?>
                            <p>Aucune photo de profil disponible.</p>
                        <?php endif; ?>
                    </div>
                    <br>
                    <!-- Portefeuille de l'utilisateur -->
                    <h2 class="text-xl font-bold mb-4">Mon Portefeuille</h2>
                    <div class="mb-8">
                        <p><strong>Solde:</strong> <?php echo htmlspecialchars($profil['wallet']); ?> €</p>
                    </div>

                    <!-- Formulaire pour augmenter le solde -->
                    <form method="post" action="AjoutWallet.php">
                        <input type="hidden" name="id_utilisateur" value="<?php echo $id_utilisateur; ?>">
                        <input type="number" name="montant" id="montant" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" min="0.01" step="0.01" required>
                        <button type="submit" class="mt-2 bg-purple-700 text-white px-4 py-2 rounded">Ajouter</button>
                    </form>
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
