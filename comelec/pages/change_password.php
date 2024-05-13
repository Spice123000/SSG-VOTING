                <?php 
                // ADMIN CHANGE PASSWORD
                if (isset($_POST['changeComPass'])) {
                    $id = $_SESSION['id'];
                    $result = $oop->changeComPass($_POST['pass'], $_POST['newPass'], $_POST['confirmPass'], $id);
                    if ($result == 1) {
                    $msgAlert = $oop->alert('Successfully changed password','warning','check-circle');?>
                    <script>function redirect(){window.location = "?page=profile";} setTimeout(redirect, 2000);</script><?php
                    }elseif ($result == 10) {
                        $msgAlert = $oop->alert('Wrong Password','danger','x-circle');
                    }elseif ($result == 20) {
                    $msgAlert = $oop->alert('Confirm password doesn\'t match','danger','x-circle');
                    }elseif ($result == 30) {
                    $msgAlert = $oop->alert('The new password cannot be the same as the current password','danger','x-circle');
                    }
                }
                ?>
                <div class="container-fluid p-0">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Comelec Profile</h1>
					</div>
					<div class="row">
                        <div class="col-md-4">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Details</h5>
								</div>
								<?php 
								$id = $_SESSION['id'];
								$myrow = $oop->displayComProfile($id);
								foreach($myrow as $row){
								?>
								<div class="card-body text-center">
									<img src="../img/profiles/<?=$row['profile']?>" alt="Administrator" class="img-fluid rounded-circle mb-2" width="140" height="140" />
									<p class="mb-0">Comelec</p>
									<h5 class="card-title"><?=$row['firstname']?></h5>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Details</h5>
									<ul class="list-unstyled mb-0" style="font-size: 13px;">
										<li class="mb-2"><a href="#"><i class="align-middle" data-feather="user"></i> <?=$row['firstname']?> <?=$row['lastname']?></a></li>
										<li class="mb-2"><a href="#"><i class="align-middle" data-feather="mail"></i> <?=$row['email']?></a></li>
										<li class="mb-2"><a href="#"><i class="align-middle" data-feather="phone"></i> <?=$row['phone_number']?></a></li>
										<li class="mb-2"><a href="#"><i class="align-middle" data-feather="map-pin"></i> <?=$row['address']?></a></li>
										<li class="mb-2"><a href="#"><i class="align-middle" data-feather="calendar"></i> <?=date("M d, Y", strtotime($row['date_of_birth']))?></a></li>
									</ul>
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="col">
							<div class="card" style="overflow-y: hidden;">
                            <?= $msgAlert?>
								<div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title mb-0">Profile Settings</h5>
                                        <a class="btn btn-info" href="?page=profile">Back</a>
                                    </div>
									<hr />
								</div>
								<div class="card-body h-100 w-100 d-flex justify-content-center">
                                        <form action="" method="POST">
                                            <h4 class="text-center">Reset Password</h4>
                                            <label>Password</label>
                                            <input type="password" name="pass" id="password" class="form-control mb-1" required>
                                            <label>New Password</label>
                                            <input type="password" name="newPass" class="form-control mb-1" required>
                                            <label>Confirm Password</label>
                                            <input type="password" name="confirmPass" class="form-control mb-3" required>
                                            <button type="submit" name="changeComPass" class="btn btn-primary form-control mb-3"><i class="align-middle" data-feather="key"></i> Change Password</button>
                                        </form>
								</div>
							</div>
						</div>
					</div>
				</div>