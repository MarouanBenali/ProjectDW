<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    @include('layouts.header')
    <main class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <div class="from-box login">
            <h2 class="animation" style="--i:0; --j:21;">Se connecter</h2>
            <form method="post" action="{{ route('login.post') }}">
                @csrf
                <div class="input-box animation" style="--i:1; --j:22;">
                    <input type="text" name="email" placeholder="Nom d'utilisateur" required>
                    <img src="/img/user.png" alt="">
                </div>
                <div class="input-box animation" style="--i:2; --j:23;">
                    <input type="password" name="password" minlength="6" maxlength="12" placeholder="Mot de passe" required>
                    <img src="/img/lock.png" alt="img">
                </div>
                <button type="submit" class="btn animation" style="--i:3; --j:24;">login</button>
                <div class="logreg-link animation" style="--i:4; --j:25;">
                    <p>Vous n'avez pas de compte ? <a href="#" class="register-link">Inscription</a></p>
                </div>
            </form>
        </div>
        <div class="info_text login">
            <h2 class="animation" style="--i:0 ; --j:20;">Bienvenue !</h2>
            <p class="animation" style="--i:1 ; --j:21;">Connectez-vous pour accéder à votre compte et profiter de nos
                services.</p>
            <h2></h2>
            <p></p>
        </div>
        <div class="from-box register">
            <h2 class="animation" style="--i:17; --j:0;">Inscription</h2>
            <form method="post" action="{{ route('register.post') }}" enctype="multipart/form-data">
                @csrf
                <!-- Nom complet -->
                <div class="input-box animation" style="--i:18; --j:1;">
                    <input type="text" name="full_name" minlength="6" maxlength="50" placeholder="Nom complet" required>
                    <img src="/img/user.png" alt="user">
                </div>
                <!-- Email -->
                <div class="input-box animation" style="--i:19; --j:2;">
                    <input type="email" name="email" placeholder="Email" required>
                    <img src="/img/mail.png" />
                </div>
                <!-- Mot de passe -->
                <div class="input-box animation" style="--i:20; --j:3;">
                    <input type="password" name="password" minlength="6" maxlength="12" placeholder="Mot de passe" required>
                    <img src="/img/lock.png" alt="user">
                </div>


                <!-- Confirmer le mot de passe -->
                <div class="input-box animation" style="--i:21; --j:4;">
                    <input type="password" name="password_confirmation" minlength="6" maxlength="12" placeholder="Confirmer le mot de passe" required>
                    <img src="/img/lock.png" alt="user">
                </div>

                <!-- Numéro de téléphone -->
                <div class="input-box animation" style="--i:22; --j:5;">
                    <input type="tel" name="phone_number" placeholder="Numéro de téléphone" required>
                    <img src="/img/tel.png" alt="phone">
                </div>
                <!-- Photo de profil -->
                <div class="input-box animation" style="--i:23; --j:6;">
                    <input type="file" name="profile_picture" id="profilePictureInput" accept="image/*" style="display: none;" required>
                    <button type="button" id="customFileButton">Ajouter une photo de profil</button>
                    <span id="fileName"></span>
                </div>
                <!-- Date de naissance -->
                <div class="input-box animation" style="--i:24; --j:7;">
                    <input type="date" name="date_of_birth" required>
                </div>
                <!-- Genre -->
                <div class="input-box animation select-container" style="--i:25; --j:8;">
                    <select name="gender" required>
                        <option value="other" disabled selected>Genre</option>
                        <option value="male">Homme</option>
                        <option value="female">Femme</option>
                    </select>
                </div>
                <!--Langue préférée-->
                <div class="input-box animation select-container" style="--i:26; --j:9;">
                    <select name="preferred_language" required>
                        <option value="ln" disabled selected>Langue préférée</option>
                        <option value="ar">Arabe</option>
                        <option value="en">Anglais</option>
                        <option value="fr">Français</option>
                    </select>
                </div>
                <!-- Conditions générales -->
                <div class="input-box animation checkbox-container" style="--i:27; --j:10;">
                    <input type="checkbox" name="terms" id="terms" required>
                    <label for="terms">J'accepte les <a href="/presentation#CGU" target="_blank">conditions générales</a></label>
                </div>
                <button type="submit" class="btn animation" style="--i:28; --j:11;">S'inscrire</button>
                <div class="logreg-link animation" style="--i:29; --j:12;">
                    <p>Vous avez déjà un compte ? <a href="#" class="login-link">Se connecter</a></p>
                </div>
            </form>
        </div>
        <div class="info_text register">
            <h2 class="animation" style="--i:17; --j:0;">Rejoignez-nous !</h2>
            <p class="animation" style="--i:18 ; --j:1;">Créez un compte pour découvrir toutes nos fonctionnalités et
                services.</p>
            <h2></h2>
            <p></p>
        </div>
    </main>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>