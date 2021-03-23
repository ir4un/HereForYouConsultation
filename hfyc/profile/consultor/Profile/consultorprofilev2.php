<!DOCTYPE html>

<?php
require "../../../m_connection/db.con.php";
session_start();

if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM consultor WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "consultor";
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
    $returnHome = "onclick = \"" . "location.href = '../../../profile/consultor/Profile/consultorprofilev2.php'\"";

    $sql = "SELECT UserEmail FROM users WHERE UserID = " . $_SESSION['id'];
    $email = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserEmail'];
} else {
    echo "<script>
    alert('Please login as Consultor to continue!');
    location.href = document.referrer;
    </script>";
}
?>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=0">
    <title>HYFC | User Profile</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="consultorprofilev2.css">
    <link rel="stylesheet" href="../../sidebartemplate.css">
    <link rel="stylesheet" href="popup.css">
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
        <div class="profile-username">
            <h1>Welcome to <?php echo $_SESSION['username'] ?>'s Profile</h1>
        </div>

        <div class="profile-picture-box">
            <?php
            if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='user-pic' class='profile-picture'>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='user-pic' class='profile-picture'>";
            } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='user-pic' class='profile-picture'>";
            } else {
                echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='profile-picture'>";
            }
            ?>
        </div>

        <div class="profile-content">
            <table class="profile-table">
                <tbody>
                    <tr>
                        <th>TP Number:</th>
                        <td><?php echo $tp ?></td>
                    </tr>
                    <tr>
                        <th>Real Name:</th>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                        <td><?php echo $gender ?></td>
                    </tr>
                    <tr>
                        <th>Age:</th>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $email ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?php echo $address ?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?php echo $description ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mobile-profile-content">
            <table class="mobile-profile-table">
                <tbody>
                    <tr>
                        <th>TP Number:</th>
                    </tr>
                    <tr>
                        <td><?php echo $tp ?></td>
                    </tr>
                    <tr>
                        <th>Real Name:</th>
                    </tr>
                    <tr>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <th>Gender:</th>
                    </tr>
                    <tr>
                        <td><?php echo $gender ?></td>
                    </tr>
                    <tr>
                        <th>Age:</th>
                    </tr>
                    <tr>
                        <td><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                    </tr>
                    <tr>
                        <td><?php echo $email ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                    </tr>
                    <tr>
                        <td><?php echo $address ?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                    </tr>
                    <tr>
                        <td><?php echo $description ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="profile-buttons">
            <button id="btn-edit-profile" onclick="editprofile()"><b><i>Edit Profile</i></b></button>
            <button id="btn-edit-pwd" onclick="editpwd()"><b><i>Edit Password</i></b></button>
            <button id="btn-del-profile" onclick="delprofile()"><b><i>Delete Profile</i></b></button>
        </div>

        <?php
        $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            if (strpos($fullUrl, 'info=editprofilesuccess') == TRUE) {

                echo "<div class='popup middle'>";
                echo "<div class='erroricon'>";
                echo "<i class='fa fa-check-circle'></i>";
                echo "</div>";
                echo "<div class='title'>";
                echo "Profile Details Successfully Edited!";
                echo "</div>";
                echo "<div class='text'>";
                echo "Your Profile Details has been Updated!";
                echo "</div>";
                echo "<div class = 'dismiss-popup-btn'>";
                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                echo "</div>";
                echo "</div>";
            } else if (strpos($fullUrl, 'info=passwordupdatesuccess') == TRUE) {

                echo "<div class='popup middle'>";
                echo "<div class='erroricon'>";
                echo "<i class='fa fa-check-circle'></i>";
                echo "</div>";
                echo "<div class='title'>";
                echo "Password Successfully Updated";
                echo "</div>";
                echo "<div class='text'>";
                echo "Your Password has been Updated!";
                echo "</div>";
                echo "<div class = 'dismiss-popup-btn'>";
                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                echo "</div>";
                echo "</div>";
            } else if (strpos($fullUrl, 'error=failtoupdate') == TRUE) {

                echo "<div class='popup middle'>";
                echo "<div class='erroricon'>";
                echo "<i class='fa fa-times'></i>";
                echo "</div>";
                echo "<div class='title'>";
                echo "An Error has Occurred!";
                echo "</div>";
                echo "<div class='text'>";
                echo "Please Try Editing Your Details and Submit Again!";
                echo "</div>";
                echo "<div class = 'dismiss-popup-btn'>";
                echo "<button id = 'dismiss-popup-btn'>Try Again</button>";
                echo "</div>";
                echo "</div>";
            }
        ?>
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

<!--Add links for redirect later!-->
<script>
    function editprofile() {
        location.href = "../EditProfile/editprofilev2.php";
    }

    function editpwd() {
        location.href = "../EditPwd/editpasswordv2.php";
    }

    function delprofile() {
        location.href = "../Delete/deleteaccountv2.php";
    }
</script>
<script src="popup.js"></script>
</html>