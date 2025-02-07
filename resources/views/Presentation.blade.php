<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de Tech Horizons</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Presentation.css') }}">
</head>

<body>
    <!-- Header Section -->
    @include('layouts.header')

    <main>
        <!-- About Us Section -->
        <section>
            <h2>Qui sommes-nous ?</h2>
            <p><strong>Tech Horizons</strong> est un magazine en ligne spécialisé dans l'exploration des dernières
                innovations technologiques tout en mettant en lumière leurs impacts éthiques et sociétaux. Le magazine offre
                une plateforme complète permettant aux utilisateurs de découvrir des articles exceptionnels dans divers
                domaines tels que l'intelligence artificielle, l'Internet des objets, la cybersécurité, la réalité virtuelle
                et augmentée, et bien d'autres sujets émergents.</p>

            <p>Nous nous engageons à offrir un contenu qui répond aux intérêts de toutes les catégories d'utilisateurs,
                qu'ils soient professionnels, passionnés de technologie ou simplement curieux d'en apprendre davantage sur
                les transformations technologiques du futur.</p>

            <p>Avec <strong>Tech Horizons</strong>, les utilisateurs enregistrés peuvent profiter d'une expérience unique en
                accédant à des fonctionnalités telles que la consultation d'articles personnalisés, la gestion des
                abonnements et des thèmes favoris, ainsi que des recommandations basées sur leurs intérêts et leur
                historique de navigation. Ils peuvent également interagir avec le contenu en évaluant les articles et en
                participant aux discussions qui y sont liées.</p>

            <h2>Notre vision</h2>
            <p>Être une fenêtre de connaissances mettant en lumière les technologies modernes et proposant des solutions
                innovantes pour permettre à nos communautés de comprendre l'avenir numérique.</p>
        </section>

        <!-- Terms of Use Section -->
        <section id="CGU">
            <h2>Conditions Générales d'Utilisation (CGU)</h2>
            
            <h3>1. Préambule</h3>
            <p>Tech Horizons est une application Web permettant la gestion d'un magazine en ligne consacré aux innovations technologiques. L'utilisation de l'application est soumise aux présentes Conditions Générales d'Utilisation (CGU), que tout utilisateur accepte pleinement et sans réserve.</p>

            <h3>2. Accès et Utilisation</h3>
            <h4>2.1. Types d'Utilisateurs</h4>
                <strong><i>Invités</i></strong> : Accès limité aux informations sur les thèmes, consultation des numéros publics et demande d'inscription. <br>
                <strong><i>Abonnés</i></strong> : Accès à un espace personnalisé, gestion des abonnements aux thèmes, consultation et notation des articles, et proposition d'articles pour publication.<br>
                <strong><i>Responsables de thème</i></strong> : Gestion des abonnements et articles d'un thème, proposition d'articles pour publication et modération des discussions. <br>
                <strong><i>Editeurs</i></strong> : Gestion globale du magazine, administration des numéros et gestion des utilisateurs. <br>
            

            <h4>2.2. Fonctionnalités</h4>
            <ul>
                <li>🛡️Un accès personnalisé aux contenus selon le statut de l'utilisateur.</li>
                <li>🛡️Un système de recommandations d'articles basé sur l'historique de navigation.</li>
                <li>🛡️La possibilité de proposer des articles, de les suivre et d'interagir via un système de chat.</li>
                <li>🛡️Un système de gestion et modération des contenus par les responsables de thème et les éditeurs.</li>
            </ul>

            <h3>3. Responsabilités des Utilisateurs</h3>
            <h4>3.1. Compte et Sécurité</h4>
            <ul>
                <li>🛡️L'utilisateur est responsable de la confidentialité de ses identifiants.</li>
                <li>🛡️Toute utilisation frauduleuse du compte doit être signalée immédiatement.</li>
            </ul>

            <h4>3.2. Contenu et Conduite</h4>
            <ul>
                <li>🛡️Les utilisateurs s'engagent à respecter les lois en vigueur et à publier des contenus conformes aux règles de l'application.</li>
                <li>🛡️Tout propos offensant, discriminatoire ou illégal est interdit et peut entraîner la suppression du compte concerné.</li>
            </ul>

            <h3>4. Modération et Contrôle</h3>
            <ul>
                <li>🛡️Les responsables de thème et éditeurs sont habilités à modérer et supprimer les contenus non conformes.</li>
                <li>🛡️L'éditeur peut bloquer ou supprimer des comptes en cas de non-respect des CGU.</li>
            </ul>

            <h3>5. Gestion des Données Personnelles</h3>
            <ul>
                <li>🛡️Les informations personnelles collectées sont utilisées uniquement dans le cadre de l'application.</li>
                <li>🛡️Aucune donnée ne sera partagée sans consentement, sauf obligation légale.</li>
            </ul>

            <h3>6. Modification des CGU</h3>
            <ul>
                <li>🛡️Tech Horizons se réserve le droit de modifier les CGU à tout moment.</li>
                <li>🛡️Les utilisateurs seront informés des modifications et devront les accepter pour continuer à utiliser l'application.</li>
            </ul>

            <h3>7. Contact</h3>
            <p>Pour toute question ou réclamation, veuillez contacter notre support à l'adresse : <a href="mailto:support@techhorizons.com">support@techhorizons.com</a>.</p>
            <p>Marouan BENALI</p>
        </section>
    </main>
    <!-- Footer Section -->
    @include('layouts.footer')
</body>

</html>
