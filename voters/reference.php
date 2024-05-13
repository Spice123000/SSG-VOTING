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
    <div class="main">
        <main class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-5 mt-5">
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
                            </center>
                        </div>
                    <div class="voting-reference">
                        <div class="greetings">
                            <h2 class="text-center mt-5 mb-5">Thank you for PARTICIPATING!</h2>
                        </div>
                            <div class="card shadow border-0 text-dark">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="text-center">Your Votes</h4>
                                        <?php 
                                            $pres = $oop->displayVotedPres($_SESSION['student_id'],$currentDate);
                                            foreach($pres as $p_row){
                                                echo "<p>President: <span class='text-muted'>".$p_row['firstname']." ".$p_row['lastname']." / ".$p_row['department']. " / ".$p_row['party_list']."</span></p>";
                                            }
                                            echo"<hr>";
                                            $exvp = $oop->displayVotedExPres($_SESSION['student_id'],$currentDate);
                                            foreach($exvp as $exvp_row){
                                                echo "<p>External Vice President: <span class='text-muted'>".$exvp_row['firstname']." ".$exvp_row['lastname']." / ".$exvp_row['department']." / ".$exvp_row['party_list']."</p>";
                                            }
                                            echo"<hr>";
                                            $invp = $oop->displayVotedInPres($_SESSION['student_id'],$currentDate);
                                            foreach($invp as $invp_row){
                                                echo "<p>Internal Vice President: <span class='text-muted'>".$invp_row['firstname']." ".$invp_row['lastname']." / ".$invp_row['department']." / ".$invp_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $gsec = $oop->displayVotedGenSec($_SESSION['student_id'],$currentDate);
                                            foreach($gsec as $gsec_row){
                                                echo "<p>General Secretary: <span class='text-muted'>".$gsec_row['firstname']." ".$gsec_row['lastname']." / ".$gsec_row['department']." / ".$gsec_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $esec = $oop->displayVotedExSec($_SESSION['student_id'],$currentDate);
                                            foreach($esec as $esec_row){
                                                echo "<p>Executive Secretary: <span class='text-muted'>".$esec_row['firstname']." ".$esec_row['lastname']." / ".$esec_row['department']." / ".$esec_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $aud = $oop->displayVotedAud($_SESSION['student_id'],$currentDate);
                                            foreach($aud as $aud_row){
                                                echo "<p>Auditor: <span class='text-muted'>".$aud_row['firstname']." ".$aud_row['lastname']." / ".$aud_row['department']." / ".$aud_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $budg = $oop->displayVotedBudg($_SESSION['student_id'],$currentDate);
                                            foreach($budg as $budg_row){
                                                echo "<p>Budgetary: <span class='text-muted'>".$budg_row['firstname']." ".$budg_row['lastname']." / ".$budg_row['department']." / ".$budg_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $swo = $oop->displayVotedSwo($_SESSION['student_id'],$currentDate);
                                            foreach($swo as $swo_row){
                                                echo "<p>Social Welfare Officer: <span class='text-muted'>".$swo_row['firstname']." ".$swo_row['lastname']." / ".$swo_row['department']." / ".$swo_row['party_list']."</p>";
                                            }
                                            echo"<hr>";

                                            $sen = $oop->displayVotedSen($_SESSION['student_id'],$currentDate);
                                            foreach($sen as $sen_row){
                                                echo "<p>Senator: <span class='text-muted'>".$sen_row['firstname']." ".$sen_row['lastname']." / ".$sen_row['department']." / ".$sen_row['party_list']."</p>";
                                            }
                                            
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $ref_row = $oop->displayReferenceID($_SESSION['student_id'], $currentDate);
                                    foreach($ref_row as $row){
                                        echo "<p class='text-center mt-2'>Date voted: <b>".date("M d, Y - h:i:s a", strtotime($row['time_voted']))."</b></p>";
                                    }
                            ?>
                    </div>
                    </div>
                </div>
            </div>  
            <div class="container px-4 py-5">
            <h2 class="pb-2 border-bottom"></h2>   
            <div class="row">
                <div class="col">
                    <div class="d-flex align-items-center justify-content-between">
                    <span><b>Note:</b></span>
                    <?php 
                    $ref_row = $oop->displayReferenceID($_SESSION['student_id'], $currentDate);
                    foreach($ref_row as $row){
                        echo "<span>Reference ID: <b>".$row['reference_id']."</b></span>";
                    }
                    ?>
                    </div>
                    <p class="text-start">This can be your proof for participating in SSG Election <?=date('Y')?>. Take a screenshot!</p>
                </div>
            </div>  
        </main>
    </div>


    <script src="bootstrap-5/js/bootstrap.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
 
</body>

</html>