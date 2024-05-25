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

<!-- mise en page -->
<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-center items-center h-30 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-1">
        <img src="Preview.png" alt="Logo" class="h-24">
    </div>
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="formulaire-recherche p-10 bg-white shadow-lg rounded-lg flex flex-col w-full max-w-lg md:max-w-2xl lg:max-w-3xl">
            <div class="flex justify-between space-x-4">

                <!-- connexion en tant que conducteur -->
                <form action="connexionConducteur.php" method="post" class="w-1/2">
                    <button type="submit" class="button bg-purple-700 text-white px-8 py-6 text-xl rounded-lg w-full shadow-lg transform transition-transform duration-200 hover:scale-105">Connectez-vous comme Conducteur</button>
                </form>

                <!-- connexion en tant que passager -->
                <form action="connexionPassager.php" method="post" class="w-1/2">
                    <button type="submit" class="button bg-purple-700 text-white px-8 py-6 text-xl rounded-lg w-full shadow-lg transform transition-transform duration-200 hover:scale-105">Connectez-vous comme Passager</button>
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




