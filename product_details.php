<?php
session_start();
include 'connection.php';

// Redirect if no product ID
if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit();
}

// Add to cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'price' => $product['price'],
        'image' => $product['image'],
        'quantity' => 1
    ];

    echo "<script>alert('Product added to cart!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $product['name']; ?> | KP Enterprises</title>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #e8ffe8, #f5f5dc, #f0f0e8);
    margin: 0;
    padding: 0;
}

/* NAVBAR */
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
}

.nav-left h1 {
  font-size: 32px;
  margin: 0;
  font-weight: 700;
}

.nav-right a {
  color:white;
  text-decoration:none;
  margin-left:10px;
  font-weight: 600;
}

.nav-right a.logout {
  background: linear-gradient(45deg, #d9534f, #c9302c);
  padding: 8px 15px;
  border-radius: 8px;
}

/* PRODUCT DETAILS BOX */
.details-container {
    margin: 60px auto;
    width: 80%;
    display: flex;
    gap: 40px;
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.15);
}

/* LEFT IMAGE */
.details-image {
    width: 45%;
}

.details-image img {
    width: 100%;
    border-radius: 15px;
    object-fit: contain;
}

/* RIGHT SIDE CONTENT */
.details-info {
    width: 55%;
}

.details-info h2 {
    font-size: 32px;
    margin-bottom: 10px;
    color: #2e4f2e;
}

.details-info p {
    font-size: 18px;
    margin: 15px 0;
}

.price-tag {
    font-size: 28px;
    font-weight: bold;
    color: #388e3c;
    margin: 10px 0 20px;
}

/* BUTTONS */
.add-cart-btn {
    background: #ffffff;
    border: 2px solid #8bcf97;
    color: #2e7d32;
    font-weight: bold;
    border-radius: 15px;
    padding: 12px 25px;
    cursor: pointer;
    font-size: 18px;
    transition: 0.3s;
}

.add-cart-btn:hover {
    background: #e8f9ec;
    transform: translateY(-3px);
}

.buy-btn {
    background: #4e9f66;
    color: white;
    padding: 12px 30px;
    border-radius: 15px;
    font-weight: bold;
    text-decoration: none;
    font-size: 18px;
    margin-left: 15px;
}

.buy-btn:hover {
    background: #6bbf85;
    transform: translateY(-3px);
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
  <div class="nav-left">
    <img src="images/logo.png">
    <h1>KP ENTERPRISES</h1>
  </div>

  <div class="nav-right">
    Welcome, <?php echo $_SESSION['username']; ?> |
    <a href="home.php">🏠 Home</a> |
    <a href="cart.php">🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a> |
    <a href="logout.php" class="logout">Logout</a>
  </div>
</div>

<!-- PRODUCT DETAILS -->
<div class="details-container">

    <div class="details-image">
        <img src="images/<?php echo $product['image']; ?>" alt="">
    </div>

    <div class="details-info">
        <h2><?php echo $product['name']; ?></h2>

        <p><strong>Description:</strong><br>
            <?php echo $product['description'] ?? "No description available."; ?>
        </p>

        <div class="price-tag">₹<?php echo $product['price']; ?></div>

        <form method="post" style="display:inline;">
            <button type="submit" name="add_to_cart" class="add-cart-btn">Add to Cart</button>
        </form>

        <a href="checkout.php?buy=<?php echo $product['id']; ?>" class="buy-btn">Buy Now</a>
    </div>

</div>

</body>
</html>
