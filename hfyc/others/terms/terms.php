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
    <title>HYFC | Terms & Condition</title>
    <link rel="stylesheet" href="terms.css">
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
            <h1>HFY Consultation Terms & Condition</h1>
        </div>

        <div class="tnc">
            <h1 id="Directory">T&C Directory: </h1>
            <ul class="directory-ul">
                <li><a href="#TNC">Terms & Condition</a></li>
                <li><a href="#C">Cookies</a></li>
                <li><a href="#L">License</a></li>
                <li><a href="#HTOC">Hyperlinking to our Content</a></li>
                <li><a href="#IF">iFrames</a></li>
                <li><a href="#CL">Content Liability</a></li>
                <li><a href="#YP">Your Privacy</a></li>
                <li><a href="#ROR">Reservation of Rights</a></li>
                <li><a href="#ROLFOW">Removal of Links from our Website</a></li>
                <li><a href="#D">Disclaimer</a></li>
            </ul>

            <h2 id="TNC">Terms & Condition</h2>
            <p>Welcome to HereForYou Consultation!</p>
            <p>
                These terms & conditions outline the rules and regulations for the use of HereForYou Consultation's
                website,
                located at www.hfyc.com.my.
            </p>
            <p>
                By accessing this website we assume you accept these terms & conditions. Do not continue to
                use HereForYou Consultation if you do not agree to take all of the terms & conditions stated on this
                page.
            </p>
            <p>
                The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice
                and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and
                compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us",
                refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms
                refer to the offer, acceptance and consideration of payment necessary to undertake the process of our
                assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s
                needs in respect of provision of the Company’s stated services, in accordance with and subject to,
                prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural,
                capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.
            </p>

            <h2 id="C">Cookies</h2>
            <p>
                We employ the use of cookies. By accessing HereForYou Consultation, you agreed to use cookies in
                agreement
                with the HereForYou Consultation's Privacy Policy.
            </p>
            <p>
                Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are
                used by our website to enable the functionality of certain areas to make it easier for people visiting
                our website. Some of our affiliate/advertising partners may also use cookies.
            </p>

            <h2 id="L">License</h2>
            <p>
                Unless otherwise stated, HereForYou Consultation and/or its licensors own the intellectual property
                rights for all material on HereForYou Consultation. All intellectual property rights are reserved.
                You may access this from HereForYou Consultation for your own personal use subjected to restrictions
                set in these terms and conditions.
            </p>

            <p>You <strong>must not: </strong></p>
            <ul class="license-tnc">
                <li>Republish material from HereForYou Consultation</li>
                <li>Sell, rent or sub-license material from HereForYou Consultation</li>
                <li>Reproduce, duplicate or copy material from HereForYou Consultation</li>
                <li>Redistribute content from HereForYou Consultation</li>
            </ul>
            <p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the
                help of the Terms And Conditions Generator and the Privacy Policy Generator.
            </p>
            <p>
                Parts of this website offer an opportunity for users to post and exchange opinions and information in
                certain areas of the website. HereForYou Consultation does not filter, edit, publish or review Comments
                prior to their presence on the website. Comments do not reflect the views and opinions of HereForYou
                Consultation,its agents and/or affiliates. Comments reflect the views and opinions of the person who
                post their views and opinions. To the extent permitted by applicable laws, HereForYou Consultation shall
                not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a
                result of any use of and/or posting of and/or appearance of the Comments on this website.
            </p>
            <p>
                HereForYou Consultation reserves the right to monitor all Comments and to remove any Comments which
                can be considered inappropriate, offensive or causes breach of these Terms and Conditions.
            </p>
            <p>You warrant and represent that: </p>
            <ul class="license-tnc-2">
                <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to
                    do so;</li>
                <li>The Comments do not invade any intellectual property right, including without limitation copyright,
                    patent or trademark of any third party;</li>
                <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful
                    material which is an invasion of privacy.</li>
                <li>The Comments will not be used to solicit or promote business or custom or present commercial
                    activities or unlawful activity.</li>
            </ul>
            <p>You hereby grant HereForYou Consultation a non-exclusive license to use, reproduce, edit and authorize
                others to use, reproduce and edit any of your Comments in any and all forms, formats or media.
            </p>

            <h2 id="HTOC">Hyperlinking to Our Content</h2>
            <p>The following organizations may link to our Website without prior written approval: </p>
            <ul class="hyperlink-tnc">
                <li>Government Agencies</li>
                <li>Search Engines</li>
                <li>News Organizations</li>
                <li>Online directory distributors may link to our Website in the same manner as they hyperlink to the
                    Websites of other listed businesses; and</li>
                <li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping
                    malls, and charity fundraising groups which may not hyperlink to our Web site.</li>
            </ul>
            <p>
                These organizations may link to our home page, to publications or to other Website information so long
                as
                the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or
                approval
                of the linking party and its products and/or services; and (c) fits within the context of the linking
                party’s
                site.
            </p>
            <p>We <strong>may consider and approve</strong> other link requests from the following types of
                organizations:</p>
            <ul class="hyperlink-tnc-2">
                <li>Commonly-known consumer and/or business information sources</li>
                <li>Dot.com community sites.</li>
                <li>Associations or other groups representing charities.</li>
                <li>Online directory distributors.</li>
                <li>Internet portals.</li>
                <li>Accounting, law and consulting firms.</li>
                <li>Educational institutions and trade associations.</li>
            </ul>
            <p>
                We will approve link requests from these organizations if we decide that: (a) the link would not make
                us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have
                any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates
                the absence of HereForYou Consultation; and (d) the link is in the context of general resource
                information.
            </p>
            <p>
                These organizations may link to our home page so long as the link: (a) is not in any way deceptive;
                (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products
                or services; and (c) fits within the context of the linking party’s site.
            </p>
            <p>
                If you are one of the organizations listed in paragraph 2 above and are interested in linking to our
                website, you must inform us by sending an e-mail to HereForYou Consultation. Please include your name,
                your organization name, contact information as well as the URL of your site, a list of any URLs from
                which you intend to link to our Website, and a list of the URLs on our site to which you would like to
                link. Wait 2-3 weeks for a response.
            </p>
            <p><strong>Approved organizations</strong> may hyperlink to our Website as follows:</p>
            <ul class="hyperlink-tnc-3">
                <li>By use of our corporate name; or</li>
                <li>By use of the uniform resource locator being linked to; or</li>
                <li>By use of any other description of our Website being linked to that makes sense within the context
                    and format of content on the linking party’s site.</li>
            </ul>
            <p>
                No use of HereForYou Consultation's logo or other artwork will be allowed for linking absent a
                trademark license agreement.
            </p>

            <h2 id="IF">iFrames</h2>
            <p>
                Without prior approval and written permission, you may not create frames around our Webpages that alter
                in any way the visual presentation or appearance of our Website.
            </p>

            <h2 id="CL">Content Liability</h2>
            <p>
                We shall not be hold responsible for any content that appears on your Website. You agree to protect and
                defend us against all claims that is rising on your Website. No link(s) should appear on any Website
                that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or
                advocates the infringement or other violation of, any third party rights.
            </p>

            <h2 id="YP">Your Privacy</h2>
            <p>Please read our <a href="#">Privacy Policy</a>.</p>

            <h2 id="ROR">Reservation of Rights</h2>
            <p>
                We reserve the right to request that you remove all links or any particular link to our Website. You
                approve to immediately remove all links to our Website upon request. We also reserve the right to amend
                these terms and conditions and it’s linking policy at any time. By continuously linking to our Website,
                you agree to be bound to and follow these linking terms and conditions.
            </p>

            <h2 id="ROLFOW">Removal of Links from our Website</h2>
            <p>
                If you find any link on our Website that is offensive for any reason, you are free to contact and inform
                us any moment. We will consider requests to remove links but we are not obligated to or so or to respond
                to you directly.
            </p>
            <p>
                We do not ensure that the information on this website is correct, we do not warrant its completeness or
                accuracy; nor do we promise to ensure that the website remains available or that the material on the
                website is kept up to date.
            </p>

            <h2 id="D">Disclaimer</h2>
            <p>
                To the maximum extent permitted by applicable law, we exclude all representations, warranties and
                conditions relating to our website and the use of this website. Nothing in this disclaimer will:
            </p>
            <ul class="disclaimer-tnc">
                <li>Limit or exclude our or your liability for death or personal injury.</li>
                <li>Limit or exclude our or your liability for fraud or fraudulent misrepresentation.</li>
                <li>Limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                <li>Exclude any of our or your liabilities that may not be excluded under applicable law.</li>
            </ul>
            <p>
                The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer:
                (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer,
                including liabilities arising in contract, in tort and for breach of statutory duty.
            </p>
            <p>
                As long as the website and the information and services on the website are provided free of charge, we
                will not be liable for any loss or damage of any nature.
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