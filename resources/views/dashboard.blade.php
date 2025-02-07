<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Gestionnaire de catégories</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/editor.css') }}">
</head>

<body>
@include('layouts.header')
@include('layouts.profile')
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Tableau de bord</h2>
            <ul>
                <li>
                    <strong onclick="Menu(0)">Articles<b>▼</b></strong>
                    <ul class="submenu">
                        @foreach ($categories as $category)
                        <li><a href="#ArtCategory-{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <strong onclick="Menu(1)">Abonnements<b>▼</b></strong>
                    <ul class="submenu">
                        @foreach ($categories as $category)
                        <li><a href="#SubCategory-{{ $category->id }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="#conversations">Conversations</a></li>
                <li><a href="#statistics">Statistiques</a></li>
            </ul>
            <span>▶</span>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <!-- Section des articles -->
            <section id="articles">
                <h2 class="title">Articles par Catégorie</h2>
                @foreach ($categories as $category)
                <table id="ArtCategory-{{ $category->id }}">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <h3> Catégorie: {{ $category->name }}</h3>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 33%;">Titre</th>
                            <th style="width: 13%;">Contenu</th>
                            <th style="width: 15%;">Auteur</th>
                            <th style="width: 12%;">Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td><a href="{{ route('viewArticle', $article->id) }}" target="_blank">Lire content</a></td>
                            <!-- <td>{{ Str::limit($article->content, 50) }}</td> -->
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->status }}</td>
                            <td>
                                <form style="display: inline-block;" action="{{ route('articles.reject', $article->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-reject">Rejeter</button>
                                </form>
                                <form action="{{ route('articles.propose', $article->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn-propose">Proposer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
            </section>

            <!-- Section des abonnements -->
            <section id="subscriptions">
                <h2 class="title">Abonnements par Catégorie</h2>
                @foreach ($categories as $category)
                <table id="SubCategory-{{ $category->id }}">
                    <thead>
                        <tr>
                            <td colspan="3">
                                <h3> Catégorie: {{ $category->name }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <th style="width : 40% ;">Nom</th>
                            <th style="width : 40% ;">Email</th>
                            <th style="width : 20% ;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions->where('category_id', $category->id) as $subscription)
                        <tr>
                            <td>{{ $subscription->user->name }}</td>
                            <td>{{ $subscription->user->email }}</td>
                            <td>
                                <form action="{{ route('subscriptions.delete', $subscription->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-reject">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
            </section>
        </div>
    </div>

    <!-- JavaScript pour confirmation avant suppression -->
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                    event.preventDefault();
                }
            });
        });

    //////////////////////////////////////////
        const sidebar = document.querySelector('.sidebar');
        const submenu = document.getElementsByClassName('submenu');
        const vecteur = document.querySelectorAll('b');

        function Menu(index) {
            submenu[index].classList.toggle('active');
            if (submenu[index].classList.contains('active')) {
                vecteur[index].textContent = '▲';
            } else {
                vecteur[index].textContent = '▼';
            }
        }
        ///////////////////////////////////////////
        sidebar.addEventListener('mouseleave', function() {
            for (var i = 0; i < vecteur.length; i++) {
                submenu[i].classList.remove('active'); 
                vecteur[i].textContent = '▼'; 
            }
        });
    </script>
    @include('layouts.footer')
</body>

</html>