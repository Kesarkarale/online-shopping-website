 <?php
include 'connection.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "✅ Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | KP Enterprises</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Poppins',sans-serif;
    overflow:hidden;
    position:relative;
}

/* 🔥 Rotating Green Background (Same as Login + Loading) */
.bg{
    position:absolute;
    width:200%;
    height:200%;
    background:linear-gradient(135deg,#daf5d6,#faf7eb,#e3f4df);
    animation:rotateBg 10s linear infinite;
    z-index:-1;
}

@keyframes rotateBg{
    0%{transform:rotate(0deg);}
    50%{transform:rotate(180deg);}
    100%{transform:rotate(360deg);}
}

/* 🔥 Register Box (Glass + Glow Border) */
.register-box{
    width:460px;
    padding:40px;
    border-radius:25px;
    background:rgba(255,255,255,0.45);
    backdrop-filter:blur(20px);
    box-shadow:0 10px 40px rgba(0,0,0,0.18);
    text-align:center;
    position:relative;
    animation:fadeIn 1.2s ease-in-out forwards;
}

/* Neon Glow Border */
.register-box::after{
    content:"";
    position:absolute;
    inset:0;
    border-radius:25px;
    padding:2px;
    background:linear-gradient(135deg,#f7f6ed,#e8f5e1,#f2f1e7);
    -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
    -webkit-mask-composite:xor;
    animation:neon 3s infinite linear;
    z-index:-1;
    pointer-events:none;
}

@keyframes neon{
    0%{opacity:0.4;filter:blur(3px);}
    50%{opacity:1;filter:blur(6px);}
    100%{opacity:0.4;filter:blur(3px);}
}

@keyframes fadeIn{
    from{opacity:0;transform:scale(0.9);}
    to{opacity:1;transform:scale(1);}
}

/* Logo Glow */
.logo{
    width:85px;
    height:85px;
    border-radius:50%;
    animation:glow 3s infinite ease-in-out;
}

@keyframes glow{
    0%{filter:drop-shadow(0 0 5px #7ba968);}
    50%{filter:drop-shadow(0 0 20px #a9e39d);}
    100%{filter:drop-shadow(0 0 5px #7ba968);}
}

h2{
    margin:15px 0;
    font-size:26px;
    font-weight:700;
    color:#2d402d;
}

/* Input */
input{
    width:90%;
    padding:12px;
    margin:10px 0;
    background:#f7f9f2;
    border:none;
    border-radius:12px;
    font-size:16px;
    outline:none;
    transition:0.3s;
    box-shadow:0 0 5px rgba(150,180,120,0.4);
}

input:focus{
    transform:scale(1.04);
    box-shadow:0 0 10px rgba(120,150,100,0.7);
}

/* Button */
button{
    width:100%;
    padding:12px;
    border:none;
    background:#96c877;
    color:white;
    font-size:18px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.06);
    background:#82b56a;
    box-shadow:0 5px 20px rgba(120,150,100,0.4);
}

/* Message */
.message{
    margin-top:15px;
    font-size:15px;
    color:#2d402d;
}

/* Footer */
.footer-text{
    margin-top:15px;
    font-size:14px;
}

.footer-text a{
    color:#405b2c;
    font-weight:600;
    text-decoration:none;
}
.footer-text a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<div class="bg"></div>

<div class="register-box">
    <img src="images/logo.png" class="logo">
    <h2>Create Account</h2>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>

    <div class="message"><?php echo $message; ?></div>

    <div class="footer-text">
        Already have an account? <a href="login.php">Login here</a>
    </div>
</div>

</body>
</html>


