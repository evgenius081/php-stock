<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet</title>
    <link rel="stylesheet" href="/css/simplebar.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/cabinet.css">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-pro-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/js/jquery-ui-1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/css/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/css/jquery-ui.theme.css">
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
                        <a href="/about">About</a>
                    </li>
                    <li class="menu-item">
                        <a href="/contacts">Contacts</a>
                    </li>
                    <li class="menu-item">
                        <a href="/stock">Stock</a>
                    </li>
                    <li class="login">
                        <i class="/fal fa-user fa-2x"></i>
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
                <a href="/about">About</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="/contacts">Contacts</a>
            </li>
            <li class="top-nav-menu-item">
                <a href="/stock">Stock</a>
            </li>
            <?php
            ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION['token'])){
        echo  '    
        <header>
            <h1>Hello, '.$_SESSION['creator'].'</h1>
        </header>
        <main id="main">
            <section id="favourite-images-container">
            <h2>Chosen images</h2>
            ';
            if(isset($this->var['images']) && !empty($this->var['images'])){
                echo '<form method="POST" id="favourite-images-form">
                <section id="favourite-images">
                ';
                $images = $this->var["images"];
                foreach($images as $image){
                    echo "<article class='favourite-item'>
                            <img src='/images/mini_".$image['name']."' alt='".$image['name']."'>
                            <a href='/image/wm_".$image['name']."' target='blank'>
                                <div class='image-info'>
                                    <div class='image-text'>
                                        <p class='image-title'>".$image["title"]."</p>
                                        <p class='image-author'>by: ".$image['author']."</p>
                                    </div>
                                    <div class='heart-container'><input type='checkbox' class='favourites' title='Add to favourites' name='".$image['_id']."' value='".$image['_id']."'> <i style='color: #fff; background: none;' class='fas fa-heart'></i></div></div></a></article>";
                }
                echo '            </section><input type="submit" value="Delete unchosen" id="delete-chosen" name="deleteChosen">
                </form>';
            }else{
                echo "<p style='margin-top: 20px;'>Sorry, no images chosen</p>";
            }
            echo '
            </section>
            <section id="logout">
                <a id="logout-a" href="/logout">Logout</a>
            </section>
        </main>';
    }else{
        echo "<main id='main'><div class='modal'><p>You aren`t logged in!</p><i class='fal fa-times fa-2x'></i></div></main>"; 
        }?>
    <footer>
        <section id="footer-wrapper"> 
            <div class="footer-list" id="list1">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="http://p444828q.beget.tech">Blog</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contacts">Contacts</a></li>
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
    <script src="js/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/script.js"></script>
    <script src="js/cabinet.js"></script>
    <script src="js/simplebar.js"></script>
</body>
</html>