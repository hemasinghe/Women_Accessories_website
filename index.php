<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories Shop</title>
    <link rel="stylesheet" href="Styles_Home.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
 <?php include('header.html');?>
<header class="header">

</header>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Content goes here -->
        <h1 align="center">Welcome to the Accessories Shop !</h1>
     
    </div>
<br><br><br><section id="about">
    <div class="container">
      
        <div class="image">
            <img src="picture03.jpg" alt="Sample Image">
        </div>
        <div class="text-box">
            <h2>About Us </h2> <br><br>
            <p>Welcome to <b>Rose & Sterling Mystique</b>, a proudly Sri Lankan accessories shop owned and operated by four passionate and creative women. Our story began with a shared love for fashion, elegance, and the desire to empower others through beautifully crafted accessories. Each piece in our collection is carefully selected to reflect the unique style and vibrant culture of Sri Lanka, blending traditional charm with modern sophistication.
<br><br><br>
At,     <b>Rose & Sterling Mystique</b>, we believe that every accessory tells a story, and we're here to help you express yours. Whether you're searching for a timeless piece to treasure or a statement item to complete your look, our collection is designed to inspire and delight. Join us on this journey, and discover the perfect accessory that resonates with your individuality and spirit.</p>
        </div>
    </div></section>
<br><br><br>
<h1>New Arrivals</h1>
<div class="image-row">
        <div class="image-container">
            <img src="picture01.jpg" alt="Image 1">
        </div>
        <div class="image-container">
            <img src="picture02.jpg" alt="Image 2">
        </div>
        <div class="image-container">
            <img src="picture04.jpg" alt="Image 3">
        </div>
    </div> 
<h1> Products Selection</h1> <section id="products">
<div class="productsimage-row">
    <fieldset class="productsimage">
        <legend><h3 color="black">Jewelleries</h4></legend>
        <a href="products.php?type=Jewelry" class="productsimage-link">
            <img src="picture06.jpg" alt="Product 1" class="productsimage">
        </a>
    </fieldset>
    
    <fieldset class="productsimage">
        <legend><h3 color="black">Accessories</h4></legend>
        <a href="products.php?type=Accessory" class="productsimage-link">
            <img src="picture05.jpg" alt="Product 2" class="productsimage">
        </a>
    </fieldset>
    
    <fieldset class="productsimage">
        <legend><h3 color="black">Bags</h4></legend>
        <a href="products.php?type=Bag" class="productsimage-link">
            <img src="picture07.jpg" alt="Product 3" class="productsimage">
        </a>
    </fieldset>
</div></selection>

<footer><section id="contact">
    <div class="footer-container">
        <div class="footer-section">
            <h2>Contact Us</h2>
            <p class="mail">Email us at <a href="mailto:R&SMystique@gmail.com"> R&SMystique@gmail.com</a></p>
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12650.446428215956!2d-122.0838474!3d37.3860517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fbb647c4b6f9b%3A0x5c9db646bf66e57e!2sGoogleplex!5e0!3m2!1sen!2sus!4v1615338803961!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="footer-section">
            <h2>Contact Information</h2>
            <ul align="left">
                <li><strong>Address:</strong> 137 Sir James Pieris Mawatha, Colombo 00200.</li>
                <li><strong>Phone:</strong> +94712184414</li>
                <li><strong>Location:</strong> Colombo, Sri Lanka</li>
            </ul>
        </div>

        <div class="footer-section">
            <h2>About Us</h2>
            <ul>
                <li><a href="Home.html">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="Cart&Checkout.html">Purcheses</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h2>Visit</h2>
            <ul class="social-media-list">
                <li><a href="https://www.facebook.com"><img src="facebook.png" alt="Facebook"> Facebook</a></li>
                <li><a href="https://www.instagram.com"><img src="instagram.png" alt="Instagram"> Instagram</a></li>
                <li><a href="https://www.linkedin.com"><img src="linkdin.png" alt="LinkedIn"> LinkedIn</a></li>
            </ul>
        </div>
    </div>
    <h4 class="text">&copy; 2024 Your Website | Designed by Group 22 </h4>
</footer></selection>

   <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>

