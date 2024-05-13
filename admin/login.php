<?php 
require_once('../inc/function.php');
require_once('process/loginAdmin.php');
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
	<title>SCSIT SSG E-Voting || ADMIN</title>
	<link href="../css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/main.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh; width: 100%;">
            <div class="col-md-4">
                <div class="card shadow overflow-hidden">
                    <div class="row mb-4">
                        <img src="../img/photos/admin-login.png" alt="Admin Login" style="height: 200px;object-fit: cover;">
                            <div class="a-logos d-flex align-items-center justify-content-center" style="margin-top: -50px;">
                                <img src="../img/logo/scsit-logo.png" alt="scsitLogo">
                                <img src="../img/logo/ssg-logo.png" alt="ssgLogo" class="ssg-logo">
                                <img src="../img/logo/comelec-logo.png" alt="comelecLogo">
                            </div>
                    </div>
                    <form action="" method="POST">
                        <div class="row p-5">
                            <h4 class="text-center" style="margin-top: -45px;">Admin Login</h4>
                            <?php 
                            ?>
                            <?= $msgAlert?>
                            <label style="margin-left: -10px;">Username</label>
                            <input type="text" name="username" class="form-control mb-1"required>
                            <label style="margin-left: -10px;">Password</label>
                            <input type="password" name="password" class="form-control mb-1" required>
                            <button type="submit" name="loginAdmin" class="btn btn-primary mt-3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<script src="../js/app.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/pdfmake.min.js"></script>
    <script src="../js/vfs_fonts.js"></script>
	
</body>

</html>