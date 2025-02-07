<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/addStayle.css') }}">
</head>

<body>
    @include('layouts.header')
    <div class="AddContainer">
        <h1>Ajouter une nouvelle catégorie</h1>
        <form action="{{ route('categories.AddCat') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="name">Nom de la catégorie:</label>
            <input type="text" id="name" name="name" required minlength="5" maxlength="25" placeholder="Nom de la catégorie">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required minlength="20" maxlength="100" placeholder="Décrivez la catégorie..."></textarea>
            <label for="image">Icône de la catégorie:</label>
            <input type="file" id="image" name="image" accept="image/png, image/jpeg" required>
            <label for="bgImg">Image de la catégorie:</label>
            <input type="file" id="bgImg" name="bgImg" accept="image/png, image/jpeg" required>
            <button type="submit" class="submit-btn">Ajouter la catégorie</button>
        </form>
    </div>
    @include('layouts.footer')
</body>

</html>