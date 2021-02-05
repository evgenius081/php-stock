<?php
    echo "<article class='stock-gallery-item'>
    <img src='/images/mini_".$this->var["image"]['name']."' alt='".$this->var["image"]['name']."'>
    <a href='/image/wm_".$this->var["image"]['name']."' target='blank'>
        <div class='image-info'>
            <div class='image-text'>
                <p class='image-title'>".$this->var["image"]["title"]."</p>
                <p class='image-author'>by: ".$this->var["image"]['author']."</p>
            </div>";
if(isset($_SESSION['token'])){ 
echo "<div class='a-container'><input type='checkbox' class='favourites' title='Add to favourites' name='".$this->var["image"]['_id']."' value='".$this->var["image"]['_id']."' ";
$tr = false;
foreach($this->var['chosen'] as $img=>$name){
    if($name == $this->var["image"]['_id']){
        $tr = true;
    }
}
if($tr){
    echo " checked";
}
echo "><i style='color: #fff; background: none;' class='";
if(isset($this->var['chosen'])){
    $tr = false;
    foreach($this->var['chosen'] as $img=>$name){
        if($name == $this->var["image"]['_id']){
            $tr = true;
        }
    }
    if($tr){
        echo "fas ";
    }else{
        echo "fal ";
    }
}else{
    echo "fal ";
}
echo "fa-heart'></i>";
if($this->var["image"]['access'] == 'private'){
   echo '<i title="This pic is only yours" class="fas fa-user-lock"></i>';
}
echo "</div>";
}
echo "</div></a></article>";
?>