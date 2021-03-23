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
    <title>HYFC | Select Consultor</title>
    <link rel="stylesheet" href="consultordetailsv2.css">
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
        <div id="page-description">
            <h1>Please Select Your Consultor</h1>
            <h2>Select your favorable consultor by clicking on the "Book My Consultation button!"</h2>
        </div>

        <form action="" method="post" class="website-view">

            <?php
            if (isset($_GET['type'])) {
                if ($_GET['type'] == 'mental') {
                    $selection = "Mental Health Consultation";
                } else if ($_GET['type'] == 'career') {
                    $selection = "Career Consultation";
                } else if ($_GET['type'] == 'further') {
                    $selection = "Further Studies Consultation";
                } else if ($_GET['type'] == 'academic') {
                    $selection = "Academic Consultation";
                } else if ($_GET['type'] == 'fitness') {
                    $selection = "Fitness Consultation";
                } else if ($_GET['type'] == 'life') {
                    $selection = "Life Consultation";
                }

                $_SESSION['setConsultType'] = $selection;

                $sql = "SELECT * FROM consultor WHERE ConsultorService = '$selection'";
                $result = mysqli_query($conn, $sql);
            }

            while ($row = mysqli_fetch_assoc($result)) {

                if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                    $img = "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg" . "' alt='consultor-pic' class='consultor-pic'>";
                } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                    $img = "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png" . "' alt='consultor-pic' class='consultor-pic'>";
                } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                    $img = "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg" . "' alt='consultor-pic' class='consultor-pic'>";
                } else {
                    $img = "<img src= '../../profile_upload_pic/avatar.png' alt='consultor-pic' class='consultor-pic'>";
                }

                echo '
            <div class="photo-background">
                '.$img.'
            </div>

            <div class="consultor-info">
                <table class="table-info">
                    <tbody>
                        <tr>
                            <th>Consulter Name</th>
                            <td>' . $row['ConsultorName'] . '</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>' . $row['ConsultorAge'] . '</td>
                        </tr>
                        <tr>
                            <th>Ratings</th>
                            <td>10/10</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>' . $row['ConsultorDescription'] . '
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-book">
                    <button class="btn-select">
                        <a href="../TP_Choose Slot/chooseSlot.php?id=' . $row['ConsultorID'] . '">Book My Consultation Now!</a>
                    </button>
                </div>
            </div>
        </form>';
            }
            ?>
            <form action="" method="post" class="mobile-view">
                <?php
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '

                <div class="photo-background">
                    <img src="Chino.png" alt="consultor-pic" class="consultor-pic">
                </div>

                <div class="mobile-consultor-info">
                    <table class="mobile-table-info">
                        <tbody>
                            <tr>
                                <th>Consulter Name</th>
                            </tr>
                            <tr>
                                <td>' . $row['ConsultorName'] . '</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                            </tr>
                            <tr>
                                <td>' . $row['ConsultorAge'] . '</td>
                            </tr>
                            <tr>
                                <th>Ratings</th>
                            </tr>
                            <tr>
                                <td>10/10</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                            </tr>
                            <tr>
                                <td>' . $row['ConsultorDescription'] . '
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-book">
                        <button class="btn-select">
                            <a href="../TP_Choose Slot/chooseSlot.php?id=' . $row['ConsultorID'] . '">Book My Consultation Now!</a>
                        </button>
                    </div>
                </div>
            </form>';
                }
                ?>

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