  <?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="3;url=home.php">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loading | KP Enterprises</title>

<style>
    *{margin:0;padding:0;box-sizing:border-box;}

    body{
        height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        overflow:hidden;
        background:#e5f3e6;
        font-family:'Poppins',sans-serif;
        position:relative;
    }

    /* 🔥 Green Animated Background */
    .bg {
        position:absolute;
        width:200%;
        height:200%;
        background:linear-gradient(135deg,#daf5d6,#faf7eb,#e3f4df);
        animation:rotateBg 10s linear infinite;
        z-index:-1;
    }

    @keyframes rotateBg {
        0%{transform:rotate(0deg);}
        50%{transform:rotate(180deg);}
        100%{transform:rotate(360deg);}
    }

    /* 🔥 Glass Loading Card */
    .loader-box{
        width:480px;
        padding:50px 60px;
        text-align:center;
        border-radius:25px;
        background:rgba(255,255,255,0.45);
        backdrop-filter:blur(20px);
        box-shadow:0 10px 40px rgba(0,0,0,0.18);
        position:relative;
        animation:fadeIn 1.2s ease-in-out forwards;
    }

    /* 🔥 Soft Green Neon Border */
    .loader-box::after{
        content:"";
        position:absolute;
        inset:0;
        border-radius:25px;
        padding:2px;
        background:linear-gradient(135deg,#f7f6ed,#e8f5e1,#f2f1e7);
        -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
        -webkit-mask-composite:xor;
        animation:neon 3s infinite linear;
        pointer-events:none;
        z-index:-1;
    }

    @keyframes neon {
        0%{opacity:0.4;filter:blur(3px);}
        50%{opacity:1;filter:blur(6px);}
        100%{opacity:0.4;filter:blur(3px);}
    }

    @keyframes fadeIn {
        from{opacity:0;transform:scale(0.9);}
        to{opacity:1;transform:scale(1);}
    }

    /* 🔥 Logo Glow */
    .loader-box img{
        width:120px;
        height:120px;
        border-radius:50%;
        animation:glow 3s infinite ease-in-out;
    }

    @keyframes glow {
        0%{filter:drop-shadow(0 0 5px #7ba968);}
        50%{filter:drop-shadow(0 0 20px #a9e39d);}
        100%{filter:drop-shadow(0 0 5px #7ba968);}
    }

    .loader-box h2{
        margin-top:20px;
        font-size:22px;
        color:#2d402d;
        letter-spacing:1.5px;
        animation:fadeText 3s infinite;
    }

    @keyframes fadeText {
        0%,100%{opacity:0.8;}
        50%{opacity:1;}
    }
</style>
</head>

<body>
    <div class="bg"></div>

    <div class="loader-box">
        <img src="images/logo.png">
        <h2>Loading KP Enterprises...</h2>
    </div>

</body>
</html>

