<?php

session_start();

if (isset($_POST['img-submit'])) {

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

   $sql = "SELECT * from news_data";
   $result = $conn->query($sql);
   $amountOfNews = mysqli_num_rows($result);
   $amountOfNews++;

   $file = $_FILES['file'];
   $fileName = $_FILES['file']['name'];
   $fileTmpName = $_FILES['file']['tmp_name'];
   $fileSize = $_FILES['file']['size'];
   $fileError = $_FILES['file']['error'];
   $fileType = $_FILES['file']['type'];

   $fileExt = explode('.', $fileName);
   $fileActualExt = strtolower(end($fileExt));

   $allowed_list = array("jpg", "png", "jpeg");

   if (in_array($fileActualExt, $allowed_list)) {
      if ($fileError === 0) {
         if ($fileSize < 1000000) {
            $fileNameNew = "newsthumb" . $amountOfNews . "." . $fileActualExt;
            $fileDestination = '../Uploaded_Files/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
         } else {
            echo "The File Size Is Too Big, Try Something Smaller!";
            exit();
         }
      } else {
         echo "An Error Happened While Uploading, Please Try Again :^(";
         exit();
      }
   } else {
      echo "You cannot upload files of this type (Only .jpg allowed)!!!";
      exit();
   }

   $newstitle = mysqli_real_escape_string($conn, $_POST['title']);
   $newscontent = mysqli_real_escape_string($conn, $_POST['cont']);
   $adminid = $_POST['adminid'];
   $news_date = date('Y-m-d', strtotime($_POST['date']));

   $sql2 = "INSERT INTO news_data (AdminID, NewsDate, NewsTitle, NewsContent) VALUES ($adminid, '$news_date', '$newstitle', '$newscontent');";

   if (mysqli_query($conn, $sql2)) {
      header("Location: Insert_News.php?submit=success");
      exit();
   } else {
      header("Location: Insert_News.php?error=sqlError");
   }
}
