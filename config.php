<?php
$Serveur = 'mysql:host=localhost;dbname=blablaomnes';
$User = 'root';
$Pass = ''; 

try {
    $bdd = new PDO($Serveur, $User, $Pass);
    // Définir le mode d'erreur sur PDO pour lancer des exceptions en cas d'erreur
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
