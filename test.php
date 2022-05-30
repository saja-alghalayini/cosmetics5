<?php

class SixGrade {
  public $name;
  private $age=13;
  public $eyeColor;
  
  public function __construct($name,$eyeColor){
    $this->name = $name;
    $this->eyeColor = $eyeColor;
   echo $this->get_name(). '<br>';
   echo $this->get_age(). "<br>";
   echo $this->get_eyeColor(). '<br>';
  }

  public function  get_name (){
    return  $this->name;
  }
  public function get_age(){
    return $this->age;
  }
  public function get_eyeColor(){
    return $this->eyeColor;
  }
}





echo "hadi info:".'<br>';
$hadi = new SixGrade('hadi','black');

echo "duaa info:".'<br>';
$Dua = new SixGrade('Dua','Green');

echo "dyar info:".'<br>';
$dyar = new SixGrade('dyar','Green');

?>