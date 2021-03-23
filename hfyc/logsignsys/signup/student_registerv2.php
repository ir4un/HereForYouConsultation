<!DOCTYPE html>
<?php
session_start();
require '../../m_connection/db.con.php';
$role = "guest";
$returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
$name = "Guest";
?>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC User Register Page</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="stylev2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="popup.css">
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
            <!--<div class="right_area">
                <form style="--i: 1.8s" action="../m_connection/logout.con.php" method="post">
                    <button type="submit" name="logout-submit" class="logout_btn"><i class="fas fa-power-off"></i>Logout</button>
                </form>
            </div>-->
        </header>
        <!--header area end-->
        <!--mobile navigation bar start-->
        <div class="mobile_nav">
            <div class="nav_bar">
                <?php
                echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
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
                echo "<img src= '../../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
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
                            <h2>Create User Account</h2>
                            <p>Come talk to us.</p>
                            <br>
                            <?php
                            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                            if ((!isset($_GET['info']) && !isset($_GET['error'])) || strpos($fullUrl, "error=wrongpassword") == TRUE || strpos($fullUrl, "error=wrongdetails") == TRUE || strpos($fullUrl, "error=invalidentry") == TRUE) {
                                echo "<div class='section-a'>
                                <form method='POST' action='user_signup.conv2.php'>
                                    <b>Section A: Verification Process</b>
                                    <p>~ To verify your user account in Asia Pacific University, enter the following details and submit to proceed ~</p>
                                    <br><br>
                                    <label for='tp'>TP Number: </label>
                                    <input name='tp' id='tp' type='text' required>
                                    <br><br>
                                    <label for='password'>Password: </label>
                                    <input name='password' id='password' type='password' required>
                                    <input name='student' type='hidden'>
                                    <br><br>
                                    <input type='submit' value='Submit' name='validate-submit'>
                                    </form>
                                    </div>";
                            } else if (strpos($fullUrl, "info=validatesuccess") == TRUE || strpos($fullUrl, "info=registersuccess") == TRUE || strpos($fullUrl, "error=sqlerror") == TRUE || strpos($fullUrl, "error=alreadyregistered") == TRUE || strpos($fullUrl, "error=usernametaken") == TRUE) {
                                if (isset($_SESSION['TP']) && isset($_SESSION['Password'])) {
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
                                    }
                                    $sql = "SELECT * FROM student WHERE student_tp=" . "'" . $_SESSION['TP'] . "'";

                                    $result = mysqli_query($conn2, $sql);
                                    $data = mysqli_fetch_assoc($result);

                                    $tp = $_SESSION['TP'];
                                    $password = $_SESSION['Password'];
                                    $age = $data["student_age"];
                                    $roles = "student";
                                    $name = $data['student_name'];
                                    $gender = $data['student_gender'];
                                    $address = $data['student_address'];
                                    $contact = $data['student_phone'];
                                    $email = $data['student_email'];

                                    echo "<div class='section-b'>
                                    <form method='POST' action='user_signup.conv2.php'>
                                        <b>Section B: Registration Process</b>
                                        <p>~ Please enter the username that you would like us to call you ~</p>
                                        
                                        <label for='username'>Username: </label><br>
                                        <input name='username' id='username' type='text' required>
                                        <br>
                                        <label for='password'>Password: </label><br>
                                        <input name='password' id='password' type='password' value='' autocomplete='new-password'>
                                        <br>
                                        <label for='description'>Description: </label><br>
                                        <input name='description' id='description' type='text' required>
                                        <br>
                                        <input name='tp' type='hidden' value=$tp>
                                        <input name='age' type='hidden' value=$age>
                                        <input name='roles' type='hidden' value=$roles>
                                        <input name='name' type='hidden' value='$name'>
                                        <input name='gender' type='hidden' value=$gender>
                                        <input name='address' type='hidden' value='$address'>
                                        <input name='contact' type='hidden' value=$contact>
                                        <input name='email' type='hidden' value=$email>
                                        <input type='submit' value='Submit' name='register-submit'>
                                    </form>
                                    </div>";
                                } else {
                                    header("Location: studentregister.php?error=invalidentry");
                                    exit();
                                }
                            }
                            ?>

                            <div class="right-side">
                                <p class="Content1">Share</p>
                                <p class="Content2">Your Thoughts</p>
                                <p class="Content3">With Us</p>
                                <img src="consultation.jpg" alt='consultation'>
                            </div>

                            <?php
                            $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            if (strpos($fullUrl, 'info=validatesuccess') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-check-circle'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Successful Validation";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Successfully Validated Your APU Affliate Status!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=wrongpassword') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Wrong Password Entered. Please Try Again!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=wrongdetails') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Wrong Details Entered. Please Try Again!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=invalidentry') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Please Enter Your Details!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=sqlerror') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "An Error Has Occured. Please Try Again Later!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=alreadyregistered') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Account Already Registered";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            } else if (strpos($fullUrl, 'error=usernametaken') == TRUE) {

                                echo "<div class='popup middle'>";
                                echo "<div class='erroricon'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</div>";
                                echo "<div class='title'>";
                                echo "Error";
                                echo "</div>";
                                echo "<div class='text'>";
                                echo "Username is Taken. Please Retry!";
                                echo "</div>";
                                echo "<div class = 'dismiss-popup-btn'>";
                                echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
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
            document.getElementById("services").style.display = "none";

            document.querySelector("#roles").addEventListener("click", function() {
                if (document.querySelector("#roles").options.selectedIndex == 1) {
                    document.getElementById("lbl-services").style.display = "inline";
                    document.getElementById("services").style.display = "inline-block";
                } else {
                    document.getElementById("lbl-services").style.display = "none";
                    document.getElementById("services").style.display = "none";
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
    <script src="popup.js"></script>
</body>

</html>