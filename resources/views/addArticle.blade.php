<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <title>Ajouter un Article</title>
    <link rel="stylesheet" href="{{ asset('css/addStayle.css') }}">
</head>

<body>
    @include('layouts.header')
    <div class="AddContainer">
        <h1>Ajouter un Article</h1>
        <form action="{{ route('storeArticle') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="categoryId" value="{{ $categoryId }}">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" placeholder="Entrez le titre de l'article" required>
            <label for="intro">Introduction :</label>
            <textarea id="intro" name="intro" placeholder="Décrivez introduction de l'article" required></textarea>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            <h3>Chapitres :</h3>
            <div id="subtitles-container">
                <div>
                    <label for="subtitles[0]">Sous-titre :</label>
                    <input type="text" name="subtitles[]" placeholder="Entrez le sous-titre" required>
                    <label for="contents[0]">Contenu :</label>
                    <textarea name="contents[]" placeholder="Entrez le contenu du sous-titre" required></textarea>
                </div>
            </div>

            <button type="button" id="add-subtitle" onclick="AddSubTitre()">Ajouter un chapitre</button>
            <button type="submit">Ajouter</button>
        </form>

    </div>
    <script>
         function AddSubTitre() {
            let container = document.getElementById('subtitles-container');
            let index = container.children.length;
            let block = document.createElement('div');
            block.innerHTML = `
            <label for="subtitles[${index}]">Sous-titre :</label>
            <input type="text" name="subtitles[]" required placeholder="Entrez le ${index+1}em sous-titre">

            <label for="contents[${index}]">Contenu :</label>
            <textarea name="contents[]" required placeholder="Entrez le contenu du sous-titre"></textarea>
            
            <button type="button" class="remove-subtitle">Supprimer</button>
        `;

            container.appendChild(block);

            block.querySelector('.remove-subtitle').addEventListener('click', function() {
                container.removeChild(block);
            });
        }
    </script>
    @include('layouts.footer')
</body>

</html>