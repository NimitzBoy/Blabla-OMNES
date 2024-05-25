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
        <h1 class="text-2xl font-bold text-purple-700">Publier un trajet</h1>
    </div>

    <!-- formulaire publi d'un trajet -->
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="FormulaireRecherche bg-white p-8 shadow-lg rounded-lg w-full max-w-md">
            <form method="post" action="AjoutTrajet.php" class="bg-white p-6 rounded-lg shadow-md">
                <div class="mb-4">
                    <!-- adresse départ -->
                    <label for="Adresse_de_départ" class="block text-gray-700 font-bold mb-2">Adresse de départ:</label>
                    <input type="text" name="Adresse_de_départ" id="Adresse_de_départ" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <!-- adresse arrivée -->
                    <label for="Adresse_d'arrivée" class="block text-gray-700 font-bold mb-2">Adresse d'arrivée:</label>
                    <input type="text" name="Adresse_d'arrivée" id="Adresse_d'arrivée" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <!-- date départ -->
                    <label for="date_de_depart" class="block text-gray-700 font-bold mb-2">Date de départ:</label>
                    <input type="date" name="date_de_depart" id="date_de_depart" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <!-- type trajet -->
                    <span class="block text-gray-700 font-bold mb-2">Sélectionnez votre trajet :</span>
                    <div class="flex items-center mb-2">
                        <input type="radio" name="type_trajet" id="aller" value="aller" class="mr-2 leading-tight">
                        <label for="aller" class="text-gray-700">Aller</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="radio" name="type_trajet" id="retour" value="retour" class="mr-2 leading-tight">
                        <label for="retour" class="text-gray-700">Retour</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="radio" name="type_trajet" id="aller_retour" value="aller_retour" class="mr-2 leading-tight">
                        <label for="aller_retour" class="text-gray-700">Aller et retour</label>
                    </div>
                </div>
                <div class="mb-4">
                    <!-- prix trajet -->
                    <label for="Prix_du_trajet_par_personne" class="block text-gray-700 font-bold mb-2">Prix du trajet par personne:</label>
                    <div class="flex items-center">
                        <input type="text" name="Prix_du_trajet_par_personne" id="Prix_du_trajet_par_personne" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <span class="ml-2 text-gray-700">€</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <!-- bouton publication -->
                    <button type="submit" class="bg-purple-700 text-white px-6 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Publier un trajet</button>
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

