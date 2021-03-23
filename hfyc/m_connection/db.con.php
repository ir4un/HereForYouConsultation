<?php
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "hfyc_apu";
$dbName2 = "apu_dummy_data";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dbName);
$conn2 = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dbName2);

// Check connection
if ((!$conn) || (!$conn2)) {
    die("Connection failed: " . mysqli_connect_error());
}