<?php
session_start();

$loggedIn = false;

$conn = new mysqli('localhost', 'root', '', 'hfyc_apu');

if (isset($_SESSION['id'])) {
    $loggedIn = true;
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
        echo "<script>var isAdmin = 1;</script>";
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

    if (isset($_GET['id'])) {
        $sql = "SELECT Post_Upvote FROM talk_it_out_post WHERE Post_ID = " . $_GET['id'];
        $upvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'];

        $sql = "SELECT * FROM `talk-it-out_upvotes` WHERE UserID = " . $_SESSION['id'] . " AND PostID = " . $_GET['id'];

        if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
            $sql = "INSERT INTO `talk-it-out_upvotes`(PostID, UserID, UpvoteState, DownvoteState) VALUES (" . $_GET['id'] . ", " . $_SESSION['id'] . ", 0, 0)";
            if (mysqli_query($conn, $sql)) {
                echo "<script>console.log('Insert Success')</script>";
            }
        } else {
            echo "<script>console.log('Already Exists')</script>";
        }
    }
} else {
    $role = "guests";
    $name = "Guest";
    $returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
}

if (isset($_POST['btnDelete'])) {
    if ($_POST['isComment']) {
        $sql = "DELETE FROM `talk-it-out_comments` WHERE ID = " . $_POST['deleteid'];
        if (mysqli_query($conn, $sql)) {
            echo "<script>
            alert('Comment Successfully Deleted!');
            location.href = document.referrer;
            </script>";
        }
    } else {
        $sql = "DELETE FROM `talk-it-out_replies` WHERE ID = " . $_POST['deleteid'];
        if (mysqli_query($conn, $sql)) {
            echo "<script>
            alert('Reply Successfully Deleted!');
            location.href = document.referrer;
            </script>";
        }
    }
}

if (isset($_POST['addUpvote'])) {
    if (isset($_POST['btnUpvotePressed'])) {
        $sql = "SELECT * FROM `talk-it-out_upvotes` WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];

        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $upvoteState = $result['UpvoteState'];
        $downvoteState = $result['DownvoteState'];

        $sql = "SELECT Post_Upvote FROM talk_it_out_post WHERE Post_ID = " . $_POST['postId'];

        if ($upvoteState == 0 && $downvoteState == 0) {
            $upvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] + 1;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 1 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        } else if ($upvoteState == 0 && $downvoteState == 1) {
            $upvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] + 2;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 1 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        } else if ($upvoteState == 1) {
            $upvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] - 1;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        }
    }

    $sql = "UPDATE talk_it_out_post SET Post_Upvote = $upvote WHERE Post_ID = " . $_POST['postId'];
    if (mysqli_query($conn, $sql)) {
        exit('' . $upvote);
    }
}

if (isset($_POST['addDownvote'])) {
    if (isset($_POST['btnDownvotePressed'])) {
        $sql = "SELECT * FROM `talk-it-out_upvotes` WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];

        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $upvoteState = $result['UpvoteState'];
        $downvoteState = $result['DownvoteState'];

        $sql = "SELECT Post_Upvote FROM talk_it_out_post WHERE Post_ID = " . $_POST['postId'];

        if ($downvoteState == 0 && $upvoteState == 0) {
            $downvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] - 1;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 1 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        } else if ($downvoteState == 0 && $upvoteState == 1) {
            $downvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] - 2;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 1 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        } else if ($downvoteState == 1) {
            $downvote = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Post_Upvote'] + 1;

            $sql = "UPDATE `talk-it-out_upvotes` SET UpvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            $sql2 = "UPDATE `talk-it-out_upvotes` SET DownvoteState = 0 WHERE PostID = " . $_POST['postId'] . " AND UserID = " . $_SESSION['id'];
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);
        }
    }

    $sql = "UPDATE talk_it_out_post SET Post_Upvote = $downvote WHERE Post_ID = " . $_POST['postId'];
    if (mysqli_query($conn, $sql)) {
        exit('' . $downvote);
    }
}

$i = 0;
$reply_arr = array_fill(0, 1000, 0);
$isComment = 0;


