<?php 
require_once('../inc/function.php'); 

// VALIDATION FOR ACCESSING THE VOTER'S SIDE
if (!isset($_SESSION['access_code'])) {
    header('location: ../');
}

// unset($_SESSION['access_code']);
// unset($_SESSION['duration']);
// unset($_SESSION['end_time']);

$myrow = $oop->displayTimer();
foreach($myrow as $row){
    $start = $row['date_start'];
    $end = $row['date_end'];
    $now = date('Y-m-d H:i:s');
    if ($start <= $now) {
        if ($now >= $end ) {
            header('location: ../ended.php');
        }
    }else {
        header('location: ../coming_soon.php');
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
	<link rel="shortcut icon" href="../img/logo/scsit-logo.png" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<title>SCSIT SSG E-Voting <?=date('Y')?></title>
	<link href="../css/main.css" rel="stylesheet">
    <link href="bootstrap-5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-6/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="dark-mode">
    <div class="main" >
        <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div class="countdown p-1">
                            <i class="fa-regular fa-clock fs-5"></i>
                            <span class="fs-5" id="timer"></span>
                        </div>
                    </ul>
                </div>
        </nav>
       <?php 
       if (isset($_GET['process'])) {
        $process = $_GET['process'];
            if ($process == 'vote_now') {
                include('pages/vote_now.php');
            }elseif($process == 'p') {
                include('pages/president.php');
            }elseif($process == 'evp') {
                include('pages/external_vp.php');
            }elseif($process == 'ivp') {
                include('pages/internal_vp.php');
            }elseif($process == 'gst') {
                include('pages/general_secretary.php');
            }elseif($process == 'est') {
                include('pages/executive_secretary.php');
            }elseif($process == 'aud') {
                include('pages/auditor.php');
            }elseif($process == 'budg') {
                include('pages/budgetary.php');
            }elseif($process == 'swo') {
                include('pages/social_welfare.php');
            }elseif($process == 'sen') {
                include('pages/senator.php');
            }elseif($process == 'review') {
                include('pages/review.php');
            }else{
                include('pages/vote_now.php');
               }
       }else{
        include('pages/vote_now.php');
       }
       ?>
    </div>


    <script src="bootstrap-5/js/bootstrap.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
    <script src="../js/countdown.js"></script>
 
</body>

</html>