// Sample cart data
const cartItems = [
    { item: "Item 1", price: 10.00, quantity: 2 },
    { item: "Item 2", price: 15.00, quantity: 1 },
    { item: "Item 3", price: 7.50, quantity: 3 }
];

function updateCart() {
    const cartTableBody = document.getElementById("cartItems");
    const totalCostElement = document.getElementById("totalCost");
    const checkoutTotalCostElement = document.getElementById("checkoutTotalCost");

    cartTableBody.innerHTML = ''; // Clear previous items
    let totalCost = 0;

    // Populate the table with cart items
    cartItems.forEach(item => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${item.item}</td>
            <td>$${item.price.toFixed(2)}</td>
            <td>${item.quantity}</td>
        `;
        cartTableBody.appendChild(row);
        totalCost += item.price * item.quantity;
    });

    totalCostElement.textContent = totalCost.toFixed(2);
    checkoutTotalCostElement.textContent = totalCost.toFixed(2);
}

// Event listener for Proceed to Checkout button
document.getElementById("proceedToCheckout").addEventListener("click", () => {
    document.getElementById("cartSection").classList.add("hidden");
    document.getElementById("checkoutSection").classList.remove("hidden");
});

// Handle the form submission
document.getElementById("checkoutForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Retrieve the necessary data from the form
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const address = document.getElementById("address").value;
    const paymentMethod = document.getElementById("payment").value;

    // Collect the order data (this can be expanded as needed)
    const orderData = {
        name: name,
        email: email,
        address: address,
        paymentMethod: paymentMethod,
        totalCost: document.getElementById("checkoutTotalCost").textContent,
        items: cartItems // Or another list of items
    };

    // Store order data in localStorage (or send it to a server if needed)
    localStorage.setItem('orderPlaced', JSON.stringify(orderData));

    // Redirect to the order confirmation page
    window.location.href = 'order_confirmation.html';
});

// Initialize cart on page load
updateCart();