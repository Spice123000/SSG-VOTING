<?php 
require_once('inc/function.php'); 
$student_id = 12; //SAMPLE STUDENT ID
$_SESSION['student_id'] = $student_id; //SESSION OF STUDENT ID
$voter_id = $_SESSION['student_id'];
include('voters/process/accessCode.php');
if(isset($_SESSION['access_code'])){?>
    <script>function redirect(){window.location = "voters/?process=vote_now";} setTimeout(redirect, 2000);</script><?php
}

$myrow = $oop->displayTimer();
foreach($myrow as $row){
    $start = $row['date_start'];
    $end = $row['date_end'];
    $now = date('Y-m-d H:i:s');
    if ($start <= $now) {
        if ($now >= $end ) {
            header('location: ended.php');
        }
    }else {
        header('location: coming_soon.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/logo/scsit-logo.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<title>SCSIT SSG E-Voting <?=date('Y')?></title>
	<link href="css/main.css" rel="stylesheet">
	<link href="voters/fontawesome-6/css/all.css" rel="stylesheet">
    <link href="voters/bootstrap-5/css/bootstrap.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="dark-mode">
    <div class="main d-flex justify-content-center align-items-center" style="height: 100vh;">
        <main class="content">
            <div class="container-fluid">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col">
                        <div class="contents">                          
                            <form action="" method="POST" autocomplete="off">
                            <center>
                                <?php 
                                $myrow = $oop->displaySystem();
                                foreach($myrow as $row){?>
                                        <img src="img/logo/<?=$row['scsit_logo'];?>" alt="SCSIT LOGO">
                                        <img src="img/logo/<?=$row['ssg_logo'];?>" alt="SSG LOGO">
                                        <img src="img/logo/<?=$row['comelec_logo'];?>" alt="COMELEC LOGO">
                                        <h2 class="text-center fw-bold mt-2"><?=$row['system_name']. " " . date('Y')?></h2>
                                <?php
                                }
                                ?>
                                <?=$msgAlert?>
                                <?php 
                                if (!isset($_SESSION['access_code'])) {
                                    ?>
                                    <label for="access_code">Enter access code here</label>
                                    <input type="text" name="access_code" class="form-control mb-3" id="access_code">
                                    <button type="submit" name="verify_ac" class="btn btn-primary btn-lg mb-5">Enter</button>
                                    
                                    <?php
                                }
                                ?>
                                <div class="reminder">
                                    <p class="text-center">
                                        Reminder: <br> <b>Your timer will start after entering a valid access code.</b>
                                    </p>
                                </div>
                            </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </main>
    </div>
    <script src="voters/bootstrap-5/js/bootstrap.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
</body>
</html>