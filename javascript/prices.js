// Simulated user database
const users = JSON.parse(localStorage.getItem('users')) || [];

// Simulated price data
const productPrices = {
    1: '$10',
    2: '$20',
    3: '$30',
    4: '$40',
    5: '$50',
    6: '$60'
};

// Function to display prices if the user is logged in
function displayPricesOnCards() {
    if (localStorage.getItem('loggedIn')) {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            const priceElement = card.querySelector('.price a');
            const priceValue = productPrices[index + 1];
            if (priceValue) {
                priceElement.innerText = priceValue;
                priceElement.removeAttribute('href'); // Remove the link if the price is displayed
                priceElement.classList.remove('login-to-view-price-btn');
            }
        });
    }
}


// Signup form handling
document.querySelector('.signup form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const firstName = document.getElementById('firstName').value;
    const lastName = document.getElementById('lastName').value;
    const email = document.querySelector('.signup input[type="email"]').value;
    const password = document.querySelector('.signup input[type="password"]').value;

    if (users.some(user => user.email === email)) {
        document.querySelector('.signup .error-txt').innerText = 'User already exists!';
    } else {
        users.push({ firstName, lastName, email, password });
        localStorage.setItem('users', JSON.stringify(users));
        localStorage.setItem('loggedIn', true);
        localStorage.setItem('loggedInUser', email);

        window.location.href = 'index.html'; // Redirect to the index page
    }
});

// Login form handling
document.querySelector('.login form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.querySelector('.login input[type="text"]').value;
    const password = document.querySelector('.login input[type="password"]').value;

    const user = users.find(u => u.email === email && u.password === password);

    if (user) {
        localStorage.setItem('loggedIn', true);
        localStorage.setItem('loggedInUser', email);
        window.location.href = 'index.html'; // Redirect to the index page
    } else {
        document.querySelector('.login .error-txt').innerText = 'Invalid email or password!';
    }
});

// Display prices on the product cards in index.html
function displayPricesOnCards() {
    if (localStorage.getItem('loggedIn')) {
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            const productId = card.getAttribute('data-product-id');
            const priceElement = card.querySelector('.price-value');
            if (productPrices[productId]) {
                priceElement.innerText = productPrices[productId];
            } else {
                priceElement.innerText = 'Price not available';
            }
        });
    }
}

// Run on page load
window.onload = function() {
    displayPricesOnCards();
};
