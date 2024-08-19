// Simulated user data (In a real application, this would be fetched from a server)
const users = [
    { username: 'user1', password: 'password1' },
    { username: 'user2', password: 'password2' }
];

// Simulated price data
const prices = [
    { item: 'Product 1', price: '$10' },
    { item: 'Product 2', price: '$20' },
    { item: 'Product 3', price: '$30' }
];

// Handle login
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Check if the user exists
    const user = users.find(u => u.username === username && u.password === password);

    if (user) {
        localStorage.setItem('loggedIn', true);
        document.getElementById('login').style.display = 'none';
        displayPrices();
    } else {
        document.getElementById('loginMessage').innerText = 'Invalid username or password.';
    }
});

// Display prices if logged in
function displayPrices() {
    if (localStorage.getItem('loggedIn')) {
        document.getElementById('prices').style.display = 'block';
        const priceList = document.getElementById('priceList');
        priceList.innerHTML = '';

        prices.forEach(price => {
            const listItem = document.createElement('li');
            listItem.innerText = `${price.item}: ${price.price}`;
            priceList.appendChild(listItem);
        });
    }
}

// Check if the user is already logged in when the page loads
window.onload = function() {
    if (localStorage.getItem('loggedIn')) {
        document.getElementById('login').style.display = 'none';
        displayPrices();
    }
};
