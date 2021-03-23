<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
$role = "guests";
$name = "Guest";
$returnHome = "onclick = \"" . "location.href = '../home/user/guesthomepage.php'\"";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC | Reset Password</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="resetpasswordv2.css">
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
        <button type="submit" name="logout-submit" class="sign_in_btn" onclick="location.href = '../logsignsys/login/login.php'"><i class="fas fa-sign-in-alt"></i>Sign In</button><br>
        <button type="submit" name="logout-submit" class="register_btn" onclick="location.href = '../logsignsys/signup/student_registerv2.php'"><i class="fas fa-user-alt"></i>Register</button>
    </header>
    <!--header area end-->
    <!--mobile navigation bar start-->
    <div class="mobile_nav">
        <div class="nav_bar">
            <?php
            echo "<img src= '../profile_upload_pic/avatar.png' alt='user-pic' class='mobile_profile_image' $returnHome>";
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
            echo "<img src= '../profile_upload_pic/avatar.png' alt='user-pic' class='profile_image' $returnHome>";
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
            <h1>Reset Password</h1>
            <h3>Input the new password and press on the "reset password" button to reset your password</h3>
        </div>

        <div class="form-box">
            <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if (empty($selector) || empty($validator)) {
                echo "Could not validate your request!";
            } else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
            ?>

                    <form action="new.con.php" method="post">
                        <div class="reset-mc">
                            <input type="hidden" name="selector" value="<?php echo $selector ?>">
                            <input type="hidden" name="validator" value="<?php echo $validator ?>">
                            <label for="uname">Enter New Password</label><br>
                            <input type="password" name="password" placeholder="Enter New Password"><br>
                            <label for="repassword">Re-Enter New Password</label><br>
                            <input type="password" name="repassword" placeholder="Re-Enter New Password"><br>
                            <button type="submit" name="new-submit">Reset Password</button>
                        </div>
                    </form>

            <?php
                }
            }
            ?>

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

    function directSearch() {

    }

    function directProfile() {

    }
</script>

</html>