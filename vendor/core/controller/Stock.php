<?php

namespace core\Controller;

class Stock extends \core\Controller{

    public function index(){
        $stock = new \core\Models\Stock();
        $images = $stock->getImages(1, 12);
//        $stock = new \core\Models\Stock();
//        $chosen = [];
//        if(isset($_POST)){
//            foreach($_POST as $image){
//                $_SESSION[$image] = $image;
//            }
//        }
//        foreach($_SESSION as $image=>$name){
//            if($image != 'uid' && $image != 'creator'&& $image != 'token' && $image != '' && $image != 'admin'  ){
//                $chosen[$image] = $image;
//            }
//        }
        //        foreach($images as $image=>$name){
//            if($name['access'] === 'private'){
//                if(isset($_SESSION['token'])){
//                    if($_SESSION['creator'] != $name['author']){
//                        unset($images[$image]);
//                    }
//                }else{
//                    unset($images[$image]);
//                }
//            }
//        }
//        $images = $stock->getImages(12, 1);
//        $this->view('stock', ["page" => 1, 'images' => $images, 'chosen' => $chosen, 'pagesNumber' => ceil(count($stock->getPagesNumber())/12)]);
        $this->view('stock', ["page" => 1, 'images' => $images, 'pagesNumber' => ceil($stock->getImagesNumer()/12)]);
    }

    public function image($params){
        $this->view('image', ['image' => $params[0]]);
    }

    public function page($params){
        $stock = new \core\Models\Stock();
        $images = $stock->getImages($params[0], 12);
        $this->view('stock', ["page" => $params[0],'images' => $images, 'pagesNumber' => ceil($stock->getImagesNumer()/12)]);
//        if(isset($_POST)){
//            foreach($_POST as $image){
//                $_SESSION[$image] = $image;
//            }
//        }
//        $chosen = [];
//        foreach($_SESSION as $image=>$name){
//            if($image != 'uid' && $image != 'creator'&& $image != 'token' && $image != '' && $image != 'admin'  ){
//                $chosen[$image] = $image;
//            }
//        }
//        $images = $stock->getImages(12, $params[0]);
//        foreach($images as $image=>$name){
//            if($name['access'] === 'private'){
//                if(isset($_SESSION['token'])){
//                    if($_SESSION['creator'] != $name['author']){
//                        unset($images[$image]);
//                    }
//                }else{
//                    unset($images[$image]);
//                }
//            }
//        }
        $this->view('stock', ["page" => $params[0],'images' => $images]);
    }

    public function ajaxSearchByTitle(){
        $stock = new \core\Models\Stock();
        foreach($_GET as $get=>$name){
            $images = $stock->getIamgesByTitle($name);
            $text = '';
//            $chosen = [];
//            foreach($_SESSION as $image=>$name){
//                if($image != 'uid' && $image != 'creator'&& $image != 'token' && $image != '' && $image != 'admin'  ){
//                    $chosen[$image] = $image;
//                }
//            }
//            foreach($images as $image=>$name){
//                if($name['access'] === 'private'){
//                    if(isset($_SESSION['token'])){
//                        if($_SESSION['creator'] != $name['author']){
//                            unset($images[$image]);
//                        }
//                    }else{
//                        unset($images[$image]);
//                    }
//                }
//            }
            foreach($images as $image){
                $text += $this->view('parts/img', ['image' => $image, 'chosen' => $chosen]);
            }
           echo $text;
       }
    }

    public function ajaxGetAll(){
        $stock = new \core\Models\Stock();
        $images = $stock->getImages(12, $_GET['page']);
        $text = '';
        $chosen = [];
        foreach($_SESSION as $image=>$name){
            if($image != 'uid' && $image != 'creator'&& $image != 'token' && $image != '' && $image != 'admin'  ){
                $chosen[$image] = $image;
            }
        }
        foreach($images as $image=>$name){
            if($name['access'] === 'private'){
                if(isset($_SESSION['token'])){
                    if($_SESSION['creator'] != $name['author']){
                        unset($images[$image]);
                    }
                }else{
                    unset($images[$image]);
                }
            }
        }
        foreach($images as $image){
            $text += $this->view('parts/img', ['image' => $image, 'chosen' => $chosen]);
        }
        echo $text;
    }

    public function upload(){
        if(isset($_POST['submit'])){
            $stock = new \core\Models\Stock();

            $img_url = $_FILES['userfile']['name'];
            $tmp_name_img= $_FILES['userfile']['tmp_name'];
            $img_size = $_FILES['userfile']['size'];
            $username = $_POST['author'];
            $userwatermark = $_POST['watermark'];
            $usertitle = $_POST['title'];

            $img_url1= basename(self::translit($img_url));
            $path = '../../public/images/'; 
            $file_type = substr($img_url1, strrpos($img_url1, '.')+1); 
            $pos = strpos($img_url1, ".");
            $fn = substr($img_url1, 0, $pos);
            $file_name = $fn;
            $img_url1=$file_name.(self::getRandomFileName($path, $file_type)).'.'.$file_type;

            if (move_uploaded_file($tmp_name_img, "$path$img_url1")) {
                $new_file_name = $path . $img_url1;
                if (($file_type == 'png') || ($file_type == 'PNG')) {
                    $orig = imagecreatefrompng($new_file_name);
                    imagepng($orig, $new_file_name, 0);
                    imagedestroy($orig);

                    $wm = imagecreatefrompng($new_file_name);
                    $this->makeWaterMark($userwatermark, $wm, $path, $img_url1);

                    $image = imagecreatefrompng($new_file_name);
                    $this->makeThumbnail($image, $path, $img_url1, $new_file_name);
                }
                if (($file_type == 'jpg') || ($file_type == 'JPG') || ($file_type == 'jpeg') || ($file_type == 'JPEG')) {
                    $orig = imagecreatefromjpeg($new_file_name);
                    imagejpeg($orig, $new_file_name, 100);
                    imagedestroy($orig);

                    $wm = imagecreatefromjpeg($new_file_name);
                    $this->makeWaterMark($userwatermark, $wm, $path, $img_url1);

                    $image = imagecreatefromjpeg($new_file_name);
                    $this->makeThumbnail($image, $path, $img_url1, $new_file_name);
                }
            }
            $image=[
                'author' => $username,
                'title' => $usertitle,
                'size' => $img_size,
                'name' => $img_url1,
                'url' => $new_file_name,
                'access' => isset($_POST['access']) ? $_POST['access'] : 'public',
            ];
            $stock->saveImage($image);
            header("location: \stock");
        }
        $this->view('upload');
    }

    public function makeThumbnail($image, $path, $img_url1, $new_file_name){
        list($width, $height) = getimagesize($new_file_name);
        $new_width = 200;
        $new_height = 125;
        $image_p = imagecreatetruecolor($new_width, $new_height);

        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagepng($image_p, $path.'mini_' . $img_url1, 0);
    }

    public function makeWaterMark($userwatermark, $wm, $path, $img_url1){
        $w = strlen($userwatermark)*10 + 10;
        $stamp = imagecreatetruecolor($w, 30);
        imagestring($stamp, 5, 10, 6, $userwatermark, 0xF5F5F5);

        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        imagecopymerge($wm, $stamp, imagesx($wm) - $sx - $marge_right, imagesy($wm) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);
        imagepng($wm, $path.'wm_' . $img_url1, 0);
        imagedestroy($wm);
    }

    public function translit($url){
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Zh', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Ju', 'Ja', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'ju', 'ja');
        $url= str_replace($rus, $lat, $url);
        return $url;
    }

    public function getRandomFileName($path, $extension=''){
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
        return $name;
    }
}

?>