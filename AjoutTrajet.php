<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        // Récupérer l'ID de l'utilisateur connecté depuis la session
        $conducteur_id = $_SESSION['user_id'];

        // Vérifier la validation du permis de l'utilisateur
        $validation_permis = getValidationPermis($conducteur_id);

        // Si le permis n'est pas validé (validation_permis = 0)
        if ($validation_permis == 0) {
            echo 'Les administrateurs n\'ont pas encore validé votre permis. Veuillez patienter.';
        }
        // Si le permis a été refusé (validation_permis = 2)
        elseif ($validation_permis == 2) {
            echo 'Votre permis n\'a pas été validé.';
        }
        // Si le permis est validé (validation_permis = 1)
        else {
            // Vérifier les données du formulaire et insérer le trajet si tout est valide
            if (isset($_POST["Adresse_de_départ"], $_POST["Adresse_d'arrivée"], $_POST["Prix_du_trajet_par_personne"], $_POST["date_de_depart"], $_POST["type_trajet"], $_POST["places_dispo"])) {
                $lieu_depart = $_POST["Adresse_de_départ"];
                $lieu_arrivee = $_POST["Adresse_d'arrivée"];
                $date_depart = $_POST["date_de_depart"];
                $type_trajet = $_POST["type_trajet"];
                $prix = $_POST["Prix_du_trajet_par_personne"];
                $places_disponibles = $_POST["places_dispo"];

                try {
                    $stmt = $bdd->prepare("INSERT INTO trajet (lieu_depart, lieu_arrivee, prix, date_depart, type_trajet, conducteur_id, places_disponibles) VALUES (:lieu_depart, :lieu_arrivee, :prix, :date_depart, :type_trajet, :conducteur_id, :places_disponibles)");
                    $stmt->bindParam(':lieu_depart', $lieu_depart);
                    $stmt->bindParam(':lieu_arrivee', $lieu_arrivee);
                    $stmt->bindParam(':date_depart', $date_depart);
                    $stmt->bindParam(':prix', $prix);
                    $stmt->bindParam(':type_trajet', $type_trajet);
                    $stmt->bindParam(':conducteur_id', $conducteur_id);
                    $stmt->bindParam(':places_disponibles', $places_disponibles);
                    if ($stmt->execute()) {
                        echo 'Trajet ajouté avec succès.';
                    } else {
                        echo 'Erreur lors de l\'ajout du trajet. Veuillez réessayer.';
                    }
                } catch (PDOException $e) {
                    echo 'ERREUR : " . $e->getMessage() . "';
                }
            }
        }
    } else {
        echo 'Erreur : utilisateur non connecté.';
    }
}

// Fonction pour récupérer la validation du permis de l'utilisateur depuis la base de données
function getValidationPermis($user_id)
{
    global $bdd;
    $validation_permis = 0; // Par défaut, non validé

    try {
        $stmt = $bdd->prepare("SELECT validation_permis FROM utilisateur WHERE id_utilisateur = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $validation_permis = $row['validation_permis'];
        }
    } catch (PDOException $e) {
        echo 'ERREUR : ' . $e->getMessage();
    }

    return $validation_permis;
}
?>
