<?php
session_start();
include 'connection.php';

$userName = "Guest";
if (isset($_SESSION['username']) && trim($_SESSION['username']) !== "") {
    $userName = $_SESSION['username'];
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove item
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $remove_id) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: cart.php");
    exit();
}

// Increase qty
if (isset($_GET['increase'])) {
    $increase_id = $_GET['increase'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $increase_id) {
            $item['quantity']++;
        }
    }
    header("Location: cart.php");
    exit();
}

// Decrease qty
if (isset($_GET['decrease'])) {
    $decrease_id = $_GET['decrease'];
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $decrease_id && $item['quantity'] > 1) {
            $item['quantity']--;
        }
    }
    header("Location: cart.php");
    exit();
}

if (isset($_POST['checkout'])) {
    header("Location: checkout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart | KP Enterprises</title>
<style>
/* 🌿 Background - Green + Cream */
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #e8ffe8, #f5f5dc, #f0f0e8);
  margin: 0;
  padding: 0;
}

/* 🌿 Navbar */
.navbar {
  background: #4e9f66;
  padding: 25px 35px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
  font-weight: 500;
  font-size: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  border-radius: 0 0 15px 15px;
}

.navbar-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

.logo {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #fff;
}

.navbar-left h1 {
  font-size: 36px; /* bigger header like home.php */
  margin: 0;
}

.navbar-right a {
  color: #fff; /* white links */
  text-decoration: none;
  margin-left: 10px;
  transition: 0.3s;
}

.navbar-right a:hover {
  color: #d8ffe0;
}

/* Logout button red gradient */
.navbar-right a.logout {
  color: #fff;
  background: linear-gradient(45deg, #d9534f, #c9302c);
  border-radius: 8px;
  padding: 8px 15px;
  text-decoration: none;
  transition: 0.3s;
}

.navbar-right a.logout:hover {
  opacity: 0.9;
}

/* 🛒 Cart container */
.container {
  max-width: 1100px;
  margin: 60px auto;
  background: #ffffff;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
  border: 3px solid #b5c99a;
  transition: transform 0.3s;
}

.container:hover {
  transform: translateY(-5px);
}

h2 {
  text-align: center;
  color: #294b31;
  font-size: 30px;
  border: 3px solid #b5c99a;
  padding: 15px;
  border-radius: 15px;
  background: #f3f7ee;
  margin-bottom: 30px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}

table {
  width: 100%;
  border-collapse: collapse;
  border: 2px solid #b5c99a;
}

th, td {
  border: 2px solid #c9deb3;
  padding: 20px;
  text-align: center;
  font-size: 16px;
  transition: background 0.3s;
}

th {
  background: #4e9f66;
  color: white;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

tr:nth-child(even) {
  background-color: #f9f9f5;
}

tr:hover td {
  background-color: #e4f2df;
}

/* Product Box */
.product-box {
  border: 1px solid #c9deb3;
  padding: 10px;
  border-radius: 12px;
  background: #f9f9f9;
  display: flex;
  align-items: center;
  gap: 15px;
}

.product-img {
  width: 70px;
  height: 70px;
  border-radius: 12px;
  object-fit: cover;
  border: 2px solid #b5c99a;
}

/* Qty Buttons */
.btn-qty {
  background: #eef7e4;
  border: 1px solid #b5c99a;
  padding: 6px 12px;
  border-radius: 50%;
  font-weight: bold;
  color: #294b31;
  text-decoration: none;
  cursor: pointer;
  transition: 0.3s;
}

.btn-qty:hover {
  background: #d9eacd;
}

/* Remove Button */
.btn-remove {
  background: #ffd6d6;
  color: #b30000;
  padding: 8px 16px;
  border-radius: 12px;
  font-weight: bold;
  text-decoration: none;
  transition: 0.3s;
  cursor: pointer;
}

.btn-remove:hover {
  background: #ffb3b3;
}

/* Total Box */
.total-box {
  margin: 30px auto 0;
  width: fit-content;
  padding: 15px 30px;
  border-radius: 15px;
  background: #eef7e4;
  border: 2px solid #b5c99a;
  font-weight: bold;
  color: #294b31;
  font-size: 22px;
  box-shadow: 0 3px 8px rgba(0,0,0,0.08);
}

/* Checkout Button */
.checkout-btn {
  display: block;
  width: 260px;
  margin: 25px auto 0;
  padding: 15px;
  background: #4e9f66;
  color: white;
  border: none;
  font-size: 18px;
  font-weight: 600;
  border-radius: 12px;
  cursor: pointer;
  transition: 0.3s;
}

.checkout-btn:hover {
  background: #6bbf85;
  transform: scale(1.05);
}
</style>
</head>

<body>

  <!-- NAVBAR -->
  <div class="navbar">
    <div class="navbar-left">
      <img src="images/logo.png" class="logo">
      <h1>KP ENTERPRISES</h1>
    </div>
    <div class="navbar-right">
      Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> |
      <a href="home.php">🏠Home</a> |
      <a href="cart.php">🛒Cart (<?php echo count($_SESSION['cart']); ?>)</a> |
      <a href="logout.php" class="logout">Logout</a>
    </div>
  </div>

  <div class="container">
    <h2>Your Cart</h2>

    <?php if (empty($_SESSION['cart'])) { ?>
      <p style="text-align:center; color:#777; font-size:18px;">Your cart is empty 😔</p>
    <?php } else { ?>

    <table>
      <tr>
        <th>Product</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>

      <?php 
      $grand_total = 0;
      foreach ($_SESSION['cart'] as $item) {
        $total = $item['price'] * $item['quantity'];
        $grand_total += $total;

        $imagePath = 'images/' . htmlspecialchars($item['image']);
        if (!file_exists($imagePath)) {
            $imagePath = 'images/noimage.png';
        }
      ?>
      <tr>
        <td><?php echo $item['name']; ?></td>
        <td><img src="<?php echo $imagePath; ?>" class="product-img"></td>
        <td>₹<?php echo $item['price']; ?></td>
        <td>
          <a href="cart.php?decrease=<?php echo $item['id']; ?>" class="btn-qty">−</a> 
          <?php echo $item['quantity']; ?>
          <a href="cart.php?increase=<?php echo $item['id']; ?>" class="btn-qty">+</a>
        </td>
        <td>₹<?php echo $total; ?></td>
        <td>
          <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn-remove">✖ Remove</a>
        </td>
      </tr>
      <?php } ?>

    </table>

    <div class="total-box">
      Grand Total: ₹<?php echo $grand_total; ?>
    </div>

    <form method="post">
      <button name="checkout" class="checkout-btn">
        Proceed to Checkout
      </button>
    </form>

    <?php } ?>
  </div>

</body>
</html>
