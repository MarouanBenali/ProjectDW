<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/Explorer.css') }}">
</head>

<body>
    @include('layouts.header')

    <div class="Cntainer">
        <h1>{{ $category->name }}</h1>
        @if (Auth::user())
        <div class="article-rating">
            <p class="rating-text">
                {{ $userRating ? "Vous avez évalué cet article à $userRating étoiles. Vous pouvez le modifier :" : "Donnez votre évaluation :" }}
            </p>

            @php
            $Route = Auth::user() ? route('CategoryRate', $category->id) : route('login');
            @endphp

            <form action="{{ $Route }}" method="POST" id="ratingForm">
                @csrf
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                        onchange="submitRating()" {{ $userRating == $i ? 'checked' : '' }}>
                    <label for="star{{ $i }}">&#9733;</label>
                    @endfor
                </div>
            </form>
        </div><br>
        <hr><br>
        @endif

        @foreach($category->articles->groupBy('numero') as $numero => $articles)
        <div class="category-section">
            <h2>Numero: {{ $numero }}</h2>
            <div class="ArticleList">
                <div id="scroll{{ $numero }}" class="scroll">
                    @foreach($articles as $article)
                    @if($article->access === 'public')
                    <div class="CadreArticle">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        <div class="content">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->intro, 130) }}</p>
                            <a href="{{ route('viewArticle', $article->id) }}">Lire plus</a>
                        </div>
                    </div>
                    @else
                    @if(auth()->check())
                    <div class="CadreArticle">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        <div class="content">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->intro, 130) }}</p>
                            <a href="{{ route('viewArticle', $article->id) }}">Lire plus</a>
                        </div>
                    </div>
                    @else
                    <div class="CadreArticle locked-article" onclick="redirectToLogin()" title="Vous devez vous inscrire">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                        <div class="lock-icon"></div>
                        <div class="content">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->intro, 130) }}</p>
                            <a>Lire plus</a>
                        </div>
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
                <button class="scrollBtn left" onclick="scrollToLeft('{{ $numero }}')">◀</button>
                <button class="scrollBtn right" onclick="scrollToRight('{{ $numero }}')">▶</button>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function scrollToLeft(numero) {
            const container = document.getElementById(`scroll${numero}`);
            container.scrollBy({
                left: -385,
                behavior: 'smooth'
            });
        }

        function scrollToRight(numero) {
            const container = document.getElementById(`scroll${numero}`);
            container.scrollBy({
                left: 385,
                behavior: 'smooth'
            });
        }

        function redirectToLogin() {
            window.location.href = "{{ route('login') }}";
        }

        function submitRating() {
            document.getElementById("ratingForm").submit();
        }
    </script>

    @include('layouts.footer')
</body>

</html>