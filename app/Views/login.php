<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LDU Monitoring System</title>

<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins', sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:
        linear-gradient(rgba(15,80,52,0.88), rgba(15,80,52,0.88)),
        url("<?= base_url('assets/images/bg.jpg') ?>");
    background-size:cover;
    background-position:center;
    padding:20px;
}

.login-container{
    width:100%;
    max-width:950px;
    min-height:520px;
    display:grid;
    grid-template-columns:1.1fr 0.9fr;
    background:#ffffff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,0.25);
}

.left-panel{
    background:linear-gradient(135deg,#2e7d5a,#3d9970);
    color:#fff;
    padding:45px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    position:relative;
}

.left-panel::after{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    background:rgba(255,255,255,0.12);
    border-radius:50%;
    bottom:-70px;
    right:-60px;
}

/* ✅ UPDATED LOGO ANIMATION */
.left-panel img{
    width:105px;
    height:105px;
    object-fit:contain;
    background:#fff;
    padding:8px;
    border-radius:50%;
    margin-bottom:25px;
    animation:floatLogo 4s ease-in-out infinite;
}

@keyframes floatLogo{
    0%,100%{
        transform:translateY(0px) scale(1);
    }
    50%{
        transform:translateY(-10px) scale(1.03);
    }
}

.left-panel h1{
    font-size:32px;
    line-height:1.25;
    margin-bottom:12px;
}

.left-panel p{
    font-size:15px;
    line-height:1.7;
    opacity:0.95;
    max-width:420px;
}

.right-panel{
    padding:45px 40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.system-title{
    font-size:26px;
    font-weight:700;
    color:#245c43;
    margin-bottom:6px;
}

.system-subtitle{
    font-size:14px;
    color:#777;
    margin-bottom:28px;
}

.alert{
    background:#fff1f1;
    color:#b00020;
    border-left:4px solid #b00020;
    padding:12px 14px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px;
    text-align:left;
}

.input-group{
    position:relative;
    margin-bottom:18px;
}

.input-group label{
    display:block;
    font-size:13px;
    font-weight:500;
    color:#444;
    margin-bottom:7px;
}

.input-wrapper{
    position:relative;
}

.input-wrapper i{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    color:#777;
    font-size:14px;
}

.form-control{
    width:100%;
    padding:13px 14px 13px 42px;
    border:1px solid #dcdcdc;
    border-radius:12px;
    font-size:14px;
    outline:none;
    transition:0.3s;
}

.form-control:focus{
    border-color:#3d9970;
    box-shadow:0 0 0 4px rgba(61,153,112,0.15);
}

.form-options{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:13px;
    margin-bottom:22px;
    color:#666;
}

.form-options label{
    display:flex;
    align-items:center;
    gap:6px;
}

.form-options a{
    color:#2e7d5a;
    text-decoration:none;
    font-weight:500;
}

.btn{
    width:100%;
    padding:14px;
    background:#2e7d5a;
    color:#fff;
    border:none;
    border-radius:12px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.btn:hover{
    background:#246648;
    transform:translateY(-1px);
}

.footer{
    margin-top:25px;
    font-size:12px;
    color:#888;
    text-align:center;
}

@media(max-width:768px){
    .login-container{
        grid-template-columns:1fr;
    }

    .left-panel{
        text-align:center;
        align-items:center;
        padding:35px 25px;
    }

    .left-panel h1{
        font-size:26px;
    }

    .right-panel{
        padding:35px 25px;
    }
}
</style>
</head>

<body>

<div class="login-container">

    <div class="left-panel">
        <img src="<?= base_url('assets/images/denr-logo.gif') ?>" alt="DENR Logo">

        <h1>Learning and Development Unit</h1>

        <p>
            A secure monitoring system designed to manage training records,
            monitor learning activities, and support efficient personnel development.
        </p>
    </div>

    <div class="right-panel">

        <div class="system-title">LDU Monitoring System</div>
        <div class="system-subtitle">DENR Region VI | Authorized Access Only</div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert">
                <i class="fa fa-circle-exclamation"></i>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('login') ?>">

            <div class="input-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>

            <button type="submit" class="btn">
                <i class="fa fa-right-to-bracket"></i> Login
            </button>

        </form>

        <div class="footer">
            © <?= date('Y') ?> DENR Region VI. All rights reserved.
        </div>

    </div>

</div>

</body>
</html>