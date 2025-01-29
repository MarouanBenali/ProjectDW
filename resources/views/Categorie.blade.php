<!DOCTYPE html>
<html lang="fr"> 

<head>
    <meta charset="UTF-8">
    <title>Tech Horizons</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Categorie.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/HeaderFooter.css') }}"> 
</head>

<body>
    <header>
        <script src="{{ asset('js/header.js') }}"></script> 
    </header>

    <div class="intro">
        <p>
            <b>ⓉⒽ</b> n'est pas qu'un simple magazine,
            c'est votre porte d'entrée
            pour une compréhension
            <br>approfondie
            des transformations technologiques qui façonnent l'avenir.
        </p>
        <p class="paragraphe">
            ✨ Découvrez, apprenez et devenez acteurs de ce monde en pleine évolution.
        </p>
    </div>

    <div class="search-container">
        <input type="search" placeholder="Rechercher une catégorie...">
    </div>

    <div class="categories">
        <script src="{{ asset('js/Categorie.js') }}"></script> 
    </div>

    <footer>
        <script src="{{ asset('js/footer.js') }}"></script>
    </footer>
</body>
</html>
