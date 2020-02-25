<?php 
    require "header.php";    
?>

    <main>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-6 m-auto ">
                <h1 class="text-center">Signup</h1>
                    <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "emptyfields") {
                                echo '<p class="text-center danger">Fill in all fields!</p>';
                            }
                            else if ($_GET['error'] == "invalidemailusername") {
                                echo '<p class="text-center danger">Invalid username and email!</p>';
                            }
                            else if ($_GET['error'] == "invalidemail") {
                                echo '<p class="text-center danger">Invalid email!</p>';
                            }
                            else if ($_GET['error'] == "invalidusername") {
                                echo '<p class="text-center danger">Invalid username!</p>';
                            }
                            else if ($_GET['error'] == "invalidpassword") {
                                echo '<p class="text-center danger">Your passwords do no match!</p>';
                            }
                            else if ($_GET['error'] == "usernametaken") {
                                echo '<p class="text-center danger">Username is already taken!</p>';
                            }
                        }
                        else if (isset($_GET['signup']) == "success") {
                            echo '<p class="text-center success">Signup successful!</p>';
                        }
                    ?>
                    <form class="text-center" action="includes/signup.inc.php" method="post">
                        <div class="form-group">
                        <?php
                            if (!empty($_GET['username'])) {
                                echo '<input type="text" name="username" placeholder="Username" value="'.$_GET["username"].'" required>';
                            } else {
                                echo '<input type="text" name="username" placeholder="Username" required>';
                            }
                        ?>
                        </div>
                        <div class="form-group">
                        <?php
                            if (!empty($_GET['email'])) {
                                echo '<input type="email" name="email" placeholder="E-mail" value="'.$_GET["email"].'" required>';
                            } else {
                                echo '<input type="email" name="email" placeholder="E-mail" required>';
                            }
                        ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password-repeat" placeholder="Repeat Password" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-dark" type="submit" name="signup-submit">Signup</button>
                        </div>
                    </form>
                    <div class="form-group text-center">
                        <?php
                            if (isset($_GET["newpassword"])) {
                                if ($_GET["newpassword"] == "passwordupdated") {
                                    echo '<p class="success">Your password has been resetted!</p>';
                                }
                            }
                        ?>
                        <a class="reset-password" href="reset-password.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>