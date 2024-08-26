// Import bcryptjs
const bcrypt = require('bcryptjs');

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

// Signup form handling
document.querySelector('.signup form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.querySelector('.signup input[type="email"]').value.trim();
    const password = document.querySelector('.signup input[type="password"]').value.trim();

    if (!firstName || !lastName || !email || !password) {
        document.querySelector('.signup .error-txt').innerText = 'All fields are required!';
        return;
    }

    if (users.some(user => user.email === email)) {
        document.querySelector('.signup .error-txt').innerText = 'User already exists!';
    } else {
        // Hash the password before storing it
        const hashedPassword = bcrypt.hashSync(password, 10);
        users.push({ firstName, lastName, email, password: hashedPassword });
        localStorage.setItem('users', JSON.stringify(users));
        localStorage.setItem('loggedIn', true);
        localStorage.setItem('loggedInUser', email);

        window.location.href = 'index.html';
    }
});

// Login form handling
document.querySelector('.login form')?.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.querySelector('.login input[type="text"]').value.trim();
    const password = document.querySelector('.login input[type="password"]').value.trim();

    if (!email || !password) {
        document.querySelector('.login .error-txt').innerText = 'Both fields are required!';
        return;
    }

    const user = users.find(u => u.email === email);

    if (user && bcrypt.compareSync(password, user.password)) {
        localStorage.setItem('loggedIn', true);
        localStorage.setItem('loggedInUser', email);
        window.location.href = 'index.html';
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
            const priceValue = productPrices[productId] || 'Price not available';
            priceElement.innerText = priceValue;
            priceElement.removeAttribute('href');
            priceElement.classList.remove('login-to-view-price-btn');
        });
    }
}

// Run on page load
window.onload = function() {
    displayPricesOnCards();
};
