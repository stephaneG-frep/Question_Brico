<?php
require_once "../db/config.php"; // Si vous utilisez des données dynamiques
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Question_Brico</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2em;
        }
        h2 {
            margin-top: 40px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            font-size: 1.6em;
        }
        .hero {
            text-align: center;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .team-member {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .team-member img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
        }
        .team-info h3 {
            margin: 0 0 5px 0;
            color: #3498db;
        }
        .team-info p {
            margin: 0;
            color: #666;
        }
        .values {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }
        .value-card {
            flex: 1;
            min-width: 200px;
            background-color: #e8f4fc;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .value-card i {
            font-size: 2em;
            color: #3498db;
            margin-bottom: 10px;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            text-align: center;
        }
        .stat {
            padding: 15px;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            color: #3498db;
        }
        .cta-button {
            display: block;
            width: 200px;
            margin: 30px auto;
            background-color: #3498db;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
        }
        .cta-button:hover {
            background-color: #2980b9;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Pour les icônes -->
</head>
<body>
<div style="text-align: center; margin-top: 30px;">
        <a href="../public/index.php" style="color: #3498db;">← Retour à l'accueil</a>
</div>

    <h1>À PROPOS DE QUESTION_BRICO</h1>

    <div class="hero">
        <p>
            <strong>Question_Brico</strong> est une plateforme communautaire dédiée au bricolage,
            où les passionnés et les débutants peuvent poser leurs questions,
            partager leurs astuces et trouver des solutions ensemble.
        </p>
        <p>
            Notre mission : <em>Rendre le bricolage accessible à tous, grâce à l'entraide et au partage d'expérience.</em>
        </p>
    </div>

    <h2>Notre histoire</h2>
    <p>
        Créé en [année de création], <strong>Question_Brico</strong> est né d'un constat simple :
        le bricolage peut parfois sembler complexe, et il est difficile de trouver des réponses fiables et adaptées à ses besoins.
    </p>
    <p>
        Que vous soyez un bricoleur du dimanche ou un expert en rénovation, nous croyons que chacun a quelque chose à apprendre
        et quelque chose à enseigner. Notre plateforme permet de connecter les membres d'une communauté bienveillante,
        où l'on échange des conseils pratiques, des tutoriels et des idées pour tous types de projets.
    </p>
    <p>
        Aujourd'hui, <strong>Question_Brico</strong> compte plus de [X] membres actifs et [Y] questions résolues,
        couvrant des domaines aussi variés que la menuiserie, l'électricité, la plomberie, la décoration, et bien plus !
    </p>

    

    <h2>Notre équipe</h2>
    <p>
        Derrière <strong>Question_Brico</strong>, une petite équipe passionnée travaille pour vous offrir
        une expérience simple, utile et conviviale.
    </p>

    <!-- Exemple avec un membre (à adapter) -->
    <div class="team-member">
        <img src="https://via.placeholder.com/100" alt="Photo de Stéphane">
        <div class="team-info">
            <h3>Stéphane Gaillet</h3>
            <p><strong>Fondateur & Développeur</strong></p>
            <p>Passionné de bricolage et de technologie, Stéphane a créé Question_Brico pour faciliter l'entraide entre bricoleurs.</p>
        </div>
    </div>

    <!-- Ajoutez d'autres membres ici si nécessaire -->

    <h2>Nos valeurs</h2>
    <p>
        Chez <strong>Question_Brico</strong>, nous croyons en :
    </p>
    <div class="values">
        <div class="value-card">
            <i class="fas fa-hands-helping"></i>
            <h3>Entraide</h3>
            <p>Partager ses connaissances pour aider les autres, sans jugement.</p>
        </div>
        <div class="value-card">
            <i class="fas fa-lightbulb"></i>
            <h3>Créativité</h3>
            <p>Trouver des solutions innovantes et accessibles pour tous.</p>
        </div>
        <div class="value-card">
            <i class="fas fa-smile"></i>
            <h3>Bienveillance</h3>
            <p>Une communauté accueillante, où chacun se sent à l'aise pour poser ses questions.</p>
        </div>
        <div class="value-card">
            <i class="fas fa-hammer"></i>
            <h3>Pratique</h3>
            <p>Des conseils concrets, testés et éprouvés par nos membres.</p>
        </div>
    </div>

    <h2>Pourquoi nous rejoindre ?</h2>
    <p>
        Que vous ayez une question précise ou que vous souhaitiez partager votre expertise,
        <strong>Question_Brico</strong> est l'endroit idéal pour :
    </p>
    <ul>
        <li>Trouver des réponses à vos problèmes de bricolage.</li>
        <li>Échanger avec une communauté active et bienveillante.</li>
        <li>Découvrir des astuces et des tutoriels pour vos projets.</li>
        <li>Participer à des défis et des discussions autour de la maison et du jardin.</li>
    </ul>

    <h2>Rejoignez-nous !</h2>
    <p>
        Vous aussi, devenez membre de <strong>Question_Brico</strong> et contribuez à la plus grande communauté
        d'entraide en bricolage !
    </p>
    <a href="inscription.php" class="cta-button">S'inscrire gratuitement</a>

    <h2>Contactez-nous</h2>
    <p>
        Une question ? Une suggestion ? N'hésitez pas à nous contacter :
    </p>
    <p>
        📧 Email : <a href="mailto:contact@questionbrico.fr">contact@questionbrico.fr</a><br>
        📱 Réseaux sociaux : [Ajoutez vos liens]
    </p>

    <div style="text-align: center; margin-top: 30px;">
        <a href="../public/index.php" style="color: #3498db;">← Retour à l'accueil</a>
    </div>
    
</body>
</html>
