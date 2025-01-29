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
                <li><a href="#articles">Articles</a></li>
                <li><a href="#issues">Numéros</a></li>
                <li><a href="#users">Utilisateurs</a></li>
                <li><a href="#statistics">Statistiques</a></li>
            </ul>
            <span>▶</span>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <!-- Section des articles -->
            <section id="articles">
                <h2 class="title">Articles Proposés</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposedArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->status }}</td>
                            <td>
                                <form action="{{ route('editor.articles.accept', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-propose">Accepter</button>
                                </form>
                                <form action="{{ route('editor.articles.reject', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-reject">Rejeter</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <!-- Section des numéros -->
            <section id="issues">
                <h2 class="title">Gestion des Numéros</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($issues as $issue)
                        <tr>
                            <td>{{ $issue->title }}</td>
                            <td>{{ $issue->status }}</td>
                            <td>
                                <form action="{{ route('editor.issues.publish', $issue->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-propose">Publier</button>
                                </form>
                                <form action="{{ route('editor.issues.unpublish', $issue->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-reject">Dépublier</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

            <!-- Section des utilisateurs -->
            <section id="users">
                <h2 class="title">Gestion des Utilisateurs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->is_banned ? 'Banni' : 'Actif' }}</td>
                            <td>
                                <form action="{{ route('editor.users.ban', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-reject">Bannir</button>
                                </form>
                                <form action="{{ route('editor.users.unban', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-propose">Débannir</button>
                                </form>
                                <form action="{{ route('editor.users.assign-editor', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-propose">Promouvoir</button>
                                </form>
                                <form action="{{ route('editor.users.remove-editor', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-reject">Rétrograder</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

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
        document.querySelectorAll('.btn-reject, .btn-propose').forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Êtes-vous sûr de vouloir effectuer cette action ?')) {
                    event.preventDefault();
                }
            });
        });
    </script>
    <footer>
        <script src="{{ asset('js/footer.js') }}"></script>
    </footer>
</body>

</html>