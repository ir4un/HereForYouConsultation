<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "hfyc_apu";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die(mysqli_connect_error());
}

if (isset($_SESSION['id'])) {
    $sql = "SELECT UserRole FROM users WHERE UserID = " . $_SESSION['id'];
    $role = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserRole'];
    if ($role == 'student') {
        $sql = 'SELECT * FROM normal_user WHERE UserID = ' . $_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $tp = $row['NormalUserTP'];
            $name = $row['NormalUserName'];
            $gender = $row['NormalUserGender'];
            $age = $row['NormalUserAge'];
            $address = $row['NormalUserAddress'];
            $description = $row["NormalUserDescription"];
        } else {
            echo "<script>
            alert('Please login as Student to continue!');
            location.href = document.referrer;
            </script>";
        }
        $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";
    }
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
    <title>HYFC | Homepage</title>
    <link rel="stylesheet" href="guesthomepage.css">
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
        <div class="card">
            <div class="mainlist">

                <div class="thumbnail"><img src="Image_Files/bg1.jpg" class="news_thumb" alt="news_thumb"></div>
                <div class="thumbtext">
                    <h1>Welcome to HereForYou <span>Consultation</span></h1>
                    <br>
                    <h2><i>Always Here, For You</i></h2>
                </div>
                <div class="border1"></div>
                <!--<div class="contentthumb1"><img src="Image_Files/bg3.jfif" class="news_thumb" alt="news_thumb"></div>-->
                <div class="contentdetail1">
                    <h1><i>"Our goal is to provide APU students a safe and easy to use online platform
                            <br>for them to be able to receive consultation from trusted profesionals."
                            <br> We believe that no one should be alone whenever they are facing a crisis in their life and studies and thus, <h2><b>We are here to help!</b></h2></i></h1>
                </div>
                <div class="border2"></div>
                <div class="contentdetail2">
                    <h1>Booking a consultation is easy as counting 1, 2 and 3</h1>
                </div>
                <div class="step-one">
                    <i class="fa fa-clipboard fa-4x"></i>
                    <h3>1. Select Consultation Type</h3>Simply select the type of consultation that fits your needs.
                </div>
                <div class="step-two">
                    <i class="fa fa-user-tie fa-4x"></i>
                    <h3>2. Select a Consultor Based On Your Preference</h3>We only provide only the best and well trained consultors.
                </div>
                <div class="step-three">
                    <i class="fa fa-calendar-alt fa-4x"></i>
                    <h3>3. Choose your time slot</h3>Pick the the most suitable time and date for your consultation.
                </div>
                <div class="border3"></div>
                <div class="contentthumb3">
                    <img src="Image_Files/bg4.jpg" class="news_thumb" alt="news_thumb">
                </div>
                <div class="contentdetail3">
                    <h1><i>"Get up to date with HereForYou Consultation latest updates
                            <br>and news in our <b>news page</b>"</i></h1>
                </div>
                <div class="border4"></div>
                <div class="contentthumb4">
                    <img src="Image_Files/bg5.jpg" class="news_thumb" alt="news_thumb">
                </div>
                <div class="contentdetail4">
                    <h1><i>"Find and get to know more other APU students using
                            <b>Chillbuds</b> to make new friends!"</i></h1>
                </div>
                <div class="border5"></div>
                <div class="contentthumb5">
                    <img src="Image_Files/bg6.jpg" class="news_thumb" alt="news_thumb">
                </div>
                <div class="contentdetail5">
                    <h1><i>"Discuss and share your opinions on Talk-It-Out and get your thoughts and opinions online and see other student's posts."</i></h1>
                </div>
                <div class="border6"></div>

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

<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

</html>