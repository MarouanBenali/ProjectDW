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
                <li><a href="#articles">Articles</a></li>
                <li><a href="#numero">Numéros</a></li>
                <li><a href="#users">Utilisateurs</a></li>
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
                            <th>Category</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposedArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->user->name }}</td>
                            <td>{{ $article->category->name }}</td>
                            <td><a href="{{ route('viewArticle', $article->id) }}" target="_blank">Lire content</a></td>
                            <td>
                                <form action="{{ route('acceptArticle', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="number" name="numero" placeholder="Numero" style="width: 80px; height:23px; font-weight: bold; " required>
                                    <button type="submit" class="btn-propose">Accepter</button>
                                </form>

                                <form action="{{ route('rejectArticle', $article->id) }}" method="POST" style="display:inline;">
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
            <section id="numero">
                <h2 class="title">Gestion des Numéros</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>category</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($numeros as $num)
                        <tr>
                            <td>{{ $num->numero }}</td>
                            <td>{{ $num->category->name }}</td>
                            <td>{{ $num->numero_published }}</td>
                            <td>
                                <form action="{{ route('publishNumero', ['num' => $num->numero, 'category_id' => $num->category->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="{{ $num->numero_published == 'unpublished' ? 'btn-propose' : 'btn-reject' }}">
                                        {{ $num->numero_published == 'unpublished' ? 'Publier' : 'Dépublier' }}
                                    </button>
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

                @foreach (['subscriber' => 'Abonnés','manager' => 'Managers', 'editor' => 'Éditeurs'] as $role => $label)
                <h3 style="font-size:25px ; text-align:center; color : red;">{{ $label }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Modifier Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users->where('role', $role) as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('assignRole', $user->id) }}" method="POST">
                                    @csrf
                                    <label for="role">Rôle :</label>
                                    <select name="role" id="role">
                                        <option value="editor">Éditeur</option>
                                        <option value="manager">Manager</option>
                                        <option value="subscriber">Utilisateur</option>
                                    </select>
                                    <button type="submit">Attribuer le rôle</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('DeBanUser', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="{{ $user->is_banned ?  'btn-propose' : 'btn-reject' }}">
                                        {{ $user->is_banned ? 'Débannir' : 'Banni' }}
                                    </button>
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
    @include('layouts.footer')
</body>

</html>