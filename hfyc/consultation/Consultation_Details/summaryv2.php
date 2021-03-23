<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
require "../../m_connection/db.con.php";
if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM normal_user WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "student";
    while ($row = mysqli_fetch_assoc($result)) {
        $tp = $row['NormalUserTP'];
        $name = $row['NormalUserName'];
        $gender = $row['NormalUserGender'];
        $age = $row['NormalUserAge'];
        $address = $row['NormalUserAddress'];
        $description = $row["NormalUserDescription"];
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";
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
    <title>HYFC Consultation Summary Page</title>
    <link rel="stylesheet" href="stylev2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
    <div class='wrapper'>
        <input type="checkbox" id="check" checked>
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
            <section>
                <br>
                <div class='overlay'>

                    <div class="remainder">
                        <button class="big-button" id="back" onclick='history.back();'><i class="fas fa-arrow-circle-left"></i> Go
                            Back</button>
                        <div class="title-border">
                            <p> YOUR </p>
                            <h1>Consultation<span>Summary</span>
                            </h1>
                        </div>
                        <?php
                        if (isset($_SESSION['id'])) {
                            if (isset($_GET['consultationid'])) {
                                $sql = "SELECT * FROM `consultor_consultation` WHERE `Consultation_ID` = " . $_GET['consultationid'];
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tp = $row['Consultor_ID'];
                                    $venue = $row['ConsultationVenue'];
                                    $date = $row['Consult_Date'];
                                    $starttime = $row['Start_Time'];
                                    $endtime = $row['End_Time'];

                                    if($venue == "Microsoft Teams"){
                                        $link = "https://tinyurl.com/2sueavzs" ;
                                    }else if($venue == "Discord"){
                                        $link = "https://discord.gg/8VDjdcyZDS";
                                    }
                                }

                                $sql = "SELECT * FROM consultor WHERE ConsultorTP = '$tp'";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $name = $row['ConsultorName'];
                                    $consultorid = $row['UserID'];
                                }

                                $sql = "SELECT UserEmail FROM users WHERE UserID = $consultorid";
                                $email = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserEmail'];
                            }
                        }
                        ?>
                        <table>
                            <tr>
                                <td style="font-weight: bold;">Consultor Name:</td>
                                <td style="color: #1d2e68;"><?php echo $name; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultor Email:</td>
                                <td style="color: #1d2e68;"><?php echo $email; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultation Category:</td>
                                <td style="color: #1d2e68;"><?php echo $_SESSION['setConsultType']; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultation Day:</td>
                                <td style="color: #1d2e68;"><?php echo $date; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultation Duration:</td>
                                <td style="color: #1d2e68;"><?php echo "$starttime - $endtime"; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultation Platform:</td>
                                <td style="color: #1d2e68;"><?php echo $venue; ?></td>
                            </tr>

                            <tr>
                                <td style="font-weight: bold;">Consultation Link:</td>
                                <td style="color: #1d2e68;"><a href=<?php echo $link; ?> target="_blank"><?php echo $link?></a></td>
                            </tr>
                        </table>


                        <p style="color:#294e99; font-weight: bold;">
                            Reminder:
                        <ul type="circle" style="color:black;">
                            <li>The consultation will be carried out in a face-to-face manner, please ensure that you
                                have a working camera before the consultation.</li>
                            <li>If unable to attend the consultation, kindly notify the consultor through his/her email
                                beforehand to cancel the consultation.</li>
                        </ul>
                        </p>
                    </div>
                    <div class="buttons">
                        <div class="btncontainer">
                            <a href="summaryv2.con.php?status=confirm" class="btnSubmit effect01"><span>Confirm Consultation</span></a>
                        </div>
                    </div>
            </section>
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
    </div>
</body>

</html>