<?php
session_start();
include('cnxbase.php'); // Inclure la configuration de la base de données
// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id_stg = $_SESSION['id_stg'];
    $message = htmlspecialchars(trim($_POST['message']));

    // Vérifier que les données ne sont pas vides
    if (!empty($id_stg) && !empty($message)) {
        // Préparer la requête SQL pour insérer le message dans la base de données
        $stmt = $conn->prepare("INSERT INTO message (id_stg, cont_message, date_message) VALUES (?, ? ,?)");
        $date_msg = date('Y-m-d');//la date d'auj
        $stmt->bind_param("iss", $id_stg, $message, $date_msg); 

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Message envoyé avec succès.";
        } else {
            echo "Erreur : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Veuillez entrer un message.";
    }
}
?>
