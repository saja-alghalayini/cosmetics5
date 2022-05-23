<?php
include_once 'connect.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $loginpath = "&id=" . $id;
    $cart = "other/cart.php?id=$id";
} else {
    $loginpath = "";
    $cart = "login.php";
}
if (isset($_GET["id"])) {
    if (isset($_GET["add"])) {
        $pro_id = $_GET['pro_id']; //$
        $query2 = "SELECT * FROM cart WHERE product_id=$pro_id AND user_id=$id;";
        $result2 = mysqli_query($conn, $query2);
        $resultcheck = mysqli_num_rows($result2);
        $row3 = mysqli_fetch_assoc($result2);
        if ($resultcheck > 0) {
            $increase = $row3['quantity'] + 1;
            $query4 = "UPDATE cart SET quantity= $increase WHERE product_id=$pro_id AND user_id=$id;";
            $result4 = mysqli_query($conn, $query4);
        } else {
            $query5 = "INSERT INTO cart(product_id, quantity, user_id) VALUES('$pro_id', 1, '$id');";
            $result5 = mysqli_query($conn, $query5);
        }
    }
}

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];
}
if (!isset($_GET["id"])) {
    $shoppath = 'ProductsPage.php';
    $categorypath = 'CategoriesPage.php?';
    $cartpath = 'login.php';
    $homepath = 'landingpage.php';
    $about = 'aboutUS.php';
    $contact = 'contactUS.php';
    $pop="";
} else {
    $shoppath = 'ProductsPage.php?id=' . $user_id;
    $categorypath = 'CategoriesPage.php?id=' . $user_id . '&';
    $cartpath = 'other/cart.php?id=' . $user_id;
    $homepath = 'landingpage.php?id=' . $user_id;
    $about = 'aboutUS.php?id=' . $user_id;
    $contact = 'contactUS.php?id=' . $user_id;

    /* *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop* */
$querypop="SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=$id;";
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
    <link rel="stylesheet" href="./CSS/ProductsPage.css">
    <script src="https://kit.fontawesome.com/aca8d5a1fa.js" crossorigin="anonymous"></script>
    <title>Products</title>
</head>

<body>
<nav style="display: flex;">
      
            <div>
                <img width="200px" src="./Images/logo.png">
            </div>

            <div>
                <a href="<?php echo $homepath; ?>">Home</a>
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

    <div class="board">
        <h1 class="bhead">Products</h1>
        <br>
        <div id="parent">

            <?php    //////////////////// Roa make sale section danimec ++ add 2 colum to data base
            $query = "SELECT * FROM products INNER JOIN categories WHERE products.category_id = categories.category_id AND sale_status=1;";
            $result = mysqli_query($conn, $query);
            $resultcheck = mysqli_num_rows($result);
            if ($resultcheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $cartpath = 'ProductsPage.php?pro_id=' . $row['id'] . '&id=' . $id . '&add=1';
                    } else {
                        $cartpath = "login.php";
                    }
                    $pbs = floor(($row['price']) / ((100 - $row['sale_pre']) / 100)); //// price before sale 
                    echo '<div>
                         <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><img src="' . $row["image"] . '" alt="Product"></a>
                         <h5>' . $row["category_name"] . '</h5>
                         <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><h3>' . $row["name"] . '</h3></a>
                         <div class="rearrange">
                         <span id="price_after">' . $row["price"] . ' JD</span>
                         <span id="price_befor">' . $pbs . ' JD</span>
                         </div>
                         <a href=' . $cartpath . ' id="addtocart" style="background: #ef3737;">Add to Cart</a>
                        </div>';
                }
            }
            $query = "SELECT * FROM products INNER JOIN categories WHERE products.category_id = categories.category_id AND sale_status=0;";
            $result = mysqli_query($conn, $query);
            $resultcheck = mysqli_num_rows($result);
            if ($resultcheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET["id"])) {
                        $id = $_GET["id"];
                        $cartpath = 'ProductsPage.php?pro_id=' . $row['id'] . '&id=' . $id . '&add=1';
                    } else {
                        $cartpath = "login.php";
                    }
                    echo '<div>
                        <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><img src="' . $row["image"] . '" alt="Product"></a>
                        <h5>' . $row["category_name"] . '</h5>
                        <a ihref="Product.php?pro_id=' . $row["id"] . $loginpath . '"><h3>' . $row["name"] . '</h3></a>
                        <h2 style="margin-top:30px;" class="rearrange">' . $row["price"] . ' JD</h2>
                        <a href=' . $cartpath . ' id="addtocart">Add to Cart</a>
                        </div>';
                }
            }
            ?>

        </div>
    </div>
</body>
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
        <h2>Our Website</h2>
       
<p> You'll find that all of our products are made of organic ingredients 
    This means that our products are free of nanoparticles, parabens,
    or other harmful or synthetic chemicals that could harm your skin.
 <b>"Our products are not tested on animals"<b>
</p>
    </div>
            </div>
    </footer>

    <?php 
print_r($row);
?>
</html>