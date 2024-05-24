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
    <h1 class="text-2xl font-bold text-purple-700">Connexion Conducteur</h1>
    </div>
    <div class="body flex justify-center items-center flex-grow bg-cover bg-fixed bg-center" style="background-image: url('Étretat.jpg');">
            <div class="FormulaireRecherche bg-white p-8 shadow-lg rounded-lg w-full max-w-md">
                <form method="post" action="verifConnexionPassager.php" class="flex flex-col space-y-4">
                    <input type="text" name="Adresse_mail" placeholder="Mail" required class="p-3 border rounded-lg">
                    <input type="password" name="Mot_de_passe" placeholder="Mot de passe" required class="p-3 border rounded-lg">
                    <button type="submit" class="bg-purple-700 text-white py-3 rounded-lg shadow-lg transform transition-transform duration-200 hover:scale-105">Valider</button>
                </form>
                <form method="post" action="creationCompte.php" class="mt-4">
                    <button type="submit" class="bg-purple-700 text-white py-3 rounded-lg w-full shadow-lg transform transition-transform duration-200 hover:scale-105">Créer un compte</button>
                </form>
                <p class="mt-4"><a href="verifConnexionPassager.php" class="text-purple-700 hover:underline">Mot de passe oublié?</a></p>
            </div>
        </div>

        </div>
    </div>
    <div class="feetpage h-25 w-full bg-purple-700 flex justify-between items-center p-5 box-border">
        <div class="feetpage-links flex space-x-5">
            <a href="QuiSommesNous.php" class="text-white">Qui sommes-nous ?</a>
            <a href="InformationsLegales.php" class="text-white">Informations légales</a>
            <a href="ParamètresDesCookies" class="text-white">Paramètres des cookies</a>
        </div>
        <div class="feetpage-Blablalogo flex items-center space-x-2">
            <span class="text-white text-sm">BlablaOmnes 2024 &copy;</span>
            <img src="Preview.png" alt="Logo" class="h-12">
        </div>
    </div>
</body>
</html>

