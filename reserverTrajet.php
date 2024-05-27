<?php
// Connexion à la base de données
require_once("config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexionPassager.php");
    exit();
}

// Vérifier si un trajet a été sélectionné
if (isset($_POST["id_trajet"], $_POST["places_demandees"])) {
    $id_trajet = $_POST["id_trajet"];
    $places_demandees = (int)$_POST["places_demandees"];

    try {
        // Récupérer les informations sur le trajet
        $stmt = $bdd->prepare("SELECT * FROM trajet WHERE id_trajet = :id_trajet");
        $stmt->bindParam(':id_trajet', $id_trajet);
        $stmt->execute();
        $trajet_details = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($trajet_details) {
            // Vérifier si le nombre de places demandées est disponible
            if ($trajet_details['places_disponibles'] >= $places_demandees) {
            // Récupérer l'ID du passager à partir de la session
            $id_passager = $_SESSION['user_id'];
            
            // Mettre à jour le trajet avec l'ID du passager
            $stmt = $bdd->prepare("UPDATE trajet SET passager_id = :passager_id WHERE id_trajet = :id_trajet");
            $stmt->bindParam(':passager_id', $id_passager);
            $stmt->bindParam(':id_trajet', $id_trajet);
            $stmt->execute();

            // Récupérer les informations sur le passager
            $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :id_passager");
            $stmt->bindParam(':id_passager', $id_passager);
            $stmt->execute();
            $passager_details = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($passager_details) {
                // établissement du prix total de la réservation
                $prix_trajet = $trajet_details['prix']* $places_demandees;

                // Récupérer les informations sur le conducteur
                $stmt = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = :conducteur_id");
                $stmt->bindParam(':conducteur_id', $trajet_details['conducteur_id']);
                $stmt->execute();
                $conducteur_details = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($conducteur_details) {
                    // Numéro du conducteur
                    $numero_conducteur = $conducteur_details['numero'];

                    // Vérifier si le passager a suffisamment de fonds
                    if ($passager_details['wallet'] >= $prix_trajet) {
                        // Mettre à jour les wallets
                        $bdd->beginTransaction();

                        // Débiter le wallet du passager
                        $stmt = $bdd->prepare("UPDATE utilisateur SET wallet = wallet - :prix WHERE id_utilisateur = :id_passager");
                        $stmt->bindParam(':prix', $prix_trajet);
                        $stmt->bindParam(':id_passager', $id_passager);
                        $stmt->execute();

                        // Mettre à le wallet du conducteur
                        $stmt = $bdd->prepare("UPDATE utilisateur SET wallet = wallet + :prix WHERE id_utilisateur = :id_conducteur");
                        $stmt->bindParam(':prix', $prix_trajet);
                        $stmt->bindParam(':id_conducteur', $trajet_details['conducteur_id']);
                        $stmt->execute();

                        $bdd->commit();

                        // Mettre à jour le numéro du conducteur dans la table trajet
                        $stmt = $bdd->prepare("UPDATE trajet SET numero_conducteur = :numero_conducteur WHERE id_trajet = :id_trajet");
                        $stmt->bindParam(':numero_conducteur', $numero_conducteur);
                        $stmt->bindParam(':id_trajet', $id_trajet);
                        $stmt->execute();
                            
                        // Enregistrer le passager sur le trajet
                        $stmt = $bdd->prepare("INSERT INTO passagers_trajet (id_trajet, id_utilisateur, statut, places_reservees) VALUES (:id_trajet, :id_passager, 'accepté', :places_reservees)");
                        $stmt->bindParam(':id_trajet', $id_trajet);
                        $stmt->bindParam(':id_passager', $id_passager);
                        $stmt->bindParam(':places_reservees', $places_demandees);
                        $stmt->execute();
                        
                        // Après avoir effectué la réservation avec succès
                        // Définir une variable de session pour indiquer que l'alerte a été affichée
                        $_SESSION['nouveau_passager_alerte_affichee'] = true;

                        // Afficher les informations de contact
                        echo "Votre réservation a bien été prise en compte";
                        echo "<p>Vous pouvez contacter le conducteur au numéro de téléphone suivant : $numero_conducteur</p>";

                        // Mettre à jour le nombre de places disponibles
                        $nouveau_nombre_places = $trajet_details['places_disponibles'] - $places_demandees;
                        $stmt = $bdd->prepare("UPDATE trajet SET places_disponibles = :nouveau_nombre_places WHERE id_trajet = :id_trajet");
                        $stmt->bindParam(':nouveau_nombre_places', $nouveau_nombre_places);
                        $stmt->bindParam(':id_trajet', $id_trajet);
                        $stmt->execute();

                    } else {
                        echo "Le passager n'a pas suffisamment de fonds pour effectuer ce paiement.";
                    }
                } else {
                    echo "Les informations du conducteur n'ont pas été trouvées ou une erreur est survenue lors de la récupération.";
                }
            } else {
                echo "Les informations du passager n'ont pas été trouvées.";
            }
        } else {
            echo "Le nombre de places disponibles est insuffisant pour cette réservation.";
        }
    } else {
        echo "Aucun détail trouvé pour ce trajet.";
    }
} catch (PDOException $e) {
    if ($bdd->inTransaction()) {
        $bdd->rollBack();
    }
    echo 'ERREUR : ' . $e->getMessage();
}
} else {
echo "Aucun trajet ou nombre de places demandées sélectionné.";
}
?>

















