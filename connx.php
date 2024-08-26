<?php
session_start();
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atfmediaacademy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
if (isset($_POST['signup'])) {
    // Récupérer les données du formulaire
    $Nom = $conn->real_escape_string($_POST['nom']);
    $Prenom = $conn->real_escape_string($_POST['prenom']);
    $adresseemail = $conn->real_escape_string($_POST['userEmail']);
    $motdepasse = password_hash($conn->real_escape_string($_POST['userPassword']), PASSWORD_BCRYPT); // Hachage du mot de passe pour la sécurité
    $Telephone = $conn->real_escape_string($_POST['userphone']);

    // Insérer les données dans la base de données
    $sql = "INSERT INTO stagiaire (nom_stg, prenom_stg, email_stg, Mot_de_passe_stg, num_tel_stg) 
            VALUES ('$Nom', '$Prenom', '$adresseemail', '$motdepasse', '$Telephone')";

    if ($conn->query($sql) === TRUE) {
        // Inscription réussie, redirection vers une page de confirmation ou d'accueil
header("Location:a2.html");
exit(); 

 // Assurez-vous que le chemin est correct
        exit(); // Terminer le script après la redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

<?php

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement de la soumission du formulaire de connexion
if (isset($_POST['login'])) {
    $Email = $_POST['Email'];
    $MotDePasse = $_POST['MotDePasse'];

    // Requête préparée pour récupérer l'utilisateur en fonction de l'email
    $stmt = $conn->prepare("SELECT id_stg, Mot_de_passe_stg FROM stagiaire WHERE email_stg = ?");
    if (!$stmt) {
        // Print the error message
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Récupération des données de l'utilisateur
        $user = $result->fetch_assoc();

        // Vérification du mot de passe
        if (password_verify($MotDePasse, $user['Mot_de_passe_stg'])) {
            // Connexion réussie
            $_SESSION['id_stg'] = $user['id_stg'];
            echo'login';
            header("location: a2.html"); // Redirection vers la page d'accueil
            exit();
        } else {
            // Mot de passe incorrect
            $_SESSION['error'] = "Mot de passe incorrect.";
            echo'mdp';
            header("location: connexion.html?erreur=mdp"); 
            exit();
        }
    } else {
        // Email non trouvé
        $_SESSION['error'] = "Email non trouvé.";
        echo'email';
        header("Location: connexion.html?erreur=email");
        exit();
    }

    $stmt->close();
}
echo'fin';
// Fermer la connexion à la base de données
$conn->close();



require 'vendor/autoload.php'; // Load Composer's autoloader for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$name = $_POST['name'];

function sendActivationEmail($email, $name)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0; // Disable verbose debug output
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication


        $mail->Username = 'email@gmail.com'; //SMTP username
        $mail->Password = ''; //SMTP password


        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to

        $mail->setFrom('email@gmail.com', 'Etudes');
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Activation de compte - Etudes';
        $mail->Body = "Bonjour $name,<br><br>Cliquez sur le lien suivant pour activer votre compte :<br><br>Merci.";

        $mail->send();
        echo 'Email d\'activation envoyé avec succès<br>';
    } catch (Exception $e) {
        echo "L'email d'activation n'a pas pu être envoyé. Erreur du mailer : {$mail->ErrorInfo}";
    }
}


sendActivationEmail($email, $name);


?>
