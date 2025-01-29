<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> Tech Horizons</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/HeaderFooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <script src="{{ asset('js/header.js') }}"></script>
    </header>
    <main class="description">
        <div class="left">
            <h1 class="fade-in"><span>PLONGEZ DANS LES INNOVATIONS DU FUTUR !</span></h1>
            <p class="fade-in delay-1">Chaque jour, la technologie redéfinit notre monde. Découvrez des articles
                captivants sur l'intelligence
                artificielle, la cybersécurité et bien plus encore. Le futur commence ici !</p>
                <a href="/login">Se connecter</a><br>
            <a href="/categories">Continuer en tant qu'invité</a>
        </div>
        <div class="right">
        <img src="{{ asset('img/imgrobot.png') }}" class="image_robot" id="robotImage">
        </div>
    </main>
    <footer>
        <script src="{{ asset('js/footer.js') }}"></script>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const robotImage = document.getElementById('robotImage');
                robotImage.classList.add('slide-in');
            }, 1500);
        });
    </script>
</body>

</html>