function createCommentRow($data)
{
    global $conn;
    global $i;
    global $reply_arr;
    global $isComment;

    if (!isset($_SESSION['id'])) {
        $response = '
        <div class="comment">
            <div class="user">' . $data['Username'] . ' <span class="time">' . $data['CreatedOn'] . '</span></div>
            <div class="userComment">' . $data['Comment'] . '</div>';
    } else {
        $response = '
            <div class="comment">
                <div class="user">' . $data['Username'] . ' <span class="time">' . $data['CreatedOn'] . '</span></div>
                <div class="userComment">' . $data['Comment'] . '</div>
                <div class="reply"><a href="javascript:void(0)" data-commentID="' . $data['ID'] . '" onclick="reply(this)">REPLY</a></div>';
    }

    if (isset($_POST['isAdmin']) && $_POST['isAdmin'] == 1) {
        $response .= '<form method="POST">
                        <input type="hidden" value=' . $data['ID'] . ' name="deleteid">
                        <input type="hidden" value=' . $isComment . ' name="isComment">
                        <div class="reply"><input type="submit" value="DELETE" name="btnDelete"></div>
                    </form>';
    } else if (isset($_POST['isAdmin']) && $_POST['isAdmin'] == 0 && isset($_SESSION['id'])) {
        $sql = "SELECT Username FROM users WHERE UserID = " . $_SESSION['id'];
        $username = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Username'];

        if ($data['Username'] == $username) {
            $response .= '<form method="POST">
                            <input type="hidden" value=' . $data['ID'] . ' name="deleteid">
                            <input type="hidden" value=' . $isComment . ' name="isComment">
                            <div class="reply"><input type="submit" value="DELETE" name="btnDelete"></div>
                        </form>';
        }
    }

    $response .= '<div class="replies">';

    if (isset($_POST['postId'])) {
        $postId = $_POST['postId'];
    } else {
        $postId = $_GET['id'];
    }
    $reply_arr[$i] = $conn->query("SELECT `talk-it-out_replies`.ID, users.Username, Comment, DATE_FORMAT(`talk-it-out_replies`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `talk-it-out_replies` INNER JOIN users ON `talk-it-out_replies`.UserID = users.UserID WHERE `talk-it-out_replies`.CommentID = '" . $data['ID'] . "'AND Post_ID = '" . $postId . "' ORDER BY `talk-it-out_replies`.ID DESC");
    $sql = $reply_arr[$i];

    while ($dataR = $sql->fetch_assoc()) {
        $i++;
        $isComment = 0;
        $response .= createCommentRow($dataR);
    }

    $response .= '
                        </div>
            </div>
        ';

    return $response;
}

if (isset($_POST['getAllComments'])) {
    $isComment = 1;

    $start = $conn->real_escape_string($_POST['start']);

    $response = "";
    $sql = $conn->query("SELECT `talk-it-out_comments`.ID, users.Username, `talk-it-out_comments`.Comment, DATE_FORMAT(`talk-it-out_comments`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `talk-it-out_comments` INNER JOIN users ON `talk-it-out_comments`.UserID = users.UserID WHERE Post_ID = '" . $_GET['id'] . "' ORDER BY `talk-it-out_comments`.ID DESC LIMIT $start, 20");
    while ($data = $sql->fetch_assoc()) {
        $isComment = 1;
        $response .= createCommentRow($data);
    }

    exit($response);
}

if (isset($_POST['addComment'])) {
    $comment = $conn->real_escape_string($_POST['comment']);
    $isReply = $conn->real_escape_string($_POST['isReply']);
    $commentID = $conn->real_escape_string($_POST['commentID']);

    if ($isReply != 'false') {
        $conn->query("INSERT INTO `talk-it-out_replies` (Comment, CommentID, UserID, CreatedOn, Post_ID) VALUES ('$comment', '$commentID', '" . $_SESSION['id'] . "', NOW(), " . $_POST['postId'] . ")");
        $sql = $conn->query("SELECT `talk-it-out_replies`.ID, users.Username, Comment, DATE_FORMAT(`talk-it-out_replies`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `talk-it-out_replies` INNER JOIN users ON `talk-it-out_replies`.UserID = users.UserID WHERE Post_ID = '" . $_POST['postId'] . "' ORDER BY `talk-it-out_replies`.ID DESC LIMIT 1");
        $isComment = 0;
    } else {
        $conn->query("INSERT INTO `talk-it-out_comments` (UserID, Comment, CreatedOn, Post_ID) VALUES ('" . $_SESSION['id'] . "','$comment',NOW(), " . $_POST['postId'] . ")");
        $sql = $conn->query("SELECT `talk-it-out_comments`.ID, users.Username, Comment, DATE_FORMAT(`talk-it-out_comments`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `talk-it-out_comments` INNER JOIN users ON `talk-it-out_comments`.UserID = users.UserID WHERE Post_ID = '" . $_POST['postId'] . "' ORDER BY `talk-it-out_comments`.ID DESC LIMIT 1");
        $isComment = 1;
    }

    $data = $sql->fetch_assoc();
    exit(createCommentRow($data));
}

