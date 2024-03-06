function filterProducts() {
    const searchQuery = document.getElementById('search').value;
    const categoryCheckboxes = document.getElementsByName('category[]');
    const selectedCategories = Array.from(categoryCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);
    const selectedPrice = document.getElementById('price-filter').value;

    // Utilisez AJAX pour envoyer la requête au serveur et récupérer les résultats
    // Adapté en fonction de votre backend
    const url = `functions.php?search=${searchQuery}&categories=${selectedCategories.join(',')}&price=${selectedPrice}`;

    fetch(url)
        .then(response => response.json())
        .then(data => updateProductList(data))
        .catch(error => console.error('Erreur lors de la récupération des données:', error));
}

function updateProductList(products) {
    const productListContainer = document.getElementById('product-list');
    productListContainer.innerHTML = '';

    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';

        productCard.innerHTML = `
            <h2>${product.Titel}</h2>
            <img src="${product.Dateiname}" alt="${product.Titel}">
            <p>Prix: ${product.Preis}</p>
        `;

        productListContainer.appendChild(productCard);
    });
}
