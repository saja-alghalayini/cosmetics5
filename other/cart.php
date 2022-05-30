<?php
include_once '../connect.php';
session_start();
$id= $_GET["id"];

$e=0;
$arr_q=[];
if(isset($_GET['save'])){

    foreach (array_keys($_GET) as $key) {
        $str = $key;
        $pattern = "/quan/i";
        if(preg_match($pattern, $str)){
            $e++;
            $arr_q[] = $key;
        } 
    }
/*************SELECT ASVE***************************** */
    $queryt="SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=$id;";
    $resultt= mysqli_query($conn, $queryt);
    $resultcheckt = mysqli_num_rows($resultt);

    // if(isset($_GET['save'])){


    if($resultcheckt > 0)
    {
        $i=0;
        while($rowt = mysqli_fetch_assoc($resultt)){

            for($r=0; $r < $e; $r++){
                $index= "quan".$i;
                $q=$_GET[$index];
                /**************** */
                $index1= "product_id".$i;
                $pro_id=$_GET[$index1];
    
            }

            $sqlt = "UPDATE cart SET quantity=$q WHERE product_id=$pro_id AND user_id=$id;";
            mysqli_query($conn, $sqlt);

            $i++;
        }
    }
}


if(isset($_GET['del_pro'])){
    $del_pro= $_GET['del_pro'];
    $query2= "DELETE FROM cart WHERE product_id=$del_pro AND user_id=$id;";
    $result2= mysqli_query($conn, $query2);
}



$query="SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=$id;";
$result= mysqli_query($conn, $query);
$resultcheck = mysqli_num_rows($result);
                    
if(isset($_POST['checkout'])){
    header("location:checkout.php");
}

$homepath= '../landingpage.php?id='.$id;
$shoppath= '../ProductsPage.php?id='.$id;
$categorypath= '../CategoriesPage.php?id='.$id.'&';
$cartpath= '#';
$about= '../aboutUS.php?id='.$id;
$contact= '../contactUS.php?id='.$id;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <script src="https://kit.fontawesome.com/aca8d5a1fa.js" crossorigin="anonymous"></script>
    <title>Cart</title>
</head>

<body>
    <nav style="display: flex;">

        <div>
            <img width="200px" src="./Images/logo.png">
        </div>

        <div style="font-family: 'Times New Roman', Times, serif;">
            <a href="<?php echo $homepath; ?>">Home</a>
            <a href="<?php echo $shoppath; ?>">Shop</a>

            <a href="<?php echo $about; ?>">About Us</a>
            <a href="<?php echo $contact; ?>">Contact Us</a>
        </div>

        <div>
            <?php

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

            echo '<a class="num" href="' . $cartpath . '">
            '.$pop.'<i class="fa-solid fa-cart-shopping"></i></a>';
            if (!isset($_GET["id"])) {
                echo '<a href="login.php">Login</a>
                      <a href="signup.php">Register</a>';
            } else {
                echo '<a href="../userpage.php?id=' . $id . '">Account</a>';
                echo '<a href="../LandingPage.php">Log Out</a>';
            }

            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $loginpath = "&id=" . $id;
            } else {
                $loginpath = "";
            }
            ?>
        </div>
    </nav>

    <div class="board">
        <h1 class="bhead">CART</h1>
        <div class="table">
            <div style="margin: auto;">
                <table>
                    <tr>
                        <th>PRODUCTS</th>
                        <th>PRICE</th>
                        <th>QUANTITY</th>
                        <th>SUBTOTAL</th>
                    </tr>

                    <?php

                $quan_sum=0;
                $sum=0;
                if($resultcheck > 0)
                    {
                    $i=0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                        if(isset($_GET['save'])){
                            for($r=0; $r < $e; $r++){
                                $index= "quan".$i;
                                $q=$_GET[$index];
                                /**************** */
                                $index1= "product_id".$i;
                                $pro_id=$_GET[$index1];

                            }
                        }else{
                            $q = $row['quantity'];
                        };

                    echo '<form action="" method="get"><tr>
                    <td style="position: relative;">
                        <div style="left: 0; margin: auto; display: flex; justify-content: space-around; align-items: center; width: 200px;">
                            <a href="cart.php?id='.$id.'&del_pro='.$row['id'].'"><i style="position: absolute; left: 10px;" class="fa-solid fa-circle-xmark"></i></a>
                            <img src=".'.$row['image'].'" width="50px" alt="">
                            <span>'.$row['name'].'</span>
                        </div>
                    </td>
                    <td>$'.$row['price'].'</td>
                    <td>
                        <input type="hidden" value="'.$row['product_id'].'" name="product_id'.$i.'">
                        <input type="number" class="num" min="1" value="'.$q.'" name="quan'.$i.'" id="">
                    </td>
                    <td>$'.($row['price']*$row['quantity']).'</td>
                    </tr>';
                    $quantity[] = $row['quantity'];

                    $sum+= ($row['price']*$row['quantity']);
                    $i++;
                    }} 
                    $_SESSION["total"]= $sum;
                    $_SESSION["id"]= $id;

                    echo '<input type="hidden" value="'.$id.'" name="id">';
                ?>

                    <tr>
                        <td colspan="4" style="text-align: center; margin: auto;">
                            <input type="submit" value="Save Changes" name="save" class="change">
                        </td>
                    </tr>
                    </form>
                </table>

                <div class="total">
                    <h3>CART TOTAL: $<?php echo $sum; ?></h3>
                    <form method="post">
                        <input type="submit" name="checkout" value="Checkout" class="change">
                    </form>
                </div>
            </div>

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
                <p style="text-align: center;">
                    <a href="https://www.facebook.com/sephora/" target="_blank"><i class="fa-brands fa-facebook" style="display: inline;"></a></i>
                    <a href="https://www.instagram.com/sephora/" target="_blank"><i class="fa-brands fa-instagram" style="display: inline;"></a></i>
                    <a href="https://www.linkedin.com/company/sephora/" target="_blank"><i class="fa-brands fa-linkedin" style="display: inline;"></a></i>
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