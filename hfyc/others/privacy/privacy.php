<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
session_start();
require "../../m_connection/db.con.php";
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
        $returnHome = "onclick = \"" . "location.href = '../../profile/user/Profile/userprofilev2.php'\"";
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
        $returnHome = "onclick = \"" . "location.href = '../../profile/admin/Profile/adminprofilev2.php'\"";
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
        $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";
    }
} else {
    $role = "guests";
    $name = "Guest";
    $returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
    //echo $returnHome;
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=0">
    <title>HYFC | Privacy</title>
    <link rel="stylesheet" href="privacy.css">
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
            <?php
            if (isset($_SESSION['id'])) {
                echo '<form style="--i: 1.8s" action="../../m_connection/logout.con.php" method="post">
                    <button type="submit" name="logout-submit" class="logout_btn"><i class="fas fa-power-off"></i>Logout</button>';
            } else {
                echo '<button type="submit" name="logout-submit" class="sign_in_btn" onclick="location.href = ' . "'" . '../../logsignsys/login/login.php' . "'" . '"' . '><i class="fas fa-sign-in-alt"></i>Sign In</button><br>
                    <button type="submit" name="logout-submit" class="register_btn" onclick="location.href = ' . "'" . '../../logsignsys/signup/student_registerv2.php' . "'" . '"' . '><i class="fas fa-user-alt"></i>Register</button>';
            }
            ?>
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
        <div class="page-desc">
            <h1>HFY Consultation Privacy Policy</h1>
        </div>

        <div class="pri">
            <h1 id="Directory"> Privacy Policy Directory: </h1>
            <ul class="directory-ul">
                <li><a href="#C">Consent</a></li>
                <li><a href="#IWC">Information we Collect</a></li>
                <li><a href="#HWUYI">How we use Your Information</a></li>
                <li><a href="#LF">Log Files</a></li>
                <li><a href="#CAWB">Cookies & Web Beacons</a></li>
                <li><a href="#APPP">Advertising Partners' Privacy Policies</a></li>
                <li><a href="#TPPP">Third Party Privacy Policies</a></li>
                <li><a href="#CPR">CCPA Privacy Rights (Do Not Sell My Personal Information)</a></li>
                <li><a href="#GDPR">GDPR Data Protection Rights</a></li>
                <li><a href="#CI">Children's Information</a></li>
            </ul>
            <p>
                At HereForYou Consultation, accessible from www.hfyc.com.my, one of our main priorities is the privacy of
                our visitors. This Privacy Policy document contains types of information that is collected and recorded by
                HereForYou Consultation and how we use it.
            </p>
            <p>
                If you have additional questions or require more information about our Privacy Policy, do not hesitate to
                contact us.
            </p>
            <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards
                to the information that they shared and/or collect in HereForYou Consultation. This policy is not applicable to
                any information collected offline or via channels other than this website. Our Privacy Policy was created with
                the help of the Free Privacy Policy Generator.
            </p>

            <h2 id="C">Consent</h2>
            <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

            <h2 id="IWC">Information we Collect</h2>
            <p>
                The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be
                made clear to you at the point we ask you to provide your personal information.
            </p>
            <p>
                If you contact us directly, we may receive additional information about you such as your name, email address,
                phone number, the contents of the message and/or attachments you may send us, and any other information you may
                choose to provide.
            </p>
            <p>
                When you register for an Account, we may ask for your contact information, including items such as name, company
                name, address, email address, and telephone number.
            </p>

            <h2 id="HWUYI">How we use Your Information</h2>
            <p>We use the information we collect in various ways, including to: </p>
            <ul class="hwuyi-ul">
                <li>Provide, operate, and maintain our website.</li>
                <li>Improve, personalize, and expand our website.</li>
                <li>Understand and analyze how you use our website.</li>
                <li>Develop new products, services, features, and functionality.</li>
                <li>Communicate with you, either directly or through one of our partners, including for customer service, to
                    provide you with updates and other information relating to the webste, and for marketing and promotional
                    purposes.</li>
                <li>Send you emails.</li>
                <li>Find and prevent fraud.</li>
            </ul>

            <h2 id="LF">Log Files</h2>
            <p>HereForYou Consultation follows a standard procedure of using log files. These files log visitors when they
                visit websites. All hosting companies do this and a part of hosting services' analytics. The information
                collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP),
                date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any
                information that is personally identifiable. The purpose of the information is for analyzing trends,
                administering the site, tracking users' movement on the website, and gathering demographic information.</p>

            <h2 id="CAWB">Cookies & Web Beacons</h2>
            <p>
                Like any other website, HereForYou Consultation uses 'cookies'. These cookies are used to store information
                including visitors' preferences, and the pages on the website that the visitor accessed or visited. The
                information is used to optimize the users' experience by customizing our web page content based on visitors'
                browser type and/or other information.
            </p>
            <p>For more general information on cookies, please read "What Are Cookies" from Cookie Consent.</p>

            <h2 id="APPP">Advertising Partners Privacy Policies</h2>
            <p>
                You may consult this list to find the Privacy Policy for each of the advertising partners of HereForYou
                Consultation.
            </p>
            <p>
                Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used
                in their respective advertisements and links that appear on HereForYou Consultation, which are sent directly to
                users' browser. They automatically receive your IP address when this occurs. These technologies are used to
                measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you
                see on websites that you visit.
            </p>
            <p>
                Note that HereForYou Consultation has no access to or control over these cookies that are used by third-party
                advertisers.
            </p>

            <h2 id="TPPP">Third Party Privacy Policies</h2>
            <p>
                HereForYou Consultation's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising
                you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It
                may include their practices and instructions about how to opt-out of certain options.
            </p>
            <p>
                You can choose to disable cookies through your individual browser options. To know more detailed information
                about cookie management with specific web browsers, it can be found at the browsers' respective websites.
            </p>

            <h2 id="CPR">CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>
            <p>Under the CCPA, among other rights, California consumers have the right to:</p>
            <ul class="cpr-ul">
                <li>Request that a business that collects a consumer's personal data disclose the categories and specific pieces
                    of personal data that a business has collected about consumers.</li>
                <li>Request that a business delete any personal data about the consumer that a business has collected.</li>
                <li>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</li>
                <li>If you make a request, we have one month to respond to you. If you would like to exercise any of these
                    rights, please contact us.</li>
            </ul>

            <h2 id="GDPR">GDPR Data Protection Rights</h2>
            <p>We would like to make sure you are fully aware of all of your <strong>data protection rights</strong>. Every user is entitled to
                the following:</p>
            <ul class="gdpr-ul">
                <li><strong>The right to access</strong> – You have the right to request copies of your personal data. We may
                    charge you a small fee for this service.</li>
                <li><strong>The right to rectification</strong> – You have the right to request that we correct any information
                    you believe is inaccurate. You also have the right to request that we complete the information you believe is
                    incomplete.</li>
                <li><strong>The right to erasure</strong> – You have the right to request that we erase your personal data,
                    under certain conditions.</li>
                <li><strong>The right to restrict processing</strong> – You have the right to request that we restrict the
                    processing of your personal data, under certain conditions.</li>
                <li><strong>The right to object to processing</strong> – You have the right to object to our processing of your
                    personal data, under certain conditions.</li>
                <li><strong>The right to data portability</strong> – You have the right to request that we transfer the data
                    that we have collected to another organization, or directly to you, under certain conditions.</li>
                <li>If you make a request, we have <strong>one month</strong> to respond to you. If you would like to exercise
                    any of these rights, please contact us.</li>
            </ul>

            <h2 id="CR">Children's Information</h2>
            <p>Another part of our priority is adding protection for children while using the internet. We encourage parents
                and guardians to observe, participate in, and/or monitor and guide their online activity.
            </p>
            <p>
                HereForYou Consultation does not knowingly collect any Personal Identifiable Information from children under the
                age of 13. If you think that your child provided this kind of information on our website, we strongly encourage
                you to contact us immediately and we will do our best efforts to promptly remove such information from our
                records.
            </p>
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
</script>

</html>