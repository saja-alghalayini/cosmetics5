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
    <nav>
        <div class="logo">
            <img src="./images/logo.png" width="200px" alt="">
        </div>
        <div class="tab1">
            <a href="">HOME</a>
            <a href="">PRODUCTS</a>
            <a href="">CART</a>
            <a href="">CONTACT US</a>
            <a href="">ABOUT US</a>
        </div>
        <div class="tab2">
            <a href="">LOGIN</a>
            <a href="">REGISTER</a>
        </div>
    </nav>

    <div class="board">
    <form action="" method="get">
        <h1 class="bhead">CheckOut</h1>
        <div class="parent">
            <div class="side1">
                
                    <div class="name">
                        <div style="width: 45%;">
                            <label for="">First name</label>
                            <br>
                            <input type="text" name="first" class="first" id="first">
                        </div>
                        <div style="width: 45%;">
                            <label for="">Last name</label>
                            <br>
                            <input type="text" class="last" id="last">
                        </div>
                    </div>
                    <div class="num">
                        <label for="">Phone</label>
                        <br>
                        <input type="phone" class="phone" id="phone">
                    </div>
                    <div class="mail">
                        <label for="">Email</label>
                        <br>
                        <input type="email" class="email" id="email">
                    </div>
                    <div class="cou">
                        <label for="">Country</label>
                        <br>
                        <input type="text" class="country" id="country">
                    </div>
                    <div class="town">
                        <label for="">City</label>
                        <br>
                        <input type="text" class="city" id="city">  
                    </div>
                    <div class="tall">
                       <label for="">Street</label>
                        <br>
                        <input type="text" class="street" id="street">
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

                    <tr>
                        <td>Product1</td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">16$</td>
                        <td style="text-align: right;">16$</td>
                    </tr>

                    <tr>
                        <td>Product2</td>
                        <td style="text-align: center;">1</td>
                        <td style="text-align: center;">30$</td>
                        <td style="text-align: right;">30$</td>
                    </tr>

                    <tr>
                        <th style="text-align: left;">Total</th>
                        <th style="text-align: right;"colspan="3">46$</th>
                    </tr>
                </table>
                <div>
                    <input type="submit" value="Place Order" class="submit" id="submit">
                </div>
            </div>
        </div>
    </form>
    </div>

    <script>

    </script>
</body>
</html>