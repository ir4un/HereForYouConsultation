<?php
session_start();

$dbServerName = "localhost";
$dbUSername = "root";
$dbPassword = "";
$dbName = "hfyc_apu";

$conn = mysqli_connect($dbServerName, $dbUSername, $dbPassword, $dbName);
if (!$conn) {
    die(mysqli_connect_error());
}

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
        $returnHome = "onclick = \"" . "location.href = '../profile/user/Profile/userprofilev2.php'\"";

        if (isset($_GET['submit']) && $_GET['submit'] == 'processing') {
            $sql = "UPDATE normal_user SET NormalUserChillBuds = 1 WHERE UserID = " . $_SESSION['id'];
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>
                alert('ChillBuds Registration Successful!');
                location.href = 'chillbudscontentv2.php';
                </script>";
            }
        }
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
        $returnHome = "onclick = \"" . "location.href = '../profile/admin/Profile/adminprofilev2.php'\"";

        if (isset($_GET['submit']) && $_GET['submit'] == 'processing') {
            $sql = "UPDATE `admin` SET AdminChillBuds = 1 WHERE UserID = " . $_SESSION['id'];
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>
                alert('ChillBuds Registration Successful!');
                location.href = 'chillbudscontentv2.php';
                </script>";
            }
        }
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
        $returnHome = "onclick = \"" . "location.href = '../profile/consultor/Profile/consultorprofilev2.php'\"";

        if (isset($_GET['submit']) && $_GET['submit'] == 'processing') {
            $sql = "UPDATE consultor SET ConsultorChillBuds = 1 WHERE UserID = " . $_SESSION['id'];
            if ($result = mysqli_query($conn, $sql)) {
                echo "<script>
                alert('ChillBuds Registration Successful!');
                location.href = 'chillbudscontentv2.php';
                </script>";
            }
        }
    }
} else {
    $role = "guests";
    $name = "Guest";
    $returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
    //echo $returnHome;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC | ChilBuds Sign Up</title>
    <link rel="stylesheet" href="signupv2.css">
    <link rel="stylesheet" href="sidebartemplate.css">
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
            <form style="--i: 1.8s" action="../m_connection/logout.con.php" method="post">
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
                if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else {
                    echo "<img src= '../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
                }
            }
            ?>
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
            <?php
            require '../sidebar_template.php';
            ?>
        </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
        <div class="profile_info">
            <?php
            if (isset($_SESSION['id'])) {
                if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                    echo "<img src='" . '../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else {
                    echo "<img src= '../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
                }
            }
            ?>
            <h4><?php echo $name; ?></h4>
        </div>
        <?php
        require '../sidebar_template.php';
        ?>
    </div>
    <!--sidebar end-->

    <div class="content">
        <div class="page-msg">
            <h1>ChillBuds Sign Up</h1>
            <h2>Please agree to the terms & condition to start using ChillBuds!</h2>
        </div>

        <div class="main-content">
            <form method="post" action="" class="tc-form">
                <div class="tnc">
                    <p>
                        Please read through ChillBuds' <br> <a href="../others/terms/terms.php">Terms & Conditions</a> before
                        agreeing by clicking on the "Join ChillBuds Now!" button.
                    </p>
                    <img src="read.gif" alt="tnc-img" class="tnc-img">
                </div>

                <div class="btn">
                    <button class="btn-submit" type="submit" onclick="location.href='signupv2.php?submit=processing'; return false;">Join ChillBuds Now!</button>
                </div>
            </form>
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