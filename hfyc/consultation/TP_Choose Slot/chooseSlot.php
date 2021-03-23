<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
require "db.con.php";
if (isset($_SESSION['id'])) {
  $sql = 'SELECT * FROM normal_user WHERE UserID = ' . $_SESSION['id'];
  $result = mysqli_query($conn, $sql);
  $role = "student";
  while ($row = mysqli_fetch_assoc($result)) {
    $tp = $row['NormalUserTP'];
    $name = $row['NormalUserName'];
    $gender = $row['NormalUserGender'];
    $age = $row['NormalUserAge'];
    $address = $row['NormalUserAddress'];
    $description = $row["NormalUserDescription"];
  }
  $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";
} else {
  echo "<script>
  alert('Please login as Student to continue!');
  location.href = document.referrer;
  </script>";
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HYFC Choose Consultation</title>
  <link rel="stylesheet" href="test.css">
  <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
  <input type="checkbox" id="check" checked=checked>
  <!--header area start-->
  <header>
    <label for="check">
      <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
      <h3>HEREFORYOU <span>CONSULTATION</span></h3>
    </div>
    <div class="right_area">
      <form style="--i: 1.8s" action="../../m_connection/logout.con.php" method="post">
        <button type="submit" name="logout-submit" class="logout_btn"><i class="fas fa-power-off"></i>Logout</button>
      </form>
    </div>
  </header>
  <!--header area end-->
  <!--mobile navigation bar start-->
  <div class="mobile_nav">
    <div class="nav_bar">
      <?php
      if (isset($_SESSION['id'])) {
        if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
        } else {
          echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
        }
      }
      ?>
      <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">
      <?php
      require '../../sidebar_template.php';
      ?>
    </div>
  </div>
  <!--mobile navigation bar end-->
  <!--sidebar start-->
  <div class="sidebar">
    <div class="profile_info">
      <?php
      if (isset($_SESSION['id'])) {
        if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='profile_image' $returnHome>";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='profile_image' $returnHome>";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
          echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='profile_image' $returnHome>";
        } else {
          echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
        }
      }
      ?>
      <h4><?php echo $name; ?></h4>
    </div>
    <?php
    require '../../sidebar_template.php';
    ?>
  </div>
  <!--sidebar end-->

  <div class="content">
    <div class="cardTitle">
      <p>Choose a consultation slot</p>
    </div>

    <div class="card">
      <div class="mainlist">
        <?php
        if (isset($_SESSION['id'])) {
          $sql = "SELECT ConsultorTP FROM consultor WHERE ConsultorID = " . $_GET['id'];
          $tp = mysqli_fetch_row(mysqli_query($conn, $sql))[0];

          $sql = "SELECT * FROM consultor_consultation WHERE Consultor_ID = '$tp' AND SlotStatus LIKE 'Available'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            $resultrows = mysqli_num_rows($result);

            if ($resultrows > 0) {

              $index = 0; // Define variable for store the indexes 
              $tablecount = 0;
              while ($row = mysqli_fetch_assoc($result)) {

                if ($index % 1 == 0) echo '<div class="gridlist">'; // Check modulus (%) of $index. Open tr if the modulus is 0


                echo '<h1>' . $row['Consult_Date'] . '</h1>';
                echo '<br><br>';

                echo '<h2>' . $row['Start_Time'] . '</h2>';
                echo '<h4>Until</h4>';

                echo '<h3>' . $row['End_Time'] . '</h3>';
                echo '<br><br>';

                echo '<form method="POST" action="chooseslot.con.php">';

                $consultationid = $row["Consultation_ID"];
                $consultorid = $row['Consultor_ID'];
                $date = $row['Consult_Date'];
                $start = $row['Start_Time'];
                $end = $row['End_Time'];
                $status = $row['SlotStatus'];

                echo '<input type="hidden" name="consultationid" id="consultationid" class="consultationid" value=' . $consultationid . '>';
                echo '<input type="hidden" name="consultorid" id="consultorid" class="consultorid" value=' . $consultorid . '>';
                echo '<input type="hidden" name="date" id="date" class="date" value=' . $date . '>';
                echo '<input type="hidden" name="start" id="start" class="start" value="' . $start . '">';
                echo '<input type="hidden" name="end" id="end" class="end" value="' . $end . '">';

                echo '<button class="slotbutton" type="submit" name="slotbutton" id="slotbutton">Select Slot</button></form>';



                $index++;
                // Increment the value of $index
                if ($index % 1 == 0)  echo '</div>'; // Check modulus (%) of $index. Close tr if the modulus is 0
              }
            } else {
              echo '<tr>';
              echo '<td><img class="error-img" style="align-items:center; "src="searching.gif" alt="Searching Image" /></td>';
              echo '<tr/>';
              echo '<tr>';
              echo '<td><h2 style="background-color:white; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">There are currently no available consultation slots</h2></td>';
              echo '<tr/>';
            }
          } else {

            echo '<tr>';
            echo '<td><img class="error-img" style="align-items:center; "src="searching.gif" alt="Searching Image" /></td>';
            echo '<tr/>';
            echo '<tr>';
            echo '<td><h2 style="background-color:white; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">There are currently no available consultation slots</h2></td>';
            echo '<tr/>';
          }

          mysqli_close($conn);
        } else {

          echo '<tr>';
          echo '<td><img class="error-img" style="align-items:center; "src="searching.gif" alt="Searching Image" /></td>';
          echo '<tr/>';
          echo '<tr>';
          echo '<td><h2 style="background-color:white; padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px;">There are currently no available consultation slots</h2></td>';
          echo '<tr/>';
        }



        ?>
      </div>
    </div>


    <script type="text/javascript">
      $(document).ready(function() {
        $('.nav_btn').click(function() {
          $('.mobile_nav_items').toggleClass('active');
        });
      });
    </script>

    <footer>
      <h3>Get in Touch</h3>
      <p>Email or call us if you have any questions</p>
      <p>Email: <strong>contact@hfyc.test</strong></p>
      <p>Phone:
        <strong>+601131313131</strong>
      </p>
      <p class="social-media">
        <a href="https://www.facebook.com/Here4U-Consultation-104752271688960"><i class="fab fa-facebook" onclick=""></i></a>
        <a href="https://twitter.com/Here4uC"><i class="fab fa-twitter"></i></a>
        <a href="https://discord.gg/8VDjdcyZDS"><i class="fab fa-discord"></i></a>
        <a href="https://tinyurl.com/2sueavzs"><i class="fab fa-microsoft"></i></a>
        <a href="https://www.instagram.com/here4u_consultation/"><i class="fab fa-instagram"></i></a>
      </p>
    </footer>

  </div>

</body>

</html>