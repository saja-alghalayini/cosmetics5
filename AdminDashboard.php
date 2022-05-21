<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/Admin.css">
    <script src="https://kit.fontawesome.com/aca8d5a1fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
    <div id="parent">
        <div class="col-11">
            <img src="./Images/logo.png" alt="logo">
            <span>Admin Dashboard</span>
        </div>
        <div class="col">
            <a href="LandingPage.php"><span>Log Out</span></a>
        </div>
    </div>
    </nav>

    <div class="container">
        <div class="col-3">
            <a href="AdminSales.php">
                <h1>Sales</h1>
                <i class="fa-solid fa-chart-column"></i>
            </a>
        </div>

        <div class="col-3">
            <a href="AdminUsers.php">
                <h1>Users</h1>
                <i class="fa-solid fa-users"></i>
            </a>
        </div>

        <div class="col-3">
            <a href="AdminCategories.php">
                <h1>Categories</h1>
                <i class="fa-solid fa-table"></i>
            </a>
        </div>

        <div class="col-3">
            <a href="AdminProducts.php">
                <h1>Products</h1>
                <i class="fa-solid fa-list"></i>
            </a>
        </div>
    </div>
</body>
</html>