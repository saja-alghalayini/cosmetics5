<?php
include_once 'connect.php';

$display='none';
$display1='none';

if(isset($_POST["deleteuser"])){
    $id= $_POST["userid"];
    $deletingdata= "UPDATE user SET is_delete=1 WHERE user_id=$id;";
    mysqli_query($conn , $deletingdata);
}

if(isset($_POST["edituser"])){
    $id= $_POST["userid"];
    $stat = "SELECT * FROM user WHERE user_id='$id';";
    $result = mysqli_query($conn,$stat);
    $resultcheck1 = mysqli_num_rows($result);
    if($resultcheck1 > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {$newfName= $row["first_name"];
            $newlName= $row["last_name"];
            $newEmail= $row["email"];
            $newmobile= $row["mobile"];
            $newPassword= $row["pass"];
            $display= 'block';
        }
    }
}

if(isset($_POST["newuser"])){
    $newfName= $_POST["newfName"];
    $newlName= $_POST["newlName"];
    $newEmail= $_POST["newEmail"];
    $newmobile= $_POST["newmobile"];
    $newPassword= $_POST["newPassword"];
    $is_admin= $_POST['admin'];
    if($is_admin == 'yes'){
        $x=1;
    }else if($is_admin == 'no'){
        $x=0;
    }
    $id= $_POST['userid'];
    $query1= "UPDATE user SET first_name='$newfName', last_name='$newlName',email='$newEmail',
    mobile='$newmobile',pass='$newPassword',is_admin='$x' WHERE user_id=$id;";
    $run1= mysqli_query($conn , $query1);
    $display= 'none';
}

if(isset($_POST["adding"])){
    $display1= 'block';
}

if(isset($_POST["addnewuser"])){
    $newufName= $_POST["newufName"];
    $newulName= $_POST["newulName"];
    $newuEmail= $_POST["newuEmail"];
    $newumobile= $_POST["newumobile"];
    $newuPassword= $_POST["newuPassword"];
    $is_admin1= $_POST['admin1'];
    if($is_admin1 == 'yes'){
        $y=1;
    }else if($is_admin1 == 'no'){
        $y=0;
    }
    $query2= "INSERT INTO user(first_name, last_name, email, mobile, pass, is_admin)
    VALUES('$newufName','$newulName','$newuEmail', '$newumobile', '$newuPassword', '$y');";
    $run2= mysqli_query($conn , $query2); 
    $display1= 'none';
}

$query= "SELECT * FROM user WHERE is_delete=0;";
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
    <title>Admin Users</title>
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
    <h2 style="display: inline; color:#0F848C;"> Beauty Care Users </h2>
    <form method="post"><input type="submit" value="Add New User" name="adding"></form>
    </div>
    <hr>
    <div class="container">
    <p style="text-align: left; color: #888">Total number of users: <?php echo $resultcheck; ?><p>

    <div id="editdiv" style="display: <?php echo $display?>;">
                <form method="post">
                    <input type="hidden" value="<?php echo $id?>" name="userid">
                    <label class="col-2">First Name:</label>
                    <input class="col-5" type="text" value="<?php echo $newfName?>" name="newfName"><br>
                    <label class="col-2">Last Name:</label>
                    <input class="col-5" type="text" value="<?php echo $newlName?>" name="newlName"><br>
                    <label class="col-2">Email:</label>
                    <input class="col-5" type="text" value="<?php echo $newEmail?>" name="newEmail"><br>
                    <label class="col-2">Mobile:</label>
                    <input class="col-5" type="text" value="<?php echo $newmobile?>" name="newmobile"><br>
                    <label class="col-2">Password:</label>
                    <input class="col-5" type="text" value="<?php echo $newPassword?>" name="newPassword"><br>
                    <label class="col-2">Admin:</label>
                    <input type="radio" value="yes" name="admin" required> Yes
                    <input type="radio" value="no" name="admin" required> No<br>
                    <input type="submit" value="Save" name="newuser">
                </form>
            </div>
            <div id="adddiv" style="display: <?php echo $display1?>;">
                <form method="post">
                    <label class="col-2">First Name:</label>
                    <input class="col-5" type="text"  name="newufName" required><br>
                    <label class="col-2">Last Name:</label>
                    <input class="col-5" type="text"  name="newulName" required><br>
                    <label class="col-2">Email:</label>
                    <input class="col-5" type="text" name="newuEmail" required><br>
                    <label class="col-2">Mobile:</label>
                    <input class="col-5" type="text" name="newumobile" required><br>
                    <label class="col-2">Password:</label>
                    <input class="col-5" type="text" name="newuPassword" required><br>
                    <label class="col-2">Admin:</label>
                    <input type="radio" value="yes" name="admin1" required> Yes
                    <input type="radio" value="no" name="admin1" required> No<br>
                    <input type="submit" value="Add" name="addnewuser">
                </form>
            </div>

    <table>
    <tr>
                <th>ID</th>
                <th>First NAME</th>
                <th>Last NAME</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Password</th>
                <th>Is Admin</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            if($resultcheck > 0)
                    {
                    while($row = mysqli_fetch_assoc($run))
                    {
                        $y= $row['user_id'];
            echo '<tr>
                    <td>'.$row['user_id'].'</td>
                    <td>'.$row['first_name'].'</td>
                    <td>'.$row['last_name'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['mobile'].'</td>
                    <td>'.$row['pass'].'</td>
                    <td>'.$row['is_admin'].'</td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="userid">
                    <input type="submit" value="Edit" name="edituser">
                    </form>
                    </td>
                    <td>
                    <form method="post">
                    <input type="hidden" value="'.$y.'" name="userid">
                    <input type="submit" value="Delete" name="deleteuser">
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