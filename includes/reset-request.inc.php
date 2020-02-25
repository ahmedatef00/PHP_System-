<?php

if (isset($_POST["reset-request-submit"])) {
    $selector = bin2hex(random_bytes(8)); // 
    $token = random_bytes(32);

    $url = "localhost:5050/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);
    $expiresDate = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];//name attribute inside the form 



//delete any existing token 
    $sql = "DELETE FROM passwordReset WHERE passwordResetEmail = ?;";


    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'There was an unexpected error';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO passwordReset (passwordResetEmail, passwordResetSelector, passwordResetToken, passwordResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'There was an unexpected error';
        exit();
    } else {

        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

       
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expiresDate);
       
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    //sending email 


    $to = $userEmail;
    $subject = "Reset your password for mmtuts";

    $message = '<p>We received a password reset request. The link to reset your password is below, if you did not make this request, you can ignor this email</p>';
    $message .= '<p>Here is your password reset link: <br>';
    $message .= '<a href="      ' .$url .'  "     >       ' .$url . '     </a></p>';

    $headers = "From: mmtuts <azerty.test.email@gmail.com>\r\n";
    $headers .= "Reply-To: azerty.test.email@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    header("Location: ../reset-password.php?reset=success");
} else {
    header("Location: ../index.php");
}