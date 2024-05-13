<?php require_once('../inc/function.php'); 
if (!isset($_SESSION['id'])) {
	header('location: login.php');
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
	<title>SCSIT SSG E-Voting || ADMIN</title>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/datatables.min.css">
	<link rel="stylesheet" href="../css/main.css">
	<script src="../js/apexchart.js"></script>
</head>
<body>
	<div class="wrapper">
            <!-- SIDEBAR -->
            <?php include_once('inc/sidebar.php') ?>
            <div class="main">
                <!-- NAVBAR -->
                <?php include_once('inc/nav.php')?>
                <main class="content">
                    <?php 
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        if ($page == 'dashboard') {
                            include('pages/dashboard.php');
                        }elseif ($page == 'comelec') {
                            include('pages/comelec.php');
                        }elseif ($page == 'voters') {
                            include('pages/voters.php');
                        }elseif ($page == 'candidates') {
                            include('pages/candidates.php');
                        }elseif ($page == 'candidate_votes') {
                            include('pages/candidate_votes.php');
                        }elseif ($page == 'partylist') {
                            include('pages/partylist.php');
                        }elseif ($page == 'departments') {
                            include('pages/departments.php');
                        }elseif ($page == 'positions') {
                            include('pages/positions.php');
                        }elseif ($page == 'ranking') {
                            include('pages/ranking.php');
                        }elseif ($page == 'chart') {
                            include('pages/chart.php');
                        }elseif ($page == 'access_code') {
                            include('pages/access_code.php');
                        }elseif ($page == 'system_settings') {
                            include('pages/system_settings.php');
                        }elseif ($page == 'profile') {
                            include('pages/profile.php');
                        }elseif ($page == 'ranking_lead') {
                            include('pages/ranking_lead.php');
                        }elseif ($page == 'all_candidates') {
                            include('pages/all_candidates.php');
                        }elseif ($page == 'change_password') {
                            include('pages/change_password.php');
                        }else {
                            include('pages/dashboard.php');
                        }
                    }else {
                        include('pages/dashboard.php');
                    }
                    ?>
                </main>
            </div>
	</div>

	<script src="../js/app.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/pdfmake.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
    <script src="../js/custom.js" type="text/javascript"></script>

</body>

</html>