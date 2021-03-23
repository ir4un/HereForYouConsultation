<?php
if (isset($_POST['validate-submit'])){
    require '../../m_connection/db.con.php';

    $tp = $_POST['tp'];

    if(isset($_POST['student'])){
        $password = $_POST['password'];
        $sql = "SELECT student_password FROM student WHERE student_tp='$tp'";

        $result = mysqli_query($conn2, $sql);

        if(mysqli_num_rows($result) == 1){
            $password_hashed = mysqli_fetch_row($result)[0];
            if(password_verify($password, $password_hashed)){
                session_start();
                $_SESSION['TP'] = $tp;
                $_SESSION['Password'] = $password;
                header("Location: student_registerv2.php?info=validatesuccess");
                exit();
            }else{
                header("Location: student_registerv2.php?error=wrongpassword");
                exit();
            }
        }else{
            header("Location: student_registerv2.php?error=wrongdetails");
            exit();
        }
    }else{
        $name = $_POST['name'];
        $sql = "SELECT staff_name FROM staff WHERE staff_tp='$tp'";

        $result = mysqli_query($conn2, $sql);
        $check_name = mysqli_fetch_row($result)[0];
    
        if(mysqli_num_rows($result) == 1 && $name == $check_name){
            session_start();
            $_SESSION['New_Admin_TP'] = $tp;
            $_SESSION['New_Admin_Name'] = $name;
            header("Location: admin_registerv2.php?info=validatesuccess");
            exit();
        }else{
            header("Location: admin_registerv2.php?error=wrongdetails");
            exit();
        }
    }
    
    mysqli_close($conn);
    mysqli_close($conn2);

}else if (isset($_POST['register-submit'])){
    require '../../m_connection/db.con.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $description = $_POST['description'];

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $roles = $_POST['roles'];
    $age = $_POST['age'];
    $tp = $_POST['tp'];
    if($roles == 'consultor'){
        $services = $_POST['services'];
    }
    if($roles == 'admin' || $roles == 'consultor'){
        $url = "admin_registerv2";
    }else{
        $url = "student_registerv2";
    }

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    if($roles == 'admin'){
        $table = 'admin';
        $table_tp = "AdminTP";
    }else if($roles == 'consultor'){
        $table = 'consultor';
        $table_tp = "ConsultorTP";
    }else{
        $table = 'normal_user';
        $table_tp = "NormalUserTP";
    }

    $sql = "SELECT * FROM normal_user WHERE NormalUserTP = '$tp'";
    $sql2 = "SELECT * FROM consultor WHERE ConsultorTP = '$tp'";
    $sql3 = "SELECT * FROM `admin` WHERE AdminTP = '$tp'";

    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);

    if(mysqli_num_rows($result) > 0 || mysqli_num_rows($result2) > 0 || mysqli_num_rows($result3) > 0){
        header("Location: $url.php?error=alreadyregistered");
        exit();
    }

    $sql = "SELECT * FROM users WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        header("Location: $url.php?error=usernametaken");
        exit();
    }

    $sql = "INSERT INTO users (Username, UserPassword, UserRole, UserEmail) VALUES 
            (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: $url.php?error=sqlerror");
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "ssss", $username, $password_hashed, $roles, $email);
        mysqli_stmt_execute($stmt);        
    }

    $sql = "SELECT UserID FROM users WHERE Username = '$username'";
    $result = mysqli_query($conn, $sql);
    $userid = mysqli_fetch_array($result)[0];
    $default = 0;

    if($roles == 'admin'){
        $sql = "INSERT INTO `admin` (AdminName, UserID, AdminTP, AdminAddress, AdminDescription, AdminAge, 
                AdminPhoneNumber, AdminGender, AdminImgStatus, AdminChillBuds)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: $url.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sisssissii", $name, $userid, $tp, $address, $description, $age, $contact, $gender, $default, $default);
            mysqli_stmt_execute($stmt);        
        }
    }else if($roles == 'consultor'){
        $sql = "INSERT INTO `consultor` (ConsultorName, UserID, ConsultorTP, ConsultorAddress, ConsultorDescription, ConsultorAge, 
                ConsultorPhoneNumber, ConsultorGender, ConsultorImgStatus, ConsultorChillBuds, ConsultorService)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: $url.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sisssissiis", $name, $userid, $tp, $address, $description, $age, $contact, $gender, $default, $default, $services);
            mysqli_stmt_execute($stmt);        
        }
    }else{
        $sql = "INSERT INTO `normal_user` (NormalUserName, UserID, NormalUserTP, NormalUserAddress, NormalUserDescription, NormalUserAge, 
                NormalUserPhoneNumber, NormalUserGender, NormalUserImgStatus, NormalUserChillBuds)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: $url.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sisssissii", $name, $userid, $tp, $address, $description, $age, $contact, $gender, $default, $default);
            mysqli_stmt_execute($stmt);        
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    mysqli_close($conn2);

    header("Location: ../login/login.php?info=registersuccess");
    exit();
}
?>