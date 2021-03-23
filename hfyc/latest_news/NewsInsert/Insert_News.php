<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
require 'db.con.php';

if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "admin";
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<script>
        alert('Please login as Admin to continue!');
        location.href = document.referrer;
        </script>";
    } else {
        $tp = $row['AdminTP'];
        $name = $row['AdminName'];
        $gender = $row['AdminGender'];
        $age = $row['AdminAge'];
        $address = $row['AdminAddress'];
        $description = $row["AdminDescription"];
    }

    $sql = "SELECT AdminID FROM `admin` WHERE UserID = " . $_SESSION['id'];
    $adminid = mysqli_fetch_assoc(mysqli_query($conn, $sql))['AdminID'];

    $returnHome = $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";
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
    <title>HYFC Insert News Page</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="test.css">
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
            <div class="card">

            <form class='img-select-button' style='--i: 1.8s' action='fileupload.con.php' method='POST' enctype='multipart/form-data'>

            <div class="mainlist">

                    <div class="title">
                        <label><h1><b>News Thumbnail:</b></h1></label><br>
                        <input class='btn transparent' type='file' name='file'>
                        <input type="hidden" name="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>
                    
                    <div class="newstitle">
                        <label for="title"><h1><b>News Title:</b></h1></label><br>   
                        <input size="50" type="title" placeholder="Choose a nice title for your news!" name="title" required>
                    </div>
                    

                    <div class="newscontent">
                        <label for="cont"><h1><b>News Content:</b><h1></label><br>
                        <textarea type="cont" placeholder="Type in news content here!" name="cont" required></textarea>
                        <input type='hidden' name='adminid' value=<?php echo $adminid ?>>
                        <button class='btn transparent' type='submit' name='img-submit'>Upload News</button>

                    </div>
                    

                </form>

            </div>
            <!--main container end-->
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