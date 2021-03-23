<?php
if($role == 'student'){
    echo '
    <a href="/SDP/hfyc/home/user/userhomepage.php"><i class="fa fa-home"></i><span>Home</span></a>
    <a href="/SDP/hfyc/latest_news/NewsList/newslist.php"><i class="far fa-newspaper"></i><span>Latest News</span></a>
    <a href="/SDP/hfyc/consultation/FP_Selection/consultation_selectionv2.php"><i class="fa fa-book"></i><span>Book Consultation</span></a>
    <a href="/SDP/hfyc/consultation/CheckConsultation/checkconsultation.php"><i class="fa fa-history"></i><span>Consultation History</span></a>
    <a href="/SDP/hfyc/consultation/Consultation_Feedback/feedbackv2.php"><i class="fa fa-comments"></i></i><span>Consultation Feedback</span></a>
    <a href="/SDP/hfyc/chillbuds/chillbudscontentv2.php"><i class="fas fa-user-friends"></i><span>Chillbuds</span></a>
    <a href="/SDP/hfyc/talk-it-out/postCreate/createpost.php"><i class="far fa-edit"></i><span>Create Talk-It-Out Post</span></a>
    <a href="/SDP/hfyc/talk-it-out/postList/postlist.php"><i class="fa fa-bullhorn"></i><span>Talk-It-Out</span></a>
    <a href="/SDP/hfyc/others/terms/terms.php"><i class="fas fa-paper-plane"></i><span>Terms and Condition</span></a>
    <a href="/SDP/hfyc/others/privacy/privacy.php"><i class="fa fa-user-secret"></i><span>Privacy Policy</span></a>
    <a href="/SDP/hfyc/others/about/about.php"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    <a href="#" style="visibility:hidden;"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    ';

}else if ($role == 'admin'){
    echo '
    <a href="/SDP/hfyc/home/admin/adminpage.php"><i class="fa fa-home"></i><span>Home</span></a>
    <a href="/SDP/hfyc/latest_news/NewsInsert/Insert_News.php"><i class="fa fa-plus-circle"></i><span>Insert Latest News</span></a>
    <a href="/SDP/hfyc/latest_news/NewsList/newslist.php"><i class="far fa-newspaper"></i><span>Latest News</span></a>
    <a href="/SDP/hfyc/logsignsys/signup/admin_registerv2.php"><i class="fas fa-user-tie"></i></i><span>Register Admin</span></a>
    <a href="/SDP/hfyc/logsignsys/signup/admin_registerv2.php"><i class="fas fa-user-nurse"></i><span>Register Consultor</span></a>
    <a href="/SDP/hfyc/chillbuds/chillbudscontentv2.php"><i class="fas fa-user-friends"></i><span>Chillbuds</span></a>
    <a href="/SDP/hfyc/talk-it-out/postCreate/createpost.php"><i class="far fa-edit"></i><span>Create Talk-It-Out Post</span></a>
    <a href="/SDP/hfyc/talk-it-out/postList/postlist.php"><i class="fa fa-bullhorn"></i><span>Talk-It-Out</span></a>
    <a href="/SDP/hfyc/others/terms/terms.php"><i class="fas fa-paper-plane"></i><span>Terms and Condition</span></a>
    <a href="/SDP/hfyc/others/privacy/privacy.php"><i class="fa fa-user-secret"></i><span>Privacy Policy</span></a>
    <a href="/SDP/hfyc/others/about/about.php"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    <a href="#" style="visibility:hidden;"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    ';


}else if($role == 'consultor'){
    echo '
    <a href="/SDP/hfyc/home/consultor/consultorpage.php"><i class="fa fa-home"></i><span>Home</span></a>
    <a href="/SDP/hfyc/latest_news/NewsList/newslist.php"><i class="far fa-newspaper"></i><span>Latest News</span></a>
    <a href="/SDP/hfyc/consultation/Settings_TimeSlot/consultv2.php"><i class="fa fa-book"></i><span>Set Timeslot</span></a>
    <a href="/SDP/hfyc/consultation/CheckAppointment/checkappointmentv2.php"><i class="fa fa-history"></i><span>Consultation History</span></a>
    <a href="/SDP/hfyc/chillbuds/chillbudscontentv2.php"><i class="fas fa-user-friends"></i><span>Chillbuds</span></a>
    <a href="/SDP/hfyc/talk-it-out/postCreate/createpost.php"><i class="far fa-edit"></i><span>Create Talk-It-Out Post</span></a>
    <a href="/SDP/hfyc/talk-it-out/postList/postlist.php"><i class="fa fa-bullhorn"></i><span>Talk-It-Out</span></a>
    <a href="/SDP/hfyc/others/terms/terms.php"><i class="fas fa-paper-plane"></i><span>Terms and Condition</span></a>
    <a href="/SDP/hfyc/others/privacy/privacy.php"><i class="fa fa-user-secret"></i><span>Privacy Policy</span></a>
    <a href="/SDP/hfyc/others/about/about.php"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    <a href="#" style="visibility:hidden;"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    ';

}else{
    echo '
    <a href="/SDP/hfyc/home/user/guesthomepage.php"><i class="fa fa-home"></i><span>Home</span></a>
    <a href="/SDP/hfyc/latest_news/NewsList/newslist.php"><i class="far fa-newspaper"></i><span>Latest News</span></a>
    <a href="/SDP/hfyc/logsignsys/login/login.php"><i class="fa fa-book"></i><span>Book Consultation</span></a>
    <a href="/SDP/hfyc/logsignsys/login/login.php"><i class="fas fa-user-friends"></i><span>Chillbuds</span></a>
    <a href="/SDP/hfyc/talk-it-out/postList/postlist.php"><i class="fa fa-bullhorn"></i><span>Talk-It-Out</span></a>
    <a href="/SDP/hfyc/others/terms/terms.php"><i class="fas fa-paper-plane"></i><span>Terms and Condition</span></a>
    <a href="/SDP/hfyc/others/privacy/privacy.php"><i class="fa fa-user-secret"></i><span>Privacy Policy</span></a>
    <a href="/SDP/hfyc/others/about/about.php"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    <a href="#" style="visibility:hidden;"><i class="fas fa-info-circle"></i><span>About Us</span></a>
    ';
}
