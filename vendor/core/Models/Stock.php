<?php

namespace core\Models;

class Stock extends \core\Model{

    public function getImages($page = 0, $amount = 0){
        $db = $this->setInstance();
        $images = $db->table('stock_images')->getSome($page, $amount);
        return $images;
//        $db = $this->getDb();
//        $collection = $db->images;
//        $query = ['limit' => $amount, 'skip' => ($actualPage - 1) * $amount];
//        return $collection->find([], $query)->toArray();
    }

    public function getImagesNumer(){
        $db = $this->setInstance();
        $images = $db->table('stock_images')->getSome($page, $amount);
        return count($images);
    }

    public function getIamgesByTitle($name){
        $db = $this->setInstance();
        $images = $db->table('stock_images')->where('title', '%', $name)->getSome();
        return $images;
   }
//
//    public function getPrivateImages(){
//        $db = $this->getDb();
//        $query = ['access' => 'private', 'author' => $_SESSION['creator']];
//        return $db->images->find($query)->toArray();
//    }
//
//    public function getPagesNumber(){
//        $db = $this->getDb();
//        $images = $db->images->find()->toArray();
//        return $images;
//    }
//
//    public function saveImage($image){
//        $db = $this->getDb();
//        $db->images->insertOne($image);
//    }
//
//    public function getImageByID($imageID){
//        $db = $this->getDb();
//        return $db->images->find(['_id' => new \MongoDB\BSON\ObjectID($imageID)])->toArray();
//    }
}