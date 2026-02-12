 <?php
session_start();
include 'connection.php';

// If user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Calculate grand total
$grand_total = 0;

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $grand_total += $item['price'] * $item['quantity'];
    }
}

// Confirm Order → Success Page
if (isset($_POST['confirm_order'])) {
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout | KP Enterprises</title>

<style>

    /* 🌿 Elegant Background */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e8ffe8, #f5f5dc, #f0f0e8);
      margin: 0;
      padding: 0;
      color: #2f2f2f;
    }

    /* 🌿 Navbar */
    .navbar {
      background: #4e9f66; 
      color: white;
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .navbar a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
      font-weight: 500;
    }

    .navbar a:hover {
      text-decoration: underline;
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



    /* 🌿 Main Checkout Page Container */
    .main-container {
        max-width: 800px;
        margin: 50px auto;
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
        border: 3px solid #cde5c1;
        text-align: center;
    }

    .heading {
        background: #f3f7ee;
        padding: 15px;
        border-radius: 15px;
        border: 2px solid #b5c99a;
        font-size: 28px;
        color: #294b31;
        margin-bottom: 30px;
        font-weight: 600;
    }

    /* Grand Total Box */
    .grand-total-box {
        background: #eef7e4;
        border: 2px solid #b5c99a;
        padding: 20px;
        border-radius: 14px;
        margin-bottom: 25px;
    }

    .grand-total-box h3 {
        margin: 0;
        font-size: 22px;
        color: #2d6a4f;
    }

    .total-amount {
        margin-top: 10px;
        font-size: 32px;
        font-weight: bold;
        color: #2e7d32;
    }

    /* Button */
    button {
        width: 90%;
        padding: 14px;
        background: #4e9f66;
        color: white;
        font-size: 20px;
        border: none;
        font-weight: 600;
        border-radius: 15px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
    }

    button:hover {
        background: #6bbf85;
    }
   .logout-btn {
    background: #d9534f;
    padding: 8px 15px;
    border-radius: 8px;
    color: #fff !important;
    font-weight: 600;
    border: 2px solid #b52b27;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #c9302c;
    border-color: #a0211d;
}

</style>
</head>

<body>

<!-- 🔹 Navbar -->
 <div class="navbar">
  
  <div class="nav-left">
    <img src="images/logo.png" alt="logo">
    <h1>KP ENTERPRISES</h1>
  </div>

    <div class="nav-right">
        Welcome, <?php echo $_SESSION['username']; ?> |
        <a href="home.php">🏡 Home</a> |
        <a href="cart.php">🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a> |
         <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<!-- 🌿 Main Content -->
<div class="main-container">

    <div class="heading">Checkout</div>

    <div class="grand-total-box">
        <h3>Grand Total</h3>
        <div class="total-amount">₹ <?php echo number_format($grand_total, 2); ?></div>
    </div>

    <form method="POST">
        <button type="submit" name="confirm_order">Confirm Order</button>
    </form>

</div>

</body>
</html>






