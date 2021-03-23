<?php
session_start();

if (isset($_POST["btnSave"])) {
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
    $id = $_SESSION['tp'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];
    $status = "Available";
    $venue = $_POST['venue'];
    $sst = strtotime($start_time);
    $eet=  strtotime($end_time);
    $diff= $eet-$sst;
    $differenceInHours = $diff / 3600;


    if (empty($start_time) || empty($end_time) || empty($date) || empty($status)|| empty($venue)) {
        header("Location: consultv2.php?loginerror=emptyFields");
        exit();
    } elseif ($start_time == $end_time) {
        header("Location: consultv2.php?Timeerror=sameTime");
        exit();

    } elseif ($differenceInHours < 0) {
        header("Location: consultv2.php?invalidTimeSelected");
        exit();
    } elseif ($differenceInHours > 1) {
        header("Location: consultv2.php?oneHourOnlyLimit");
        exit();
    } else {
        $sql = "SELECT * from Consultor_Consultation where Consultor_ID = '$id' and  Consult_Date= '$date' and Start_Time = '$start_time' and End_Time = '$end_time'";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: consultv2.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $id, $date, $start_time, $end_time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCount = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);

            if ($resultCount > 0) {
                header("Location: consultv2.php?Slot=exist");
                exit();
            } else {
                $sql = "INSERT INTO Consultor_Consultation (`Start_Time`, `End_Time`, `Consult_Date`, `Consultor_ID`, `SlotStatus`, `ConsultationVenue`) VALUES (?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: consultv2.php?error=sqlError");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $start_time, $end_time, $date, $id, $status, $venue);
                    mysqli_stmt_execute($stmt);
                    header("Location: consultv2.php?submit=success");
                    exit();
                }
            }
        }
    }
}
