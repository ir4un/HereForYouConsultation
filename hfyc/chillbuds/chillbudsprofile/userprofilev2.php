<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
$dbServerName = 'localhost';
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
        while ($row = mysqli_fetch_assoc($result)) {
            $tp = $row['NormalUserTP'];
            $name1 = $row['NormalUserName'];
            $gender = $row['NormalUserGender'];
            $age = $row['NormalUserAge'];
            $address = $row['NormalUserAddress'];
            $description = $row["NormalUserDescription"];
        }
        $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";

        $sql = "SELECT NormalUserChillBuds FROM normal_user WHERE UserID = " . $_SESSION['id'];
        $chillbuds = mysqli_fetch_assoc(mysqli_query($conn, $sql))['NormalUserChillBuds'];
        if (!$chillbuds) {
            echo "<script>location.href = 'signupv2.php'</script>";
        }
    } else if ($role == 'admin') {
        $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $tp = $row['AdminTP'];
            $name1 = $row['AdminName'];
            $gender = $row['AdminGender'];
            $age = $row['AdminAge'];
            $address = $row['AdminAddress'];
            $description = $row["AdminDescription"];
        }
        $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";

        $sql = "SELECT AdminChillBuds FROM `admin` WHERE UserID = " . $_SESSION['id'];
        $chillbuds = mysqli_fetch_assoc(mysqli_query($conn, $sql))['AdminChillBuds'];
        if (!$chillbuds) {
            echo "<script>location.href = 'signupv2.php'</script>";
        }
    } else if ($role == 'consultor') {
        $sql = 'SELECT * FROM consultor WHERE UserID = ' . $_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $tp = $row['ConsultorTP'];
            $name1 = $row['ConsultorName'];
            $gender = $row['ConsultorGender'];
            $age = $row['ConsultorAge'];
            $address = $row['ConsultorAddress'];
            $description = $row["ConsultorDescription"];
        }
        $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";

        $sql = "SELECT ConsultorChillBuds FROM consultor WHERE UserID = " . $_SESSION['id'];
        $chillbuds = mysqli_fetch_assoc(mysqli_query($conn, $sql))['ConsultorChillBuds'];
        if (!$chillbuds) {
            echo "<script>location.href = 'signupv2.php'</script>";
        }
    }

    if (isset($_GET['id'])) {
        $chillbudsid = $_GET['id'];
        $sql = "SELECT UserRole FROM users WHERE UserID = " . $_GET['id'];
        $role = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserRole'];

        if ($role == 'admin') {
            $sql = "SELECT * FROM `admin` WHERE UserID = " . $_GET['id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['AdminName'];
            $tp = $row['AdminTP'];
            $age = $row['AdminAge'];
            $address = $row['AdminAddress'];
            $desc = $row['AdminDescription'];
        } else if ($role == 'consultor') {
            $sql = "SELECT * FROM `consultor` WHERE UserID = " . $_GET['id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['ConsultorName'];
            $tp = $row['ConsultorTP'];
            $age = $row['ConsultorAge'];
            $address = $row['ConsultorAddress'];
            $desc = $row['ConsultorDescription'];
        } else if ($role == 'student') {
            $sql = "SELECT * FROM `normal_user` WHERE UserID = " . $_GET['id'];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['NormalUserName'];
            $tp = $row['NormalUserTP'];
            $age = $row['NormalUserAge'];
            $address = $row['NormalUserAddress'];
            $desc = $row['NormalUserDescription'];
        }

        $sql = "SELECT UserEmail FROM users WHERE UserID = " . $_GET['id'];
        $email = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserEmail'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=0">
    <title>HYFC | User Chillbuds Profile</title>
    <link rel="stylesheet" href="userprofilev2.css">
    <link rel="stylesheet" href="../sidebartemplate.css">
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
            <h4><?php echo $name1; ?></h4>
        </div>
        <?php
        require '../../sidebar_template.php';
        ?>
    </div>
    <!--sidebar end-->

    <div class="content">
        <button class="big-button" id="back" onclick="history.back()"><i class="fas fa-arrow-circle-left"></i> Go
            Back</button>
        <div class="profile-username">
            <h1>Welcome to <?php echo $name; ?>'s Profile</h1>
        </div>
        <div class="profile-picture-box">
            <?php
            if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".jpg")) {
                echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".jpg" . "' alt='profile_image' class='profile-picture'>";
            } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".png")) {
                echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".png" . "' alt='profile_image' class='profile-picture'>";
            } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".jpeg")) {
                echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $chillbudsid . ".jpeg" . "' alt='profile_image' class='profile-picture'>";
            } else {
                echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='profile-picture'>";
            }
            ?>
            <!--<img src="af580fa9-93b0-40b5-b545-16b545322741.JPG" alt="profile.jpg" class="profile-picture">-->
        </div>

        <div class="real-name">
            <h2>
                <?php echo $name; ?>
            </h2>
        </div>
        <div class="profile-content">
            <h4>TP Number: <?php echo $tp; ?></h4>
            <h4>Age: <?php echo $age; ?></h4>
            <h4>Email: <?php echo $email; ?></h4>
            <h4>Address : <?php echo $address; ?></h4>
        </div>
        <div class="profile-buttons" hidden="hidden">
            <button id="btn-edit-profile" onclick="editprofile()"><b><i>Edit Profile</i></b></button>&nbsp;&nbsp;&nbsp;
            <button id="btn-edit-pwd" onclick="editpwd()"><b><i>Edit Password</i></b></button>&nbsp;&nbsp;&nbsp;
            <button id="btn-del-profile" onclick="delprofile()"><b><i>Delete Profile</i></b></button>&nbsp;&nbsp;&nbsp;
        </div>
        <div class="profile-descriptions">
            <h4 style="color: #212121;">Description:</h4>
            <P style="color:#4b515d ; word-spacing: 3px;">
                <?php echo $desc; ?>
            </P>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.nav_btn').click(function() {
                $('.mobile_nav_items').toggleClass('active');
            });
        });
    </script>

    <br><br><br>
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

<!--Add links for redirect later!-->
<script>
    function editprofile() {
        location.replace()
    }

    function editprofile() {
        location.replace()
    }

    function delprofile() {
        location.replace()
    }
</script>

</html>