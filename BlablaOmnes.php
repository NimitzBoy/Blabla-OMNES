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
    <style>
        .dropdown-content {
            display: none;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>
<body class="h-screen w-screen flex flex-col">
    <div class="header flex justify-between items-center h-24 bg-white bg-no-repeat bg-center bg-[url('Preview.png')] p-1">
        <div class="dropdown relative">
            <button class="buttonMenu bg-purple-700 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Menu</button>
            <div class="dropdown-content absolute left-0 mt-1 w-48 bg-white shadow-lg rounded-lg flex flex-col items-center">
                <a href="#" class="py-2 px-4 hover:bg-purple-700 hover:text-white text-center ">Mon profil</a>
                <br>
                <a href="#" class="py-2 px-4 hover:bg-purple-700 hover:text-white text-center ">Mes Trajets</a>
            </div>
        </div>
        <img src="Preview.png" alt="Logo" class="h-24">
        <a href="choixUtilisateur.php" class="buttonLogin bg-purple-700 text-white px-4 py-2 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Connexion</a>
    </div>
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
        <div class="formulaire-recherche p-9 bg-white shadow-lg rounded-lg flex flex-col w-full max-w-lg md:max-w-2xl lg:max-w-2xl">
            <form action="" method="post" class="flex flex-col space-y-3">
                <input type="text" name="Lieu Départ" placeholder="Lieu de Départ" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="text" name="destination" placeholder="Destination" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="number" name="passagers" placeholder="Nombre de passagers" min="1" class="bg-gray-300 p-2 rounded-lg w-full" required>
                <input type="date" name="date départ" placeholder="Date de départ" class="bg-gray-300 p-2 rounded-lg w-full" required>
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
    <script>
        function toggleMenu() {
            var menu = document.getElementById('menu');
            if (menu.style.display === 'block' || menu.style.display === '') {
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }
    </script>
</body>
</html>







