<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/Article.css') }}">
    <title>{{ $article->title }}</title>
</head>

<body>
    @include('layouts.header')

    <div class="article-container">
        <h1 class="article-title">{{ $article->title }}</h1>
        <p class="article-author"><strong>Auteur:</strong> {{ $article->user->name }}</p>
        <hr>
        <h2 class="article-subtitle">Introduction</h2>
        <p class="article-content"> {{$article->intro}} </p>
        @foreach ($article->contents as $content)
        <h2 class="article-subtitle">{{ $content->subtitle }}</h2>
        <p class="article-content">{{ $content->content }}</p>
        @endforeach

        <hr><br>
        @if ($article->status === 'Publie')
        @if (Auth::user())
        <div class="article-rating">
            <p class="rating-text">
                @if($userRating)
                Vous avez évalué cet article à {{ $userRating }} étoiles. Vous pouvez le modifier :
                @else
                Donnez votre évaluation :
                @endif
            </p>

            <form action="{{ route('articlesRate', $article->id) }}" method="POST" id="ratingForm">
                @csrf
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                        onchange="submitRating()" {{ $userRating == $i ? 'checked' : '' }}>
                    <label for="star{{ $i }}">&#9733;</label>
                    @endfor
                </div>
            </form>
            @endif

            <div class="evaluation">
                <p><strong>Évaluation moyenne : </strong> {{ $MoyRating ? number_format($MoyRating, 2) : 'Pas de note' }}</p>
                <p><strong>Nombre de notes : </strong> {{ $ratingsCount }}</p>
            </div>
        </div><br>
        <hr>

        <!-- Affichage des conversations (Commentaires) -->
        <div class="conversations">
            @foreach ($article->conversations as $conversation)
            <div class="conversation-item">
                <img src="{{ asset('storage/' . $conversation->user->profile_picture) }}" alt="Profile Picture">
                <strong>{{ $conversation->user->name }}:</strong>
                <p>{{ $conversation->content }}</p>
                @if(Auth::user() && Auth::user()->role === 'manager')
                @if($categoryManager)
                <div class="delete-container">
                    <form action="{{ route('deleteConversation', $conversation->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="delete-btn">Supprimer</button>
                    </form>
                </div>
                @endif
                @endif
            </div>
            @endforeach
            <h3>Commentaires</h3>
            @php
            $Route2 = Auth::user() ? route('addConversation', $article->id) : route('login');
            @endphp
            <form action="{{ $Route2 }}" method="POST">
                @csrf
                <textarea name="content" placeholder="Ajoutez un commentaire" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
        @endif
    </div>

    @include('layouts.footer')

    <script>
        function submitRating() {
            document.getElementById("ratingForm").submit();
        }
    </script>
</body>

</html>