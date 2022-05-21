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
} else {
    $shoppath = 'ProductsPage.php?id=' . $user_id;
    $categorypath = 'CategoriesPage.php?id=' . $user_id . '&';
    $cartpath = 'other/cart.php?id=' . $user_id;
    $homepath = 'landingpage.php?id=' . $user_id;
    $about = 'aboutUS.php?id=' . $user_id;
    $contact = 'contactUS.php?id=' . $user_id;
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
            <a href="<?php echo $cartpath; ?>">Cart</a>
            <a href="<?php echo $about; ?>">About Us</a>
            <a href="<?php echo $contact; ?>">Contact Us</a>
        </div>

        <div>
            <?php
            if (!isset($_GET["id"])) {
                echo '<a href="login.php">Login</a>
                <a href="signup.php">Register</a>';
            } else {
                echo '<a href="userpage.php?id=' . $user_id . '">Account</a>';
                echo '<a href="LandingPage.php">Log Out</a>';
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
                         <h3 id="price_befor">$' . $pbs . '</h3>
                         <h3 id="price_after">$' . $row["price"] . '</h3>
                         <a href=' . $cartpath . ' id="addtocart" style="background: red;">Add to Cart</a>
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
                        <h3 >$' . $row["price"] . '</h3>
                        <a href=' . $cartpath . ' id="addtocart">Add to Cart</a>
                        </div>';
                }
            }
            ?>

        </div>
</body>

</html>