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
								<div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title mb-0">Profile Settings</h5>
                                    </div>
									<hr />
								</div>
								    <div class="card-body h-100 w-100 d-flex justify-content-center">
                                         <div class="change-password">
                                        <h4><i class="align-middle" data-feather="settings"></i> Password Settings</h4>
                                        <a href="?page=change_password" class="btn btn-primary mb-5"><i class="align-middle" data-feather="key"></i> Change Password</a>
                                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>