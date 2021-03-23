<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>HFYC | Login Page</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="popup.css">
    <link rel="icon" href="browsericon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
    <input type="checkbox" id="check" checked=checked>
    <header>
        <div class="left_area">
            <h3>HEREFORYOU<span>CONSULTATION</span></h3>
        </div>
        <div class="right_area">
            <a href="../signup/student_registerv2.php" class="signup_btn">Sign Up</a>
        </div>
    </header>
    <div class='wrapper'>
        <h2 class="title"><b>Log into Your HFYC Account</b></h2>
        <center><img src="icon.png" class="logo"></center>
        <div class="center">
            <center>
                <form action='login.con.php' method='post' class='form'>
                    <div class="input-field">
                        <input type="text" placeholder="Enter Username" id="username" name="username" required><label>Username</label>
                    </div>
                    <br>
                    <div class="input-field">
                        <input type="password" placeholder="Enter Password" id="password" name="password" required><i class="fa fa-eye" id="eye" onclick="showHide();"></i>
                        <label>Password</label>
                    </div><br>
                    <div class="input-field">
                        <select name="roles" id="roles" class="user-role" required>
                            <option value="" selected="selected" class="select">&nbsp;Select User Role</option>
                            <option value="admin" class="select">&nbsp;Admin</option>
                            <option value="consultor" class="select">&nbsp;Consultor</option>
                            <option value="student" class="select">&nbsp;User</option>
                        </select><label>User Role</label>
                    </div>
                    <br><br>
                    <button type="submit" id="btnsubmit" name="login-submit">Log In</button>
                    <br><br>
                    <p class='options'>
                        <a href="../../forgotpassword/forgotpasswordformv2.php" class="link">Forgotten Password?</a>
                    </p>
                    <?php
                    $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, 'error=emptyfields&username=') == TRUE) {

                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-times'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Error";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "Please Fill Out All The Details!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Try Again</button>";
                        echo "</div>";
                        echo "</div>";
                    } else if (strpos($fullUrl, "error=sqlerror") == TRUE) {

                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-times'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Error";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "Something Went Wrong. Please Try Again!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Try Again</button>";
                        echo "</div>";
                        echo "</div>";
                    } else if (strpos($fullUrl, "errorpr=wrongpassword&role_username=") == TRUE) {

                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-times'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Error";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "Please Check Your Password or Roles!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Try Again</button>";
                        echo "</div>";
                        echo "</div>";
                    } else if (strpos($fullUrl, "errorup=wrongusername&password") == TRUE) {

                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-times'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Error";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "Please Check Your Username or Password!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Try Again</button>";
                        echo "</div>";
                        echo "</div>";
                        
                    } else if (strpos($fullUrl, "newpwd=passwordupdated") == TRUE) {
                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-check-circle'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Update";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "Your Password has been Updated!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Noted</button>";
                        echo "</div>";
                        echo "</div>";
                    } else if (strpos($fullUrl, "info=registersuccess") == TRUE) {
                        
                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-check-circle'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Registration Successful";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "You have successfully registered!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Nice</button>";
                        echo "</div>";
                        echo "</div>";
                    } else if (strpos($fullUrl, "info=deleteaccountsuccess") == TRUE) {
                        
                        echo "<div class='popup middle'>";
                        echo "<div class='erroricon'>";
                        echo "<i class='fa fa-check-circle'></i>";
                        echo "</div>";
                        echo "<div class='title'>";
                        echo "Delete Account Successful";
                        echo "</div>";
                        echo "<div class='text'>";
                        echo "You Have Successfully Deleted Your Account!";
                        echo "</div>";
                        echo "<div class = 'dismiss-popup-btn'>";
                        echo "<button id = 'dismiss-popup-btn'>Okay</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>

                </form>
            </center>
        </div> <br>

        <!--<footer class="footer">
            <div class="descriptions">
                <a>HOME</a>
                <a>ABOUT</a>
                <a>HELP</a>
                <a>PRIVACY</a>
                <a>TERMS</a>
            </div>
        </footer>-->

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


        <script type="text/javascript">
            const password = document.getElementById("password");
            const eye = document.getElementById("eye");

            function showHide() {
                if (password.type === 'password') {
                    password.setAttribute('type', 'text');
                    eye.style.color = 'Aqua';
                    toggle.classlist.add('hide')

                } else {
                    password.setAttribute('type', 'password');
                    eye.style.color = 'white';
                    toggle.classlist.remove('hide')
                }
            }
        </script>
        <script src="popup.js"></script>
    </div>
</body>
</html>