<?php 
require_once('inc/function.php');
$myrow = $oop->displayTimer();
foreach($myrow as $row){
    $start = $row['date_start'];
    $end = $row['date_end'];
    $now = date('Y-m-d H:i:s');
    if ($now <= $end ) {
        header('location: index.php');
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
    <link href="voters/bootstrap-5/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="voters/fontawesome-6/css/all.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="dark-mode">
    <div class="main d-flex justify-content-center align-items-center" style="height: 100vh;">
            <main class="content">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="voting-contents mt-5">
                                <center>
                                    <?php 
                                    $myrow = $oop->displaySystem();
                                    foreach($myrow as $row){?>
                                            <img src="img/logo/<?=$row['scsit_logo'];?>" alt="SCSIT LOGO">
                                            <img src="img/logo/<?=$row['ssg_logo'];?>" alt="SSG LOGO">
                                            <img src="img/logo/<?=$row['comelec_logo'];?>" alt="COMELEC LOGO">
                                            <h1 class="text-center fw-bold"><?=$row['system_name']. " " . date('Y')?></h1>
                                    <?php
                                    }
                                    ?>
                                    <img src="img/photos/outoftime.png" alt="Ended" style="height: 200px;">
                                    <h2>The election has ended!</h2>
                                    <h3 class="fs-5">We will be back soon.</h3>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>

    <script src="voters/bootstrap-5/js/bootstrap.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
</body>

</html>