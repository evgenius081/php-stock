<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-pro-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.css">
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css">
    <link rel="shortcut icon" href="/img/fav.png" type="image/x-icon">
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
                        <a href="/">Home</a>
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
                </ul>
            </li>
            <li class="top-nav-menu-item">
                <a href="/">Home</a>
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
        </ul>
    </nav>
    <main id="main">
        <section id="popup-container">
            <div class="form-container">
                <form method="POST" id="registration_form">
                    <h3>Sign in</h3>
                    <label for="login">
                        <input type="text" class="login" name="userlogin" id="reg-login" required>
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <span class="label">Login</span>
                    </label>
                    <label for="email">
                        <input type="text" class="email" name="email" id="reg-email" required>
                        <span class="icon"><i class="fal fa-envelope"></i></span>
                        <span class="label">Email</span>
                    </label>
                    <label for="password">
                        <input type="password" id="reg-password" class="password" name="password" required>
                        <span class="icon"><i class="fa fa-lock"></i></span>    
                        <span class="label">Password</span>
                    </label>
                    <label for="confirm-password">
                        <input type="password" id="confirm-password" class="confirm-password" name="confirm-password" required>
                        <span class="icon"><i class="fa fa-lock"></i></span>    
                        <span class="label">Confirm password</span>
                    </label>
                    <button type="submit" class="sign-in" name="signin" disabled="true">Sign in</button>
                    <a href="login" title="Login" id="enter">Login</a>
                </form>
            </div>
        </section>
    </main>
    <footer>
            <section id="footer-wrapper"> 
                <div class="footer-list" id="list1">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="http://p444828q.beget.tech">Blog</a></li>
                        <li><a href="about">About</a></li>
                        <li><a href="contacts">Contacts</a></li>
                        <li><a href="stock">Stock</a></li>
                    </ul>
                </div>
                <div class="footer-list" id="list2">
                    <ul>
                        <li>ul. Grunwaldska, 81, Gdańsk, Polska</li>
                        <li>+48730858675</li>
                        <li>guleichzhenya@gmail.com</li>
                        <li>Pn - Pt 10.00 - 18.00</li>
                    </ul>
                </div>
                <div class="footer-list" id="soc-net">
                    <div id="list-socials">
                        <a href="https://www.facebook.com/profile.php?id=100016544251212" rel="nofollow"><i style="background: #3c5a9a;" class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/gulevichzhenya" rel="nofollow"><i style="background: #58ccff;" class="fab fa-twitter"></i></a>
                        <a href="https://vk.com/id393642414" rel="nofollow"><i style="color: #4A76A8" class="fab fa-vk fa-2x"></i></a>
                    </div>
                </div>
            </section>
            <div id="socials">
                <a href="https://www.facebook.com/profile.php?id=100016544251212" rel="nofollow"><i style="background: #3c5a9a;" class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/gulevichzhenya" rel="nofollow"><i style="background: #58ccff;" class="fab fa-twitter"></i></a>
                <a href="https://vk.com/id393642414" rel="nofollow"><i style="color: #4A76A8" class="fab fa-vk fa-2x"></i></a>
            </div>
            <section id="copyright">
                &copy;2020 Evgenius081 | All rights reserved(nope)
            </section>
        </footer>
        <script src="js/jquery-3.5.1.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
        <script src="js/script.js"></script>
        <script src="js/simplebar.js"></script>
    </body>
</html>