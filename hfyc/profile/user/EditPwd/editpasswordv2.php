<!DOCTYPE html>

<?php
require "../../../m_connection/db.con.php";
session_start();

if (isset($_SESSION['id'])) {
    $sql = 'SELECT UserPassword FROM users WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "student";
    $password_check = mysqli_fetch_array($result)[0];

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
    $returnHome = "onclick = \"" . "location.href = '../../../profile/user/Profile/userprofilev2.php'\"";
} else {
    echo "<script>
    alert('Please login as Student to continue!');
    location.href = document.referrer;
    </script>";
}
?>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=0">
    <title>HYFC | Edit Password</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="editpasswordv2.css">
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
            if (isset($_SESSION['id'])) {
                if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='mobile_profile_image' $returnHome>";
                } else {
                    echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
                }
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
            if (isset($_SESSION['id'])) {
                if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='profile_image' class='profile_image' $returnHome>";
                } else {
                    echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
                }
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
        <div class="edit-password">
            <h1>Edit Password</h1>
            <h2>Please input your current password to verify that you are the owner of this account.</h2>
            <h2>After that, input your new password.</h2>
        </div>

        <form method="post" class="edit-password-form">
            <label for="CurrentPassword" class="current">Insert Current Password</label><br>
            <input type="password" id="CurrentPassword" name="CurrentPassword" required><br>
            <center class="btn-currentpwd">
                <button type="submit" id="VerifyPassword" class="btnVerify" name='btnVerify'>Verify Ownership</button>
                <button type="button" class="fas fa-eye" onclick="showPwd()"></button>
            </center>
            <label for="NewPassword" class="New">Insert New Password </label><br>
            <input type="password" id="NewPassword" name="NewPassword" disabled><br>
            <label for="RepNewPassword" class="New">Insert New Password Again</label><br>
            <input type="password" id="RepNewPassword" class="RepNewPassword" name="RepNewPassword" disabled><br>
            <center class="btn-newpwd">
                <button type="submit" id='ResetPassword' class="btnChange" name='btnChange' disabled>Reset Password</button>
                <button type="button" class="fas fa-eye" onclick="showPwd2()"></button>
            </center>
        </form>
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

<script>
    function showPwd() {
        var x = document.getElementById("CurrentPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function showPwd2() {
        var x = document.getElementById("NewPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<?php
if (isset($_SESSION['id'])) {
    if (isset($_POST['btnVerify'])) {
        $password = $_POST['CurrentPassword'];
        if (password_verify($password, $password_check)) {
            echo "<script>
        document.getElementById('NewPassword').disabled = false;
        document.getElementById('RepNewPassword').disabled = false;
        document.getElementById('NewPassword').required = true;
        document.getElementById('RepNewPassword').required = true;
        document.getElementById('ResetPassword').disabled = false;
        document.getElementById('CurrentPassword').value = '';
        document.getElementById('CurrentPassword').disabled = true;
        document.getElementById('VerifyPassword').disabled = true;
        </script>";
        } else {
            echo "<script>
        alert('Verification Process Failed. Please Retry.');
        location.href = './editpasswordv2.php';
        </script>";
        }
    }

    if (isset($_GET['error']) && $_GET['error'] = 'pwdmismatch') {
        echo "<script>
    document.getElementById('NewPassword').disabled = false;
    document.getElementById('RepNewPassword').disabled = false;
    document.getElementById('NewPassword').required = true;
    document.getElementById('RepNewPassword').required = true;
    document.getElementById('ResetPassword').disabled = false;
    document.getElementById('CurrentPassword').value = '';
    document.getElementById('CurrentPassword').disabled = true;
    document.getElementById('VerifyPassword').disabled = true;
    </script>";
    }

    if (isset($_POST['btnChange'])) {
        if ($_POST['NewPassword'] != $_POST['RepNewPassword']) {
            echo "<script>
        alert('Password Does Not Match. Please Retry.');
        location.href = './editpasswordv2.php?error=pwdmismatch';
        </script>";
        } else {
            $password = $_POST['NewPassword'];
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET UserPassword = '$password_hashed' WHERE UserID = " . $_SESSION['id'];
            if (mysqli_query($conn, $sql)) {
                echo "<script>
            location.href = '../Profile/userprofilev2.php?info=passwordupdatesuccess';
            </script>";
            } else {
                echo "<script>
            location.href = '../Profile/userprofilev2.php?error=failtoupdate';
            </script>";
            }
        }
    }
}
?>

</html>