<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Gestionnaire de catégories</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/HeaderFooter.css') }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgba(157, 180, 242, 0.65);
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            display: flex;
        }

        .title {
            background-color: #f88e04;
            border-radius: 30px;
            color: white;
            box-shadow: 5px 5px 14px 3px red;
            width: 40%;
            padding: 6px;
            margin: 25px auto;
            text-align: center;
        }

        .sidebar {
            position: fixed;
            width: 15px;
            background-color: #f88e04;
            border: 1px solid black;
            border-radius: 0 60px 60px 0;
            padding: 0 20px 0 5px;
            margin: 0;
            height: 100vh;
            transition: width 0.3s ease;
        }

        .sidebar h2,
        .sidebar ul {
            opacity: 0;
            font-weight: bold;
        }

        .sidebar:hover {
            width: fit-content;
        }

        .sidebar:hover h2,
        .sidebar:hover ul {
            opacity: 1;
        }

        .sidebar:hover span {
            opacity: 0;
        }

        .sidebar span {
            font-size: 40px;
            color: red;
            margin: 0;
            padding: 0;
        }

        .sidebar h2 {
            padding: 0 10px;
        }

        .sidebar ul {
            padding: 0 15px;
        }

        .sidebar ul li a,
        strong {
            text-decoration: none;
            cursor: pointer;
            color: white;
        }

        .sidebar ul li a:hover,
        strong:hover {
            color: #007bff;
        }

        strong b {
            color: red;
        }

        .submenu {
            display: none;
            padding-left: 20px;
        }

        .submenu li a {
            font-weight: 100;
        }

        .submenu.active {
            display: block;
        }

        .content {
            width: 100%;
            margin-left: 45px;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #e0f7fa;
            /* light cyan background */
            margin-bottom: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1.5px solid black;
            padding: 10px;
            text-align: center;
        }

        table thead {
            background-color: rgb(27, 86, 204);
            /* Deep blue header */
            color: white;
            font-weight: bold;
        }

        table th {
            border-bottom: 2px solid #fff;
        }

        ul li {
            margin-bottom: 12px;
        }

        #articles button {
            width: 75px;
            color: white;
            border: none;
            padding: 2px 10px;
            font-weight: bold;
            cursor: pointer;
            margin: 2px 0;
        }

        .btn-reject {
            background-color: #e53935;
            /* Red button */
        }

        .btn-propose {
            background-color: #1e88e5;
            /* Blue button */
        }

        .btn-delete {
            background-color: #e53935;
            /* Red button */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        h3 {
            color: gold;
            margin: 0;
            padding: 0;
        }
    </style>

</head>

<body>
    <header>
        <script src="{{ asset('js/header.js') }}"></script>
    </header>
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
                            <th style="width: 40%;">Titre</th>
                            <th style="width: 15%;">Contenu</th>
                            <th style="width: 15%;">Auteur</th>
                            <th style="width: 15%;">Statut</th>
                            <th style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td><a href="{{ route('article.view', $article->id) }}" target="_blank">Lire content</a></td>
                            <!-- <td>{{ Str::limit($article->content, 50) }}</td> -->
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->status }}</td>
                            <td>
                                <form action="{{ route('articles.reject', $article->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-reject">Rejeter</button>
                                </form>
                                <form action="{{ route('articles.propose', $article->id) }}" method="POST">
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
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Actions</th>
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
                                    <button type="submit" class="btn-delete">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
            </section>

            <!-- Section des conversations
            <section id="conversations">
                <h2 class="title">Conversations</h2>
                <ul>
                    @foreach ($conversations as $conversation)
                    <li>
                        <strong>{{ $conversation->user->name }}</strong>: {{ $conversation->content }}
                        <form action="{{ route('messages.delete', $conversation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Supprimer</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </section> -->

            <!-- Section des statistiques -->
            <section id="statistics">
                <h2 class="title">Statistiques</h2>
                <ul>
                    <li>Nombre d'articles : {{ $statistics['articles_count'] }}</li>
                    <li>Nombre d'abonnés : {{ $statistics['subscribers_count'] }}</li>
                    <li>Nombre de vues : {{ $statistics['views_count'] }}</li>
                    <li>Nombre de likes : {{ $statistics['likes_count'] }}</li>
                </ul>
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
        // إغلاق القائمة الفرعية عند إزالة الـ hover من الـ Sidebar
        sidebar.addEventListener('mouseleave', function() {
            for (var i = 0; i < vecteur.length; i++) {
                submenu[i].classList.remove('active'); 
                vecteur[i].textContent = '▼'; 
            }
        });
    </script>
    <footer>
        <script src="{{ asset('js/footer.js') }}"></script>
    </footer>
</body>

</html>