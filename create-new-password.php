<?php 
    require "header.php";    
?>

    <main>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <?php
                    if (isset($_GET["newpassword"])) {
                        if ($_GET["newpassword"] == "empty") {
                             echo '<p class="danger">Your password cannot be empty!</p>';
                        }
                        else if ($_GET["newpassword"] == "passwordnotsame") {
                            echo '<p class="danger">Your password has been resetted!</p>';
                        }
                    }
                    ?>
                    <?php
                        $selector = $_GET["selector"];
                        $validator = $_GET["validator"];


                        if (empty($selector) || empty($validator)) {
                            echo 'We could not validate your request!';
                            exit();
                        } 
                        //illget's tokens if these hexadecimal ??? ctype_xdigit() true or false if it's not = tp false
                        else if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                            ?>
                                <form action="includes/reset-password.inc.php" method="POST">
                                    <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                                    <input type="password" name="password" placeholder="Enter a new password...">
                                    <input type="password" name="password-repeat" placeholder="Repeat new password...">
                                    <button type="submit" name="reset-password-submit">Reset password</button>
                                </form>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>