<?php
/**
 * Created by PhpStorm.
 * User: masih
 * Date: 2/5/18
 * Time: 9:28 PM
 */
require "Bot.php";
class ResturantBot extends Bot {
    private $welcomeMsg;
    public $menu;
    public $price;
    public $stock;
    private $admins;
    public function __construct($token, $offset = 0)
    {
        parent::__construct($token, $offset);
    }
    public function setWelcomeMsg($str){
        $this->welcomeMsg=$str;
    }
    public function getWelcomeMsg(){
        return $this->welcomeMsg;
    }
    public function setMenu($menu){
        $this->menu=$menu;
    }
    public function setAdmins($admins){
        $this->admins=$admins;
    }
    public function setPrice($price){
        $this->price=$price;
    }
    public function getMenu(){
        return $this->menu;
    }
    public function getAdmins(){
        return $this->admins;
    }
    public function getPrice(){
        return $this->price;
    }
    public function addAdmin($admin){
        $this->admins[count($this->admins)]=$admin;
    }
    public function deleteAdmin($admin){
        $admins=$this->admins;
        $this->admins=null;
        $i=0;
        foreach ($admins as $ad){
            if($ad == $admin)
                continue;
            $this->admins[$i]=$ad;
            $i++;
        }
    }

}