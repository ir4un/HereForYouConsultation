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
            $name = $row['AdminName'];
            $gender = $row['AdminGender'];
            $age = $row['AdminAge'];
            $address = $row['AdminAddress'];
            $description = $row["AdminDescription"];
        }
        $returnHome = "onclick = \"" . "location.href = '../profile/admin/Profile/adminprofilev2.php'\"";

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
            $name = $row['ConsultorName'];
            $gender = $row['ConsultorGender'];
            $age = $row['ConsultorAge'];
            $address = $row['ConsultorAddress'];
            $description = $row["ConsultorDescription"];
        }
        $returnHome = "onclick = \"" . "location.href = '../profile/consultor/Profile/consultorprofilev2.php'\"";

        $sql = "SELECT ConsultorChillBuds FROM consultor WHERE UserID = " . $_SESSION['id'];
        $chillbuds = mysqli_fetch_assoc(mysqli_query($conn, $sql))['ConsultorChillBuds'];
        if (!$chillbuds) {
            echo "<script>location.href = 'signupv2.php'</script>";
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
    <title>HYFC | ChillBuds User</title>
    <link rel="stylesheet" href="chillbudscontentv2.css">
    <!--<link rel="stylesheet" href="sidebartemplate.css">-->
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
            <h1>Welcome to ChillBuds!</h1>
            <h2>Meet other ChillBuds' users by viewing their profiles.</h2>
        </div>

        <div class="web-main-content">
            <table class="web-chillbuds-users">
                <?php
                $sql = "SELECT * FROM normal_user WHERE NormalUserChillBuds = 1";
                $sql2 = "SELECT * FROM `admin` WHERE AdminChillBuds = 1";
                $sql3 = "SELECT * FROM consultor WHERE ConsultorChillBuds = 1";
                $count = 0;

                $user_result = mysqli_query($conn, $sql);
                $admin_result = mysqli_query($conn, $sql2);
                $consultor_result = mysqli_query($conn, $sql3);

                $response = '<tr>';
                if (mysqli_num_rows($user_result) > 0) {
                    while ($row = mysqli_fetch_assoc($user_result)) {
                        if ($count >= 3) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['NormalUserName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($admin_result) > 0) {
                    while ($row = mysqli_fetch_assoc($admin_result)) {
                        if ($count >= 3) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['AdminName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($consultor_result) > 0) {
                    while ($row = mysqli_fetch_assoc($consultor_result)) {
                        if ($count >= 3) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['ConsultorName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                $response .= '</tr>';
                echo $response;
                ?>
            </table>
        </div>

        <div class="resp-main-content">
            <table class="resp-chillbuds-users">
                <?php
                $sql = "SELECT * FROM normal_user WHERE NormalUserChillBuds = 1";
                $sql2 = "SELECT * FROM `admin` WHERE AdminChillBuds = 1";
                $sql3 = "SELECT * FROM consultor WHERE ConsultorChillBuds = 1";
                $count = 0;

                $user_result = mysqli_query($conn, $sql);
                $admin_result = mysqli_query($conn, $sql2);
                $consultor_result = mysqli_query($conn, $sql3);

                $response = '<tr>';
                if (mysqli_num_rows($user_result) > 0) {
                    while ($row = mysqli_fetch_assoc($user_result)) {
                        if ($count >= 2) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['NormalUserName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($admin_result) > 0) {
                    while ($row = mysqli_fetch_assoc($admin_result)) {
                        if ($count >= 2) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }


                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['AdminName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($consultor_result) > 0) {
                    while ($row = mysqli_fetch_assoc($consultor_result)) {
                        if ($count >= 2) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['ConsultorName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                $response .= '</tr>';
                echo $response;
                ?>
            </table>
        </div>

        <div class="mobile-main-content">
            <table class="mobile-chillbuds-users">
                <?php
                $sql = "SELECT * FROM normal_user WHERE NormalUserChillBuds = 1";
                $sql2 = "SELECT * FROM `admin` WHERE AdminChillBuds = 1";
                $sql3 = "SELECT * FROM consultor WHERE ConsultorChillBuds = 1";
                $count = 0;

                $user_result = mysqli_query($conn, $sql);
                $admin_result = mysqli_query($conn, $sql2);
                $consultor_result = mysqli_query($conn, $sql3);

                $response = '<tr>';
                if (mysqli_num_rows($user_result) > 0) {
                    while ($row = mysqli_fetch_assoc($user_result)) {
                        if ($count >= 1) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }


                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['NormalUserName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($admin_result) > 0) {
                    while ($row = mysqli_fetch_assoc($admin_result)) {
                        if ($count >= 1) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['AdminName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                if (mysqli_num_rows($consultor_result) > 0) {
                    while ($row = mysqli_fetch_assoc($consultor_result)) {
                        if ($count >= 1) {
                            $response .= '</tr>';
                            $count = 0;
                            $response .= '<tr>';
                        }

                        if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpg";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".png";
                        } else if (file_exists('../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg")) {
                            $src = '../profile_upload_pic/' . "ProfilePicID" . $row['UserID'] . ".jpeg";
                        } else {
                            $src = '../profile_upload_pic/avatar.png';
                        }

                        $response .= '<td>
                            <img src="' . $src . '" alt="userprofile" class="user-img">
                            <p>' . $row['ConsultorName'] . '</p>
                            <button class="btn-viewprofile" onclick="directProfile(' . $row['UserID'] . ')">View Profile</button>
                        </td>';

                        $count += 1;
                    }
                }

                $response .= '</tr>';
                echo $response;
                ?>
            </table>
        </div>

        <button id="btn-top" onclick="goTop()">
            <i class="fas fa-arrow-circle-up"></i>
        </button>
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

<!--Add  JS to direct Function-->
<script>
    var goTopBtn = document.getElementById("btn-top");

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            goTopBtn.style.display = "block";
        } else {
            goTopBtn.style.display = "none";
        }
    }

    function goTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function directProfile(id) {
        location.href = "chillbudsprofile/userprofilev2.php?id=" + id;


    }
</script>

</html>