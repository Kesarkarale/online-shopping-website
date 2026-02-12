  <?php
session_start();
include 'connection.php';

// Fetch products
$products = $conn->query("SELECT * FROM products");

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
        'image' => $product_image,
        'quantity' => 1
    ];

    echo "<script>alert('Product added to cart!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home | KP Enterprises</title>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #e8ffe8, #f5f5dc, #f0f0e8);
  margin:0; padding:0; color:#2f2f2f;
}

/* Navbar */
.navbar {
  background: #4e9f66;
  padding: 25px 35px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  font-weight: 600;
  font-size: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  border-radius: 0 0 15px 15px;
}

/* LOGO + NAME SAME SIDE */
.nav-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

.nav-left img {
  height: 70px;
  width: 70px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #fff;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
}

.nav-left h1 {
  font-size: 32px;
  margin: 0;
  letter-spacing: 1px;
  font-weight: 700;
}

/* Right Side */
.nav-right a {
  color:white;
  text-decoration:none;
  margin-left:10px;
  font-weight: 600;
}

/* Logout button */
.nav-right a.logout {
  color: #fff;
  background: linear-gradient(45deg, #d9534f, #c9302c);
  border-radius: 8px;
  padding: 8px 15px;
  text-decoration: none;
  transition: 0.3s;
}

.nav-right a.logout:hover {
  opacity: 0.9;
}

 /* Product Container */
.product-container {
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  margin:40px auto;
  width:90%;
  gap:20px;
}

.product {
  background:#ffffff;
  border-radius:18px;
  padding:20px;
  text-align:center;
  width:220px;
  box-shadow:0 6px 18px rgba(0,0,0,0.1);
  transition: all 0.35s ease;
  position:relative;
  overflow:hidden;
}

 .product::before {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: 18px;
      background: radial-gradient(circle at top left, rgba(255,192,203,0.18), transparent 70%);
      opacity: 0;
      transition: opacity 0.4s ease;
      z-index: 0;
    }

    .product:hover::before {
      opacity: 1;
    }

    .product:hover {
      transform: translateY(-8px) scale(1.03);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    .product img {
      width: 100%;
      height: 180px;
      object-fit: contain;
      border-radius: 10px;
      z-index: 1;
      position: relative;
      transition: transform 0.3s ease;
    }

    .product:hover img {
      transform: scale(1.08);
    }

    .product h3 a {
      text-decoration: none;
      color: #36454f;
      font-weight: 600;
      z-index: 1;
      position: relative;
    }

    .product p {
      color: #555;
      margin-bottom: 15px;
      z-index: 1;
      position: relative;
    }

    /* 💚 Add to Cart Button */
    .add-cart-btn {
      background:  #ffffff;
      border: 2px solid #8bcf97;
      color: #2e7d32;
      font-weight: bold;
      border-radius: 15px;
      padding: 10px 22px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      cursor: pointer;
      transition: 0.3s ease;
      z-index: 1;
      position: relative;
    }

    .add-cart-btn:hover {
      background: #e8f9ec;
      color: white;
      transform: translateY(-3px);
    }

    /* 🧡 Buy Now Button */
    .buy-btn {
      background: #4e9f66;
      color: white;
      padding: 10px 25px;
      border-radius: 15px;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: 0.3s ease;
      z-index: 1;
      position: relative;
    }

    .buy-btn:hover {
      background: #6bbf85;
      transform: translateY(-3px);
    }
 
/* Footer */
footer { 
  background:#faf8f0;
  padding:50px 20px; 
  margin-top:70px; 
  text-align:center; 
  border-top:2px solid #e5e2d0;
}
.footer-container { 
 display:flex; 
 justify-content:space-around; 
 flex-wrap:wrap; 
 max-width:1100px;
 margin:0 auto; 
 text-align:left; 
}
.footer-container h3, .footer-container h4 { color:#294b31; }
.footer-links ul { list-style:none; padding:0; }
.footer-links ul li { margin:5px 0; }
.footer-links a { text-decoration:none; color:#555; }
.footer-links a:hover { text-decoration:underline; }
.social-icons img { width:25px; margin:5px; transition:0.3s ease; }
.social-icons img:hover { transform:scale(1.2); }
.footer-bottom { margin-top:25px; font-size:14px; color:#777; }


</style>
</head>

<body>

<!-- ⭐ NAVBAR FIXED -->
<div class="navbar">
  
  <div class="nav-left">
    <img src="images/logo.png" alt="logo">
    <h1>KP ENTERPRISES</h1>
  </div>

  <div class="nav-right">
    Welcome, <?php echo $_SESSION['username']; ?> |
    <a href="cart.php">🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a> |
    <a href="logout.php" class="logout">Logout</a>
  </div>

</div>

 <div class="product-container">
    <?php while ($row = $products->fetch_assoc()) { ?>
      <div class="product">
        <a href="product_details.php?id=<?php echo $row['id']; ?>">
          <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        </a>

        <h3><a href="product_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h3>
        <p>₹<?php echo $row['price']; ?></p>

        <form method="post">
          <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
          <button type="submit" name="add_to_cart" class="add-cart-btn">Add to Cart</button>
        </form>
        <br>
        <a href="checkout.php?buy=<?php echo $row['id']; ?>" class="buy-btn">Buy Now</a>
      </div>
    <?php } ?>
  </div>

<footer>
  <div class="footer-container">
    <div class="footer-about">
      <h3>KP ENTERPRISES</h3>
      <p>Your trusted partner for quality products and great service.</p>
    </div>

    <div class="footer-links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

    <div class="footer-contact">
      <h4>Contact Info</h4>
      <p>Email: support@kpenterprises.com</p>
      <p>Phone: +91 98765 43210</p>
      <p>Address: Pune, Maharashtra, India</p>

      <div class="social-icons">
        <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
        <a href="#"><img src="images/instagram.png" alt="Instagram"></a>
        <a href="#"><img src="images/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="images/linkedin.png" alt="LinkedIn"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2025 KP Enterprises | All Rights Reserved</p>
  </div>
</footer>
</body>
</html>

