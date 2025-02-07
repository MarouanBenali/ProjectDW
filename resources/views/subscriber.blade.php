<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnements et Catégories</title>
    <link rel="stylesheet" href="{{ asset('css/Categorie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Explorer.css') }}">
    <style>
        .titre {
            background-color: #f88e04;
            border-radius: 30px;
            color: white;
            box-shadow: 5px 5px 14px 3px red;
            width: 40%;
            padding: 6px;
            margin: 10px auto;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('layouts.header')
    @include('layouts.profile')

    <div class="container">
        <h1 class="titre">Abonnements et Catégories</h1>
        <div class="categories">
            @if($subscriptions->isEmpty())
            <p class="vide">Aucun résultat correspondant...</p>
            @else
            @foreach($subscriptions as $category)
            <div class="category cat" data-bg="{{ $category->bgImg }}">
                <img src="{{ $category->category_image }}" alt="img">
                <h2>{{ $category->category_name }}</h2>
                <p>{{ $category->category_description }}</p>
                <div class="rating">
                    @for($i = 0; $i < 5; $i++)
                        <span class="star {{ $i < round($category->AvgRating ?? 0) ? 'active' : '' }}">★</span>
                        @endfor
                </div>
                <div class="buttons">
                    <a href="{{ route('DeSabonner', ['categoryId' => $category->category_id]) }}">Se désabonner</a>
                    <a href="{{ route('category.show', ['categoryId' => $category->category_id]) }}">Explorer</a>
                    <a href="{{ route('AddArticle', ['categoryId' => $category->category_id]) }}">Ajouter Article</a>
                </div>

            </div>
            @endforeach
            @endif
        </div>

        <div class="history"></div>
    </div>

    <div class="ArticleList">
        <h1 class="titre">Historique de navigation</h1>
        <div class="scroll" id="scroll1">
            @foreach($history as $article)
            <div class="CadreArticle">
                <img src="{{ asset('storage/' . $article->article->image) }}" alt="{{ $article->article->title }}">
                <div class="content">
                    <h3>{{ $article->article->title }}</h3>
                    <p>{{ Str::limit($article->article->intro, 130) }}</p>
                    <a href="{{ route('viewArticle', $article->article->id) }}">Lire plus</a>
                </div>
            </div>
            @endforeach

        </div>
        <button class="scrollBtn left" onclick="scrollToLeft(1)">◀</button>
        <button class="scrollBtn right" onclick="scrollToRight(1)">▶</button>
    </div>

    <div class="ArticleList">
        <h1 class="titre">Derniers ajouts</h1>
        <div class="scroll" id="scroll2">
            @foreach($articleWeek as $article)
            <div class="CadreArticle">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                <div class="content">
                    <h3>{{ $article->title }}</h3>
                    <p>{{ Str::limit($article->intro, 130) }}</p>
                    <a href="{{ route('viewArticle', $article->id) }}">Lire plus</a>
                </div>
            </div>
            @endforeach
        </div>
        <button class="scrollBtn left" onclick="scrollToLeft(2)">◀</button>
        <button class="scrollBtn right" onclick="scrollToRight(2)">▶</button>
    </div>

    <script>
        let elements = document.querySelectorAll('.cat');
        elements.forEach(item => {
            item.onmouseenter = () => item.style.background = `url('${item.dataset.bg}') center / cover`;
            item.onmouseleave = () => item.style.background = "";
        });

        function scrollToLeft(index) {
            const container = document.querySelector(`#scroll${index}`);
            container.scrollBy({
                left: -416,
                behavior: 'smooth'
            });
        }

        function scrollToRight(index) {
            const container = document.querySelector(`#scroll${index}`);
            container.scrollBy({
                left: 416,
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>