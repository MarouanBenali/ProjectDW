<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <link rel="stylesheet" href="HeaderFooter.css">
</head>

<body>
    <header>
        <script src="header.js"></script>
    </header>
    <h1> Internet des Objets </h1>

    <div class="container">
        <button class="button">subscribe</button>
        <button class="button">suggerer un article</button>
    </div>
    <h2 class="numero">Numero</h2>
    <div class="slider-container">
        <div class="slider" id="slider1">
            <div class="article">
                <img src="22.jpeg" alt="Intelligence Artificielle">
                <h2> Révolution dans l'automatisation domestique</h2>
                <p>Découvrez comment l'IoT transforme nos maisons en espaces intelligents avec des appareils connectés qui rendent nos vies plus faciles et plus efficaces.</p>
                <a href="article/article1.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="11.jpeg" alt="Internet des Objets">
                <h2>LoT et Industrie 4.0 : Une nouvelle ère pour la production</h2>
                <p>Explorez comment l'Internet des Objets transforme les processus industriels, avec des usines intelligentes et une gestion optimisée des ressources.</p>
                <a href="article/article6.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="33.jpeg" alt="Cybersécurité">
                <h2>Protéger les appareils connectés contre les cyberattaques</h2>
                <p> Examinez les défis de sécurité que pose l'Internet des Objets et les solutions disponibles pour protéger les appareils connectés contre les vulnérabilités.
                </p>
                <a href="article/article2.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="44.jpeg" alt="Intelligence Artificielle">
                <h2>Les applications de l'IoT dans la santé </h2>
                <p> L'IoT révolutionne le secteur médical, avec des dispositifs connectés qui permettent un suivi en temps réel des patients et une gestion plus efficace des traitements</p>
                <a href="article/article3.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="55.jpeg" alt="Intelligence Artificielle">
                <h2>L'IoT et la ville intelligente </h2>
                <p>Comment l'Internet des Objets aide à construire des villes plus intelligentes, avec des infrastructures qui améliorent la gestion de l'énergie, de la circulation et des services publics.</p>
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
                <img src="66.jpeg" alt="Réalité Virtuelle">
                <h2>L'impact de l'IoT sur l'agriculture </h2>
                <p> L'IoT permet aux agriculteurs de suivre les conditions climatiques, les cultures et les animaux en temps réel, améliorant ainsi la production agricole.</p>
                <a href="article/article7.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="77.jpeg" alt="Blockchain">
                <h2>Le futur de la mobilité connectéen</h2>
                <p>Examinez comment l'IoT révolutionne le secteur du transport, des véhicules autonomes aux solutions de gestion de la circulation basées sur des données en temps réel</p>
                <a href="article/article8.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="88.jpeg" alt="Robotique">
                <h2>L'IoT et la gestion des ressources naturelles </h2>
                <p>Découvrez comment les capteurs IoT peuvent aider à surveiller et à gérer l'utilisation des ressources naturelles, contribuant à la durabilité et à la conservation.</p>
                <a href="article/article9.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="99.jpeg" alt="Réalité Virtuelle">
                <h2>L'IoT dans la chaîne d'approvisionnement</h2>
                <p>Comment l'IoT transforme la logistique et la chaîne d'approvisionnement, en permettant un suivi en temps réel des produits et une gestion améliorée des stocks.</p>
                <a href="article/article10.html" class="button">Lire plus</a>
            </div>
            <div class="article">
                <img src="100.jpeg" alt="Intelligence Artificielle">
                <h2>Les défis éthiques de l'Internet des Objets</h2>
                <p> Une réflexion sur les défis éthiques posés par l'IoT, notamment en matière de confidentialité des données et de surveillance, et les solutions possibles</p>
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