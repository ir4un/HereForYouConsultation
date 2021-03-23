<?php
if(isset($_POST['logout-submit'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: /SDP/hfyc/home/user/guesthomepage.php?logout=success");
}