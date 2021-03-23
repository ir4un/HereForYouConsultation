<!DOCTYPE html>
<html lang="en" dir="ltr">
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
    $sql = "SELECT * FROM consultor WHERE UserID = " . $_SESSION['id'];
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
    $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";


    if (isset($_POST['btnSubmit'])) {
        $id = $_POST['consultid'];
        $sql = "UPDATE consultor_consultation SET SlotStatus = 'Past' WHERE Consultation_ID = $id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Successfully Updated');
            location.href = 'checkappointmentv2.php';
            </script>";
        } else {
            echo "<script>alert('Something Went Wrong');
            location.href = 'checkappointmentv2.php';
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

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC | Check Appointment</title>
    <link rel="stylesheet" href="checkappointmentv2.css">
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
        <div class="tabs">
            <input type="radio" name="tab" id="tabone" checked="checked">
            <!--Ongoing Consultation-->
            <label for="tabone">Ongoing</label>
            <div class="tab">
                <?php
                $sql = "SELECT Consultation_ID FROM consultor_consultation WHERE Consultor_ID = '$tp' AND SlotStatus = 'Ongoing'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM consultation_info WHERE ConsultationSessionID = " . $row['Consultation_ID'];
                    $result2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($result2);
                    @$userid = $row2['UserID'];
                    @$service = $row2['ConsultType'];
                    @$date = $row2["ConsultDate"];
                    @$time = $row2["ConsultStartTime"] . " - " . $row2["ConsultEndTime"];

                    $sql = "SELECT NormalUserName FROM normal_user WHERE UserID = $userid";
                    @$username = mysqli_fetch_assoc(mysqli_query($conn, $sql))['NormalUserName'];


                    if (mysqli_num_rows($result2) > 1) {
                        echo "<script>alert('Something Went Wrong!')</script>";
                        exit();
                    }

                    echo '<div class="consultation">
                        <div class="consultation-info">
                            <h1>Consultation Service: ' . $service . '</h1>
                            <h4>Consultee Name: ' . $username . '</h4>
                            <h4>Appointment Date, Time: ' . $date . ', ' . $time . '</h4>
                        </div>
                        <div class="view-consultation-details">
                            <button class="btn-view"><i class="fas fa-search-plus" onclick="location.href = \'../CheckPastHistory/displaypast.php?id=' . $row['Consultation_ID'] . '\'"></i></button>
                            <form method="POST">
                                <button class="btn-view" type="submit" name="btnSubmit"><i class="fa fa-check-circle-o"></i></button>
                                <input type="hidden" name="consultid" value=' . $row['Consultation_ID'] . '>
                            </form>
                        </div>
                    </div>';
                }
                ?>
            </div>
            <input type="radio" name="tab" id="tabtwo">
            <!--Past Consultation-->
            <label for="tabtwo">Past</label>
            <div class="tab">
                <?php
                $sql = "SELECT Consultation_ID FROM consultor_consultation WHERE Consultor_ID = '$tp' AND SlotStatus = 'Past'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM consultation_info WHERE ConsultationSessionID = " . $row['Consultation_ID'];
                    $result2 = mysqli_query($conn, $sql);
                    $row2 = mysqli_fetch_assoc($result2);
                    @$userid = $row2['UserID'];
                    @$service = $row2['ConsultType'];
                    @$date = $row2["ConsultDate"];
                    @$time = $row2["ConsultStartTime"] . " - " . $row2["ConsultEndTime"];

                    $sql = "SELECT NormalUserName FROM normal_user WHERE UserID = $userid";
                    @$username = mysqli_fetch_assoc(mysqli_query($conn, $sql))['NormalUserName'];


                    if (mysqli_num_rows($result2) > 1) {
                        echo "<script>alert('Something Went Wrong!')</script>";
                        exit();
                    }
                    echo '<div class="consultation">
                    <div class="consultation-info">
                        <h1>Consultation Service: ' . $service . '</h1>
                        <h4>Consultee Name: ' . $username . '</h4>
                        <h4>Appointment Date, Time: ' . $date . ', ' . $time . '</h4>
                    </div>
                    <div class="view-consultation-details">
                        <button class="btn-view"><i class="fas fa-search-plus" onclick="location.href = \'../CheckPastHistory/displaypast.php?id=' . $row['Consultation_ID'] . '\'"></i></button>
                    </div>
                </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(' .nav_btn').click(function() {
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