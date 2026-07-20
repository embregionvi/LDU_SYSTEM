<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= esc($title ?? 'LDU SYSTEM') ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family:'Segoe UI', sans-serif;
}

.sidebar{
    width:250px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    background:linear-gradient(180deg, #3d9970, #2e7d5a);
    padding:20px;
    z-index:1000;
    display:flex;
    flex-direction:column;
    border-right:1px solid rgba(255,255,255,0.15);
    overflow-y:auto;
    transition:0.3s ease;
}

.sidebar,
.sidebar *{
    color:#ffffff !important;
}

.sidebar-header{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:20px;
}
.sidebar-header img{
    width:52px;
    height:52px;
    object-fit:contain;
    background:transparent;
    padding:0;
    animation:floatLogo 4s ease-in-out infinite;
}

/* FLOATING LOGO ANIMATION */
@keyframes floatLogo{

    0%,100%{
        transform:translateY(0px) scale(1);
    }

    50%{
        transform:translateY(-10px) scale(1.03);
    }
}
.sidebar-header h4{
    margin:0;
    font-size:20px;
    font-weight:bold;
}

.sidebar hr{
    border:none;
    border-top:1px solid rgba(255,255,255,0.2);
    margin:12px 0 18px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 14px;
    margin-bottom:6px;
    text-decoration:none;
    border-radius:10px;
    background:transparent;
    font-weight:500;
    transition:0.25s ease;
    position:relative;
    overflow:hidden;
}

.sidebar a::before{
    content:'';
    position:absolute;
    left:0;
    top:0;
    width:4px;
    height:100%;
    background:#ffffff;
    transform:scaleY(0);
    transition:0.25s ease;
}

.sidebar a:hover::before,
.sidebar a.active::before{
    transform:scaleY(1);
}

.sidebar a:hover{
    background:rgba(255,255,255,0.12);
}

.sidebar a.active{
    background:#1f5c45;
    font-weight:600;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

.sidebar a i{
    min-width:18px;
    color:#d9f7ea !important;
}

.logout-form{
    margin-top:auto;
}

.logout-btn{
    width:100%;
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 14px;
    border:none;
    border-radius:10px;
    background:transparent;
    color:#ffe3e3 !important;
    font-weight:500;
    text-align:left;
    transition:0.25s ease;
}

.logout-btn:hover{
    background:rgba(255,255,255,0.12);
}

.logout-btn i{
    min-width:18px;
    color:#ffe3e3 !important;
}

.sidebar-footer{
    margin-top:15px;
    text-align:center;
    opacity:0.75;
    font-size:12px;
}

.main-content{
    margin-left:250px;
    min-height:100vh;
    background:#f8fafc;
    padding:30px;
    transition:0.3s ease;
}

.content-wrapper{
    background:#ffffff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 4px 15px rgba(0,0,0,0.04);
    min-height:calc(100vh - 60px);
}

.menu-toggle{
    border:none;
    background:#2e7d5a;
    color:#ffffff;
    width:42px;
    height:42px;
    border-radius:10px;
    display:none;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
}

.sidebar::-webkit-scrollbar{
    width:6px;
}

.sidebar::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,0.3);
    border-radius:10px;
}

.sidebar::-webkit-scrollbar-track{
    background:transparent;
}

@media (max-width:768px){

    .sidebar{
        transform:translateX(-100%);
        width:250px;
    }

    .sidebar.show{
        transform:translateX(0);
    }

    .main-content{
        margin-left:0;
        padding:20px;
    }

    .menu-toggle{
        display:flex;
    }

    .content-wrapper{
        padding:20px;
    }
}

</style>
</head>

<body>

<?php

$path = trim(service('uri')->getPath(), '/');

function is_active($path, $routes)
{
    foreach ((array) $routes as $route) {

        $route = trim($route, '/');

        if ($path === $route || str_starts_with($path, $route . '/')) {
            return true;
        }
    }

    return false;
}

?>

<div class="sidebar" id="sidebar">

    <div class="sidebar-header">
        <img src="<?= base_url('assets/images/denr-logo.gif') ?>" alt="Logo">
        <h4>LDU SYSTEM</h4>
    </div>

    <hr>

    <a href="<?= base_url('dashboard') ?>" class="<?= is_active($path, ['dashboard']) ? 'active' : '' ?>">
        <i class="fa-solid fa-gauge-high"></i>
        <span>Dashboard</span>
    </a>

    <a href="<?= base_url('employees') ?>" class="<?= is_active($path, ['employees']) ? 'active' : '' ?>">
        <i class="fa-solid fa-users"></i>
        <span>Employees</span>
    </a>

    <a href="<?= base_url('documents') ?>" class="<?= is_active($path, ['documents']) ? 'active' : '' ?>">
        <i class="fa-solid fa-folder-open"></i>
        <span>Document Tracking</span>
    </a>

    <a href="<?= base_url('learning-events') ?>" class="<?= is_active($path, ['learning-events']) ? 'active' : '' ?>">
        <i class="fa-solid fa-book-open-reader"></i>
        <span>Learning Events Attended</span>
    </a>

    <a href="<?= base_url('learning-events-conducted') ?>" class="<?= is_active($path, ['learning-events-conducted']) ? 'active' : '' ?>">
        <i class="fa-solid fa-person-chalkboard"></i>
        <span>Learning Events Conducted</span>
    </a>

    <a href="<?= base_url('events') ?>" class="<?= is_active($path, ['events']) ? 'active' : '' ?>">
        <i class="fa-solid fa-calendar-days"></i>
        <span>Event Tracking</span>
    </a>

    <a href="<?= base_url('trainings/cos-database') ?>" class="<?= is_active($path, ['trainings/cos-database']) ? 'active' : '' ?>">
        <i class="fa-solid fa-database"></i>
        <span>COS Training Database</span>
    </a>

    <hr>

    <form method="post" action="<?= base_url('logout') ?>" class="logout-form">
        <?= csrf_field() ?>

        <button type="submit" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </button>
    </form>

    <div class="sidebar-footer">
        LDU System v1.0
    </div>

</div>

<div class="main-content">

    <button class="menu-toggle" id="menuToggle">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');

menuToggle.addEventListener('click', function(){
    sidebar.classList.toggle('show');
});

</script>

</body>
</html>