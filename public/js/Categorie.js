let categories = [];
let User = [];
let subscriptions = [];
let currentSortType = '';

Promise.all([
    fetch('/categorie-data').then(response => response.json()),
    fetch('/getInfoUser').then(response => response.json()),
    fetch('/getSubscriptions').then(response => response.json())
]).then(data => {
    console.log(data);
    categories = data[0];
    User = data[1];
    subscriptions = data[2];
    renderCategories(categories, User);
})

//---------------------------------------------------------------------------------------------//

document.addEventListener('DOMContentLoaded', () => {
    const Input = document.querySelector('div>input');
    Input.addEventListener('input', () => {
        const search = Input.value.toLowerCase();
        let filteredCategories;
        if (search === '') {
            applySort(currentSortType, categories);
        } else {
            filteredCategories = categories.filter(cat =>
                cat.name.toLowerCase().includes(search) ||
                cat.description.toLowerCase().includes(search)
            );
            applySort(currentSortType, filteredCategories);
        }
    });

    const sortSelect = document.createElement('select');
    sortSelect.innerHTML = `
        <option disabled selected>Trier par</option>
        <option value="name">Nom</option>
        <option value="rating">évaluation</option>
        <option value="abonne">nombre d'abonnés</option>
    `;
    document.querySelector('.search-container').appendChild(sortSelect);

    sortSelect.addEventListener('change', (e) => {
        applySort(e.target.value);
    });
});

function createCategoryElement(cat) {
    var stars = '';
    for (var j = 0; j < 5; j++) {
        if (j < Math.round(cat.rating)) {
            stars += `<span class="star active">★</span>`;
        } else {
            stars += `<span class="star">★</span>`;
        }
    }
    const a = document.createElement('a');
    a.className = `category`;
    a.setAttribute('href', `/Explorer/${cat.id}`);
    a.innerHTML = `
    <img src="${cat.image}" alt="img">
    <h2>${cat.name}</h2>
    <p>${cat.description}</p>
    <div class="rating">${stars}</div>
    <p>Votes : ${cat.totalRatings} </p>
    <p>Articles: ${cat.articles}</p>
    <p>Abonnements: ${cat.subscriptions}</p>
    <div class="buttons">
       ${(subscriptions.includes(cat.id) ?
            `<a href="/DeSabonner/${cat.id}">Se désabonner</a>`
            : `<a href="/DeSabonner/${cat.id}">S'abonner</a>`)
        }
       <a href="/Explorer/${cat.id}">Explorer</a>
       ${User.role == 'editor' ? `<a href="/DelCategorie/${cat.id}" class="DelCat">Supprimer</a>` : ''}
    </div>
`;

    if (cat.bgImg) {
        a.addEventListener('mouseenter', function () {
            a.style.background = `url('${cat.bgImg}') center / cover`;
        });

        a.addEventListener('mouseleave', function () {
            a.style.background = "";
        });

        return a;
    }
}

function renderCategories(Cat, User) {
    const container = document.querySelector('.categories');
    container.innerHTML = '';
    if (Cat.length == 0) {
        container.innerHTML = '<p class="vide">Aucun résultat correspondant...</p>';
    } else {
        Cat.forEach((ele) => {
            container.appendChild(createCategoryElement(ele));
        });
    }

    if (User.role == 'editor') {
        container.appendChild(buttonAddCategorie());
    }
}

function buttonAddCategorie() {
    const div = document.createElement('div');
    div.className = 'categoryAdd';
    div.innerHTML = `
                <h2>Ajouter une catégorie</h2>
                <a href="/AddCategorie"><img src="img/addCat.png" alt="img"></a>
        `;
    return div;
}

function applySort(sortType, cats = categories) {
    currentSortType = sortType;
    let sortedCategories;
    switch (sortType) {
        case 'name':
            sortedCategories = cats.toSorted((a, b) => a.name.localeCompare(b.name));
            break;
        case 'rating':
            sortedCategories = cats.toSorted((a, b) => b.rating - a.rating);
            break;
        case 'abonne':
            sortedCategories = cats.toSorted((a, b) => b.subscriptions - a.subscriptions);
            break;
        default:
            sortedCategories = cats;
            break;
    }

    renderCategories(sortedCategories, User);
}


