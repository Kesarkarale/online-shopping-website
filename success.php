<?php
session_start();

// Order confirm झाल्यावर cart रिकामी
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Order Success | KP Enterprises</title>

<style>

    /* 🌿 Background */
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg,#e8ffe8,#f5f5dc,#f0f0e8);
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

    /* 🔴 Logout Button */
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

    /* ⭐ Success Box */
    .center-box {
        max-width: 650px;
        margin: 130px auto;
        background: white;
        border-radius: 20px;
        padding: 50px;
        text-align: center;
        border: 3px solid #b5c99a;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    }

    .center-box h1 {
        font-size: 28px;
        color: #2d6a4f;
        margin-bottom: 20px;
    }

    .tick {
        font-size: 70px;
        color: #4e9f66;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .home-btn {
        background:#4e9f66;
        padding:12px 25px;
        border-radius:12px;
        color:white;
        text-decoration:none;
        font-size:18px;
        transition:0.3s;
    }

    .home-btn:hover {
        background:#6bbf85;
        transform:scale(1.05);
    }

</style>
</head>

<body>

<!-- 🌿 Navbar -->
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

<!-- ⭐ Success Box -->
<div class="center-box">
    <div class="tick">✔</div>
    <h1>Your order has been successfully placed!</h1>

    <a href="home.php" class="home-btn">Back to Home</a>
</div>

</body>
</html>

