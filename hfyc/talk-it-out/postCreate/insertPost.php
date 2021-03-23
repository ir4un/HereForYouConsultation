<?php
session_start();
if (isset($_POST["btn-submit"])) {
    $dBServername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "hfyc_apu";

    // Create connection
    $conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $currentDateTime = date('Y-m-d H:i:s');
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    $id = $_SESSION["id"];
    $date_time = $_POST["time_create_post"];
    $default = 0;
    //$user = $_POST["user_create_post"];

    if (empty($post_title) || empty($post_content)) {
        header("Location: createpost.php?loginerror=emptyFields");
        exit();
    } else {


        $sql = "INSERT INTO talk_it_out_post (`Post_Title`, `Post_Content`, `Post_Date_Time`, `UserID`, `Post_Upvote`) VALUES (?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: createpost.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssii", $post_title, $post_content, $currentDateTime, $id, $default);
            mysqli_stmt_execute($stmt);
            header("Location: createpost.php?submit=success");
            exit();
        }
    }
}
