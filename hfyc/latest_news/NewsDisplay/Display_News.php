<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <?php
  session_start();
  require "db.con.php";
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
  } else {
    $role = "guests";
    $name = "Guest";
    $returnHome = "onclick = \"" . "location.href = '../../home/user/guesthomepage.php'\"";
  }

  if (isset($_POST['btnDelete'])) {
    if ($_POST['isComment']) {
      $sql = "DELETE FROM `latest-news_comments` WHERE ID = " . $_POST['deleteid'];
      if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Comment Successfully Deleted!');
            location.href = document.referrer;
            </script>";
      }
    } else {
      $sql = "DELETE FROM `latest-news_replies` WHERE ID = " . $_POST['deleteid'];
      if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Reply Successfully Deleted!');
            location.href = document.referrer;
            </script>";
      }
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

    $reply_arr[$i] = $conn->query("SELECT `latest-news_replies`.ID, users.Username, Comment, DATE_FORMAT(`latest-news_replies`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `latest-news_replies` INNER JOIN users ON `latest-news_replies`.UserID = users.UserID WHERE `latest-news_replies`.CommentID = '" . $data['ID'] . "'AND News_ID = '" . $postId . "' ORDER BY `latest-news_replies`.ID");
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
    $sql = $conn->query("SELECT `latest-news_comments`.ID, users.Username, `latest-news_comments`.Comment, DATE_FORMAT(`latest-news_comments`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `latest-news_comments` INNER JOIN users ON `latest-news_comments`.UserID = users.UserID WHERE News_ID = '" . $_GET['id'] . "' ORDER BY `latest-news_comments`.ID DESC LIMIT $start, 20");
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
      $conn->query("INSERT INTO `latest-news_replies` (Comment, CommentID, UserID, CreatedOn, News_ID) VALUES ('$comment', '$commentID', '" . $_SESSION['id'] . "', NOW(), " . $_POST['postId'] . ")");
      $sql = $conn->query("SELECT `latest-news_replies`.ID, users.Username, Comment, DATE_FORMAT(`latest-news_replies`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `latest-news_replies` INNER JOIN users ON `latest-news_replies`.UserID = users.UserID WHERE News_ID = '" . $_POST['postId'] . "' ORDER BY `latest-news_replies`.ID DESC LIMIT 1");
      $isComment = 0;
    } else {
      $conn->query("INSERT INTO `latest-news_comments` (UserID, Comment, CreatedOn, News_ID) VALUES ('" . $_SESSION['id'] . "','$comment',NOW(), " . $_POST['postId'] . ")");
      $sql = $conn->query("SELECT `latest-news_comments`.ID, users.Username, Comment, DATE_FORMAT(`latest-news_comments`.CreatedOn, '%Y-%m-%d') AS CreatedOn FROM `latest-news_comments` INNER JOIN users ON `latest-news_comments`.UserID = users.UserID WHERE News_ID = '" . $_POST['postId'] . "' ORDER BY `latest-news_comments`.ID DESC LIMIT 1");
      $isComment = 1;
    }

    $data = $sql->fetch_assoc();
    exit(createCommentRow($data));
  }

  $sqlNumComments = $conn->query("SELECT ID FROM `latest-news_comments` WHERE News_ID = " . $_GET['NewsID']);
  $numComments = $sqlNumComments->num_rows;

  $row = ($conn->query("SELECT NewsTitle FROM news_data WHERE NewsID = " . $_GET['NewsID']))->fetch_assoc();

  ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['NewsTitle'] ?></title>
  <link rel="stylesheet" href="News.css">
  <link rel="icon" href="HFYCIcon.png">
  <!--<link rel="stylesheet" href="../sidebartemplate.css">-->
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
    <div class="card">
      <div class="mainlist">
        <?php

        require "db.con.php";
        $sql = 'SELECT * FROM news_data WHERE NewsID LIKE ' . $_GET["NewsID"] . ';';
        $result = mysqli_query($conn, $sql);
        $resultrows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $sql = "SELECT AdminName FROM `admin` WHERE AdminID = '" . $row['AdminID'] . "'";
        $name = mysqli_fetch_assoc(mysqli_query($conn, $sql))['AdminName'];

        if (file_exists('../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.jpg')) {
          echo '<div class="thumbnail"><img src="../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.jpg" class="news_thumb" alt="news_thumb">';
        } else if (file_exists('../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.png')) {
          echo '<div class="thumbnail"><img src="../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.png" class="news_thumb" alt="news_thumb">';
        } else if (file_exists('../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.jpeg')) {
          echo '<div class="thumbnail"><img src="../Uploaded_Files/newsthumb' . $_GET['NewsID'] . '.jpeg" class="news_thumb" alt="news_thumb">';
        } else {
        }
        echo '<div class="newstitle"><h1>' . $row['NewsTitle'] . '</h1></div>';

        echo '<div class="detail"><b>Written By ' . $name . '</b></div>';

        echo '<div class="postdate"><b>Posted on ' . $row['NewsDate'] . '</b></div>';

        echo '<div class="info">' . $row['NewsContent'] . '</div>';

        ?>

      </div>
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

            echo "<input type='hidden' id='postId' value='" . $_GET['NewsID'] . "'>";

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
                url: 'Display_News.php',
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
            url: 'Display_News.php?id=' + id,
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

<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

</html>