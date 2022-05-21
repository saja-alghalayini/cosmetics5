<?php
include_once 'connect.php';
if(isset($_GET["id"])){
  $user_id= $_GET["id"];
}


if(isset($_POST['newinfo'])){
    $newfirstname= $_POST['newfirstname'];
    $newlastname= $_POST['newlastname'];
    $newemail= $_POST['newemail'];
    $newmobile= $_POST['newmobile'];
    $query1= "UPDATE user SET first_name='$newfirstname',last_name='$newlastname',
    email='$newemail',mobile='$newmobile' WHERE user_id=$user_id;";
    $result1= mysqli_query($conn, $query1);
}

$query= "SELECT * FROM user WHERE user_id=$user_id;";
$result= mysqli_query($conn, $query);
$info= mysqli_fetch_assoc($result);

if(isset($_GET['id'])){
  $id= $_GET['id'];
}
if(!isset($_GET["id"])){
  $shoppath= 'ProductsPage.php';
  $categorypath= 'CategoriesPage.php?';
  $cartpath= 'login.php';
  $homepath= 'landingpage.php';
  $about= 'aboutUS.php';
  $contact= 'contactUS.php';
}else{
  $shoppath= 'ProductsPage.php?id='.$id;
  $categorypath= 'CategoriesPage.php?id='.$id.'&';
  $cartpath= 'other/cart.php?id='.$id;
  $homepath= 'landingpage.php?id='.$id;
  $about= 'aboutUS.php?id='.$id;
  $contact= 'contactUS.php?id='.$id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ueser Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7b836f378e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/user.css">
    <style>
nav{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: row;
    padding-right: 50px;
    background-color: #dae0e065;
}

nav a{
    color: #063e42;
    text-decoration: none;
    font-family: sans-serif;
    margin: 20px;
}
      #editinfo{
        border: none;
        background-color: transparent;
      }
    </style>
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
          echo '<a href="userpage.php?id='.$user_id.'">Account</a>';
          echo '<a href="LandingPage.php">Log Out</a>';
        }
          ?>
      </div>
  
  </nav>

    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
          <?php
              if(isset($_POST['editinfo'])){
              echo '
              <div class="container" style="text-align:center;">
              <form method="post">
              <input type="text" value="'.$info['first_name'].'" name="newfirstname">
              <input type="text" value="'.$info['last_name'].'" name="newlastname">
              <input type="text" value="'.$info['email'].'" name="newemail">
              <input type="text" value="'.$info['mobile'].'" name="newmobile">
              <input type="submit" value="Save Changes" name="newinfo" class="btn btn-primary">
              </form>
              </div>';
            }

            if(isset($_POST['changepass'])){
              echo '
              <div class="container" style="text-align:center;">
              <form method="post">
              <input type="password" name="oldpass" placeholder="Enter Old Password">
              <input type="password" name="newpass" placeholder="Enter New Password">
              <input type="submit" value="Save Changes" name="newpassbtn" class="btn btn-primary">
              </form>
              </div>';
            }

            if(isset($_POST['newpassbtn'])){
              $oldpass= $_POST['oldpass'];
              $newpass= $_POST['newpass'];
              $query2= "SELECT pass FROM user WHERE user_id=$user_id;";
              $result2= mysqli_query($conn, $query2);
              $oldpassword= mysqli_fetch_assoc($result2);
              if($oldpassword['pass'] == $oldpass){
              $query3= "UPDATE user SET pass='$newpass' WHERE user_id=$user_id;";
              $result3= mysqli_query($conn, $query3);
              }else{
                echo "<h5 style='color:red; text-align:center;'> The password you entered is wrong.</h5>";
                }
            }
            ?>
            <div class="col col-lg-6 mb-4 mb-lg-0">
              <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                  <div class="col-md-4 gradient-custom text-center text-white"
                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                    <img src="./img/userpic.png"
                      alt="Avatar" class="img-fluid "  />
                    <h5><?php echo $info['first_name'].' '.$info['last_name'];?></h5>
                    <div class="chang1" id="chang1">
                      <form method="post">
                        <button type="submit" name="editinfo" id="editinfo"><i class="far fa-edit mb-5"></i></button>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body p-4">
                      <h6>Information</h6>
                      <hr class="mt-0 mb-4">
                      <div class="row pt-1">
                        <div class="col-6 mb-3">
                          <h6>Email</h6>
                          <p class="text-muted" id="text1"><?php echo $info['email']?></p>
                        </div>
                        <div class="col-6 mb-3">
                          <h6>Phone</h6>
                          <p class="text-muted"><?php echo $info['mobile']?></p>
                        </div>
                      </div>
                      <h6>Password</h6>
                      <hr class="mt-0 mb-4">
                      <form method='post'>
                      <input type="submit" class="btn btn-primary" value="Change Password" name="changepass">
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- <script>
          document.getElementById("chang1").onclick = function(){
              document.getElementById("text1").innerHTML = "<input type='text' value='>info@example.com'>";
          }
      </script> -->
</body>
</html>