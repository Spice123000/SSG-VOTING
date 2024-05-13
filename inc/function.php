<?php 
    // START ALL SESSION
    session_start();
    // DB CONNECTION
    class Connection{
        public $host = "localhost";
        public $user = "root";
        public $password = "";
        public $db_name = "ssg_e_voting";
        public $conn;

        public function __construct(){
            $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        }
    }

    

    // OTHER OPERATIONS HERE!!!
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y');
    // SET DATA TO YEAR
    if (isset($_GET['year_of'])) {
        $date = $_GET['year_of'];
    }else {
        $date = date('Y');
    }

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // RANDOM PASS
    $randomPass = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYX", 5)), 0, 10);
    // VOTERS REFERENCE ID -- RANDOM
    $reference_id = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 11);

    // PASSWORD HASH
    $hashed = password_hash($randomPass, PASSWORD_DEFAULT);

    // UPLOAD FILE
    @$oldProfile = $_POST['oldProfile'];
    @$file_name = $_FILES['newProfile']['name'];
    if ($file_name != '') {
        move_uploaded_file($_FILES['newProfile']['tmp_name'],'../img/profiles/'.$file_name);
    }else {
        $file_name = $oldProfile;
    }

    // UPLOAD  SYSTEM LOGO's 
    @$oldSCSIT = $_POST['oldSCSIT'];
    @$oldSSG = $_POST['oldSSG'];
    @$oldCOMELEC = $_POST['oldCOMELEC'];

    @$scsit = $_FILES['scsit']['name'];
    @$ssg = $_FILES['ssg']['name'];
    @$comelec = $_FILES['comelec']['name'];

    if ($scsit != '') {
        move_uploaded_file($_FILES['scsit']['tmp_name'],'../img/logo/'.$scsit);
    }else {
        $scsit = $oldSCSIT;
    }
    if ($ssg != '') {
        move_uploaded_file($_FILES['ssg']['tmp_name'],'../img/logo/'.$ssg);
    }else {
        $ssg = $oldSSG;
    }
    if ($comelec != '') {
        move_uploaded_file($_FILES['comelec']['tmp_name'],'../img/logo/'.$comelec);
    }else {
        $comelec = $oldCOMELEC;
    }

    $msgAlert = "";
    $msgSetAlert = "";
    // OTHER OPERATIONS ENDS HERE!!!

    // CLASS START !!!
    // CLASS DATAOPERATION EXTEND TO DB !!!
    class dataOperation extends Connection{

        // AUTOMATICALLY INSERT NEW YEAR
        public function addYear($currentDate){
            $insertNewDate = mysqli_query($this->conn, "SELECT * FROM year_of_data WHERE year='$currentDate'");
            if (mysqli_num_rows($insertNewDate) > 0) {
                // BLANK
            }else {
                $query = "INSERT INTO year_of_data (year) VALUES ('$currentDate')";
                mysqli_query($this->conn, $query);
            }
        }

        public function countDown(){
            $timer = mysqli_query($this->conn, "SELECT * FROM voting_date_time");
            $array = array();
            $row = mysqli_fetch_assoc($timer);
            $array[] = $row;
            return $array;
        }

        // ADMIN SIDE ALERT !!!
        public function alert($msg, $bg, $icon){
            $msgAlert = "
            <span class='badge bg-$bg text-center text-light rounded p-2 mb-2' id='hideThis'>
            <i class='align-middle' data-feather='$icon'></i>   
                $msg!
            </span>
            <script>
                function hideThis(){
                    document.getElementById('hideThis').style.visibility='hidden';
                    document.getElementById('hideThis').style.marginTop='-40px';
                    document.getElementById('hideThis').style.transition = 'all 0.3s';
                } 
                setTimeout(hideThis, 3000);
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>
            ";
              return $msgAlert;
        }


        // VOTER SIDE ALERT !!!
        public function voterAlert($msg, $bg, $icon){
            $msgAlert = "
            <p class='bg-$bg text-center text-light rounded p-2' style='width: 300px;' id='hideThis'>
            <i class='$icon'></i>
                $msg!
            </p>
            <script>
                function hideThis(){
                    document.getElementById('hideThis').style.visibility='hidden';
                    document.getElementById('hideThis').style.marginTop='-55px';
                    document.getElementById('hideThis').style.transition = 'all 0.3s';
                } 
                setTimeout(hideThis, 3000);
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>
            ";
              return $msgAlert;
        }

        // SET COUNTDOWN TIMER ALERT !!!
        public function alertSet($msg, $bg, $icon){
            $msgSetAlert = "
            <span class='badge bg-$bg text-center text-light rounded p-2 mb-2' id='hideThis'>
            <i class='align-middle' data-feather='$icon'></i>   
                $msg!
            </span>
            <script>
                function hideThis(){
                    document.getElementById('hideThis').style.visibility='hidden';
                    document.getElementById('hideThis').style.marginTop='-40px';
                    document.getElementById('hideThis').style.transition = 'all 0.3s';
                } 
                setTimeout(hideThis, 3000);
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script>
            ";
              return $msgSetAlert;
        }


        // ADMIN LOGIN PROCESS HERE!!!
        public function loginAdmin($username, $password){
            $sql = mysqli_query($this->conn, "SELECT * FROM admin WHERE username='$username'");
            $row = mysqli_fetch_assoc($sql);
            if (mysqli_num_rows($sql) > 0) {
                $hashed_password = $row['password'];
                if (!password_verify($password, $hashed_password)) {
                    return 20;
                }else {
                    $this->id = $row['id'];
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $this->id;
                    return 1;
                }
            }else{
                return 10;
            }
        }

        // COMELEC LOGIN PROCESS HERE!!!
        public function loginComelec($email, $password){
            $sql = mysqli_query($this->conn, "SELECT * FROM comelec WHERE email='$email'");
            $row = mysqli_fetch_assoc($sql);
            if (mysqli_num_rows($sql) > 0) {
                $hashed_password = $row['password'];
                if (!password_verify($password, $hashed_password)) {
                    return 20;
                }else {
                    $this->id = $row['id'];
                    $_SESSION['login'] = true;
                    $_SESSION['id'] = $this->id;
                    return 1;
                }
            }else{
                return 10;
            }
        }

        // REQUEST NEW PASSWORD
        public function sendPassword($email, $randomPass){
            $sql = mysqli_query($this->conn, "SELECT * FROM comelec WHERE email='$email'");
            $row = mysqli_fetch_assoc($sql);
            if (mysqli_num_rows($sql) > 0) {
                $hashedNewPass = password_hash($randomPass, PASSWORD_DEFAULT);
                $reset = "UPDATE comelec SET password = '$hashedNewPass' WHERE email='$email'";
                mysqli_query($this->conn, $reset);
                // PHPMailer Files
                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'ssgelection2024@gmail.com';            //SMTP username
                    $mail->Password   = 'dmlslhaddcqwwxen';                     //SMTP password
                    $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    //Recipients
                    $mail->setFrom('ssgelection2024@gmail.com');
                    $mail->addAddress($email);                                  //Add a recipient
                    //Content
                    $mail->isHTML(true);                                        //Set email format to HTML
                    $mail->Subject = 'SCSIT SSG ELECTION / REQUEST NEW PASSWORD';
                    $mail->Body    =  'Your new password is <b>'. $randomPass .'</b>';
                    $mail->send();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                return 1;
            }else{
                return 10;
            }
        }
       

        // ADMIN RESET PASSWORD PROCESS!!!
        public function changePass($pass, $newPass, $confirmPass){
            $selectPass = mysqli_query($this->conn, "SELECT * FROM admin WHERE username = 'administrator'");
            $row = mysqli_fetch_array($selectPass, MYSQLI_ASSOC);
            $hashed_password = $row['password'];
            if (!password_verify($pass, $hashed_password)) {
                return 10;
            }
            elseif ($newPass != $confirmPass) {
               return 20;
            }
            elseif ($pass == $newPass) {
                return 30;
            }
            else{
                $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);
                $reset = "UPDATE admin SET password = '$hashedNewPass'";
                mysqli_query($this->conn, $reset);
                return 1;
            }
                
           
        }

        // COMELEC RESET PASSWORD PROCESS!!!
        public function changeComPass($pass, $newPass, $confirmPass, $id){
            $selectPass = mysqli_query($this->conn, "SELECT * FROM comelec WHERE id = '$id'");
            $row = mysqli_fetch_array($selectPass, MYSQLI_ASSOC);
            $hashed_password = $row['password'];
            if (!password_verify($pass, $hashed_password)) {
                return 10;
            }
            elseif ($newPass != $confirmPass) {
               return 20;
            }
            elseif ($pass == $newPass) {
                return 30;
            }
            else{
                $hashedNewPass = password_hash($newPass, PASSWORD_DEFAULT);
                $reset = "UPDATE comelec SET password = '$hashedNewPass' WHERE id = '$id'";
                mysqli_query($this->conn, $reset);
                return 1;
            }
                
           
        }

        // VALIDATING ACCESS CODE
        public function verifyAC($access_code, $voter_id, $currentDate){
            $validate = mysqli_query($this->conn, "SELECT * FROM students_access_code WHERE access_code='$access_code' AND year_inserted='$currentDate'");
            $v_row = mysqli_fetch_assoc($validate);
            if (mysqli_num_rows($validate) > 0) {
                $access = $v_row['access_code'];
                $try = mysqli_query($this->conn, "SELECT * FROM students_access_code WHERE access_code='$access' AND status = 'Used' AND year_inserted='$currentDate'");
                if (mysqli_num_rows($try) > 0) {
                    return 10;
                }else{
                    $set_time = mysqli_query($this->conn, "SELECT * FROM voting_date_time WHERE id = 1 ");
                    $t_row = mysqli_fetch_assoc($set_time);
                    $_SESSION['duration'] = $t_row['time'];
                    $_SESSION['start_time'] = date('Y-m-d H:i:s');
                    $end_time = date('Y-m-d H:i:s', strtotime('+'.$_SESSION['duration'].'minutes', strtotime($_SESSION['start_time'])));
                    $_SESSION['end_time'] = $end_time;

                    $update = mysqli_query($this->conn, "UPDATE students_access_code SET status = 'Used', used_by='$voter_id' WHERE access_code='$access' AND year_inserted='$currentDate'");
                    $_SESSION['access_code'] = $v_row['access_code'];
                    
                    return 1;
                }
            }else{
                return 20;
            }
        }

        // DISPLAY STARTS HERE!!!

        // DISPLAY VOTING SETTINGS
        public function displayTimer(){
            $sql = mysqli_query($this->conn, "SELECT * FROM voting_date_time WHERE id = 1 ");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY COMELECS
        public function displayCom($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM comelec WHERE year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY toUpdate COMELEC
        public function toUpdateCom($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM comelec WHERE id ='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

      
        // DISPLAY DEPARTMENTS
        public function displayDept($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM departments WHERE year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY VOTE COUNT BY DEPARTMENT 1ST YEAR
        public function displayVoteDeptCount1st($dept ,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS dept_cnt FROM student INNER JOIN votes ON student.student_id = votes.voted_by WHERE student.department = '$dept' AND student.year_level = '1st' AND votes.year = '$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

         // DISPLAY VOTE COUNT BY DEPARTMENT 2ND YEAR
         public function displayVoteDeptCount2nd($dept ,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS dept_cnt FROM student INNER JOIN votes ON student.student_id = votes.voted_by WHERE student.department = '$dept' AND student.year_level = '2nd' AND votes.year = '$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY VOTE COUNT BY DEPARTMENT 3RD YEAR
        public function displayVoteDeptCount3rd($dept ,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS dept_cnt FROM student INNER JOIN votes ON student.student_id = votes.voted_by WHERE student.department = '$dept' AND student.year_level = '3rd' AND votes.year = '$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY VOTE COUNT BY DEPARTMENT 4TH YEAR
        public function displayVoteDeptCount4th($dept ,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS dept_cnt FROM student INNER JOIN votes ON student.student_id = votes.voted_by WHERE student.department = '$dept' AND student.year_level = '4th' AND votes.year = '$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY toUpdate DEPARTMENT
        public function toUpdateDept($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM departments WHERE id ='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LISTS
        public function displayPL($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM party_list WHERE year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }    

        // DISPLAY toUpdate PARTY LIST
        public function toUpdatePL($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM party_list WHERE id ='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY CANDIDATE BY POSITION FOR CANDIDATE VOTES TABLE
        public function displayCanByPos($pos, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='$pos' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }   
        
        // DISPLAY CANDIDATE VOTES
        public function displayCanVotes($id, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN student ON votes.voted_by=student.student_id WHERE president='$id' OR external_vp='$id' OR internal_vp='$id' OR general_sec='$id' OR executive_sec='$id' OR auditor='$id' OR budgetary='$id' OR social_wo='$id' OR senator='$id' AND year='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY CANDIDATE BY ID FOR CANDIDATE VOTES TABLE
        public function displayCanById($id, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$id' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }   
 
        // DISPLAY POSITIONS
        public function displayPos($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM positions WHERE year_inserted='$date' ORDER BY id ASC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }    

        // DISPLAY toUpdate POSITION
        public function toUpdatePos($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM positions WHERE id ='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY CANDIDATES
        public function displayCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY toUpdate CANDIDATE
        public function toUpdateCan($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id ='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY RANKING PRESIDENT VOTE COUNT
        public function displayVoteCntPres($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_pres_cnt FROM votes INNER JOIN candidates ON votes.president = candidates.id WHERE votes.president = '$c_id' AND votes.year='$date' GROUP BY votes.president ORDER BY rank_pres_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING PRESIDENT DETAILS VOTE COUNT DESC
        public function displayVotePresDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.president WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.president ORDER BY COUNT(votes.president) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING PRESIDENT DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVotePresLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.president WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.president ORDER BY COUNT(votes.president) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING PRESIDENT VOTE COUNT FOR LEADING
        public function displayVoteCntPresLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_pres_cnt FROM votes INNER JOIN candidates ON votes.president = candidates.id WHERE votes.president = '$c_id' AND votes.year='$date' GROUP BY votes.president ORDER BY rank_pres_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

         // DISPLAY RANKING EXTERNAL VICE PRESIDENT VOTE COUNT
         public function displayVoteCntEvp($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_evp_cnt FROM votes INNER JOIN candidates ON votes.external_vp = candidates.id WHERE votes.external_vp = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.external_vp ORDER BY rank_evp_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING EXTERNAL VICE PRESIDENT DETAILS VOTE COUNT DESC
        public function displayVoteEvpDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.external_vp WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.external_vp ORDER BY COUNT(votes.external_vp) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING EXTERNAL VICE PRESIDENT DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteEvpLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.external_vp WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.external_vp ORDER BY COUNT(votes.external_vp) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING EXTERNAL VICE PRESIDENT VOTE COUNT FOR LEADING
        public function displayVoteCntEvpLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_evp_cnt FROM votes INNER JOIN candidates ON votes.external_vp = candidates.id WHERE votes.external_vp = '$c_id' AND votes.year='$date' GROUP BY votes.external_vp ORDER BY rank_evp_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING INTERNAL VICE PRESIDENT VOTE COUNT
        public function displayVoteCntIvp($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_ivp_cnt FROM votes INNER JOIN candidates ON votes.internal_vp = candidates.id WHERE votes.internal_vp = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.internal_vp ORDER BY rank_ivp_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING INTERNAL VICE PRESIDENT DETAILS VOTE COUNT DESC
        public function displayVoteIvpDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.internal_vp WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.internal_vp ORDER BY COUNT(votes.internal_vp) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING INTERNAL VICE PRESIDENT DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteIvpLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.internal_vp WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.internal_vp ORDER BY COUNT(votes.internal_vp) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING INTERNAL VICE PRESIDENT VOTE COUNT FOR LEADING
        public function displayVoteCntIvpLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_ivp_cnt FROM votes INNER JOIN candidates ON votes.internal_vp = candidates.id WHERE votes.internal_vp = '$c_id' AND votes.year='$date' GROUP BY votes.internal_vp ORDER BY rank_ivp_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING GENERAL SECRETARY VOTE COUNT
        public function displayVoteCntGsec($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_gen_cnt FROM votes INNER JOIN candidates ON votes.general_sec = candidates.id WHERE votes.general_sec = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.general_sec ORDER BY rank_gen_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING GENERAL SECRETARY DETAILS VOTE COUNT DESC
        public function displayVoteGsecDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.general_sec WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.general_sec ORDER BY COUNT(votes.general_sec) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING GENERAL SECRETARY DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteGsecLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.general_sec WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.general_sec ORDER BY COUNT(votes.general_sec) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING GENERAL SECRETARY VOTE COUNT FOR LEADING
        public function displayVoteCntGsecLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_gsec_cnt FROM votes INNER JOIN candidates ON votes.general_sec = candidates.id WHERE votes.general_sec = '$c_id' AND votes.year='$date' GROUP BY votes.general_sec ORDER BY rank_gsec_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING EXECUTIVE SECRETARY VOTE COUNT
        public function displayVoteCntEsec($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_esec_cnt FROM votes INNER JOIN candidates ON votes.executive_sec = candidates.id WHERE votes.executive_sec = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.executive_sec ORDER BY rank_esec_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING EXECUTIVE SECRETARY DETAILS VOTE COUNT DESC
        public function displayVoteEsecDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.executive_sec WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.executive_sec ORDER BY COUNT(votes.executive_sec) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING EXECUTIVE SECRETARY DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteEsecLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.executive_sec WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.executive_sec ORDER BY COUNT(votes.executive_sec) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING EXECUTIVE SECRETARY VOTE COUNT FOR LEADING
        public function displayVoteCntEsecLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_esec_cnt FROM votes INNER JOIN candidates ON votes.executive_sec = candidates.id WHERE votes.executive_sec = '$c_id' AND votes.year='$date' GROUP BY votes.executive_sec ORDER BY rank_esec_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }


        // DISPLAY RANKING AUDITOR VOTE COUNT
        public function displayVoteCntAud($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_aud_cnt FROM votes INNER JOIN candidates ON votes.auditor = candidates.id WHERE votes.auditor = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.auditor ORDER BY rank_aud_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING AUDITOR DETAILS VOTE COUNT DESC
        public function displayVoteAudDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.auditor WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.auditor ORDER BY COUNT(votes.auditor) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING AUDITOR DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteAudLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.auditor WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.auditor ORDER BY COUNT(votes.auditor) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING AUDITOR VOTE COUNT FOR LEADING
        public function displayVoteCntAudLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_aud_cnt FROM votes INNER JOIN candidates ON votes.auditor = candidates.id WHERE votes.auditor = '$c_id' AND votes.year='$date' GROUP BY votes.auditor ORDER BY rank_aud_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING BUDGETARY VOTE COUNT
        public function displayVoteCntBudg($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_budg_cnt FROM votes INNER JOIN candidates ON votes.budgetary = candidates.id WHERE votes.budgetary = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.budgetary ORDER BY rank_budg_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING BUDGETARY DETAILS VOTE COUNT DESC
        public function displayVoteBudgDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.budgetary WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.budgetary ORDER BY COUNT(votes.budgetary) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING BUDGETARY DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteBudgLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.budgetary WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.budgetary ORDER BY COUNT(votes.budgetary) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING BUDGETARY VOTE COUNT FOR LEADING
        public function displayVoteCntBudgLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_budg_cnt FROM votes INNER JOIN candidates ON votes.budgetary = candidates.id WHERE votes.budgetary = '$c_id' AND votes.year='$date' GROUP BY votes.budgetary ORDER BY rank_budg_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING SOCIAL WELFARE OFFICER VOTE COUNT
        public function displayVoteCntSwo($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_swo_cnt FROM votes INNER JOIN candidates ON votes.social_wo = candidates.id WHERE votes.social_wo = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.social_wo ORDER BY rank_swo_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING SOCIAL WELFARE OFFICER DETAILS VOTE COUNT DESC
        public function displayVoteSwoDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.social_wo WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.social_wo ORDER BY COUNT(votes.social_wo) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING SOCIAL WELFARE OFFICER DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteSwoLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.social_wo WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.social_wo ORDER BY COUNT(votes.social_wo) DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING SOCIAL WELFARE OFFICER VOTE COUNT FOR LEADING
        public function displayVoteCntSwoLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_swo_cnt FROM votes INNER JOIN candidates ON votes.social_wo = candidates.id WHERE votes.social_wo = '$c_id' AND votes.year='$date' GROUP BY votes.social_wo ORDER BY rank_swo_cnt DESC LIMIT 1");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING SENATOR VOTE COUNT
        public function displayVoteCntSen($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_sen_cnt FROM votes INNER JOIN candidates ON votes.senator = candidates.id WHERE votes.senator = '$c_id' AND votes.year='$date' AND candidates.year_inserted = '$date' GROUP BY votes.senator ORDER BY rank_sen_cnt DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        

        // DISPLAY RANKING SENATOR DETAILS VOTE COUNT DESC
        public function displayVoteSenDesc($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.senator WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.senator ORDER BY COUNT(votes.senator) DESC");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY RANKING SENATORS DETAILS VOTE COUNT DESC FOR LEADING
        public function displayVoteSenLead($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates INNER JOIN votes ON candidates.id = votes.senator WHERE candidates.year_inserted='$date' AND votes.year='$date' GROUP BY votes.senator ORDER BY COUNT(votes.senator) DESC LIMIT 10");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY RANKING SENATORS VOTE COUNT FOR LEADING
        public function displayVoteCntSenLead($c_id,$date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS rank_sen_cnt FROM votes INNER JOIN candidates ON votes.senator = candidates.id WHERE votes.senator = '$c_id' AND votes.year='$date' GROUP BY votes.senator ORDER BY rank_sen_cnt DESC LIMIT 10");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY CANDIDATES BY POSITION AND VOTE COUNT DESC FOR RANKING
        public function displayCanDetsRanking($pos ,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='$pos' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }
        
        // DISPLAY CANDIDATES BY POSITION AND VOTE COUNT DESC FOR RANKING
        public function displayCanCntVotesRanking($id ,$date){
            $select = mysqli_query($this->conn, "SELECT COUNT(*) AS all_can_votes FROM votes WHERE president='$id' OR external_vp='$id' OR internal_vp='$id' OR general_sec='$id' OR executive_sec='$id' OR auditor='$id' OR budgetary='$id' OR social_wo='$id' OR senator='$id'");
            $array = array();
            while($row = mysqli_fetch_assoc($select)){
                $array[] = $row;
            }
            return $array;
        }


        // DISPLAY COUNTS HERE!!!

        // DISPLAY COUNT OF CANDIDATE
        public function displayCanCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_candidates FROM candidates WHERE year_inserted='$date'");
            $array = array();
            $cnt = mysqli_fetch_assoc($sql);
            $array[] = $cnt;
            
            return $array;
        }

        // DISPLAY COUNT OF PARTY LIST
        public function displayPLCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_pl FROM party_list WHERE year_inserted='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            
            return $array;
        }    

        // DISPLAY COUNT OF DEPARTMENT
        public function displayDeptCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_dept FROM departments WHERE year_inserted='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            return $array;
        }    

        // DISPLAY COUNT OF POSITION
        public function displayPosCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_pos FROM positions WHERE year_inserted='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            return $array;
        }    

        // DISPLAY COUNT OF COMELEC
        public function displayComCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_comelec FROM comelec WHERE year_inserted='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            return $array;
        }    

        // DISPLAY COUNT OF INDEPENDENT
        public function displayIndCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_independent FROM candidates WHERE party_list = 'Independent' AND year_inserted='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            return $array;
        }

        // DISPLAY COUNT OF OVER ALL VOTES
        public function displayVoteCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_votes FROM votes WHERE year='$date'");
            $array = array();
           $cnt = mysqli_fetch_assoc($sql);
                $array[] = $cnt;
            return $array;
        }

        // DISPLAY COUNT OF OVER ALL STUDENTS
        public function displayStudentCnt($date){
            $sql = mysqli_query($this->conn, "SELECT COUNT(*) AS total_students FROM student");
            $array = array();
            $cnt = mysqli_fetch_assoc($sql);
            $array[] = $cnt;
            return $array;
        }

        // DISPLAY COUNTS ENDS HERE!!!

        // DISPLAY ACCESS CODE
        public function displayAC($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM students_access_code WHERE year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY SYSTEM SETTING
        public function displaySystem(){
            $sql = mysqli_query($this->conn, "SELECT * FROM system_settings");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY POSITION CANDIDATES
        public function displayPosCan($pos, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='$pos' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 
        
        // DISPLAY PARTY LIST PRESIDENT
        public function displayPLPres($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='President' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST INTERNAL VICE PRESIDENT
        public function displayPLIVP($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Internal Vice President' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST EXTERNAL VICE PRESIDENT
        public function displayPLEVP($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='External Vice President' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST GENERAL SECRETARY
        public function displayPLGS($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='General Secretary' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST EXECUTIVE SECRETARY
        public function displayPLES($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Executive Secretary' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST AUDITOR
        public function displayPLAU($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Auditor' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST BUDGETARY
        public function displayPLBU($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Budgetary' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST SOCIAL WELFARE OFFICER
        public function displayPLSWO($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Social Welfare Officer' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY PARTY LIST SENATORS
        public function displayPLSEN($pl, $date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Senator' AND party_list='$pl' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY PARTY LIST SENATORS
        public function displayYear(){
            $sql = mysqli_query($this->conn, "SELECT * FROM year_of_data");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

      

        // DISPLAY PRESIDENT CANDIDATES
        public function displayPresCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='President' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY EXTERNAL VICE PRESIDENT CANDIDATES
        public function displayEvpCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='External Vice President' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY INTERNAL VICE PRESIDENT CANDIDATES
        public function displayIvpCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Internal Vice President' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY GENERAL SECRETARY CANDIDATES
        public function displayGstCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='General Secretary' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY EXECUTIVE SECRETARY CANDIDATES
        public function displayEstCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Executive Secretary' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY AUDITOR CANDIDATES
        public function displayAudCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Auditor' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        } 

        // DISPLAY BUDGETARY CANDIDATES
        public function displayBudgCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Budgetary' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY SOCIAL WELFARE OFFICER CANDIDATES
        public function displaySwoCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Social Welfare Officer' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY SENATOR CANDIDATES
        public function displaySenCan($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE position='Senator' AND year_inserted='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY VOTERS
        public function displayVoters($date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN student ON votes.voted_by = student.student_id WHERE votes.year='$date'");
            $array = array();
            while($row = mysqli_fetch_assoc($sql)){
                $array[] = $row;
            }
            return $array;
        }

        // DISPLAY VOTED CANDIDATES --- VOTERS SIDE
        public function votedPres($pres_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$pres_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedExvp($exvp_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$exvp_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedInvp($invp_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$invp_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedGst($gst_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$gst_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedEst($est_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$est_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedAud($aud_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$aud_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedBudg($budg_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$budg_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedSwo($swo_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$swo_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }
        public function votedSen($sen_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM candidates WHERE id='$sen_id'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        // DISPLAY VOTED CANDIDATES --- ADMIN/COMELEC SIDE
        public function displayVotedPres($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.president = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedExPres($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.external_vp = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedInPres($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.internal_vp = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedGenSec($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.general_sec = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedExSec($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.executive_sec = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedAud($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.auditor = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedBudg($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.budgetary = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedSwo($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.social_wo = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayVotedSen($student_id,$date){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes INNER JOIN candidates ON votes.senator = candidates.id WHERE votes.voted_by='$student_id' AND votes.year='$date'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        public function displayReferenceID($voter_id,$currentDate){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes WHERE voted_by='$voter_id' AND year='$currentDate'");
            $array = array();
            $p_row = mysqli_fetch_assoc($sql);
            $array[] = $p_row;
            return $array;
        }

        // DISPLAY COMELIC PROFILE
        public function displayComProfile($id){
            $sql = mysqli_query($this->conn, "SELECT * FROM comelec WHERE id='$id'");
            $array = array();
            $row = mysqli_fetch_assoc($sql);
            $array[] = $row;
            return $array;
        }

        // DISPLAY ENDS HERE!!!



        // INSERTION STARTS HERE!!!

        // ADD COMELEC
        public function createCom($fname, $lname, $hashed, $email, $pNumber, $address, $dateOB, $file_name ,$randomPass,$currentDate){
            $duplicate = mysqli_query($this->conn, "SELECT * FROM comelec WHERE year_inserted='$currentDate' AND email = '$email' AND phone_number = '$pNumber'");
            if (mysqli_num_rows($duplicate) > 0) {
                return 10;
            }else{
                $query = "INSERT INTO comelec (firstname, lastname, password, email, phone_number, address, date_of_birth, profile) VALUES ('$fname', '$lname', '$hashed', '$email', '$pNumber', '$address', '$dateOB', '$file_name')";
                mysqli_query($this->conn, $query);

                // PHPMailer Files
                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
                
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'ssgelection2024@gmail.com';            //SMTP username
                    $mail->Password   = 'dmlslhaddcqwwxen';                     //SMTP password
                    $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                    //Recipients
                    $mail->setFrom('ssgelection2024@gmail.com');
                    $mail->addAddress($email);                                  //Add a recipient
    
                    //Content
                    $mail->isHTML(true);                                        //Set email format to HTML
                    $mail->Subject = 'SCSIT SSG ELECTION';
                    $mail->Body    =  'Welcome to the SCSIT ELECTION Comelec <b>'. $fname .'</b><br>here\'s your password <b>'. $randomPass .'</b>';
    
                    $mail->send();

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                return 1;
            }
        }

        // ADD DEPARTMENT
        public function addDept($dept,$currentDate){
            $duplicate = mysqli_query($this->conn, "SELECT * FROM departments WHERE department = '$dept' AND year_inserted='$currentDate'");
            if (mysqli_num_rows($duplicate) > 0) {
                return 10;
            }else{
                $query = "INSERT INTO departments (department) VALUES ('$dept')";
                mysqli_query($this->conn, $query);

                return 1;
            }
        }

        // ADD PARTY LIST
        public function addPL($PL, $currentDate){
            $duplicate = mysqli_query($this->conn, "SELECT * FROM party_list WHERE party_list_name = '$PL' AND year_inserted='$currentDate'");
            if (mysqli_num_rows($duplicate) > 0) {
                return 10;
            }else{
                $query = "INSERT INTO party_list (party_list_name) VALUES ('$PL')";
                mysqli_query($this->conn, $query);

                return 1;
            }
        }

        // ADD POSITION
        public function addPos($position, $currentDate){
            $duplicate = mysqli_query($this->conn, "SELECT * FROM positions WHERE position_name = '$position' AND year_inserted='$currentDate'");
            if (mysqli_num_rows($duplicate) > 0) {
                return 10;
            }else{
                $query = "INSERT INTO positions (position_name) VALUES ('$position')";
                mysqli_query($this->conn, $query);

                return 1;
            }
        }

         // ADD ACCESS CODE
         public function addAC(){
            for ($i=0; $i < 50; $i++) { 
                $code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYX", 5)), 0, 12);
                $query = "INSERT INTO students_access_code (access_code,status) VALUES ('$code','Not Used')";
                mysqli_query($this->conn, $query);
            }
            return 1;
        }

        
        // ADD CANDIDATE
        public function addCan($fname, $lname, $year_level, $department, $party_list, $position, $file_name, $currentDate){
            $duplicate = mysqli_query($this->conn, "SELECT * FROM candidates WHERE firstname = '$fname' AND lastname = '$lname' AND year_level = '$year_level' AND department='$department' AND party_list = '$party_list' AND position = '$position'  AND year_inserted='$currentDate'");
            if (mysqli_num_rows($duplicate) > 0) {
                return 10;
            }else{
              
                $query = "INSERT INTO candidates (firstname, lastname, year_level, department, party_list, position, profile) VALUES ('$fname', '$lname', '$year_level', '$department', '$party_list', '$position', '$file_name')";
                mysqli_query($this->conn, $query);

                return 1;
            }
        }

        // INSERTION OF VOTES
        public function submitVotes($voter_id, $pres, $exvp, $invp, $gensec, $exsec, $aud, $budg, $swo, $sen, $currentDate ,$reference_id){
            $sql = mysqli_query($this->conn, "SELECT * FROM votes WHERE voted_by = '$voter_id' AND year = '$currentDate'");
            if (mysqli_num_rows($sql) > 0) {
                return 20;
            }elseif (empty($pres)) {
                return 10;
            }elseif(empty($exvp)){
                return 10;
            }elseif(empty($invp)){
                return 10;
            }elseif(empty($gensec)){
                return 10;
            }elseif(empty($exsec)){
                return 10;
            }elseif(empty($aud)){
                return 10;
            }elseif(empty($budg)){
                return 10;
            }elseif(empty($swo)){
                return 10;
            }elseif(empty($sen)){
                return 10;
            }
            else{
                $query = "INSERT INTO votes (voted_by, president, external_vp, internal_vp, general_sec, executive_sec, auditor, budgetary, social_wo, senator,reference_id) VALUES ('$voter_id', '$pres', '$exvp', '$invp', '$gensec', '$exsec', '$aud', '$budg', '$swo', '$sen','$reference_id')";
                mysqli_query($this->conn, $query);
                return 1;
            }
        }
        // INSERTION ENDS HERE!!!


        // UPDATE STARTS HERE!!!

        // Update COMELEC 
        public function updateCom($fname, $lname, $email, $pNumber, $address, $dateOB, $file_name,$id){
            try {
                $query = "UPDATE comelec SET firstname='$fname', lastname='$lname', email='$email', phone_number='$pNumber', address='$address', date_of_birth='$dateOB', profile='$file_name' WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

        // Update DEPARTMENT 
        public function updateDept($dept,$id){
            try {
                $query = "UPDATE departments SET department='$dept' WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

        // Update PARTY LIST 
        public function updatePL($PL,$id){
            try {
                $query = "UPDATE party_list SET party_list_name='$PL' WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

        // Update POSITION
        public function updatePos($position,$id){
            try {
                $query = "UPDATE positions SET position_name='$position' WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

        // Update CANDIDATE 
        public function updateCan($fname, $lname, $year_level, $department, $party_list, $position, $file_name,$id){
            try {
                $query = "UPDATE candidates SET firstname='$fname', lastname='$lname', year_level='$year_level', department='$department', party_list='$party_list', position='$position', profile='$file_name' WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

        // Update SYSTEM SETTINGS 
        public function updateSystem($sname, $scsit, $ssg, $comelec){
            try {
                $query = "UPDATE system_settings SET system_name='$sname', scsit_logo='$scsit', ssg_logo='$ssg', comelec_logo='$comelec' WHERE id=1";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }

         // Update SYSTEM SETTINGS 
         public function updateVotingSetting($start,$end,$time){
            try {
                $query = "UPDATE voting_date_time SET date_start='$start', date_end='$end', time='$time' WHERE id=1";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
             
        }



        // DELETION STARTS HERE!!!

        // DELETE COMELEC
        public function deleteCom($id){
            try {
                $query = "DELETE FROM comelec WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
        }

        // DELETE COMELEC
        public function deleteCan($id){
            try {
                $query = "DELETE FROM candidates WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
        }

        // DELETE PARTY LIST
        public function deletePL($id){
            try {
                $query = "DELETE FROM party_list WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
        }

        // DELETE DEPARTMENT
        public function deleteDept($id){
            try {
                $query = "DELETE FROM departments WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
        }

        // DELETE POSITION
        public function deletePos($id){
            try {
                $query = "DELETE FROM positions WHERE id='$id'";
                mysqli_query($this->conn, $query);
                return 1;
            } catch (\Throwable $e) {
                return 10;
            }
        }
      
    }

    $oop = new dataOperation;