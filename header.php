<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <title>PHP Login System</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="./images/php-logo.svg" alt="logo"/>
            </a>
            <div class="container-inline mr-auto">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About me</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </div>
            <div class="container-inline ml-auto">
                <?php
                if (isset($_SESSION['userId'])) {
                    echo '
                    <form class="form-group-logout" action="includes/logout.inc.php" method="post">
                        <button class="btn btn-danger" type="submit" name="logout-submit">Logout</button>
                    </form>
                    ';
                }
                else {
                    echo '
                    <form class="form-group-login" action="includes/login.inc.php" method="post">
                        <input type="text" name="mailusername" placeholder="Username/E-mail...">
                        <input type="password" name="password" placeholder="Password...">
                        <button class="btn btn-dark" type="submit" name="login-submit">Login</button>
                    </form>
                    <a class="btn btn-light" href="signup.php">Signup</a>
                    ';
                }
                ?>
            </div>
        </nav>
    </header>