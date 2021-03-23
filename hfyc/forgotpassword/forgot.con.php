<?php

if (isset($_POST["forgot-submit"])) {
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://localhost/SDP/hfyc/forgotpassword/resetpasswordv2.php?selector=" . $selector . "&validator=" . bin2hex($token); 

    $expires = date("U") + 3600;

    require '../m_connection/db.con.php'; 

    $Email = $_POST["email"];

    $sql = "DELETE FROM reset WHERE ResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $Email);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO reset (ResetEmail, ResetSelector, ResetToken, ResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $Email, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to =  $Email;

    $subject = 'Password Reset for HereForYou Consultation';

    $message = '<p> A password reset was requested by you. The link to reset your password is below.
                    If you did not make this request, you can ignore this email. </p>';
    $message .= '<p> Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: HereForYou Consultation <sdpapu2401@gmail.com>\r\n";
    $headers .= "Reply-To: sdpapu2401@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: forgotpasswordformv2.php?reset=success");
    
} else {
    header("Location: ../home/user/guesthomepage.php");
}