<?php 
require_once('../inc/function.php');
require_once('process/loginComelec.php');
if (isset($_SESSION['id'])) {
    ?><script>function redirect(){window.location = "index.php?page=dashboard";} setTimeout(redirect, 2000);</script><?php
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
	<title>SCSIT SSG E-Voting || COMELEC</title>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <?php 
    if (isset($_GET['process'])) {
        $page = $_GET['process'];
        if ($page == 'login') {
            include('pages/login.php');
        }elseif($page == 'forgot_password'){
            include('pages/forgot_password.php');
        }else{
            include('pages/login.php');
        }
    }else{
        include('pages/login.php');
    }
    ?>
	<script src="../js/app.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/pdfmake.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
	<style>
        label{
            margin-left: -10px;
        }
    </style>
</body>

</html>