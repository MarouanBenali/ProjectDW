<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<div class="profile-container">
    <img class="profile-img" src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="Profile Picture">
    <form action="{{ route('updatePicture') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="profile_picture" accept="image/*" id="profile-input" onchange="showSubmitButton()">
        <label for="profile-input" class="change-btn">🖊 Changer</label>
        <button type="submit" class="submit-btn" id="submit-btn">✔</button>
    </form>
    <h3 class="profile-info"> <span>{{ Auth::user()->role }} : </span> {{ Auth::user()->name }}</h3>
</div>

<script>
    function showSubmitButton() {
        var fileInput = document.getElementById("profile-input");
        var submitButton = document.getElementById("submit-btn");

        if (fileInput.files.length > 0) {
            submitButton.style.display = "inline-block";
        } else {
            submitButton.style.display = "none";
        }
    }
</script>