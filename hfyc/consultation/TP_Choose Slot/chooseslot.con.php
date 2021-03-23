<?php
session_start();

if (isset($_POST["slotbutton"])) {
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
    $_SESSION['setConsultationid'] = $_POST['consultationid'];
    $_SESSION['setConsultorid'] = $_POST['consultorid'];
    $_SESSION['setDate'] = $_POST['date'];
    $_SESSION['setStarttime'] = $_POST['start'];
    $_SESSION['setEndtime'] = $_POST['end'];

    header("Location: ../Consultation_Details/summaryv2.php?consultationid=" . $_POST['consultationid']);
    exit();
}
