    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh; width: 100%;">
            <div class="col-md-4">
                <div class="card shadow overflow-hidden">
                    <div class="row bg-light mb-4">
                            <img src="../img/photos/comelec-login.png" alt="Comelec Login" style="height: 200px; object-fit: cover;">
                            <div class="a-logos d-flex align-items-center justify-content-center" style="margin-top: -50px;">
                                <img src="../img/logo/scsit-logo.png" alt="scsitLogo">
                                <img src="../img/logo/comelec-logo.png" alt="ssgLogo" class="ssg-logo">
                                <img src="../img/logo/ssg-logo.png" alt="comelecLogo">
                            </div>
                    </div>
                    <form action="" method="POST">
                    <div class="row p-5">
                        <h4 class="text-center" style="margin-top: -45px;">Forgot Password</h4>
                        <?= $msgAlert?>
                        <label>Email</label>
                        <input type="email" name="email" class="form-control mb-1">
                        <button type="submit" name="send_password" class="btn btn-primary mt-3">Request new password</button>
                        <a href="?process=login" class="text-center mt-2">Go back</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>