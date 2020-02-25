<?php 
    require "header.php";    
?>

    <main>
        <?php
            if (isset($_SESSION['userId'])) {
                echo '<p class="text-center mt-4">You are logged in!</p>';
            }
            else {
                echo '<p class="text-center mt-4">You are logged out!</p>';
            }
        ?>
    </main>

<?php
    require "footer.php";
?>