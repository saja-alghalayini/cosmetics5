<?php
include_once 'connect.php';

if (isset($_GET["id"])) {
  $user_id = $_GET["id"];
}
if (!isset($_GET["id"])) {
  $homepath = 'landingpage.php';
  $shoppath = 'ProductsPage.php';
  $categorypath = 'CategoriesPage.php?';
  $cartpath = 'login.php';
  $about = 'aboutUS.php';
  $contact = 'contactUs.php';

  $pop="";
} else {
  $homepath = 'landingpage.php?id=' . $user_id;
  $shoppath = 'ProductsPage.php?id=' . $user_id;
  $categorypath = 'CategoriesPage.php?id=' . $user_id . '&';
  $cartpath = 'other/cart.php?id=' . $user_id;
  $about = 'aboutUS.php?id=' . $user_id;
  $contact = 'contactUs.php?id=' . $user_id;

  /* *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop* */
$querypop="SELECT * FROM cart INNER JOIN products WHERE cart.product_id=products.id  AND user_id=$user_id;";
$resultpop= mysqli_query($conn, $querypop);
$resultcheckpop = mysqli_num_rows($resultpop);

$quan_sum=0;
if($resultcheckpop > 0){
    while($rowpop = mysqli_fetch_assoc($resultpop)){
        $quan_sum+= $rowpop['quantity'];
    }
}

$_SESSION["quan_sum"]= $quan_sum;


if($_SESSION["quan_sum"]){
$numeric=$_SESSION["quan_sum"];
$pop='<div class="sub">'.$numeric.'</div>';
}else{
$pop='';
}
/* *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop*  *pop* */

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us Page</title>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7b836f378e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./CSS/aboutUs.css">
</head>

<body>

<nav style="display: flex;">
      
            <div>
                <img width="200px" src="./Images/logo.png">
            </div>

            <div>
                <a href="<?php echo $homepath; ?>">Home</a>
                <a href="<?php echo $shoppath; ?>">Shop</a>
                
                <a href="<?php echo $about; ?>">About Us</a>
                <a href="<?php echo $contact; ?>">Contact Us</a>
            </div>
            
            <div>
              <?php
              echo '<a class="num" href="' . $cartpath . '">
              '.$pop.'<i class="fa-solid fa-cart-shopping"></i></a>';
              if(!isset($_GET["id"])){
                echo '<a href="login.php">Login</a>
                      <a href="signup.php">Register</a>';
              }else{
                echo '<a href="userpage.php?id='.$user_id.'">Account</a>';
                echo '<a href="LandingPage.php">Log Out</a>';
              }

              if(isset($_GET["id"])){
                $id= $_GET["id"];
                $loginpath= "&id=".$id;
              }else{
                $loginpath= "";
              }
                ?>
            </div>
        </nav>


  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-6 col-6">
            <div class="row">
              <div class="col-lg-12 col-md-12 mt-4 pt-2">
                <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                  <img src="./img/ourteam1.jpg" class="img-fluid" alt="Image" />
                  <div class="img-overlay bg-dark"></div>
                </div>
              </div>
              <!--end col-->


            </div>
            <!--end row-->
          </div>
          <!--end col-->

          <div class="col-lg-6 col-md-6 col-6">
            <div class="row">
              <div class="col-lg-12 col-md-12">
                <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                  <img src="./img/ourteam3.jpg" class="img-fluid" alt="Image" />
                  <div class="img-overlay bg-dark"></div>
                </div>
              </div>
              <!--end col-->

              <div class="col-lg-12 col-md-12 mt-4 pt-2">
                <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                  <img src="./img/ourteam2.jpg" class="img-fluid" alt="Image" />
                  <div class="img-overlay bg-dark"></div>
                </div>
              </div>
              <!--end col-->
            </div>
            <!--end row-->
          </div>
          <!--end col-->
        </div>
        <!--end row-->
      </div>
      <!--end col-->

      <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2">
        <div class="section-title ml-lg-5">
          <h5 class="text-custom font-weight-normal mb-3 ">Our Story </h5>
          <h4 class="title mb-4 display-4 "><span class="custom"> Beauty</span> Care Team </h4>
          <p class="text-muted mb-0 cus">We are a team of five people from the Orange Academy for Programming, Aqaba branch, and this is our fifth project; we were able to build this website for four continuous days without interruption using the technology that we learned during three months of this program, 4 of our team members do not have any background IT knowledge, so we are proud of this achievement that we have done. We are delighted with the enjoyable time we spent together completing this excellent site, and we believe that it will be a new step for our progress in this field.</p>

          <a href="<?php echo $homepath; ?>" style="display: block;" class="butt">Explor</a>
        </div>
      </div>
      <!--end col-->
    </div>
    <!--enr row-->




    <div class=" py-5 flx">
      <div class="container py-5  ">
        <div class="row mb-4">
          <div class="col-lg-5">
            <h2 class="display-4 font-weight-light text-center">Our team</h2>

          </div>
        </div>

        <div class="row text-center flx">

          <!-- Team item-->
          <div class="row text-center flx">
            <!-- Team item-->
            <!-- was edited -->
            <div class="col-xl-4 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./img/bahaa.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Baha'a Aldeen</h5><span class="small text-uppercase text-muted">CEO - Founder <br> Back-end Expert(The PERSON for hardest tasks)</span>
                <ul class="social mb-0 list-inline mt-3">
                  <li class="list-inline-item"><a href="https://www.facebook.com/bahaa.aldeen.3348" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a href="https://github.com/bahaa12edeen" target="_blank" class="social-link"><i class="fa fa-github"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.facebook.com/bahaa.aldeen.3348" target="_blank" class="social-link"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.linkedin.com/in/bahaa-aldeen-489081232" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-4 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./img/gufran.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Ghufran Almomani</h5><span class="small text-uppercase text-muted">CEO - Founder  <br>Our Creative Designer
</span>
                <ul class="social mb-0 list-inline mt-3">
                  <li class="list-inline-item"><a href="https://web.facebook.com/ghufran.almomani" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a href="https://github.com/ghufranalmomani/" target="_blank" class="social-link"><i class="fa fa-github"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/almomanighufran" target="_blank" class="social-link"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.linkedin.com/in/ghufran-almomani-777b93232" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-4 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./img/Roaa.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Ro'a Yaseen</h5><span class="small text-uppercase text-muted">CEO - Founder <br> Scrum Master </span>
                <ul class="social mb-0 list-inline mt-3">
                  <li class="list-inline-item"><a href="https://web.facebook.com/roaa.yaseen.9/" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a href="https://github.com/roayas" target="_blank" class="social-link"><i class="fa fa-github"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/roaa.yaseen.9" target="_blank" class="social-link"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.linkedin.com/in/ro-a-yaseen-58076696" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->

            <div class="col-xl-4 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./img/sara.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Sara Kteifan</h5><span class="small text-uppercase text-muted">CEO - Founder <br>Product Owner</span>
                <ul class="social mb-0 list-inline mt-3">
                  <li class="list-inline-item"><a href="https://www.facebook.com/sara.kteifan" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a href="https://github.com/SaraKteifan" target="_blank" class="social-link"><i class="fa fa-github"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/sara_kteifan" target="_blank" class="social-link"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.linkedin.com/in/sara-kteifan-38803222a" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-4 col-sm-6 mb-5 ">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="./img/sajaa.jpg" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Saja Al Ghalayini </h5><span class="small text-uppercase text-muted">CEO - Founder <br>Data Base Expert</span>
                <ul class="social mb-0 list-inline mt-3">
                  <li class="list-inline-item"><a href="https://www.facebook.com/Saja.AlGhalayini" target="_blank" class="social-link"><i class="fa fa-facebook-f"></i></a></li>
                  <li class="list-inline-item"><a href="https://github.com/saja-alghalayini" target="_blank" class="social-link"><i class="fa fa-github"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.instagram.com/_saja_alghalayini" target="_blank" class="social-link"><i class="fa fa-instagram"></i></a></li>
                  <li class="list-inline-item"><a href="https://www.linkedin.com/in/saja-al-ghalayini" target="_blank" class="social-link"><i class="fa fa-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- End-->


        </div>
      </div>
    </div>
  </div>


  <footer>
    <div id="footerdiv">
        <div class="col-3">
            <img src="./Images/logo.png">
        </div>
        <div class="col-3">
            <h1 style="text-align: center;">Stay In Touch</h1><br>
            <h2 style="text-align: center;"></h2>
            <p style="text-align: center;" >
            <a href="https://www.facebook.com/sephora/" target="_blank" ><i class="fa-brands fa-facebook"style="display: inline;"></a></i>
            <a href="https://www.instagram.com/sephora/" target="_blank" ><i class="fa-brands fa-instagram"style="display: inline;"></a></i>
            <a href="https://www.linkedin.com/company/sephora/" target="_blank" ><i class="fa-brands fa-linkedin"style="display: inline;"></a></i>
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