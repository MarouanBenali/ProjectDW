<link rel="stylesheet" href="{{ asset('css/headerFooter.css') }}">
<header>
    <h1>
        <img src="{{ asset('img/titre.png') }}" width="40px" alt="Logo">
        <span>Ⓣ</span>ech <span>Ⓗ</span>orizons
        <img src="{{ asset('img/tit.png') }}" width="40px" alt="Logo">
    </h1>
    <nav>
        @php
        $redirectPage = '/';
        if (Auth::check())
        $redirectPage = '/subscriber';
        @endphp
        <a href="{{ url($redirectPage) }}">Accueil</a>
        <a href="{{ url('/categories') }}">Catégories</a>
        <a href="{{ url('/presentation') }}">Présentation</a>
    </nav>
    <div style="display: flex; align-items: center; gap: 10px;">
        @php
        $user = auth()->user();
        $authUrl = $user ? url('/logout') : url('/login');
        $authIcon = $user ? asset('img/logout.png') : asset('img/login.png');

        if ($user) {
        switch ($user->role) {
        case 'subscriber': $profileUrl = url('/subscriber'); break;
        case 'manager': $profileUrl = url('/dashboard'); break;
        default : $profileUrl = url('/editor'); break;
        }

        $imgProfile = asset('storage/' . $user->profile_picture) ?? asset('img/user_other.png');
        } else {
        $profileUrl = url('/login');
        $imgProfile = asset('img/user_other.png');
        }

        $notifications = auth()->check()
        ? \App\Models\Notification::where('user_id', auth()->id())->get()
        : collect([]);
        @endphp

        <a href="{{ $authUrl }}">
            <img src="{{ $authIcon }}" alt="Auth" style="width: 30px; cursor: pointer;">
        </a>

        @if ($user)
        <a onclick="toggleNotifications()">
            <img src="{{ asset('img/notification.png') }}" alt="Notifications" style="width: 30px; cursor: pointer;">
        </a>
        <a class="userName" href="{{ $profileUrl }}">
            {{ $user->name }}
        </a>
        @else
        <a class="userName" href="{{ $profileUrl }}">
            Connexion
        </a>
        @endif

        <a href="{{ $profileUrl }}">
            <img src="{{ $imgProfile }}" alt="Profile" style="width: 56px; border-radius: 50%; cursor: pointer;">
        </a>
    </div>
</header>

<div id="notifications" style="display: none;">
    <h3 style="color: gold;">Notification</h3>
    <ul>
        @foreach ($notifications as $notification)
        @if ($notification->is_read)
        <li style="color: gray; padding: 10px;">
            {{ $notification->message }}
        </li>
        @else
        <li style="color: white; padding: 10px;">
            {{ $notification->message }}
        </li>
        @endif
        @endforeach
    </ul>

</div>

<script>
    function toggleNotifications() {
        let notifications = document.getElementById('notifications');
        notifications.style.display = (notifications.style.display === 'block') ? 'none' : 'block';
    }
</script>