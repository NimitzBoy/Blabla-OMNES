<!DOCTYPE html>

<?php
require_once("config.php");
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlablaOMNES.com</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">

        <!-- créer profil conducteur si besoin -->
        <h1 class="text-2xl font-bold text-purple-700">Créer un profil conducteur</h1>
    </div>

    <!-- formulaire profil conducteur avec ttes infos -->
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="FormulaireRecherche bg-white p-8 shadow-lg rounded-lg w-full max-w-sm">
            <form method="post" action="formulaireVerifProfilConducteur.php" class="space-y-4">
                <div>
                    <label for="Modèle_du_véhicule" class="block text-sm font-medium text-gray-700">Modèle du véhicule</label>
                    <input type="text" id="Modèle_du_véhicule" name="Modèle_du_véhicule" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="fileInput" class="block text-sm font-medium text-gray-700">Photo du véhicule</label>
                    <input type="file" id="fileInput" name="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="Numéro_de_permis_de_conduire" class="block text-sm font-medium text-gray-700">Numéro de permis de conduire</label>
                    <input type="text" id="Numéro_de_permis_de_conduire" name="Numéro_de_permis_de_conduire" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="Date_de_délivrance_du_permis_de_conduire" class="block text-sm font-medium text-gray-700">Date de délivrance du permis de conduire</label>
                    <input type="date" id="Date_de_délivrance_du_permis_de_conduire" name="Date_de_délivrance_du_permis_de_conduire" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <label for="fileInputPermis" class="block text-sm font-medium text-gray-700">Photo du permis de conduire</label>
                    <input type="file" id="fileInputPermis" name="file" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label for="Préférences_de_voyage" class="block text-sm font-medium text-gray-700">Préférences de voyage</label>
                    <input type="text" id="Préférences_de_voyage" name="Préférences_de_voyage" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-purple-700 text-white px-6 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Valider</button>
                </div>
            </form>
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

