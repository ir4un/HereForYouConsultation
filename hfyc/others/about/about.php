<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
require "../../m_connection/db.con.php";
if (isset($_SESSION['id'])) {
  $sql = "SELECT UserRole FROM users WHERE UserID = " . $_SESSION['id'];
  $role = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserRole'];
  if ($role == 'student') {
    $sql = 'SELECT * FROM normal_user WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $tp = $row['NormalUserTP'];
      $name = $row['NormalUserName'];
      $gender = $row['NormalUserGender'];
      $age = $row['NormalUserAge'];
      $address = $row['NormalUserAddress'];
      $description = $row["NormalUserDescription"];
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";
  } else if ($role == 'admin') {
    $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $tp = $row['AdminTP'];
      $name = $row['AdminName'];
      $gender = $row['AdminGender'];
      $age = $row['AdminAge'];
      $address = $row['AdminAddress'];
      $description = $row["AdminDescription"];
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";
  } else if ($role == 'consultor') {
    $sql = 'SELECT * FROM consultor WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $tp = $row['ConsultorTP'];
      $name = $row['ConsultorName'];
      $gender = $row['ConsultorGender'];
      $age = $row['ConsultorAge'];
      $address = $row['ConsultorAddress'];
      $description = $row["ConsultorDescription"];
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";
  }
} else {
  $role = "guests";
  $name = "Guest";
  $returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
  //echo $returnHome;
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HYFC | About Us</title>
  <link rel="stylesheet" href="about.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  <link rel="icon" href="HFYCIcon.png">
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
      <?php
      if (isset($_SESSION['id'])) {
        echo '<form style="--i: 1.8s" action="../../m_connection/logout.con.php" method="post">
                    <button type="submit" name="logout-submit" class="logout_btn"><i class="fas fa-power-off"></i>Logout</button>';
      } else {
        echo '<button type="submit" name="logout-submit" class="sign_in_btn" onclick="location.href = ' . "'" . '../../logsignsys/login/login.php' . "'" . '"' . '><i class="fas fa-sign-in-alt"></i>Sign In</button><br>
                    <button type="submit" name="logout-submit" class="register_btn" onclick="location.href = ' . "'" . '../../logsignsys/signup/student_registerv2.php' . "'" . '"' . '><i class="fas fa-user-alt"></i>Register</button>';
      }
      ?>
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
    <div class="page-desc">
      <h1>About Us</h1>
      <h3>Want to know more about us? Then, you have come to the right place!</h3>
    </div>

    <div class="aboutus-content">
      <div class="book-consultation">
        <h1>Book Consultation</h1>
        <img src="consultation.jpg" alt="bc-img">
        <h3>Enjoy Top Notch Consultation Services Provided!</h3>
      </div>
      <div class="talk-it-out">
        <h1>Talk-it-Out Forum</h1>
        <img src="talk-it-out.jpg" alt="tio-img">
        <h3>Share Your Thoughts & Opinions with Everyone!</h3>
      </div>
      <div class="chillbuds">
        <h1>ChillBuds</h1>
        <img src="friends.jpg" alt="c-img">
        <h3>Meet New Friends and Get Connected!</h3>
      </div>
      <div class="latest-news">
        <h1>Latest News</h1>
        <img src="latest-news.jpg" alt="ln-img">
        <h3>Gain The Latest News on Various Topics!</h3>
      </div>
      <div class="access">
        <img src="laptop-access.png" alt="la-img" class="la-img">
        <img src="mobile-access.png" alt="ma-img" class="ma-img">
        <h3>You Can Access the Website via Your Mobile Devices and Desktop!</h3>
      </div>
      <div class="register-now">
        <img src="dumbfounded.gif" alt="dumbfounded" class="rn-img">
        <h3>What Are You Waiting For!?</h3>
        <?php
        if(!isset($_SESSION['id'])){
          echo '<button class="btn-signup">Sign Up Now!</button>';
        }
        ?>
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