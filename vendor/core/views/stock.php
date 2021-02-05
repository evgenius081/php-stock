<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome-pro-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" href="/css/stock.css">
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
                        <a href="/about">About</a>
                    </li>
                    <li class="menu-item">
                        <a href="/contacts">Contacts</a>
                    </li>
                    <li class="menu-item">
                        <a href="">Stock</a>
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
            <li class="top-nav-menu-item"  id="actual-page">
                <a href="">Stock</a>
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
    <main id='main'>
        <section id="stock-search">
            <div class="search">
                <input type="text" name="search-input" placeholder="Type something...">
            </div>
        </section>
        <form id="stock-form" action="" method="POST">
            <section id="stock-gallery">
                <section id="stock-gallery-container"></section>
                    <?php
                    echo "<section id='stock-pagination'>";
                        $current = $this->var['page'];
                        if($current == 1){
                            echo '<a style="background-color: #757575;" class="prev page-numbers"><i class="far fa-arrow-left"></i></a>
                    <div>
                    <span class="page-numbers current">1</span>
                    ';
                        }else if($current == 2){
                            echo '<a class="prev page-numbers" href="/stock"><i class="far fa-arrow-left"></i></a>
                                <div>
                                <a href="/stock">1</a>
                                ';
                        }else{
                            echo    '<a class="prev page-numbers" href="/stock/' . ($current - 1) . '"><i class="far fa-arrow-left"></i></a>
                                    <div>
                                    <a class="page-numbers" href="/stock">1</a>
                                    ';
                        }
                        for($i = 2; $i<=$this->var['pagesNumber']; $i++ ){
                            if($i != $current){
                                echo '<a class="page-numbers" href="/stock/'. $i .'">' . $i .'</a>';
                            }else{
                                echo "<span class='page-numbers current'>". $current ."</span>";
                            }
                        }
                        if($current != $this->var['pagesNumber']){
                            echo '</div>
                                    <a class="next page-numbers" href="/stock/' . ($current + 1) . '"><i class="far fa-arrow-right"></i></a>';
                        }else{
                            echo '</div>
                                <a style="background-color: #757575;" class="next page-numbers"><i class="far fa-arrow-right"></i></a>';
                        }
                        echo "                </section>";
                        ?>
            </section>
                <?php if(isset($_SESSION['token'])) echo '<section id="stock-controls">
            <a href="/upload">Upload</a>
            <input type="submit" value="Add chosen"></input>
                        </section>';?>
        </form>
    </main>
    <footer>
        <section id="footer-wrapper"> 
            <div class="footer-list" id="list1">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="http://p444828q.beget.tech">Blog</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contacts">Contacts</a></li>
                    <li><a href="">Stock</a></li>
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
            &copy;2021 Evgenius081 | All rights reserved(nope)
        </section>
    </footer>
    <script src="/js/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="/js/jquery-ui-1.12.1/jquery-ui.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/stock.js"></script>
    <script src="/js/search.js"></script>
    <script src="/js/simplebar.js"></script>
</body>
</html>