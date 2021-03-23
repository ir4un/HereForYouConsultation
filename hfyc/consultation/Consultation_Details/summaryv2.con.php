<?php
session_start();
if(isset($_GET['status']) && $_GET['status'] == 'confirm'){
    if(isset($_SESSION['id'])){
        $dBServername = "localhost";
        $dBUsername = "root";
        $dBPassword = "";
        $dBName = "hfyc_apu";
    
        // Create connection
        $conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);
    
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }


        $consultorid = $_SESSION['setConsultorid'];
        $date = $_SESSION['setDate'];
        $start = $_SESSION['setStarttime'];
        $end = $_SESSION['setEndtime'];
        $type = $_SESSION['setConsultType'];
        
        $userid = $_SESSION['id'];

        $sql = "INSERT INTO consultation_info (`ConsultorID`, `ConsultDate`, `ConsultStartTime`, `ConsultEndTime`, `ConsultType`, `UserID`, `ConsultationSessionID`) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: summaryv2.php?error=sqlError");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssssii", $_SESSION['setConsultorid'], $_SESSION['setDate'], $_SESSION['setStarttime'], $_SESSION['setEndtime'], $_SESSION['setConsultType'], $userid, $_SESSION['setConsultationid']);
            mysqli_stmt_execute($stmt);

            $sql = "UPDATE consultor_consultation SET SlotStatus = 'Ongoing' WHERE Consultor_ID = '$consultorid' AND Start_Time = '$start' AND End_Time = '$end'";
            if(!mysqli_query($conn, $sql)){
                header("Location: summaryv2.php?error=sqlError");
                exit();
            }

            header("Location: ../../home/user/userhomepage.php?book=success");
            exit();
        }

    }


}

?>