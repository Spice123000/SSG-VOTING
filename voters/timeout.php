<?php require_once('../inc/function.php');?>
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
    <div class="main">
        <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <div class="countdown p-2 text-danger">
                            <i class="fa-regular fa-clock fs-5"></i>
                            <span class="fs-5">00:00:00<span style='font-size: 11px;'>secs</span></span>
                        </div>
                    </ul>
                </div>
        </nav>
            <main class="content">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center" style="height: 80vh;">
                        <div class="col">
                            <div class="voting-contents mt-5">
                                <center>
                                    <?php 
                                    $myrow = $oop->displaySystem();
                                    foreach($myrow as $row){?>
                                            <img src="../img/logo/<?=$row['scsit_logo'];?>" alt="SCSIT LOGO">
                                            <img src="../img/logo/<?=$row['ssg_logo'];?>" alt="SSG LOGO">
                                            <img src="../img/logo/<?=$row['comelec_logo'];?>" alt="COMELEC LOGO">
                                            <h1 class="text-center fw-bold"><?=$row['system_name']. " " . date('Y')?></h1>
                                    <?php
                                    }
                                    ?>
                                    <img src="../img/photos/outoftime2.png" alt="Out of time" style="height: 200px;">
                                    <h2>YOU RAN OUT OF TIME!</h2>
                                    <span>Kindly reach to comelec for another access.</span> <br>
                                    <a href="../?process=vote_now" class="btn btn-primary mt-2"><i class="fa-solid fa-arrows-rotate"></i> Try again</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>
        </div>

    <script src="bootstrap-5/js/bootstrap.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
</body>

</html>