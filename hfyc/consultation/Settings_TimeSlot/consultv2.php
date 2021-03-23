<!DOCTYPE html>
<?php
date_default_timezone_set('Asia/Singapore');
session_start();
require '../../m_connection/db.con.php';
if (isset($_SESSION['id'])) {
    $sql = 'SELECT * FROM consultor WHERE UserID = ' . $_SESSION['id'];
    $result = mysqli_query($conn, $sql);
    $role = "consultor";
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $tp = $row['ConsultorTP'];
        $name = $row['ConsultorName'];
        $gender = $row['ConsultorGender'];
        $age = $row['ConsultorAge'];
        $address = $row['ConsultorAddress'];
        $description = $row["ConsultorDescription"];
    } else {
        echo "<script>
        alert('Please login as Consultor to continue!');
        location.href = document.referrer;
        </script>";
    }
    $returnHome = "onclick = \"" . "location.href = '../../profile/consultor/Profile/consultorprofilev2.php'\"";
} else {
    echo "<script>
    alert('Please login as Consultor to continue!');
    location.href = document.referrer;
    </script>";
}
?>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HFYC | Consultation Slot</title>
    <link rel="stylesheet" href="styleconsultv2.css">
    <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.js"></script>
    <link rel="icon" href="browsericon.png">
    <script src="createConsult.js" defer></script>
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
                if ($_SESSION['id']) {
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
                <div class='overlay'>
                    <h1> Create Consultation Slots</h1><button class="btnOpen" id="btnOpen">Add Slot</button>

                    <?php
                    $fullUrl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if (strpos($fullUrl, "loginerror=emptyFields") == TRUE) {
                        echo "<div class = 'alert show'>";
                        echo "<span class= 'fas fa-exclamation-circle'></span>";
                        echo "<span class= 'msg'> Warning: Please try again! You have failed to select all the fields needed.</span>";
                        echo "<span class= 'close-btn' id='close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.close-btn').addEventListener('click', function() {
                        document.querySelector('.alert').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "Timeerror=sameTime") == TRUE) {
                        echo "<div class = 'error show'>";
                        echo "<span class= 'fas fa-times-circle'></span>";
                        echo "<span class= 'msg'> Error: Start time and End time should be different!</span>";
                        echo "<span class= 'e-close-btn' id = 'e-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.e-close-btn').addEventListener('click', function() {
                        document.querySelector('.error').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "Slot=exist") == TRUE) {
                        echo "<div class = 'error show'>";
                        echo "<span class= 'fas fa-times-circle'></span>";
                        echo "<span class= 'msg'> Error: Slot Already Exist! Please Try Again with a New Input.</span>";
                        echo "<span class= 'e-close-btn' id = 'e-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.e-close-btn').addEventListener('click', function() {
                        document.querySelector('.error').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "invalidTimeSelected") == TRUE) {
                        echo "<div class = 'error show'>";
                        echo "<span class= 'fas fa-times-circle'></span>";
                        echo "<span class= 'msg'> Error: Selected time is not valid!</span>";
                        echo "<span class= 'e-close-btn' id = 'e-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.e-close-btn').addEventListener('click', function() {
                        document.querySelector('.error').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "oneHourOnlyLimit") == TRUE) {
                        echo "<div class = 'error show'>";
                        echo "<span class= 'fas fa-times-circle'></span>";
                        echo "<span class= 'msg'> Error: Consultation duration should be within 1 hour!</span>";
                        echo "<span class= 'e-close-btn' id = 'e-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.e-close-btn').addEventListener('click', function() {
                        document.querySelector('.error').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "error=sqlError") == TRUE) {
                        echo "<div class = 'error show'>";
                        echo "<span class= 'fas fa-times-circle'></span>";
                        echo "<span class= 'msg'> Warning: Please try again! There was an error occured.</span>";
                        echo "<span class= 'e-close-btn' id= 'e-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.e-close-btn').addEventListener('click', function() {
                        document.querySelector('.error').style.display = 'none';
                        });
                        </script>";
                    } elseif (strpos($fullUrl, "submit=success") == TRUE) {
                        echo "<div class = 'success show'>";
                        echo "<span class= 'fas fa-check-circle'></span>";
                        echo "<span class= 'msg'> Success: Slots has been added successfully.</span>";
                        echo "<span class= 's-close-btn' id = 's-close-btn'>";
                        echo "<span class='fas fa-times'></span>";
                        echo "</span>";
                        echo "</div>";

                        echo "<script>
                        document.querySelector('.s-close-btn').addEventListener('click', function() {
                        document.querySelector('.success').style.display = 'none';
                        });
                        </script>";
                    }
                    ?>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $db = "hfyc_apu";

                    $conn = mysqli_connect($servername, $username, $password, $db);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT `ConsultorTP` from consultor where `UserID` = '" . $_SESSION['id'] . "'";
                    $sessiontp = mysqli_fetch_row(mysqli_query($conn, $sql))[0];
                    $_SESSION['tp'] = $sessiontp;
                    $sql = "SELECT * from consultor_consultation where `Consultor_ID` = '$sessiontp'";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows <= 0) {
                        echo "<div class='box'>";
                        echo "<div class='center-text'>";
                        echo "<img src = 'sadFace.png'>";
                        echo "<h2>Oopss!!! It seems like you haven't added any slots yet. Add some for the users to book.</h2>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                    <div id="dialogoverlay"></div>
                    <div id="dialogbox">
                        <div>
                            <div id="dialogboxhead"></div>
                            <div id="dialogboxbody"></div>
                            <div id="dialogboxfoot"></div>
                        </div>
                    </div>


                    <div class="time-slot">
                        <div class="modal-content"><br>
                            <h2 class="title-slot">Add New Time Slot</h2>
                            <div class="btnClose" id="btnClose">+</div><br><br>
                            <h5>Please Select All the Fields!</h3>
                                <form class="form" method="POST" action="addTimeslotv2.php">
                                    <h6 class="select-date">Select Date</h6>
                                    <input type="date" name="date" id="dateValidate" class="date-align">
                                    <h6 class="select-venue">Select Venue</h6>

                                    <select name="venue" class="venue-align">
                                        <option value="" selected="selected">Venue</option>
                                        <option value="Microsoft Teams">Microsoft Teams</option>
                                        <option value="Discord">Discord</option>
                                    </select>

                                    <h6 class='select-duration'>Select Duration</h6><br>
                                    <select name="start_time" class="time-align">
                                        <option value="" selected>Start-Time</option>
                                        <option value="09:00 AM">09.00 AM</option>
                                        <option value="09:30 AM">09.30 AM</option>
                                        <option value="10:00 AM">10.00 AM</option>
                                        <option value="10:30 AM">10.30 AM</option>
                                        <option value="11:00 AM">11.00 AM</option>
                                        <option value="11:30 AM">11.30 AM</option>
                                        <option value="12:00 PM">12.00 PM</option>
                                        <option value="12:30 PM">12.30 PM</option>
                                        <option value="1:00 PM">01.00 PM</option>
                                        <option value="1:30 PM">01.30 PM</option>
                                        <option value="2:00 PM">02.00 PM</option>
                                        <option value="2:30 PM">02.30 PM</option>
                                        <option value="3:00 PM">03.00 PM</option>
                                        <option value="3:30 PM">03.30 PM</option>
                                        <option value="4:00 PM">04.00 PM</option>
                                        <option value="4:30 PM">04.30 PM</option>
                                        <option value="5:00 PM">05.00 PM</option>
                                        <option value="5:30 PM">05.30 PM</option>
                                    </select><label class="time-label"> to </label> <select name="end_time" class="time-align">
                                        <option value="" selected>End-Time</option>
                                        <option value="09:00 AM">09.00 AM</option>
                                        <option value="09:30 AM">09.30 AM</option>
                                        <option value="10:00 AM">10.00 AM</option>
                                        <option value="10:30 AM">10.30 AM</option>
                                        <option value="11:00 AM">11.00 AM</option>
                                        <option value="11:30 AM">11.30 AM</option>
                                        <option value="12:00 PM">12.00 PM</option>
                                        <option value="12:30 PM">12.30 PM</option>
                                        <option value="1:00 PM">01.00 PM</option>
                                        <option value="1:30 PM">01.30 PM</option>
                                        <option value="2:00 PM">02.00 PM</option>
                                        <option value="2:30 PM">02.30 PM</option>
                                        <option value="3:00 PM">03.00 PM</option>
                                        <option value="3:30 PM">03.30 PM</option>
                                        <option value="4:00 PM">04.00 PM</option>
                                        <option value="4:30 PM">04.30 PM</option>
                                        <option value="5:00 PM">05.00 PM</option>
                                        <option value="5:30 PM">05.30 PM</option>
                                        <option value="6:00 PM">06.00 PM</option>
                                    </select><br><br>

                                    <button type="sudmit" name="btnSave" class="btnSave" id="btnSave"><i class="fa fa-save" style="font-size: 30px;padding-top: 1px;"></i></button>
                                </form>
                        </div>
                    </div>
                    <?php

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $db = "hfyc_apu";

                    $conn = mysqli_connect($servername, $username, $password, $db);

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * from Consultor_Consultation where Consultor_ID = '$sessiontp'";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows >= 1) {
                        echo "<table class='table-style' width='100%'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Date</th>";
                        echo "<th >Time Slots</th>";
                        echo "<th>Status</th>";
                        echo "<th>Venue</th>";
                        echo "<th >Details</th>";
                        echo "<th></th>";
                        echo "</tr>";

                        echo "</thead>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tbody>";
                            echo "<tr>";
                            echo "<td>" . $row["Consult_Date"] . "</td>";
                            echo "<td>" . $row["Start_Time"] . " - " . $row["End_Time"] . "</td>";
                            echo "<td class= 'sold'>" . $row["SlotStatus"] . "</td>";
                            echo "<td>" . $row["ConsultationVenue"] . "</td>";

                            if ($row["SlotStatus"] == "Ongoing") {            
                                echo "<td>" . "<a href= '../CheckPastHistory/displaypast.php?id=" . $row['Consultation_ID'] . "' style= 'text-decoration: underline;color;black;' class = 'link'>Click Here</a>" . "</td>";
                            }else{
                                echo "<td>" . "<a href= '#' style= 'text-decoration: none; color: black;' class = 'link'>-</a>" . "</td>";
                            }

                            echo "<td><a style ='color:white' href ='deletev2.php?id=" . $row["Consultation_ID"] . "'><button class='btnDelete' name='btnDelete' id='btnDelete' onClick='deleteme()' >Delete</button></a>";
                            echo "</tr>";
                        }
                    }
                    ?>
                    <script type="text/javascript">
                        function deleteme() {
                            if (confirm("Are you sure you want delete this slot?")) {
                                window.location.href = 'deletev2.php?id=" . $row["Consultation_ID"] . "';
                                return true;
                            }
                            return false;
                        }
                        $(function() {
                            $('table tr').each(function() {
                                var Cell = $(this).find('td:eq(2)');
                                if (Cell.text() !== 'Available') {
                                    $(this).find('.btnDelete').css("visibility", "hidden");

                                }
                            });
                        });
                        $(function() { //document ready event
                            $('table tr').each(function() { //loop all tr's
                                var Cell = $(this).find('td:eq(2)'); //find the 3rd td cell
                                if (Cell.text() == 'Past') {
                                    $(this).find('.btnDelete').css("visibility", "hidden"); //if try then find the button of this tr and hide it 
                                    $(this).find('td').remove();
                                }
                            });
                        });
                    </script>

                    </tbody>
                    </table>
                </div>
            </section>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.nav_btn').click(function() {
                    $('.mobile_nav_items').toggleClass('active');
                });
            });

            vpw = $(window).width();
            vph = $(window).height();

            $('.footer').height(vph);

            $("td.sold").filter(function() {
                return +$(this).text().trim() === "Past";
            }).parent().hide();
        </script>


    </div>
    <div class="footer">
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