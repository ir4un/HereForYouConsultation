<!DOCTYPE html>

<?php
require "../../../m_connection/db.con.php";
session_start();

if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "admin";
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
    $returnHome = "onclick = \"" . "location.href = '../../../profile/admin/Profile/adminprofilev2.php'\"";
} else {
    echo "<script>
    alert('Please login as Admin to continue!');
    location.href = document.referrer;
    </script>";
}
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC | Delete Account</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="deleteaccountv2.css">
    <link rel="stylesheet" href="../../sidebartemplate.css">
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
            <form style="--i: 1.8s" action="../../../m_connection/logout.con.php" method="post">
                <button type="submit" name="logout-submit" class="logout_btn"><i class="fas fa-power-off"></i>Logout</button>
            </form>
        </div>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <?php
            if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
            } else {
                echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
            }
            ?>
            <i class="fa fa-bars nav_btn"></i>
        </div>
        <div class="mobile_nav_items">
            <?php
            require '../../../sidebar_template.php';
            ?>
        </div>
    </div>
    <!--mobile navigation bar end-->
    <!--sidebar start-->
    <div class="sidebar">
        <div class="profile_info">
            <?php
            if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='profile_image' $returnHome>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='profile_image' $returnHome>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='profile_image' $returnHome>";
            } else {
                echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
            }
            ?>
            <h4><?php echo $name; ?></h4>
        </div>
        <?php
        require '../../../sidebar_template.php';
        ?>
    </div>
    <!--sidebar end-->

    <div class="content">
        <div class="del-account">
            <h1>Delete Account</h1>
            <h4>Please firstly verify your ownership of the account by inputting the correct current password.</h4>
            <h4>The "Delete Account" option will be available after the verification.</h4>
        </div>

        <div class="main-del-content">
            <form method="post" class="del-account-form">
                <label for="CurrentPassword" class="current">Current Password</label><br>
                <input type="password" id="CurrentPassword" name="CurrentPassword" required><br>
                <div class="btn-pwd">
                    <button type="submit" name='btnVerify' class="btnVerify">Verify Ownership</button>
                    <button class="fas fa-eye" type="button" onclick="showPwd()"></button>
                </div>
                <p><b>Are you sure you want to delete your account?</b></p>
                <p><b>If yes, please click on the "Delete Account" button below.</b></p>
                <center>
                    <button type='submit' name='btnDelete' id='btnDelete' class="del-account-btn" disabled>Delete Account</button>
                </center>
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

    <script>
        function showPwd() {
            var x = document.getElementById("CurrentPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <?php
    if (isset($_SESSION['id'])) {
        $sql = 'SELECT UserPassword FROM users WHERE UserID = ' . $_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        $password_check = mysqli_fetch_array($result)[0];

        if (isset($_POST['btnVerify'])) {
            $password = $_POST['CurrentPassword'];
            if (password_verify($password, $password_check)) {
                echo "<script defer>
            document.getElementById('btnDelete').disabled = false;
            document.getElementsByName('btnVerify')[0].disabled = true;
            </script>";
            } else {
                echo "<script>
            alert('Password Does Not Match. Please Retry.');
            </script>";
            }
        }

        if (isset($_POST['btnDelete'])) {
            $sql = "DELETE FROM users WHERE UserID = " . $_SESSION['id'];
            $sql2 = "DELETE FROM `admin` WHERE UserID = " . $_SESSION['id'];

            if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
                echo "<script>
                location.href='../../../logsignsys/login/login.php?info=deleteaccountsuccess';
            </script>";
            } else {
                echo "<script>
            alert('Something Has Went Wrong. Please Try Again');
            location.href='./deleteaccountv2.php';
            </script>";
            }
        }
    }
    ?>

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