$sqlNumComments = $conn->query("SELECT ID FROM `talk-it-out_comments` WHERE Post_ID = " . $_GET['id']);
$numComments = $sqlNumComments->num_rows;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HYFC | Talk-It-Out Post</title>
    <link rel="icon" href="HFYCIcon.png">
    <link rel="stylesheet" href="postdiscussion.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        .comment {
            margin-bottom: 20px;
        }

        .user {
            font-weight: bold;
            color: black;
        }

        .time,
        .reply {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .replies .comment {
            margin-top: 20px;
        }

        .replies {
            margin-left: 20px;
        }

        #registerModal input,
        #logInModal input {
            margin-top: 10px;
        }
    </style>
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
        <div class="page-msg">
            <h1>Talk-it-Out Discussion</h1>
            <h2>Input all the necessary details and click on the submit button to create your post!</h2>
        </div>

        <div class="op-post">
            <table class="table-post">
                <tr>
                    <td class="btn-vote">
                        <?php if (isset($_SESSION['id'])) echo '<button class="btn-upvote"><i class="fas fa-sort-up"></i></button>'; ?>
                        <?php if (isset($_SESSION['id'])) echo '<p class="displayUpvote">'; ?><?php if (isset($_SESSION['id'])) echo $upvote . " </p>"; ?>
                        <?php if (isset($_SESSION['id'])) echo '<button class="btn-downvote"><i class="fas fa-sort-down"></i></button>'; ?>
                    </td>
                    <td class="post">
                        <?php
                        if (isset($_GET['id'])) {
                            $sql = "SELECT * FROM talk_it_out_post WHERE Post_ID = " . $_GET['id'];
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $title = $row['Post_Title'];
                            $content = $row['Post_Content'];
                            $datetime = $row['Post_Date_Time'];
                            $userid = $row['UserID'];

                            $time = date("Y") - substr($datetime, 0, 4);

                            if ($time < 1) {
                                $year = " Less Than 1 year";
                            } else if ($time == 1) {
                                $year = "$time year ago";
                            } else {
                                $year = "$time years ago";
                            }

                            $sql = "SELECT Username FROM users WHERE UserID = " . $userid;
                            $result = mysqli_query($conn, $sql);
                            $username = mysqli_fetch_assoc($result)['Username'];

                            echo "<h4>Posted by $username $year</h4>
                            <h1>$title</h1>
                            <p>$content</p>";
                        } else {
                            echo "<h1>Nothing to Show!</h1>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="mobile-op-post">
            <table class="mobile-table-post">
                <tr>
                    <td class="post" colspan="10">
                        <?php
                        if (isset($_GET['id'])) {
                            echo "<h4>Posted by $username 2 years ago</h4>
                            <h1>$title</h1>
                            <p>$content</p>";
                        } else {
                            echo "<h1>Nothing to Show!</h1>";
                        }
                        ?>
                    </td>
                </tr>
                <tr class="btn-vote">
                    <?php if (isset($_SESSION['id'])) echo '<td class="btn-upvote"><i class="fas fa-sort-up"></i></td>'; ?>
                    <?php if (isset($_SESSION['id'])) echo '<td class="count">'; ?>
                    <?php if (isset($_SESSION['id'])) echo "<p class='displayUpvote'>"; ?><?php if (isset($_SESSION['id'])) echo $upvote . " </p></td>"; ?>
                    <?php if (isset($_SESSION['id'])) echo '<td class="btn-downvote"><i class="fas fa-sort-down"></i></td>'; ?>
                </tr>
            </table>
        </div>

        <div class="comment-section">
            <div class="modal" id="registerModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registration Form</h5>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="userName" class="form-control" placeholder="Your Name">
                            <input type="email" id="userEmail" class="form-control" placeholder="Your Email">
                            <input type="password" id="userPassword" class="form-control" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="registerBtn">Register</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="logInModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Log In Form</h5>
                        </div>
                        <div class="modal-body">
                            <input type="email" id="userLEmail" class="form-control" placeholder="Your Email">
                            <input type="password" id="userLPassword" class="form-control" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="loginBtn">Log In</button>ajax
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top:50px;">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if (isset($_SESSION['id']))
                            echo '<textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>';

                        echo "<input type='hidden' id='postId' value='" . $_GET['id'] . "'>";

                        if (isset($_SESSION['id']))
                            echo '<button style="float:right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Add Comment</button>';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h2><b id="numComments"><?php echo $numComments ?> Comments</b></h2>
                        <div class="userComments">

                        </div>
                    </div>
                </div>
            </div>

            <div class="row replyRow" style="display:none">
                <div class="col-md-12">
                    <textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                    <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
                    <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
                </div>
            </div>

            <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script type="text/javascript">
                var isReply = false,
                    commentID = 0,
                    max = <?php echo $numComments ?>;

                var btnUpvotePressed = true,
                    btnDownvotePressed = true;

                if (isAdmin) {
                    var isAdmin = 1;
                } else {
                    var isAdmin = 0;
                }

                $(document).ready(function() {
                    $("#addComment, #addReply").on('click', function() {
                        var comment;
                        var postId;

                        if (!isReply)
                            comment = $("#mainComment").val();
                        else
                            comment = $("#replyComment").val();

                        postId = $("#postId").val();

                        if (comment.length > 5) {
                            $.ajax({
                                url: 'postdiscussion.php',
                                method: 'POST',
                                dataType: 'text',
                                data: {
                                    addComment: 1,
                                    postId: postId,
                                    comment: comment,
                                    isReply: isReply,
                                    commentID: commentID,
                                    isAdmin: isAdmin
                                },
                                success: function(response) {
                                    max++;
                                    $("#numComments").text(max + " Comments");

                                    if (!isReply) {
                                        $(".userComments").prepend(response);
                                        $("#mainComment").val("");
                                    } else {
                                        commentID = 0;
                                        $("#replyComment").val("");
                                        $(".replyRow").hide();
                                        $('.replyRow').parent().next().append(response);
                                    }
                                }
                            });
                        } else
                            alert('Please Check Your Inputs');
                    });

                    $(".btn-upvote").click(function() {
                        var postId = $("#postId").val();

                        $.ajax({
                            url: 'postdiscussion.php',
                            method: 'POST',
                            dataType: 'text',
                            data: {
                                addUpvote: 1,
                                postId: postId,
                                btnUpvotePressed: btnUpvotePressed,
                            },
                            success: function(response) {
                                $(".displayUpvote").html(response);
                            }
                        });

                    });

                    $(".btn-downvote").click(function() {
                        var postId = $("#postId").val();

                        $.ajax({
                            url: 'postdiscussion.php',
                            method: 'POST',
                            dataType: 'text',
                            data: {
                                addDownvote: 1,
                                postId: postId,
                                btnDownvotePressed: btnDownvotePressed,
                            },
                            success: function(response) {
                                $(".displayUpvote").html(response);
                            }
                        });

                    });
                    getAllComments(0, max);
                });

                function reply(caller) {
                    commentID = $(caller).attr('data-commentID');
                    $(".replyRow").insertAfter($(caller));
                    $('.replyRow').show();
                }

                function getAllComments(start, max) {
                    var id;
                    id = $("#postId").val();

                    if (start > max) {
                        return;
                    }
                    $.ajax({
                        url: 'postdiscussion.php?id=' + id,
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            getAllComments: 1,
                            start: start,
                            isAdmin: isAdmin
                        },
                        success: function(response) {
                            $(".userComments").append(response);
                            getAllComments((start + 20), max);
                        }
                    });
                }
            </script>

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