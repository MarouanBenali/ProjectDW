<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="HeaderFooter.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #0766AD, #8EA7E9, #E5E0FF);
            margin: 0;
            padding: 0;
            /* height: 100%; */
        }

        .container {
            margin: 50px auto;
            width: 80%;
        }

        .container {
            margin: 50px auto;
            width: 80%;
            max-width: 1200px;
            padding: 0 20px;
            display: flex;
            /* Active le modèle flexbox */
            justify-content: center;
            /* Centre horizontalement les boutons */
            gap: 20px;
            /* Espacement entre les boutons */
        }

        .button {
            padding: 15px 30px;
            margin: 10px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;

        }

        .button:hover {
            background-color: white;
            box-shadow: 1px 2px 3px gold;
            color: black;
        }

        .slider-container {
            overflow: hidden;
            width: 80%;
            margin: auto;
            position: relative;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .article {
            position: relative;
            background: white;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
            flex: 0 0 auto;
        }

        .article img {
            width: 100%;
            border-radius: 10px;
        }

        .article h2 {
            font-size: 20px;
            color: #007BFF;
        }

        .article img {
            width: 100%;
            height: 60%;
        }

        .button {
            display: block;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .nav-buttons {
            display: flex;
            justify-content: space-between;
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        .nav-buttons button {
            background-color: rgba(0, 123, 255, 0.7);
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
        }

        .nav-buttons button:hover {
            background-color: rgba(0, 86, 179, 0.9);
        }

        .article .button {
            position: sticky;
            bottom: 0;
        }

        .numero {
            background-color: #f88e04;
            border-radius: 30px;
            color: white;
            box-shadow: 5px 5px 14px 3px red;
            width: 40%;
            padding: 6px;
            margin: 25px auto;
            text-align: center;
        }

        h1 {
            font-size: 40px;
            width: 60%;
            margin: 0 auto;
            text-align: center;
            border-radius: 20px;
            padding: 0;
            color: #f88e04;
        }

        h1::before {
            content: "🤖";
            /* Icône d'IA (emoji robot) avant le titre */
            font-size: 1.5em;
            margin-right: 10px;
        }

        h1::after {
            content: "🚀";
            /* Icône d'IA (emoji fusée) après le titre */
            font-size: 1.5em;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <header>
        <script src="header.js"></script>
    </header>
    <h1> Intelligence Artificielle</h1>

    <div class="container">
        <button class="button">subscribe</button>
        <button class="button">suggerer un article</button>
    </div>
    <h2 class="numero">Numero</h2>
    <div class="slider-container">
        <div class="slider" id="slider1">
            <div class="article">
                <img src="1.jpg" alt="Intelligence Artificielle">
                <h2>L'évolution de l'Intelligence Artificielle </h2>
                <p>Un aperçu historique de l’IA, de ses premières recherches aux modèles actuels comme</p>
                <a href="article/article1.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="2.jpeg" alt="Internet des Objets">
                <h2>Les impacts de l'IA sur le marché du travail</h2>
                <p>Une analyse des emplois remplacés et créés par l'IA et des nouvelles compétences recherchées..</p>
                <a href="article/article6.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="3.jpeg" alt="Cybersécurité">
                <h2>L'IA dans la santé </h2>
                <p> Comment l’IA est utilisée dans le diagnostic médical, la robotique chirurgicale et la médecine personnalisée.</p>
                <a href="article/article2.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="4.png" alt="Intelligence Artificielle">
                <h2>Les biais algorithmiques </h2>
                <p>DUne discussion sur les préjugés dans les modèles d’IA et leurs conséquences sur la société.</p>
                <a href="article/article3.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="5.jpeg" alt="Intelligence Artificielle">
                <h2>Intelligence artificielle et éthique </h2>
                <p>Les questions éthiques posées par l'IA, comme la vie privée, la surveillance et l’autonomie des machines..</p>
                <a href="article/article4.html" class="button">Lire plus</a>
            </div>

        </div>
        <div class="nav-buttons">
            <button onclick="moveSlider('slider1', -1)">&#10094;</button>
            <button onclick="moveSlider('slider1', 1)">&#10095;</button>
        </div>
    </div>
    <h2 class="numero">Numero</h2>
    <div class="slider-container">
        <div class="slider" id="slider2">
            <div class="article">
                <img src="6.jpeg" alt="Réalité Virtuelle">
                <h2>L’IA dans l’industrie du divertissement</h2>
                <p>CComment l’IA est utilisée pour composer de la musique, générer des scénarios ou animer des personnages virtuels.</p>
                <a href="article/article7.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="7.jpeg" alt="Blockchain">
                <h2>l’IA manipule l’information</h2>
                <p>Les dangers des technologies deepfake et leur impact sur la désinformation en ligne.</p>
                <a href="article/article8.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="8.jpeg" alt="Robotique">
                <h2>IA et cybersécurité </h2>
                <p>L L'utilisation de l'IA dans la défense contre les cyberattaques, mais aussi comment elle peut être exploitée par les hackers.</p>
                <a href="article/article9.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="9.jpeg" alt="Réalité Virtuelle">
                <h2>Vers une Intelligence Artificielle générale</h2>
                <p>Une réflexion sur l’avenir de l’IA et la possibilité d’atteindre une intelligence comparable à celle des humains.</p>
                <a href="article/article10.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="10.jpg" alt="Intelligence Artificielle">
                <h2>Les assistants virtuels intelligents</h2>
                <p> Une exploration des technologies derrière Siri, Alexa et Google Assistant et leur futur.</p>
                <a href="article/article11.html" class="button">Lire plus</a>
            </div>

        </div>
        <div class="nav-buttons">
            <button onclick="moveSlider('slider2', -1)">&#10094;</button>
            <button onclick="moveSlider('slider2', 1)">&#10095;</button>
        </div>
    </div>

    </div>
    <footer>
        <script src="footer.js"></script>
    </footer>
    <script>
        function moveSlider(sliderId, direction) {
            const slider = document.getElementById(sliderId);
            const articles = slider.children;
            const total = articles.length;
            const articleWidth = articles[0].offsetWidth + 20;
            let index = slider.dataset.index ? parseInt(slider.dataset.index) : 0;
            index += direction;
            if (index < 0) index = total - 1;
            if (index >= total) index = 0;
            slider.style.transform = `translateX(${-index * articleWidth}px)`;
            slider.dataset.index = index;
        }
    </script>
</body>

</html>