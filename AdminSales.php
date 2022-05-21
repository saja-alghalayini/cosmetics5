<?php
include_once 'connect.php';


$query= "SELECT * FROM `order` INNER JOIN bill ON `order`.bill_id=bill.id INNER JOIN products ON `order`.product_id=products.id;";
$run= mysqli_query($conn, $query);
$resultcheck = mysqli_num_rows($run);

$sql= "SELECT total FROM bill;";
$result= mysqli_query($conn, $sql);
$check= mysqli_num_rows($result);
$total= 0;
if($check > 0){
    while($row2 = mysqli_fetch_assoc($result))
    {
        $total+= $row2["total"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/Admin.css">
    <script src="https://kit.fontawesome.com/aca8d5a1fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Sales</title>
</head>
<body>
    <nav>
    <div id="parent">
        <div class="col-11">
            <img src="./Images/logo.png" alt="logo">
            <a href="AdminDashboard.php"><span>Admin Dashboard</span></a>
        </div>
        <div class="col">
            <a href="LandingPage.php"><span>Log Out</span></a>
        </div>
    </div>
    </nav>

    <div class="container" id="title">
    <h2 style="display: inline; color:#0F848C;"> Beauty Care Sales </h2>
    </div>
    
    <hr>

    <div class="container">
    <p style="text-align: left; color: #888">Total Earnings: $<?php echo $total; ?><p>
    <table>
    <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>User ID</th>
                <th>Bill ID</th>
            </tr>
            <?php
            if($resultcheck > 0)
                    {
                    while($row = mysqli_fetch_assoc($run))
                    {
            echo '<tr>
                    <td>'.$row['order_id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['quantity'].'</td>
                    <td>'.$row['user_id'].'</td>
                    <td>'.$row['bill_id'].'</td>
                </tr>';
                }
                }
                echo '</table> <br><br>';
                
            ?>
    </div>
</body>
</html>