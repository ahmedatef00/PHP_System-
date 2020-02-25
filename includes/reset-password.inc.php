<?php

if (isset($_POST["reset-password-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../create-new-password.php?newpassword=empty");
        exit();
    } else if ($password != $passwordRepeat) {
        header("Location: ../create-new-password.php?newpassword=passwordnotsame&selector=".$selector."&validator=".$validator);
        exit();
    }

    $currentDate = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM passwordReset WHERE passwordResetSelector = ? AND passwordResetExpires >= $currentDate;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysql_stmt_prepare($stmt, $sql)) {
        echo 'There was an unexpected error';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $selector);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
            exit();
        } else {
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["passwordResetToken"]);

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $row["passwordResetEmail"];
                $sql = "SELECT * FROM users where email = ?;";

                if (!mysql_stmt_prepare($stmt, $sql)) {
                    echo 'There was an unexpected error';
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There was an error!";
                        exit();
                    } else {
                        $sql = "UPDATE users SET password = ? WHERE email = ?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysql_stmt_prepare($stmt, $sql)) {
                            echo 'There was an unexpected error';
                            exit();
                        } else {
                            $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newHashedPassword, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM passwordReset WHERE passwordResetEmail = ?;";
                            $stmt = mysqli_stmt_init($conn);
    
                            if (!mysql_stmt_prepare($stmt, $sql)) {
                                echo 'There was an unexpected error';
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../signup.phph?newpassword=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }

    // mysqli_stmt_close($stmt);
    // mysqli_close();

} else {
    header("Location: ../index.php");
}

?>