    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh; width: 100%; ">
            <div class="col-md-4">
                <div class="card shadow overflow-hidden">
                    <div class="row bg-light mb-4">
                            <img src="../img/photos/comelec-login.png" alt="Comelec Login" style="height: 200px; object-fit: cover;">
                            <div class="a-logos d-flex align-items-center justify-content-center" style="margin-top: -50px;">
                                <img src="../img/logo/scsit-logo.png" alt="scsitLogo">
                                <img src="../img/logo/ssg-logo.png" alt="ssgLogo" class="ssg-logo">
                                <img src="../img/logo/comelec-logo.png" alt="comelecLogo">
                            </div>
                    </div>
                    <form action="" method="POST">
                        <div class="row p-5">
                            <h4 class="text-center" style="margin-top: -45px;">Comelec Login</h4>
                            <?= $msgAlert?>
                            <label style="margin-left: -10px;">Email</label>
                            <input type="email" name="email" class="form-control mb-1"required>
                            <label style="margin-left: -10px;">Password</label>
                            <input type="password" name="password" class="form-control mb-1" required>
                            <button type="submit" name="loginComelec" class="btn btn-primary mt-3">Login</button>
                            <a href="?process=forgot_password" class="text-center mt-3">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
