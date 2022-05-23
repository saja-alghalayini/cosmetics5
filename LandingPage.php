<?php
include_once 'connect.php';

if(isset($_GET["id"])){
  $user_id= $_GET["id"];
}
if(!isset($_GET["id"])){
  $shoppath= 'ProductsPage.php';
  $categorypath= 'CategoriesPage.php?';
  $cartpath= 'login.php';
  $about= 'aboutUS.php';
  $contact= 'contactUS.php';

  $pop='';
}else{
  $shoppath= 'ProductsPage.php?id='.$user_id;
  $categorypath= 'CategoriesPage.php?id='.$user_id.'&';
  $cartpath= 'other/cart.php?id='.$user_id;
  $about= 'aboutUS.php?id='.$user_id;
  $contact= 'contactUS.php?id='.$user_id;

  /* *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop* */
$querypop="SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=$user_id;";
$resultpop= mysqli_query($conn, $querypop);
$resultcheckpop = mysqli_num_rows($resultpop);

$quan_sum=0;
if($resultcheckpop > 0){
    while($rowpop = mysqli_fetch_assoc($resultpop)){
        $quan_sum+= $rowpop['quantity'];
    }
}

$_SESSION["quan_sum"]= $quan_sum;


if($_SESSION["quan_sum"]){
$numeric=$_SESSION["quan_sum"];
$pop='<div class="sub">'.$numeric.'</div>';
}else{
$pop='';
}
/* *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop* */

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/LandingPage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ccfa87eec6.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>

    <!-- //////////////////Header//////////////////// -->
    <header>
        <nav style="display: flex;">
      
            <div>
                <img width="200px" src="./Images/logo.png">
            </div>

            <div>
                <a href="">Home</a>
                <a href="<?php echo $shoppath; ?>">Shop</a>
                
                <a href="<?php echo $about; ?>">About Us</a>
                <a href="<?php echo $contact; ?>">Contact Us</a>
            </div>
            
            <div>
              <?php
              echo '<a class="num" href="' . $cartpath . '">
              '.$pop.'<i class="fa-solid fa-cart-shopping"></i></a>';
              if(!isset($_GET["id"])){
                echo '<a href="login.php">Login</a>
                      <a href="signup.php">Register</a>';
              }else{
                echo '<a href="userpage.php?id='.$user_id.'">Account</a>';
                echo '<a href="LandingPage.php">Log Out</a>';
              }

              if(isset($_GET["id"])){
                $id= $_GET["id"];
                $loginpath= "&id=".$id;
              }else{
                $loginpath= "";
              }
                ?>
            </div>
        </nav>

        <div class="head">
            <h1 id="headerh1">Welcome to Beauty Care Store</h1>
            <p style="font-size: 20px; font-weight: 600; margin: 30px auto;">Explore your beauty with our magnificent products</p>
            <a class="button" href="<?php echo $shoppath; ?>">Explore Our Products</a>
        </div>
    </header>


    <!-- //////////////////Body//////////////////// -->
    <h1 id="categories-h1">Categories</h1>
    <div id="categories">
        <a class="button" id ="cat1" style="width: 20%;" href="<?php echo $categorypath.'cat_id=2' ?>">Fragrance</a>
        <a class="button" id ="cat2"  style="width: 20%;" href="<?php echo $categorypath.'cat_id=3' ?>">Makeup</a>
        <a class="button" id ="cat3"  style="width: 20%;" href="<?php echo $categorypath.'cat_id=1' ?>">Hair products</a>
        <a class="button" id ="cat4"  style="width: 20%;" href="<?php echo $categorypath.'cat_id=4' ?>">Skin Care</a>
    </div>

    <h1 id="discount-h1">Discount Section</h1>
    <div id="discount" class="container">
        <?php  //////////////////// Roa make sale section danimec ++ add 2 colum to data base
      $sql= 'SELECT * from products where     sale_status=1 LIMIT 3;';
      $result= mysqli_query($conn, $sql);
            $resultcheck = mysqli_num_rows($result);
                    if($resultcheck > 0)
                    {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $pbs= floor(($row['price'])/((100-$row['sale_pre'])/100)); //// price before sale 

                      echo ' <div class="col-3">
                      <img height="250px" src="'.$row['image'].'">
                      <h4>'.$row['name'].'</h4>
                      <p id = "price_befor">'.$pbs.' JD</p>
                      <p id = "price_after">'.$row['price'].' JD</p>
                      <a href="Product.php?pro_id='.$row["id"].$loginpath.'"><button type="submit" name="sub" id="dis" class="button"> See Product</button></a>
                  </div>';
                    }
                  }

      ?>
      
    </div>
    <div id="seemore"><a href="<?php echo $shoppath; ?>">See More<a></div>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
          <div id = "img1" style="height:500px;">
            <!-- <img class="d-block w-100" src="./Images/Slider1.png" alt="First slide" style="height:500px;" > -->
                </div>
            <div class="carousel-caption d-none d-md-block">
              <h3 style="color: black;">Get your beloved one the best gift ever</h3>
              <p></p>
            </div>
          </div>

          <div class="carousel-item">
          <div id = "img2" style="height:500px;">
            <!-- <img class="d-block w-100" src="./Images/Slider2.jpg" alt="Second slide" style="height:500px;"> -->
            </div>
            <div class="carousel-caption d-none d-md-block">
              <h3 style="color: black;">Treat yourself with our high quality products</h3>
              <p></p>
            </div>
          </div>

        <div class="carousel-item">
          <div id = "img3" style="height:500px;">

            <!-- <img class="d-block w-100" src="./Images/Slider3.jpg" alt="Third slide" > -->
                </div>
            <div class="carousel-caption d-none d-md-block">
              <h3 style="color: white;">Make your world more colorful</h3>
              <p></p>
            </div>
          </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <!-- //////////////////Footer//////////////////// -->

    
    <footer>
    <div id="footerdiv">
        <div class="col-3">
            <img src="./Images/logo.png">
        </div>
        <div class="col-3">
            <h1 style="text-align: center;">Stay In Touch</h1><br>
            <h2 style="text-align: center;"></h2>
            <p style="text-align: center;" >
            <a href="https://www.facebook.com/sephora/" target="_blank" ><i class="fa-brands fa-facebook"style="display: inline;"></a></i>
            <a href="https://www.instagram.com/sephora/" target="_blank" ><i class="fa-brands fa-instagram"style="display: inline;"></a></i>
            <a href="https://www.linkedin.com/company/sephora/" target="_blank" ><i class="fa-brands fa-linkedin"style="display: inline;"></a></i>
            <br>
            <p style="text-align: center;">copyright <i class="fa-solid fa-copyright"></i> 2022 BeautyCare</p>
        </div>
        <div class="col-3">
        <h1>Our Website</h1>
       
<p> You'll find that all of our products are made of organic ingredients 
    This means that our products are free of nanoparticles, parabens,
    or other harmful or synthetic chemicals that could harm your skin.
 <b>"Our products are not tested on animals"<b>
</p>
    </div>
            </div>
    </footer>
  </body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>