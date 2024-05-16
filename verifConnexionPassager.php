<?php
 require_once("config.php");
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $email = $_POST['Adresse_mail'];
     $password = $_POST['Mot_de_passe'];
    //  $motDePasse = password_hash($_POST["motDePasse"], PASSWORD_DEFAULT);
     echo "Mot de passe saisi : " . $password . "<br>";
     echo "Mot de passe stocké : " . $_POST['Mot_de_passe'] . "<br>";
    
     // requête SQL pour sélectionner l'utilisateur correspondant à l'adresse e-mail
     $sql = "SELECT * FROM utilisateur WHERE email = :email";
     $stmt = $bdd->prepare($sql);
     $stmt->bindParam(':email', $email);
     $stmt->execute();
 
     if ($stmt->rowCount() > 0) {
         // l'utilisateur est trouvé -> récupérer les données de l'utilisateur
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         var_dump($row);

         if (password_verify($password, $row['mot_de_passe'])) {
             // mot de passe correct -> rediriger vers la page appropriée
             header("Location: BlablaOmnes.php");
             exit;
         } else {
             // mot de passe incorrect
             echo "Mot de passe incorrect <br>";
         }
     } else {
         // utilisateur non trouvé
         echo "Adresse e-mail non enregistrée";
     }

 }
 ?>


