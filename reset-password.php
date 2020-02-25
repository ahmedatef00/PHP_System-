<?php 
    require "header.php";    
?>

    <main>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-8 m-auto">
                    <h1 class="text-center">Reset your password</h1>
                    <p>An e-mail will be send to you with instructions on how to reset your password.</p>
                    <form class="text-center" action="includes/reset-request.inc.php" method="post">
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Enter your e-mail address...">
                            <button class="btn btn-dark" type="submit" name="reset-request-submit">Receive new password by e-mail</button>
                        </div>
                    </form>
                    <?php
                        if (isset($_GET["reset"])) {
                            if ($_GET["reset"] == "success") {
                                echo '<p class="text-center success">Check your e-mail!</p>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

<?php
    require "footer.php";
?>