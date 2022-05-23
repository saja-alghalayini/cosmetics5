<?php
include_once 'connect.php';

$display='none';
$display1= "none";


if(isset($_POST["deletecat"])){
    $cat_id= $_POST["catid"];
    $deletingdata= "DELETE FROM categories WHERE category_id=$cat_id;";
    mysqli_query($conn , $deletingdata);
}

// 
if(isset($_POST["editcat"])){
    $cat_id= $_POST["catid"];
    $query1= "SELECT * FROM categories WHERE category_id=$cat_id;";
    $run1= mysqli_query($conn, $query1);
    $resultcheck1 = mysqli_num_rows($run1);
    if($resultcheck1 > 0)
    {
        while($row1 = mysqli_fetch_assoc($run1))
        {$newcatname= $row1['category_name'];
            $display= 'block';
        }
    }
}

if(isset($_POST["newcat"])){
    $cat_id= $_POST["catid"];
    $newcatname= $_POST["newcatname"];
    $id= $_POST['catid'];
    $query2= "UPDATE categories SET category_name='$newcatname' WHERE category_id=$cat_id;";
    $run2= mysqli_query($conn , $query2);
    $display= 'none';
}
// 

if(isset($_POST["adding"])){
    $display1= "block";
}

if(isset($_POST["addnewcat"])){
    $newcatname= $_POST['newcatname'];
    $query2= "INSERT INTO categories(category_name)
    VALUES('$newcatname');";
    $run2= mysqli_query($conn , $query2); 
    $display1= 'none';
}

$query= "SELECT * FROM categories;";
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
    <title>Admin categories</title>
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
    <h2 style="display: inline; color:#0F848C;"> Beauty Care Categories </h2>
    
    <form method="post"><input type="submit" value="Add New Category" name="adding"></form>
    </div>
    
    <hr>

    <div class="container">
    <p style="text-align: left; color: #888">Total number of categories: <?php echo $resultcheck; ?><p>
    <div id="editdiv" style="display: <?php echo $display?>;">
                <form method="post">
                    <input type="hidden" value="<?php echo $cat_id?>" name="catid">
                    <label>Category Name:</label>
                    <input type="text"  value="<?php echo $newcatname?>" name="newcatname" required>
                    <input type="submit" value="Save" name="newcat">
                </form>
    </div>
    <div id="adddiv" style="display: <?php echo $display1?>;">
                <form method="post">
                    <label>Category Name:</label>
                    <input type="text"  name="newcatname" required>
                    <input type="submit" value="Add" name="addnewcat">
                </form>
    </div>
    <table>
    <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if($resultcheck > 0)
                    {
                    while($row = mysqli_fetch_assoc($run))
                    {
                        $y= $row['category_id'];
            echo '<tr>
                    <td>'.$row['category_id'].'</td>
                    <td>'.$row['category_name'].'</td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="catid">
                    <input type="submit" value="Edit" name="editcat">
                    </form>
                    </td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="catid">
                    <input type="submit" value="Delete" name="deletecat">
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