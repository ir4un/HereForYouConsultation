<?php
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "hfyc_apu";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}