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

    if (isset($_POST['changeContent'])) {
        $sql = "SELECT * FROM consultation_info WHERE UserID = " . $_SESSION['id'] . " AND ConsultID = " . $_POST['consultId'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $consultDate = $row['ConsultDate'];
        $consultDuration = $row['ConsultStartTime'] . " - " . $row['ConsultEndTime'];

        $sql = "SELECT ConsultorName, UserID FROM consultor WHERE ConsultorTP = '" . $row['ConsultorID'] . "'";
        $consultorName = mysqli_fetch_assoc(mysqli_query($conn, $sql))['ConsultorName'];
        $consultorid = mysqli_fetch_assoc(mysqli_query($conn, $sql))['UserID'];

        if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".jpg")) {
            $imagesrc = '../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".jpg";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".png")) {
            $imagesrc = '../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".png";
        } else if (file_exists('../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".jpeg")) {
            $imagesrc = '../../profile_upload_pic/' . "ProfilePicID" . $consultorid . ".jpeg";
        } else {
            $imagesrc =  "../../profile_upload_pic/avatar.png";
        }

        echo "$consultorName | $consultDate | $consultDuration | " . $_POST['consultId'] . " | $imagesrc";
        exit();
    }

    if (isset($_POST['btnSubmit'])) {
        $reviews = $_POST['reviews'];
        $ratings = $_POST['ratings'];
        $consultId = $_POST['id'];

        $sql = "UPDATE consultation_info SET ConsultRating = $ratings, ConsultFeedback = '$reviews' WHERE UserID = " . $_SESSION['id'] . " AND ConsultID = $consultId";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Successfully Submited!');
                location.href = 'feedbackv2.php';
            </script>";
        }
    }
} else {
    echo "<script>
    alert('Please login as Student to continue!');
    location.href = document.referrer;
    </script>";
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC Consultation Summary Page</title>
    <link rel="stylesheet" href="stylesv2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
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
                        echo "<img src='" . '../../profile_upload_pic/' . "ProfilePicID" . $_SESSION['id'] . ".png" . "' alt='profile_image' class='mobile_profile_image' >";
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
                    <div class='bg-image-parent'>
                        <div class="title">
                            <h1>Consultation Feedback</h1>
                            <h2>~ Feel Free To Provide Reviews And Ratings About Your Consultation Experience ~</h2>
                        </div>
                        <div class="feedback-details">
                        <p style="display: inline-block">Consultation Session: </p><br>
                            <!-- Select Box -->
                            <?php
                            $sql = "SELECT * FROM consultation_info WHERE UserID = " . $_SESSION['id'];
                            $result = mysqli_query($conn, $sql);
                            $first_id = mysqli_fetch_assoc($result)["ConsultID"];

                            echo '
                            <div class="custom-select-wrapper">
                                <div class="custom-select">
                                    <div class="custom-select__trigger"><span>Consultation #' . $first_id . '</span>
                                    <i class="fas fa-caret-down"></i>
                                    </div>
                                    <div class="custom-options" id="selection-options">';
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $sessionid = $row["ConsultationSessionID"];
                                $sql = "SELECT Consultation_ID FROM consultor_consultation WHERE SlotStatus = 'Past' AND Consultation_ID = $sessionid";
                                $sessionid_check = @mysqli_fetch_assoc(mysqli_query($conn, $sql))['Consultation_ID'];

                                if ($sessionid == $sessionid_check) {
                                    echo '
                                    <span class="custom-option" data-value="' . $row['ConsultID'] . '">Consultation #' . $row['ConsultID'] . '</span>
                                    ';
                                }
                            }
                            echo   '</div>
                                </div>
                            </div>
                            ';
                            ?>
                        <br><img id='consultor-pic' src='../../profile_upload_pic/avatar.png' class='profile_image'><br>
                            <label id='name-label'>Consultor Name: </label><br>
                            <label id='date-label'>Consultation Date: </label><br>
                            <label id='duration-label'>Consultation Duration: </label>
                        </div>
                        <div class="feedback-form-title">
                            <p>Please Enter Your Ratings And Review</p><br>
                        </div>
                        <div class="feedback-ratings">                                
                            <form method='POST'><label>Ratings (out of 10): </label>
                            <div class="rating-outside">
                                <div class="rating">
                                    <span><input type="radio" name="rating" id="str10" value="10"><label for="str10"></label></span>
                                    <span><input type="radio" name="rating" id="str9" value="9"><label for="str9"></label></span>
                                    <span><input type="radio" name="rating" id="str8" value="8"><label for="str8"></label></span>
                                    <span><input type="radio" name="rating" id="str7" value="7"><label for="str7"></label></span>
                                    <span><input type="radio" name="rating" id="str6" value="6"><label for="str6"></label></span>
                                    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
                                    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                                    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                                    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                                    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                                    <input type='hidden' id='rating-submit' name='ratings'>
                                    <input type='hidden' id='consult-id' name='id'>
                                </div>
                            </div>
                        </div>
                        <div class="feedback-textarea">
                            <label>Reviews:</label><br>
                            <textarea type='text' name='reviews'></textarea>
                        </div>
                        <div class="feedback-submitbutton">
                            <input class="submitbutton" type='submit' name='btnSubmit'></form>
                        </div>
                    </div>
            </section>

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

        <script type="text/javascript">
            $(document).ready(function() {
                $('.nav_btn').click(function() {
                    $('.mobile_nav_items').toggleClass('active');
                });
            });
        </script>

        <script type='text/javascript'>
            var consultationId;

            document.querySelector('.custom-select-wrapper').addEventListener('click', function() {
                this.querySelector('.custom-select').classList.toggle('open');
            })

            for (const option of document.querySelectorAll(".custom-option")) {
                option.addEventListener('click', function() {
                    if (!this.classList.contains('selected')) {
                        if (this.parentNode.querySelector('.custom-option.selected')) {
                            this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
                        }
                        this.classList.add('selected');
                        this.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;
                        consultationId = this.textContent;

                        $.ajax({
                            url: 'feedbackv2.php?',
                            method: 'POST',
                            dataType: 'text',
                            data: {
                                consultId: consultationId.substring(consultationId.length - 2, consultationId.length),
                                changeContent: 1,
                            },
                            success: function(response) {
                                var res = response.split("|");
                                $('#name-label').text("Consultor Name: " + res[0]);
                                $('#date-label').text("Consultation Date: " + res[1]);
                                $('#duration-label').text("Consultation Duration: " + res[2]);
                                $('#consult-id').val(res[3]);
                                $('#consultor-pic').attr('src', res[4]);
                            }
                        })
                    }
                })
            }

            window.addEventListener('click', function(e) {
                const select = document.querySelector('.custom-select');
                if (!select.contains(e.target)) {
                    select.classList.remove('open');
                }
            });

            $(document).ready(function() {
                // Check Radio-box
                $(".rating input:radio").attr("checked", false);

                $('.rating input').click(function() {
                    $(".rating span").removeClass('checked');
                    $(this).parent().addClass('checked');
                });

                $('input:radio').change(
                    function() {
                        var userRating = this.value;
                        $('#rating-submit').val(userRating);

                    });
            });
        </script>
       
    </div>
</body>

</html>