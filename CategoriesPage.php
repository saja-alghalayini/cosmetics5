<?php
include_once 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$cat_id = $_GET['cat_id'];
$query = "SELECT * FROM products INNER JOIN categories WHERE products.category_id = categories.category_id AND products.category_id=$cat_id AND sale_status;";
$result = mysqli_query($conn, $query);
$resultcheck = mysqli_num_rows($result);

$query1 = "SELECT category_name FROM categories WHERE category_id=$cat_id;";
$result1 = mysqli_query($conn, $query1);
$cat_name = mysqli_fetch_assoc($result1);

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $loginpath = "&id=" . $id;
} else {
    $loginpath = "";
}

if (isset($_GET["id"])) {
    if (isset($_GET["add"])) {
        $pro_id = $_GET['pro_id'];
        $query2 = "SELECT * FROM cart WHERE product_id=$pro_id AND user_id=$id;";
        $result2 = mysqli_query($conn, $query2);
        $resultcheck2 = mysqli_num_rows($result2);
        $row3 = mysqli_fetch_assoc($result2);
        if ($resultcheck2 > 0) {
            $increase = $row3['quantity'] + 1;
            $query4 = "UPDATE cart SET quantity= $increase WHERE product_id=$pro_id AND user_id=$id;";
            $result4 = mysqli_query($conn, $query4);
        } else {
            $query5 = "INSERT INTO cart(product_id, quantity, user_id) VALUES('$pro_id', 1, '$id');";
            $result5 = mysqli_query($conn, $query5);
        }
    }
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
    $shoppath = 'ProductsPage.php?id=' . $id;
    $categorypath = 'CategoriesPage.php?id=' . $id . '&';
    $cartpath = 'other/cart.php?id=' . $id;
    $homepath = 'landingpage.php?id=' . $id;
    $about = 'aboutUS.php?id=' . $id;
    $contact = 'contactUS.php?id=' . $id;

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
    <title>Categories</title>
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
                echo '<a href="userpage.php?id='.$id.'">Account</a>';
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

        <h1 class="bhead">Category: <?php echo $cat_name['category_name'] ?></h1>
        <br>
        <div id="parent">
            <?php
            if ($resultcheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET['id'])) { //here
                        $path = 'CategoriesPage.php?cat_id=' . $cat_id . '&pro_id=' . $row["id"] . '&id=' . $id . '&add=1';
                    } else {
                        $path = "login.php";
                    }
                    $pbs = floor(($row['price']) / ((100 - $row['sale_pre']) / 100)); //// price before sale

                    echo '<div>
                    <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><img src="' . $row['image'] . '" alt="Product"></a>
                    <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><h3>' . $row['name'] . '</h3></a>
                    <div class="rearrange">
                    <span id = "price_befor">' . $pbs . ' JD</span>
                    <span id="price_after">' . $row['price'] . ' JD</span>
                    </div>
                    <a href="' . $path . '" id="addtocart" style="background-color: #ef3737;">Add to Cart</a>
                    </div>';
                }
                $query = "SELECT * FROM products INNER JOIN categories WHERE products.category_id = categories.category_id AND products.category_id=$cat_id AND sale_status=0";;
                $result = mysqli_query($conn, $query);
                $resultcheck = mysqli_num_rows($result);
                ////////////////////////////////////////////////////////////////
                while ($row = mysqli_fetch_assoc($result)) {
                    if (isset($_GET['id'])) { //here
                        $path = 'CategoriesPage.php?cat_id=' . $cat_id . '&pro_id=' . $row["id"] . '&id=' . $id . '&add=1';
                    } else {
                        $path = "login.php";
                    }

                    echo '<div>
                    <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><img src="' . $row['image'] . '" alt="Product"></a>
                    <a href="Product.php?pro_id=' . $row["id"] . $loginpath . '"><h3>' . $row['name'] . '</h3></a>
                    <h2 style="margin-top:30px;"  class="rearrange">' . $row['price'] . ' JD</h2>
                    <a href="' . $path . '" id="addtocart">Add to Cart</a>
                    </div>';
                }
            }
            ?>
        </div>

    </div>

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

</html>