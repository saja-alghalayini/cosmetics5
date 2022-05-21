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
} else {
    $shoppath = 'ProductsPage.php?id=' . $id;
    $categorypath = 'CategoriesPage.php?id=' . $id . '&';
    $cartpath = 'other/cart.php?id=' . $id;
    $homepath = 'landingpage.php?id=' . $id;
    $about = 'aboutUS.php?id=' . $id;
    $contact = 'contactUS.php?id=' . $id;
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
                echo '<a href="userpage.php?id=' . $id . '">Account</a>';
                echo '<a href="LandingPage.php">Log Out</a>';
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
                    <p id = "price_befor">' . $pbs . '</p>
                    <h3 id="price_after">$' . $row['price'] . '</h3>
                    <a href="' . $path . '" id="addtocart" style="background-color: red;">Add to Cart</a>
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
                    <h3>$' . $row['price'] . '</h3>
                    <a href="' . $path . '" id="addtocart">Add to Cart</a>
                    </div>';
                }
            }
            ?>
        </div>

    </div>
</body>

</html>