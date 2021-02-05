<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaceShop</title>
    <link rel="stylesheet" href="css/simplebar.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome-pro-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css">
    <link rel="shortcut icon" href="img/fav.png" type="image/x-icon">
    </head>
<body>
    <nav>
        <ul id="top-nav-menu">
            <li class="top-nav-menu-item"  id="hamburger-menu">
                <input id="menu-toggle" type="checkbox" />
                <label class="menu-btn" for="menu-toggle">
                    <span></span>
                </label>
                <ul id="menu-box">
                    <li class="menu-item">
                        <a href="">Home</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://p444828q.beget.tech">Blog</a>
                    </li>
                    <li class="menu-item">
                        <a href="about">About</a>
                    </li>
                    <li class="menu-item">
                        <a href="contacts">Contacts</a>
                    </li>
                    <li class="menu-item">
                        <a href="stock">Stock</a>
                    </li>
                    <?php
            if(isset($_SESSION['token'])){  
                echo "
                <li class='top-nav-menu-item login' id='menu-login'>
                        <a href='/cabinet'><i class='fas fa-user'></i></a>
                    </li>";
            }else{
                echo "<li class='top-nav-menu-item login' id='menu-login'>
                        <a href='/login'><i class='fal fa-user'></i></a>
                    </li>";
            }
            ?>
                </ul>
            </li>
            <li class="top-nav-menu-item" id="actual-page">
                <a href="">Home</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="http://p444828q.beget.tech">Blog</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="about">About</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="contacts">Contacts</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="stock">Stock</a>
            </li>
            <?php
            if(isset($_SESSION['token'])){ 
                echo "
                <li class='top-nav-menu-item login' id='login'>
                        <a href='/cabinet'><i class='fas fa-user'></i></a>
                    </li>";
            }else{
                echo "<li class='top-nav-menu-item login' id='login'>
                        <a href='/login'><i class='fal fa-user'></i></a>
                    </li>";
            }
            ?>
        </ul>
    </nav>