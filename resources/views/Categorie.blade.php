<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tech Horizons</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/Categorie.css') }}">
</head>

<body>
    @include('layouts.header')
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
    
    @include('layouts.footer')
</body>

</html>


