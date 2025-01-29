let categories = [];

let currentSortType = 'none'; // trie par defaut

function createCategoryElement(cat, i) {
    var stars = '';
    for (var j = 0; j < 5; j++) {
        if (j < Math.round(cat.rating)) {
            stars += `<span class="star active">★</span>`;
        } else {
            stars += `<span class="star">★</span>`;
        }
    }

    const a = document.createElement('a');
    a.className = `category cat${i + 1}`;
    a.setAttribute('href',  cat.link);
    a.innerHTML = `
        <img src="${cat.image}" alt="img">
        <h2>${cat.name}</h2>
        <p>${cat.description}</p>
        <div class="rating">${stars}</div>
        <p>Votes : ${cat.totalRatings} </p>
        <p>Articles: ${cat.articles}</p>
        <p>Visitors: ${cat.visitors}</p>
    `;
    return a;
}

function renderCategories(Cat) {
    const container = document.querySelector('.categories');
    container.innerHTML = '';
    if (Cat.length == 0) {
        container.innerHTML = '<p class="vide">Aucun résultat correspondant...</p>';
        return;
    }
    Cat.forEach((ele, index) => {
        container.appendChild(createCategoryElement(ele, index));
    });
}

function applySort(sortType, cats = categories) {
    currentSortType = sortType; // enregistrer la méthode de tri courante
    let sortedCategories;
    switch (sortType) {
        case 'name':
            sortedCategories = cats.toSorted((a, b) => a.name.localeCompare(b.name));
            break;
        case 'rating':
            sortedCategories = cats.toSorted((a, b) => b.rating - a.rating);
            break;
        case 'visitors':
            sortedCategories = cats.toSorted((a, b) => b.visitors - a.visitors);
            break;
        default:
            sortedCategories = cats; // sans tri
            break;
    }
    renderCategories(sortedCategories);
}

document.addEventListener('DOMContentLoaded', () => {
    // جلب الفئات من الخادم
    fetch('/categorie-data')
        .then(response => response.json())
        .then(data => {
            categories = data;
            renderCategories(categories); // Afficher les catégories initiales
        });

    const Input = document.querySelector('div>input');
    Input.addEventListener('input', () => {
        const search = Input.value.toLowerCase();
        let filteredCategories;
        if (search === '') {
            // Si le champ de recherche est vide, appliquer le tri actuel sur les catégories originales
            applySort(currentSortType, categories);
        } else {
            // Si du texte est saisi dans le champ de recherche, filtrer les catégories
            filteredCategories = categories.filter(cat =>
                cat.name.toLowerCase().includes(search) ||
                cat.description.toLowerCase().includes(search)
            );
            // Appliquer le tri actuel sur les catégories filtrées
            applySort(currentSortType, filteredCategories);
        }
    });

    const sortSelect = document.createElement('select');
    sortSelect.innerHTML = `
        <option disabled selected>Trier par</option>
        <option value="name">Nom</option>
        <option value="rating">évaluation</option>
        <option value="visitors">nombre de visiteurs</option>
    `;
    sortSelect.addEventListener('change', (e) => {
        applySort(e.target.value); // Appliquer le tri sélectionné
    });

    const searchContainer = document.querySelector('.search-container');
    searchContainer.appendChild(sortSelect);
});