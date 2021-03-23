<?php
if (isset($_POST['login-submit'])) {
    
    require '../../m_connection/db.con.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['roles'];

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=emptyfields&username=".$username);
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE Username=?"; 

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: login/login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
            
                $roleCheck = ($role === $row['UserRole']);
                $pwdCheck = password_verify($password, $row['UserPassword']);

                if ($pwdCheck == false || $roleCheck == false) {
                    header("Location: login.php?errorpr=wrongpassword&role_username=".$username);
                    exit();
                }
                else if ($pwdCheck == true && $roleCheck == true) {

                    session_start();

                    $_SESSION['id'] = $row['UserID'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['position'] = $row['UserRole']; 

                    if($role == "admin"){
                        header("Location: ../../home/admin/adminpage.php?login=success");
                        exit();
                    }else if($role == "consultor"){
                        header("Location: ../../home/consultor/consultorpage.php?login=success");
                        exit();
                    }else if($role == "student"){
                        header("Location: ../../home/user/userhomepage.php?login=success");
                        exit();
                    }
                }
            }
            else {
                header("Location: login.php?errorup=wrongusername&password");
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("location: login/login.php");
    exit();
}