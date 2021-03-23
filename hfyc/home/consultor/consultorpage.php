<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
require "db.con.php";
if (isset($_SESSION['id'])) {
  $sql = "SELECT UserRole FROM users WHERE UserID = " . $_SESSION['id'];
  $role = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserRole'];
  if ($role == 'consultor') {
    $sql = 'SELECT * FROM consultor WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
      $tp = $row['ConsultorTP'];
      $name = $row['ConsultorName'];
      $gender = $row['ConsultorGender'];
      $age = $row['ConsultorAge'];
      $address = $row['ConsultorAddress'];
      $description = $row["ConsultorDescription"];
    } else {
      echo "<script>
      alert('Please login as Consultor to continue!');
      location.href = document.referrer;
      </script>";
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";
  }
} else {
  echo "<script>
  alert('Please login as Consultor to continue!');
  location.href = document.referrer;
  </script>";
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HYFC | Consultor Page</title>
  <link rel="stylesheet" href="consultorpage.css">
  <link rel="icon" href="HFYCIcon.png">
  <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
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
      if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
      } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
      } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
      } else {
        echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
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
      if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='profile_image' $returnHome>";
      } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='profile_image' $returnHome>";
      } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='profile_image' $returnHome>";
      } else {
        echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
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
    <div class="page-msg">
      <h1>Welcome To The Consultor Page</h1>
      <h2>"You are here to guide those who has lost their way, back to the right path"</h2>
    </div>
    <!--main grid containing all content-->
    <div class="mainlist">
      <!--php to retrieve data from database-->
      <?php
      $sql1 = "SELECT Consultation_ID FROM consultor_consultation WHERE Consultor_ID = '$tp'";
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_num_rows($result1);
      ?>

      <!--grid 1: contains thumbnail-->
      <div class="thumbnail"><img src="consult.jpg" class="thumb" alt="thumb"></div>
      <!--grid 2,3,4: contains number of student, consultor and admin-->
      <div class="consultationnum">
        <h1>Number of Consultations Available: </h1>
        <h2><i>
            <?php echo $row1; ?>
          </i></h2>
      </div>

      <div class="consultdetail">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hfyc_apu";

        $conn = mysqli_connect($servername, $username, $password, $db);

        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * from Consultor_Consultation where Consultor_ID = '$tp'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows <= 0) {
          echo "<img src = 'sadFace.png'>";
          echo "<h2>Oopss!!! It seems like you haven't added any slots yet. Add some for the users to book.<h2>";
        } else if ($result->num_rows >= 1) {
          echo "<table class='table-style' width='100%'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Date</th>";
          echo "<th >Time Slots</th>";
          echo "<th>Status</th>";
          echo "<th>Venue</th>";
          echo "</tr>";

          echo "</thead>";
          while ($row = $result->fetch_assoc()) {
            echo "<tbody>";
            echo "<tr>";
            echo "<td>" . $row["Consult_Date"] . "</td>";
            echo "<td>" . $row["Start_Time"] . " - " . $row["End_Time"] . "</td>";
            echo "<td>" . $row["SlotStatus"] . "</td>";
            echo "<td>" . $row["ConsultationVenue"] . "</td>";
            echo "</tr>";
          }
        }
        ?></table>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function() {
        $('.nav_btn').click(function() {
          $('.mobile_nav_items').toggleClass('active');
        });
      });

                      
                        $(function() { //document ready event
                            $('table tr').each(function() { //loop all tr's
                                var Cell = $(this).find('td:eq(2)'); //find the 3rd td cell
                                if (Cell.text() !== 'Ongoing') {
                                //if try then find the button of this tr and hide it 
                                    $(this).find('td').remove();
                                }
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
</body>

</html>