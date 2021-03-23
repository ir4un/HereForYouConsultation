<?php

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
$consult = $_GET['id'];
$sql = "DELETE  FROM `Consultor_Consultation` WHERE Consultation_ID = $consult";
mysqli_query($conn, $sql);

//$secondWait = 1;
//echo '<meta http-equiv="refresh" content="' . $secondWait . '">';

if (mysqli_affected_rows($conn) <= 0) {
    echo "<script>alert('Unable to delete data!');";
    die("window.location.href='consultv2.php';</script>");
}

//echo "<script> alert('Slot deleted!');</script>";
echo "<script> window.location.href='consultv2.php';</script>";
mysqli_close($conn);

?>