<!DOCTYPE html>
<?php
session_start();
require '../../m_connection/db.con.php';

if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM `admin` WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "admin";
    while ($row = mysqli_fetch_assoc($result)) {
        $tp = $row['AdminTP'];
        $name = $row['AdminName'];
        $gender = $row['AdminGender'];
        $age = $row['AdminAge'];
        $address = $row['AdminAddress'];
        $description = $row["AdminDescription"];
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";

    $sql = "SELECT UserEmail FROM users WHERE UserID = " . $_SESSION['id'];
    $email = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserEmail'];
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
    <title>HYFC Admin Register Page</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="adminstylev2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
                <div class="overlay">
                    <div class="control-content">

                        <div class="left-side">
                            <h2>Create Admin Account</h2>
                            <p>Come talk to us.</p>
                            <br>
                            <?php
                            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            if ((!isset($_GET['info']) && !isset($_GET['error'])) || strpos($fullUrl, "error=wrongpassword") == TRUE || strpos($fullUrl, "error=wrongdetails") == TRUE || strpos($fullUrl, "error=invalidentry") == TRUE) {
                                if (isset($_GET['error'])) {
                                    if ($_GET['error'] == 'wrongpassword') {
                                        $error_message = "Wrong Password Entered. Please Try Again.";
                                    } else if ($_GET['error'] == 'wrongdetails') {
                                        $error_message = "Wrong Details Entered. Please Try Again.";
                                    } else if ($_GET['error'] == 'invalidentry') {
                                        $error_message = 'Please Enter Your Details.';
                                    }
                                    echo "<p class='popup'>
                                $error_message                
                            </p>";
                                }

                                echo
                                "<div class='section-a'>
                                <form method='POST' action='user_signup.conv2.php'>
                                    <b>Section A: Verification Process</b>
                                    <p>~ To verify your staff account in Asia Pacific University, enter the following details and submit to proceed ~</p>
                                    <br><br>
                                    <label for='tp'>TP Number: </label><br>
                                    <input name='tp' id='tp' type='text' required>
                                    <br>
                                    <label for='password'>Name: </label>
                                    <br>
                                    <input name='name' id='name' type='text' required>
                                    <br>
                                    <input type='submit' value='Submit' name='validate-submit'>
                                </form>
                            </div>";
                            } else if (strpos($fullUrl, "info=validatesuccess") == TRUE || strpos($fullUrl, "info=registersuccess") == TRUE || strpos($fullUrl, "error=sqlerror") == TRUE || strpos($fullUrl, "error=alreadyregistered") == TRUE || strpos($fullUrl, "error=usernametaken") == TRUE) {
                                if (isset($_SESSION['New_Admin_TP']) && isset($_SESSION['New_Admin_Name'])) {
                                    require '../../m_connection/db.con.php';

                                    if (isset($_GET['error']) || (isset($_GET['info']) && $_GET['info'] == 'registersuccess')) {
                                        if (isset($_GET['error'])) {
                                            if ($_GET['error'] == 'sqlerror') {
                                                $error_message = "An Error Has Occured. Please Retry.";
                                            } else if ($_GET['error'] == 'alreadyregistered') {
                                                $error_message = "Account Already Registered.";
                                            } else if ($_GET['error'] == 'usernametaken') {
                                                $error_message = 'Username Is Taken. Please Retry';
                                            }
                                        } else {
                                            $error_message = 'Registration Successful.';
                                        }
                                        echo "<p id='popup'>
                                    $error_message                
                                </p>";
                                    }

                                    $sql = "SELECT * FROM staff WHERE staff_tp=" . "'" . $_SESSION['New_Admin_TP'] . "'";

                                    $result = mysqli_query($conn2, $sql);
                                    $data = mysqli_fetch_assoc($result);

                                    $tp = $_SESSION['New_Admin_TP'];
                                    $age = $data["staff_age"];
                                    $name = $_SESSION['New_Admin_Name'];
                                    $gender = $data['staff_gender'];
                                    $address = $data['staff_address'];
                                    $contact = $data['staff_phone'];
                                    $email = $data['staff_email'];

                                    echo
                                    "<div class='section-b'>
                                    <form method='POST' action='user_signup.conv2.php'>
                                        <b>Section B: Registration Process</b>
                                        <p>~ Please enter the username that you would like us to call you ~</p>
                                        <br><br>
                                        <label for='username'>Username: </label>
                                        <br>
                                        <input name='username' id='username' type='text' required>
                                        <br><br>
                                        <label for='password'>Password: </label>
                                        <br>
                                        <input name='password' id='password' type='password'>
                                        <br><br>
                                        <label for='description'>Description: </label>
                                        <br>
                                        <input name='description' id='description' type='text' required>
                                        <br><br>
                                        <label for='roles'>Please select the required position</label>
                                        <br><br>
                                        <select name='roles' class='roles' required>
                                            <option value='admin'>Admin</option>
                                            <option value='consultor'>Consultor</option>
                                        </select>
                                        <br><br>
                                        <label id='lbl-services' for='services'>Please select the proper service</label>
                                        <br><br>
                                        <select name='services' class='roles' required>
                                            <option value='Mental Health Consultation'>Mental Health Consultation</option>
                                            <option value='Career Consultation'>Career Consultation</option>
                                            <option value='Further Studies Consultation<'>Further Studies Consultation</option>
                                            <option value='Academic Consultation'>Academic Consultation</option>
                                            <option value='Fitness Consultation'>Fitness Consultation</option>
                                            <option value='Life Consultation'>Life Consultation</option>
                                        </select>
                                        <br><br>
                                        <input name='tp' type='hidden' value=$tp>
                                        <input name='age' type='hidden' value=$age>
                                        <input name='name' type='hidden' value='$name'>
                                        <input name='gender' type='hidden' value=$gender>
                                        <input name='address' type='hidden' value='$address'>
                                        <input name='contact' type='hidden' value=$contact>
                                        <input name='email' type='hidden' value=$email>
                                        <input type='submit' value='Submit' name='register-submit'>
                                    </form>
                                </div>";
                                } else {
                                    header("Location: admin_register.php?error=invalidentry");
                                    exit();
                                }
                            }
                            ?>
                            <br><br>

                            <div class="right-side">
                                <p class="Content1">Share</p>
                                <p class="Content2">Your Thoughts</p>
                                <p class="Content3">With Us</p>
                                <img src="consultation.jpg" alt='consultation'>
                            </div>
                        </div>
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

        <script>
            document.getElementById("lbl-services").style.display = "none";
            document.querySelectorAll(".roles")[1].style.display = "none";

            document.querySelectorAll(".roles")[0].addEventListener("click", function() {
                if (document.querySelectorAll(".roles")[0].options.selectedIndex == 1) {
                    document.getElementById("lbl-services").style.display = "inline";
                    document.querySelectorAll(".roles")[1].style.display = "inline-block";
                } else {
                    document.getElementById("lbl-services").style.display = "none";
                    document.querySelectorAll(".roles")[1].style.display = "none";
                }
            })
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