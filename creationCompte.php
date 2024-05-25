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


<!-- formulaire de création de compte -->
<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-9">
        <h1 class="text-2xl font-bold text-purple-700">Créer un compte</h1>
    </div>
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
            <div class="FormulaireRecherche bg-white p-8 shadow-lg rounded-lg w-full max-w-md">
            <form method="post" action="AjoutCompte.php" class="space-y-1">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" name="prenom" id="prenom" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label for="Numero_de_telephone" class="block text-sm font-medium text-gray-700">Numéro de téléphone</label>
                <input type="text" name="Numero_de_telephone" id="Numero_de_telephone" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label for="adresseMail" class="block text-sm font-medium text-gray-700">Adresse mail</label>
                <input type="email" name="adresseMail" id="adresseMail" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div>
                <label for="motDePasse" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="motDePasse" id="motDePasse" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-purple-700 text-white px-6 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Valider</button>
            </div>
        </form>
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