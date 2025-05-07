// Simulated data from a database
const items = [
    { id: 1, name: 'Item 1', price: 0, quantity: 0 },
    { id: 2, name: 'Item 2', price: 0, quantity: 0 },
    { id: 3, name: 'Item 3', price: 0, quantity: 0 },
    // Add more items as needed
];

// Function to create input fields for each item
function createItemInputs() {
    const container = document.getElementById('itemsContainer');
    items.forEach(item => {
        const div = document.createElement('div');
        div.innerHTML = `
            <label>${item.name} Price: $</label>
            <input type="number" id="price${item.id}" placeholder="0.00" min="0" step="0.01" oninput="updateItem(${item.id}, 'price', this.value)">
            <label>Quantity: </label>
            <input type="number" id="quantity${item.id}" placeholder="0" min="0" step="1" oninput="updateItem(${item.id}, 'quantity', this.value)">
        `;
        container.appendChild(div);
    });
}

// Function to update item data when input changes
function updateItem(id, field, value) {
    const item = items.find(i => i.id === id);
    item[field] = parseFloat(value) || 0;
    calculateTotal();
}

// Function to calculate the total cost
function calculateTotal() {
    let overallTotal = 0;
    items.forEach(item => {
        overallTotal += item.price * item.quantity;
    });
    document.getElementById('totalCost').textContent = overallTotal.toFixed(2);
}

// Function to proceed to checkout
function proceedToCheckout() {
    // Hide calculator section and show checkout section
    document.getElementById('calculatorSection').classList.add('hidden');
    document.getElementById('checkoutSection').classList.remove('hidden');

    // Set the total cost on the checkout form
    document.getElementById('checkoutTotalCost').textContent = document.getElementById('totalCost').textContent;
}

// Handle form submission
document.getElementById('checkoutForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    const formData = new FormData(event.target);

    // You can process formData or send it to the server here
    console.log('Order Submitted');
    console.log('Customer Details:', Object.fromEntries(formData.entries()));



    // For demo purposes, just alert a success message
    alert('Order Submitted Successfully!');

      // Save the order details in localStorage
    localStorage.setItem('orderPlaced', JSON.stringify({
        totalCost: document.getElementById('totalCost').textContent,
        details: Object.fromEntries(formData.entries())
    }));

    // Redirect to the confirmation page
    window.location.href = 'Confirmation.html';
});



// Initialize the input fields when the page loads
window.onload = function() {
    createItemInputs();

    // Set up the "Proceed to Checkout" button
    document.getElementById('proceedToCheckoutButton').addEventListener('click', proceedToCheckout);
};