<?php
include_once 'connect.php';

$display= "none";
$display1= "none";

if(isset($_POST["deletepro"])){
    $pro_id= $_POST["proid"];
    $deletingdata= "DELETE FROM products WHERE id=$pro_id;";
    mysqli_query($conn , $deletingdata);
}

// 
if(isset($_POST["editpro"])){
    $pro_id= $_POST["proid"];
    $sql1 = "SELECT * FROM products WHERE id='$pro_id';";
    $result1 = mysqli_query($conn,$sql1);
    $resultcheck1 = mysqli_num_rows($result1);
    if($resultcheck1 > 0)
    {
        while($row2 = mysqli_fetch_assoc($result1))
        {$newcatid= $row2["category_id"];
            $newname= $row2["name"];
            $newprice= $row2["price"];
            $newsales= $row2["sale_status"];
            $newsalep= $row2["sale_pre"];
            $newdescription= $row2["description"];
            $newstuatus= $row2["status"];
        }
    }
    $display= 'block';
}

if(isset($_POST["saveeditpro"])){
    $pro_id= $_POST["proid"];
    $newcatid= $_POST["newcatid"];
    $newname= $_POST["newname"];
    $newprice= $_POST["newprice"];
    $newsales= $_POST["newsales"];
    $newsalep= $_POST["newsalep"];
    $newdescription= $_POST["newdescription"];
    $newstuatus= $_POST["newstuatus"];
    
    $sql2= "UPDATE products SET category_id='$newcatid', name='$newname', price='$newprice',
    sale_status='$newsales', sale_pre='$newsalep', description='$newdescription', status='$newstuatus'  WHERE id=$pro_id;";
    mysqli_query($conn , $sql2);
    $display= 'none';
}

if(isset($_POST["saveimg"])){
    $pro_id= $_POST["proid"];

    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tem = $_FILES["file"]["tmp_name"];
    $file_store = "./Images/ProductsImages/".$file_name;
    // echo $file_store;
    move_uploaded_file($file_tem, $file_store);

    $sql2= "UPDATE products SET image='$file_store'  WHERE id=$pro_id;";
    mysqli_query($conn , $sql2);
}
// 

if(isset($_POST["adding"])){
    $display1= "block";
}

if(isset($_POST["addnewpro"])){
    $newpcatid= $_POST["newpcatid"];
    $newpname= $_POST["newpname"];
    $newpprice= $_POST["newpprice"];
    $newpsales= $_POST["newpsales"];
    $newpsalep= $_POST["newpsalep"];
    $newpdescription= $_POST["newpdescription"];
    $newpstuatus= $_POST["newpstuatus"];

    $file_name = $_FILES["file"]["name"];
    $file_type = $_FILES["file"]["type"];
    $file_size = $_FILES["file"]["size"];
    $file_tem = $_FILES["file"]["tmp_name"];
    $file_store = "./Images/ProductsImages/".$file_name;
    // echo $file_store;
    move_uploaded_file($file_tem, $file_store);

    $adding_pro= "INSERT INTO products(category_id, name, price, sale_status, sale_pre, description, image, status)
    VALUES('$newpcatid','$newpname','$newpprice', '$newpsales', '$newpsalep', '$newpdescription','$file_store','$newpstuatus');";
    mysqli_query($conn , $adding_pro); 
    $display1= 'none';
}


$query= "SELECT * FROM products ORDER BY id DESC;";
$run= mysqli_query($conn, $query);
$resultcheck = mysqli_num_rows($run);
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
    <title>Admin Products</title>
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
    <h2 style="display: inline; color:#0F848C;"> Beauty Care Products </h2>
    
    <form method="post"><input type="submit" value="Add New Product" name="adding"></form>
    </div>
    
    <hr>

    <div class="container">
    <p style="text-align: left; color: #888">Total number of products: <?php echo $resultcheck; ?><p>
    <div id="editdiv" style="display: <?php echo $display?>;">
                <form action="?" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $pro_id?>" name="proid">
                    <label>Change Image:</label>
                    <input type="file" name="file" id="file" required>
                    <input type="submit" value="Change Image" name="saveimg">
                </form>
                <hr>
                <form  method="post">
                    <input type="hidden" value="<?php echo $pro_id?>" name="proid">
                    <label class="col-2">Category ID:</label>
                    <input class="col-5" type="text" value="<?php echo $newcatid?>" name="newcatid" required><br>
                    <label class="col-2">Name:</label>
                    <input class="col-5" type="text" value="<?php echo $newname?>" name="newname" required><br>
                    <label class="col-2">Price:</label>
                    <input class="col-5" type="text" value="<?php echo $newprice?>" name="newprice" required><br>
                    <label class="col-2">Sale Status:</label>
                    <input class="col-5" type="text" value="<?php echo $newsales?>" name="newsales" required><br>
                    <label class="col-2">Sale Percentage:</label>
                    <input class="col-5" type="text" value="<?php echo $newsalep?>" name="newsalep" required><br>
                    <label class="col-2">Description:</label>
                    <input class="col-5" type="text" value="<?php echo $newdescription?>" name="newdescription" required><br>
                    <label class="col-2">Status:</label>
                    <input class="col-5" type="text" value="<?php echo $newstuatus?>" name="newstuatus" required><br>
                    <input type="submit" value="Save" name="saveeditpro">
                </form>
    </div>
    <div id="adddiv" style="display: <?php echo $display1?>;">
                <form action="?" method="post" enctype="multipart/form-data">
                    <label class="col-2">Category ID:</label>
                    <input class="col-5" type="text"  name="newpcatid" required><br>
                    <label class="col-2">Name:</label>
                    <input class="col-5" type="text" name="newpname" required><br>
                    <label class="col-2">Price:</label>
                    <input class="col-5" type="text" name="newpprice" required><br>
                    <label class="col-2">Sale Status:</label>
                    <input class="col-5" type="text" name="newpsales" required><br>
                    <label class="col-2">Sale Percentage:</label>
                    <input class="col-5" type="text" name="newpsalep" required><br>
                    <label class="col-2">Description:</label>
                    <input class="col-5" type="text" name="newpdescription" required><br>
                    <label class="col-2">Image:</label>
                    <input class="col-5" type="file" name="file" id="file" required><br>
                    <label class="col-2">Status:</label>
                    <input class="col-5" type="text" name="newpstuatus" required><br>
                    <input type="submit" value="Add" name="addnewpro">
                </form>
    </div>
    <table>
    <tr>
                <th>ID</th>
                <th>Category ID</th>
                <th>NAME</th>
                <th>Price</th>
                <th>Sale Status</th>
                <th>Sale Percentage</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if($resultcheck > 0)
                    {
                    while($row = mysqli_fetch_assoc($run))
                    {
                        $y= $row['id'];
            echo '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['category_id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                    <td>'.$row['sale_status'].'</td>
                    <td>'.$row['sale_pre'].'</td>
                    <td>'.$row['description'].'</td>
                    <td><img src="'.$row['image'].'"></td>
                    <td>'.$row['status'].'</td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="proid">
                    <input type="submit" value="Edit" name="editpro">
                    </form>
                    </td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="proid">
                    <input type="submit" value="Delete" name="deletepro">
                    </form>
                    </td>
                </tr>
                ';
                }
                }
                echo '</table> <br><br>';
                
            ?>
    </div>
</body>
</html>