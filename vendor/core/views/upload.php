<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/upload.css">
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
    <main id='main'>
        <section>
            <form id="upload-form" method="POST" action="" enctype="multipart/form-data">
                <section id="upload-container">
                <i class="fas fa-file-upload fa-10x"></i>
                    <input id="userfile" type="file" name="userfile" multiple>
                    <label for="userfile">Choose file</label>
                    <span>or drag it here</span>
                </section>
                <section id="upload-controls">
                    <label for="watermark">
                        <input type="text" class="watermark" name="watermark" required>
                        <span class="icon"><i class="fas fa-stamp"></i></span>
                        <span class="label">Watermark</span>
                    </label>
                    <label for="name">
                        <input type="text" class="title" name="title" required>
                        <span class="icon"><i class="far fa-heading"></i></span>
                        <span class="label">Title</span>
                    </label>
                    <label for="author">
                        <input type="text" class="author" name="author" required <?php if(isset($_SESSION['token'])) echo "value='".$_SESSION['creator']."'";?>>
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <span class="label">Author</span>
                    </label>
                    <?php if(isset($_SESSION['token'])){
                     echo '<div id="access">
                     <div class="radio">
                         <input class="custom-radio" type="radio" id="private" name="access" value="private">
                         <label for="private">Private</label>
                     </div>                
                     <div class="radio">
                         <input class="custom-radio" type="radio" id="public" name="access" value="public" checked>
                         <label for="public">Public</label>
                     </div>
                 </div>';   
                    }else{
                        
                    }?>
                    <input type="submit" name="submit" value="Submit">
                </section>
            </form>
        </section>
        <div id="modal-size" class="modal"><p>File is too heavy(</p><i class="fal fa-times fa-2x"></i></div>
        <div id="modal-type" class="modal"><p>Wrong type(</p><i class="fal fa-times fa-2x"></i></div>
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
       <script src="/js/script.js"></script>
       <script src="/js/upload.js"></script>
    <script src="/js/simplebar.js"></script>
</body>
</html>