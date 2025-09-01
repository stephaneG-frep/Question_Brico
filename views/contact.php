<?php
require_once "../db/Database.php";
require_once "../db/config.php";
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sujet = trim($_POST['sujet'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation des champs
    $errors = [];
    if (empty($nom)) $errors[] = "Le nom est obligatoire.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email est invalide.";
    }
    if (empty($sujet)) $errors[] = "Le sujet est obligatoire.";
    if (empty($message)) $errors[] = "Le message est obligatoire.";

    if (empty($errors)) {
        // Envoi de l'email (à configurer avec vos informations)
        $to = "contact@questionbrico.fr"; // Remplacez par votre email
        $subject = "[Question_Brico] Nouveau message : " . htmlspecialchars($sujet);
        $headers = "From: " . htmlspecialchars($email) . "\r\n";
        $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $email_content = "
            Nom : " . htmlspecialchars($nom) . "
            Email : " . htmlspecialchars($email) . "
            Sujet : " . htmlspecialchars($sujet) . "

            Message :
            " . htmlspecialchars($message);
        ;

        if (mail($to, $subject, $email_content, $headers)) {
            $success = "Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.";
        } else {
            $errors[] = "Une erreur est survenue lors de l'envoi du message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Question_Brico</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 30px;
        }
        .contact-form {
            flex: 1;
            min-width: 300px;
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .contact-info {
            flex: 1;
            min-width: 300px;
            background-color: #e8f4fc;
            padding: 25px;
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        .button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            width: 100%;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 15px;
        }
        .success {
            color: #27ae60;
            margin-bottom: 15px;
            text-align: center;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .info-item i {
            color: #3498db;
            margin-right: 10px;
            font-size: 1.2em;
        }
        .map-container {
            width: 100%;
            height: 300px;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>CONTACTEZ-NOUS</h1>

    <div class="contact-container">
        <!-- Formulaire de contact -->
        <div class="contact-form">
            <?php if (isset($success)): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
                </div>

                <div class="form-group">
                    <label for="sujet">Sujet *</label>
                    <select id="sujet" name="sujet" required>
                        <option value="">-- Sélectionnez un sujet --</option>
                        <option value="Question technique" <?= (isset($sujet) && $sujet === 'Question technique') ? 'selected' : '' ?>>Question technique</option>
                        <option value="Problème avec mon compte" <?= (isset($sujet) && $sujet === 'Problème avec mon compte') ? 'selected' : '' ?>>Problème avec mon compte</option>
                        <option value="Suggestion" <?= (isset($sujet) && $sujet === 'Suggestion') ? 'selected' : '' ?>>Suggestion</option>
                        <option value="Partenariat" <?= (isset($sujet) && $sujet === 'Partenariat') ? 'selected' : '' ?>>Partenariat</option>
                        <option value="Autre" <?= (isset($sujet) && $sujet === 'Autre') ? 'selected' : '' ?>>Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
                </div>

                <button type="submit" class="button">Envoyer le message</button>
            </form>
        </div>

        <!-- Informations de contact -->
        <div class="contact-info">
            <h2 style="color: #2c3e50; margin-top: 0;">Nos coordonnées</h2>

            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <strong>Adresse :</strong><br>
                    [Votre adresse]<br>
                    [Code postal] [Ville], [Pays]
                </div>
            </div>

            <div class="info-item">
                <i class="fas fa-phone"></i>
                <div>
                    <strong>Téléphone :</strong><br>
                    [Votre numéro de téléphone]
                </div>
            </div>

            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <strong>Email :</strong><br>
                    <a href="mailto:contact@questionbrico.fr">contact@questionbrico.fr</a>
                </div>
            </div>

            <div class="info-item">
                <i class="fas fa-clock"></i>
                <div>
                    <strong>Horaires :</strong><br>
                    Du lundi au vendredi : 9h - 18h
                </div>
            </div>

            <div class="info-item">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <div>
                    <strong>Réseaux sociaux :</strong><br>
                    <a href="#" target="_blank">Facebook</a>, <a href="#" target="_blank">Twitter</a>, <a href="#" target="_blank">Instagram</a>
                </div>
            </div>

            <!-- Carte (optionnelle) -->
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991625557438!2d2.2944813156747056!3d48.85837007928755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1620000000000!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <div style="text-align: center;">
        <a href="../public/index.php" style="color: #3498db;">← Retour à l'accueil</a>
    </div>
</body>
</html>
