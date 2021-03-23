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
    <title>HYFC | Consultation Selection Page</title>
    <link rel="stylesheet" href="styleservicev2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="icon" href="HFYCIcon.png">
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>
<script>
    jQuery(document).ready(function($) {

        //Count nr. of square classes
        var countSquare = $('.square').length;

        //For each Square found add BG image
        for (i = 0; i < countSquare; i++) {
            var firstImage = $('.square').eq([i]);
            var secondImage = $('.square2').eq([i]);

            var getImage = firstImage.attr('data-image');
            var getImage2 = secondImage.attr('data-image');

            firstImage.css('background-image', 'url(' + getImage + ')');
            secondImage.css('background-image', 'url(' + getImage2 + ')');
        }

    });
</script>

<body>

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
    <div class='wrapper'>
        <h1 class="main-title">Consultation Selection</h1>
        <div class="centerflipcards">

            <div class="square-flip">

                <div class='square' data-image="https://brewminate.com/wp-content/uploads/2016/12/Life06.jpeg">
                    <div class="square-container">
                        <div class="align-center"><img src="http://titanicthemes.com/files/flipbox/kallyas2.png" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">Life Consultation</h2>
                        <h3 class="textshadow">"Life is what happens when you're busy making other plans." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="https://images.unsplash.com/photo-1517960413843-0aee8e2b3285?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1000&q=80">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=life" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>


        <div class="centerflipcards">
            <div class="square-flip">
                <div class='square' data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTApf3Mk4vlgk7VAX45FMBISmCrwFUjB3s8sg&usqp=CAU">
                    <div class="square-container">
                        <div class="align-center"><img src="" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">
                            Career Consultation
                        </h2>
                        <h3 class="textshadow"> "Find out what you like doing best and get someone to pay you for doing it." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxOyC7qe22r1_lJsthW5fP8Sq50p67dpD9Rw&usqp=CAU">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=career" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>



        <div class="centerflipcards">
            <div class="square-flip">
                <div class='square' data-image="https://www.thesundaily.my/binrepository/768x432/0c0/0d0/none/11808/QMVG/12973703836-c1975811-17102-392-arch488995-mg529416_1189306_20200603175756.jpg">
                    <div class="square-container">
                        <div class="align-center"><img src="" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">
                            Further Studies Consultation
                        </h2>
                        <h3 class="textshadow"> "Learning is the only thing the mind never exhausts, never fears, and never regrets." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="https://www.stei.edu.sg/wp-content/uploads/2017/03/Further-Studies.jpg">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=further" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>

        <div class="centerflipcards">
            <div class="square-flip">
                <div class='square' data-image="https://my.alfred.edu/center-academic-success/_images/dsc0052.jpg">
                    <div class="square-container">
                        <div class="align-center"><img src="" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">
                            Academic Consultation
                        </h2>
                        <h3 class="textshadow"> "Learning is the only thing the mind never exhausts, never fears, and never regrets." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="https://www.bristol.ac.uk/media-library/sites/policybristol/consultations-page/Academic%20studying%20consultations%20photo%20for%20web%20650.jpg">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=academic" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>


        <div class="centerflipcards">
            <div class="square-flip">
                <div class='square' data-image="https://www.opexfit.com/hubfs/Imported_Blog_Media/Consultation-blog-Oct-13-2020-03-31-28-85-PM.png">
                    <div class="square-container">
                        <div class="align-center"><img src="" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">
                            Fitness Consultation
                        </h2>
                        <h3 class="textshadow"> "Life begins at the end of your comfort zone." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="https://blog.nasm.org/hubfs/initial-fitness-consultation.jpg">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=fitness" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>

        <div class="centerflipcards">
            <div class="square-flip">
                <div class='square' data-image="https://gpsoncurzon.com.au/wp-content/uploads/2020/09/Women-has-unique-mental-health-challenges.jpg">
                    <div class="square-container">
                        <div class="align-center"><img src="" class="boxshadow" alt=""></div>
                        <h2 class="textshadow">
                            Mental Health Consultation
                        </h2>
                        <h3 class="textshadow"> "Mental health is not a destination, but a process. It's about how you drive, not where you're going." </h3>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
                <div class='square2' data-image="bg.png">
                    <div class="square-container2">
                        <div class="align-center"></div>
                        <h2> <a href="../SP_ConsultorDetails/consultordetailsv2.php?type=mental" class="boxshadow kallyas-button">Click Here</a></h2>
                    </div>
                    <div class="flip-overlay"></div>
                </div>
            </div>
        </div>
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


</html>