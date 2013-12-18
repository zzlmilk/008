<?php
class FavoriteController extends BaseController{
       public function __construct() {
        parent::__construct();
    }
    public function getUserFavorite(){
        $userId = $this->request['userId'];
        $favorite=new FavoriteBllModel();
//        $userId='80';
        $favorite->getFavorite($userId);
    }
    public function delFavorite(){
        $userId = $this->request['userId'];
        $favoriteId = $this->request['planId'];
        $favorite=new FavoriteBllModel();
//                $userId='79';
//        $favoriteId='1';
        $favorite->delFavoriteByUserId($userId, $favoriteId);
    }

    public function addFavorite(){
        $userId = $this->request['userId'];
        $favoriteId = $this->request['planId'];
        $favorite=new FavoriteBllModel();
//        $userId='79';
//        $favoriteId='1';
        $favorite->addFavoriteByUserId($userId, $favoriteId);
    }
}

?>
