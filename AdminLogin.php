<?php
session_start();
include_once('connect.php');

if (isset($_POST['submit'])){
    $Email =$_POST['email'];
    $Password= $_POST['Password'];

    $sql1="SELECT * FROM user;";
    $result= mysqli_query($conn , $sql1);
    $result_check= mysqli_num_rows($result);

    if ($result_check > 0) {
         while ($row=mysqli_fetch_assoc($result)) {
          if($Email== ($row['email'])&& $Password== $row['pass'] && $row['is_admin']==1){

             header('location:AdminDashboard.php');
            
           }else{

                 $wrong2= '<style type="text/css">
                     #i22, #two2{
                         display: inline;
                     }
                     </style>';
             
             }

  }
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
    <title>Admin Login</title>
    <style>
        .container div {
            border:solid black 1px;
            width: 80%;
            margin-top: 100px;
            border-radius: 0;
        }
        h1{
        margin-bottom: 50px;
        }
        .error-icon,
        .error-text {
	        display: none;
        }
        /* .error-icon {
            position: absolute;
            top: 0;
            right: 2%;
            top: 33%;
        } */
        /* .error-text,
        .error-icon {
	        display: block;
        } */
        #login{
            letter-spacing: 3px;
            background: #3FB4BE;
            color: #fff;
            margin-top: 20px;
            box-shadow:0 0 4px 4px #3FB4BE;
            border: none;
        }
        #login:hover{
            background: #fff;
            color: #3FB4BE;
        }
        #i11, #i22 {
            width: 25px;
        }

    </style>
</head>
<body>
    <nav>
    <div id="parent">
        <div class="col-11">
            <img src="./Images/logo.png" alt="logo">
            <span>Admin Dashboard</span>
        </div>

    </div>
    </nav>

    <div class="container">
    <form  method="post">
        <div>
        <h1>LOGIN</h1>
              <label for="Email" class="col-2">Email Address:</label>
              <input class="col-3" name='email' id="Email" value="" type="email"  required="true"><br><br>

            
              <label for="password" class="col-2">Password:</label>
              <input class="col-3" name='Password' id="password" value="" type="password"  required="true"><br><br>

              
              <img src="./img/icon-error (1).svg" class="error-icon" alt="" id='i22'>
              <p class="error-text" id='two2'>wrong email or password</p> 
            
              <?php if(isset($wrong2)){echo $wrong2;}?>              
            
          <br>
            <input type="submit" value='LOGIN' name='submit' id='login'> 
          </form>
    </div>

    </div>
</body>
</html>