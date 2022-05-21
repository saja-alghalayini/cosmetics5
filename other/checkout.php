<?php
include_once '../connect.php';
session_start();

$total = $_SESSION["total"];
$id = $_SESSION["id"];

$non = "none";

$sql = "SELECT * FROM cart INNER JOIN products ON products.id=cart.product_id AND cart.user_id=$id";
$query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_assoc($query);
$resultcheck = mysqli_num_rows($query);

if (isset($_GET["submit"])) {

    $non = "block";

    $sql1 = "SELECT id FROM bill";
    $query1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($query1);
    $resultcheck1 = mysqli_num_rows($query1);

    $num = $resultcheck1 + 1;

    // echo "$num / $id / $total";

    $_SESSION["bill_id"] = $num;
    $sql2 = "INSERT INTO bill(id, user_id, total) VALUES('$num', '$id', '$total');";
    $run2 = mysqli_query($conn, $sql2);
    /************************************** */

    if ($resultcheck > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $txt = $row["id"];
            $txt1 = $row["quantity"];
            $sql4 = "INSERT INTO `order`(product_id, quantity, bill_id) VALUES('$txt', '$txt1', '$num');";
            $run4 = mysqli_query($conn, $sql4);
        }
    }

    $sql5 = "DELETE FROM cart;";
    $query5 = mysqli_query($conn, $sql5);
    echo "<script language='javascript'>
setTimeout(() => {
    window.location.href = '../landingpage.php?id=$id'; 
 }, 3000);
</script>";
    // header("location:../landingpage.php?id=$id");
}

$homepath = '../landingpage.php?id=' . $id;
$shoppath = '../ProductsPage.php?id=' . $id;
$categorypath = 'CategoriesPage.php?id=' . $id . '&';
$cartpath = 'cart.php?id=' . $id;
$about = '../aboutUS.php?id=' . $id;
$contact = '../contactUS.php?id=' . $id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <script src="https://kit.fontawesome.com/aca8d5a1fa.js" crossorigin="anonymous"></script>
    <title>CheckOut</title>
</head>

<body>
    <div class="pop" style="display: <?php echo $non; ?>;">
        <div class="mess">
            Your Order is Placed! Thank You for Buying from Beauty Care.
        </div>
    </div>
    <!-- <img src="../Images/categories background1.jpg" alt=""> -->
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
            if (!isset($_SESSION["id"])) {
                echo '<a href="../login.php">Login</a>
                <a href="../signup.php">Register</a>';
            } else {
                echo '<a href="../userpage.php?id=' . $id . '">Account</a>';
                echo '<a href="../LandingPage.php">Log Out</a>';
            }
            ?>
        </div>
    </nav>

    <div class="board">
        <form action="" method="GET">
            <h1 class="bhead">CheckOut</h1>
            <div class="parent">
                <div class="side1">

                    <div class="name">
                        <div style="width: 45%;">
                            <label for="">First name</label>
                            <br>
                            <input type="text" name="first" class="first" id="first" required>
                        </div>
                        <div style="width: 45%;">
                            <label for="">Last name</label>
                            <br>
                            <input type="text" class="last" id="last" required>
                        </div>
                    </div>
                    <div class="num">
                        <label for="">Phone</label>
                        <br>
                        <input type="phone" class="phone" id="phone" required>
                    </div>
                    <div class="mail">
                        <label for="">Email</label>
                        <br>
                        <input type="email" class="email" id="email" required>
                    </div>
                    <div class="cou">
                        <label for="">Country</label>
                        <br>
                        <input type="text" class="country" id="country" required>
                    </div>
                    <div class="town">
                        <label for="">City</label>
                        <br>
                        <input type="text" class="city" id="city" required>
                    </div>
                    <div class="tall">
                        <label for="">Street</label>
                        <br>
                        <input type="text" class="street" id="street" required>
                    </div>

                </div>
                <div class="side2">
                    <h2 style="text-align: center;">YOUR ORDER</h2>
                    <table style="font-family: sans-serif;">
                        <tr>
                            <th style="text-align: left;">Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th style="text-align: right;">Subtotal</th>
                        </tr>

                        <?php
                        $sql4 = "SELECT * FROM cart INNER JOIN products ON products.id=cart.product_id AND cart.user_id=$id";
                        $query4 = mysqli_query($conn, $sql4);
                        // $row4 = mysqli_fetch_assoc($query4);
                        $resultcheck4 = mysqli_num_rows($query4);

                        if ($resultcheck4 > 0) {
                            // $i=0;
                            while ($row4 = mysqli_fetch_assoc($query4)) {
                                // echo "i: ".$i;

                                // echo "<li>".$row["name"]."</li>";
                                echo '
                                <tr>
                                    <td>' . $row4["name"] . '</td>
                                    <td style="text-align: center;">' . $row4["quantity"] . '</td>
                                    <td style="text-align: center; width: 30%;">$' . $row4["price"] . '</td>
                                    <td style="text-align: right;">$' . ($row4["quantity"] * $row4["price"]) . '</td>
                                </tr>';
                                // $i++;
                            }
                        }

                        ?>

                        <tr>
                            <th style="text-align: left;">Total</th>
                            <th style="text-align: right;" colspan="3">$<?php echo $total; ?></th>
                        </tr>
                    </table>
                    <div>

                        <div class="cash">
                            <input type="checkbox" name="cash" id="cash" required>
                            <label for="cash">cash on delivery</label>
                        </div>

                        <input type="submit" name="submit" value="Place Order" class="submit" id="submit">
                    </div>
                </div>
            </div>
        </form>
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
                <h2>Our Website</h2>

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