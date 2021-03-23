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


    if (isset($_POST['submit'])) {
        $name = $_POST['realname'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $description = $_POST['description'];

        $sql = "UPDATE consultor SET ConsultorName = '$name', ConsultorAge = '$age', ConsultorAddress = '$address', ConsultorDescription = '$description' WHERE UserID = " . $_SESSION['id'];

        $sql2 = "UPDATE users SET UserEmail = '$email' WHERE UserID = " . $_SESSION['id'];

        if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
            echo "<script>location.href = '../profile/consultorprofilev2.php?info=editprofilesuccess'</script>";
        } else {
            echo "<script>location.href = '../profile/consultorprofilev2.php?error=failtoupdate'</script>";
        }
    }

    if (isset($_POST['img-submit'])) {
        $filename = $_FILES['file']["name"];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        $filetmpname = $_FILES['file']['tmp_name'];
        $fileerror = $_FILES['file']['error'];

        $extension_raw = explode(".", $filename);
        $extension = strtolower(end($extension_raw));
        $allowed_list = array("jpg", "png", "jpeg");

        if (in_array($extension, $allowed_list)) {
            if ($fileerror == 0) {
                if ($filesize < 10000000) {
                    $filenewname = "ProfilePicID" . $_SESSION['id'] . ".$extension";
                    $dirname = '../../../profile_upload_pic/' . $filenewname;
                    move_uploaded_file($filetmpname, $dirname);
                    $sql = "UPDATE consultor SET ConsultorImgStatus = 1 WHERE UserID = " . $_SESSION['id'];
                    if (mysqli_query($conn, $sql)) {
                        echo "<script>
                        alert('File Has Been Uploaded Successfully');
                        </script>";
                    }
                } else {
                    echo "<script>
                    alert('The file is too big. Please try using files with sizes less than 10MB');
                    </script>";
                }
            } else {
                echo "<script>
                alert('Some error has occurred. Please retry again');
                </script>";
            }
        } else {
            echo "<script>
            alert('The File Format is Not Supported. Please use .jpg, .png or .jpeg files instead');
            </script>";
        }
    }
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
    <title>HYFC | Edit Profile</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="editprofilev2.css">
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
        <div class="editprofile">
            <h1>Edit Profile</h1>
            <h2>You can change your user picture & details now!</h2>
        </div>
        <div class="editprofile-main-content">
            <div class="profile-pic">
                <?php
                if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpg" . "' alt='user-pic' class='user-pic'>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='user-pic' class='user-pic'>";
                } else if (file_exists('../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg")) {
                    echo "<img src='" . '../../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".jpeg" . "' alt='user-pic' class='user-pic'>";
                } else {
                    echo "<img src= '../../../profile_upload_pic/avatar.png' alt='user-pic' class='user-pic'>";
                }
                ?>
            </div>
            <form class="img-select-button" method="post" action="" enctype="multipart/form-data">
                <input class="btn-file" type="file" name="file">
                <button class="btn-submit" name="img-submit">Upload & Save Image Changes</button>
            </form>
            <div class="profile-info">
                <form class="info-form" method="post" action="">
                    <label for="realname"><b>Real Name</b></label><br>
                    <input type="realname" name="realname" value="" required><br>
                    <label for="age"><b>Age</b></label><br>
                    <input type="age" name="age" value="" required><br>
                    <label for="email"><b>Email</b></label><br>
                    <input type="email" name="email" value="" required><br>
                    <label for="address"><b>Address</b></label><br>
                    <textarea rows="4" cols="50" type="address" name="address" value="" required></textarea><br>
                    <label for="description"><b>Description</b></label><br>
                    <textarea type="description" name="description" value="" required></textarea><br>
                    <center>
                        <button id="btn-cancel" onclick="cancelEdit()">Cancel Edit</button>
                        <button type="submit" name='submit' class="btn-save">Save Changes Made</button>
                    </center>
                </form>
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

<!-- Add JS later-->
<script>
    function cancelEdit() {
        window.history.back() 
    }
</script>
</html>