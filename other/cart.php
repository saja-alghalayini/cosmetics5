<?php
include_once '../connect.php';
session_start();
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

}
$id= $_GET["id"];

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

      <div>
      <a href="<?php echo $homepath; ?>">Home</a>
          <a href="<?php echo $shoppath; ?>">Shop</a>
          <a href="<?php echo $cartpath; ?>">Cart</a>
          <a href="<?php echo $about; ?>">About Us</a>
          <a href="<?php echo $contact; ?>">Contact Us</a>
      </div>
      
      <div>
        <?php
        if(!isset($_GET["id"])){
          echo '<a href="login.php">Login</a>
                <a href="signup.php">Register</a>';
        }else{
          echo '<a href="../userpage.php?id='.$id.'">Account</a>';
          echo '<a href="../LandingPage.php">Log Out</a>';
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

                                $sql = "UPDATE cart SET quantity=$q WHERE product_id=$pro_id AND user_id=$id;";
                                mysqli_query($conn, $sql);
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
                    print_r($row);
                ?>

                <tr>
                    <td colspan="4" style="text-align: center; margin: auto;">
                        <input type="submit" value="Save Changes" name="save" class="change">
                    </td>
                </tr></form>
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

</body>
</html>
