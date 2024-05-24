<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlablaOMNES Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col bg-gray-100">
    <header class="bg-purple-700 text-white p-4 text-center">
        <h1 class="text-2xl font-bold">BlablaOmnes Administrator</h1>
    </header>
    <main class="flex-grow flex flex-col justify-center items-center p-6">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <ul class="space-y-4">
                <li><a href="afficherTrajetsAdmin.php" class="block bg-purple-700 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-800">Gestion Trajets</a></li>
                <li><a href="validationPermis.php" class="block bg-purple-700 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-800">Validation des Permis de conduire</a></li>
                <li><a href="afficherUtilisateursAdmin.php" class="block bg-purple-700 text-white py-2 px-4 rounded-lg text-center hover:bg-purple-800">Gestion utilisateurs</a></li>
            </ul>
        </div>
    </main>
    <footer class="bg-purple-700 text-white p-4 text-center flex justify-center items-center space-x-2">
        <p> 2024 BlablaOMNES &copy;</p>
        <img src="Preview.png" alt="Logo" class="h-10">
    </footer>
</body>
</html>

