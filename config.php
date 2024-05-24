<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
session_start();
$Serveur = 'mysql:host=localhost;dbname=blablaomnes'; // creation des données servant pour la connexion de la bdd
$User = 'root';
$Pass = '';

try {
    $bdd = new PDO($Serveur, $User, $Pass); // connexion
    // Définir le mode d'erreur sur PDO pour lancer des exceptions en cas d'erreur
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fonction pour vérifier si l'utilisateur est connecté
function check_session() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: connexionPassager.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        exit();
    }
}
?>
