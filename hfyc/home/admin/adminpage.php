<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start();
require "db.con.php";
if (isset($_SESSION['id'])) {
  $sql = "SELECT UserRole FROM users WHERE UserID = " . $_SESSION['id'];
  $role = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserRole'];
  if ($role == 'admin') {
    $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
      $tp = $row['AdminTP'];
      $name = $row['AdminName'];
      $gender = $row['AdminGender'];
      $age = $row['AdminAge'];
      $address = $row['AdminAddress'];
      $description = $row["AdminDescription"];
    } else {
      echo "<script>
      alert('Please login as Admin to continue!');
      location.href = document.referrer;
      </script>";
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";
  }
} else {
  echo "<script>
  alert('Please login as Admin to continue!');
  location.href = document.referrer;
  </script>";
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HYFC | Admin Page</title>
  <link rel="stylesheet" href="adminpage.css">
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
    <div class="page-msg">
      <h1>Welcome To The Admin Page</h1>
      <h2>"With Great Power Comes Great Responsibility"</h2>
    </div>
    <!--main grid containing all content-->
    <div class="mainlist">
      <!--php to retrieve data from database-->
      <?php
      $sql1 = "SELECT UserID FROM users WHERE UserRole = 'student'";
      $result1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_num_rows($result1);

      $sql2 = "SELECT UserID FROM users WHERE UserRole = 'consultor'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_num_rows($result2);

      $sql3 = "SELECT UserID FROM users WHERE UserRole = 'admin'";
      $result3 = mysqli_query($conn, $sql2);
      $row3 = mysqli_num_rows($result3);

      $sql4 = "SELECT ConsultID FROM consultation_info";
      $result4 = mysqli_query($conn, $sql4);
      $row4 = mysqli_num_rows($result4);
      ?>

      <!--grid 1: contains thumbnail-->
      <div class="thumbnail"><img src="work.jpg" class="thumb" alt="thumb"></div>
      <!--grid 2,3,4: contains number of student, consultor and admin-->
      <div class="studentnum">
        <h1>Number of Registered Students: </h1>
        <h2><i>
            <?php echo $row1; ?>
          </i></h2>
      </div>
      <div class="consultornum">
        <h1>Number of Registered Consultors: </h1>
        <h2><i>
            <?php echo $row2; ?>
          </i></h2>
      </div>
      <div class="adminnum">
        <h1>Number of Registered Admins: </h1>
        <h2><i>
            <?php echo $row3; ?>
          </i></h2>
      </div>
      <div class="consultationnum">
        <h1>Total Number of Consultations Provided: </h1>
        <h2><i>
            <?php echo $row4; ?>
          </i></h2>
      </div>

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
</body>

</html>