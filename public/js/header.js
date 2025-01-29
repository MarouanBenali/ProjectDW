let imgProfile = 'img/user_other.png'; // Image de profil par défaut
let profileUrl = '/login'; // URL par défaut
let authIcon = 'img/login.png'; // Image par défaut pour la connexion
let authUrl = '/login'; // URL pour la connexion ou la déconnexion

fetch('/photoProfil')
    .then(response => response.json())
    .then(data => {
        imgProfile = data.profile_picture; // Mettre à jour l'image de profil
        profileUrl = getProfileUrl(data.role); // Mettre à jour l'URL en fonction du rôle

        if (data.role) {
            authIcon = 'img/logout.png'; // Si l'utilisateur est connecté, afficher l'icône de déconnexion
            authUrl = '/logout'; // URL de déconnexion
        }

        updateHeader(data); // Passer le rôle pour mettre à jour l'en-tête
    });

// Fonction pour déterminer l'URL en fonction du rôle de l'utilisateur
function getProfileUrl(role) {
    switch (role) {
        case 'subscriber': return '/subscriber'; // Si l'utilisateur est abonné
        case 'manager': return '/dashboard'; // Si l'utilisateur est gestionnaire
        case 'editor': return '/editor'; // Si l'utilisateur est éditeur
        default: return '/login'; // Sinon, rediriger vers la page de connexion
    }
}

// Fonction pour mettre à jour l'en-tête de la page
function updateHeader(data) {
    const html = document.querySelector('header');
    if (html) {
        html.innerHTML = `
            <h1>
                <img src="img/titre.png" width="40px" alt="Logo">
                <span>Ⓣ</span>ech <span>Ⓗ</span>orizons
                <img src="img/tit.png" width="40px" alt="Logo">
            </h1>
            <nav>
                <a href="/">Accueil</a> 
                <a href="/categories">Catégories</a> 
                <a href="/presentation">Présentation</a> 
            </nav>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="${authUrl}">
                    <img src="${authIcon}" alt="Auth" style="width: 30px; cursor: pointer;">
                </a> 

                ${data.role ? `
                <a onclick="toggleNotifications()">
                    <img src="img/notification.png" alt="Notifications" style="width: 30px; cursor: pointer;">
                </a> 
                <a class = "userName" href="${profileUrl}">
                    ${data.userName}
                </a>`
                : 
                `<a class = "userName" href="${authUrl}">
                    ${data.userName}
                </a>`            
            } 
                <a href="${profileUrl}">
                    <img src="${imgProfile}" alt="Profile" style="width: 40px; border-radius: 50%; cursor: pointer;">
                </a>
            </div>
        `;
    }
}

let notificationsVisible = false;
const notificationsContainer = document.createElement('div'); //creation element de notification

// fonction pour ouvrir et fermer les notification : 
function toggleNotifications() {
    const notifications = document.getElementById('notifications');
    if (notifications.style.display === 'block') {
        notifications.style.display = 'none';
    } else {
        notifications.style.display = 'block';
    }
}

// Fonction pour les element de notification :
function createNotifications(notifications) {
    notificationsContainer.id = 'notifications';
    const heading = document.createElement('h3');
    heading.innerText = 'Notification';
    heading.style.color = "gold";
    notificationsContainer.appendChild(heading);

    const list = document.createElement('ul');
    notifications.forEach(notification => {
        const li = document.createElement('li');
        li.innerText = notification.type + '  :  ' + notification.message; 
        if (notification.is_read) {
            li.style.color = 'gray';
        }
        list.appendChild(li);
    });
    notificationsContainer.appendChild(list);

    document.body.appendChild(notificationsContainer); 
}


window.onload = () => {
    fetch('/get-notifications')
        .then(response => response.json())
        .then(data => {
            createNotifications(data);
        })
};

