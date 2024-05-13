				<?php 
					// INCLUDE COMELEC PROCESS
					require_once('process/comelec_proc.php');
				?>
				<div class="container-fluid">
					<div class="d-flex justify-content-between">
						<h1 class="h3">Comelec List</h1> 
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=comelec&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
						</div>	
					</div>
					<div class="row">	
                        <div class="col-md-3">
							<?php 
							if (isset($_GET['update'])) {
								$id = $_GET['update'];
								$myrow = $oop->toUpdateCom($id);
											foreach ($myrow as $row){
											?>
												<form action="" method="POST" enctype="multipart/form-data">
												<div class="card shadow p-2">
													<span class="mb-3 text-center"><i class="align-middle" data-feather="edit"></i> Update Comelec</span>
													<label>Firstname</label>
													<input type="text" name="firstname" value="<?=$row['firstname']?>" class="form-control mb-1" >
													<label>Lastname</label>
													<input type="text" name="lastname" value="<?=$row['lastname']?>"class="form-control mb-1" >
													<label>Email</label>
													<input type="email" name="email" value="<?=$row['email']?>"class="form-control mb-1" >
													<label>Phone #</label>
													<input type="text" name="pNumber" value="<?=$row['phone_number']?>"class="form-control mb-1" >
													<label>Address</label>
													<input type="text" name="address" value="<?=$row['address']?>"class="form-control mb-1" >
													<label>Date of birth</label>
													<input type="date" name="dateOB" value="<?=$row['date_of_birth']?>"class="form-control mb-1" >
													<div class="dflex"><label>Profile</label><span style="float:right;"><?= substr($row['profile'],0,15)?>...</span></div>
													<input type="text" name="oldProfile" value="<?=$row['profile']?>" style="display: none;" >
													<input type="file" name="newProfile" accept="image/*"  class="form-control mb-3" >
													<button type="submit" class="btn btn-success mb-2" name="updateCom"><i class="align-middle" data-feather="edit"></i> Save</button>
													<a href="?page=comelec" class="btn btn-info">Cancel</a>
												</div>
												</form>
											<?php
											}
							}else {
								?>
								<form action="" method="POST" enctype="multipart/form-data">
								<div class="card shadow p-2">
									<span class="mb-3 text-center"><i class="align-middle" data-feather="plus"></i> Add Comelec</span>
									<label>Firstname</label>
									<input type="text" name="firstname" class="form-control mb-1" required>
									<label>Lastname</label>
									<input type="text" name="lastname" class="form-control mb-1" required>
									<label>Email</label>
									<input type="email" name="email" class="form-control mb-1" required>
									<label>Phone #</label>
									<input type="text" name="pNumber" class="form-control mb-1" required>
									<label>Address</label>
									<input type="text" name="address" class="form-control mb-1" required>
									<label>Date of birth</label>
									<input type="date" name="dateOB" class="form-control mb-1" required>
									<label>Profile</label>
									<input type="file" name="newProfile" accept="image/*" class="form-control mb-3" required>
									<button type="submit" class="btn btn-success" name="createCom"><i class="align-middle" data-feather="plus"></i> Add</button>
								</div>
								</form>
								<?php
							}
							?>
                        </div>
						<div class="col">
							<div class="card shadow p-4" style="overflow-y: hidden;">
								<?= $msgAlert?>
								<div class="data_table">
									<table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Name</th>
												<th>Email</th>
												<th>Phone #</th>
												<th>Address</th>
												<th>Date of birth</th>
												<th width="70px">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											// Display Comelec Data
											$myrow = $oop->displayCom($date);
											foreach ($myrow as $row){
											?>
												<tr>
													<td><?= $row['firstname']?> <?= $row['lastname']?></td>
													<td><?= $row['email']?></td>
													<td><?= $row['phone_number']?></td>
													<td><?= $row['address']?></td>
													<td><?= date("M d, Y", strtotime($row['date_of_birth']));?></td>
													<td>
														<a href="#" class="badge bg-info" onclick="openModal('viewModal<?= $row['id']?>')"><i class="align-middle" data-feather="eye"></i></a>
														<a href="?page=comelec&update=<?= $row['id']?>" class="badge bg-success"><i class="align-middle" data-feather="edit"></i></a>
														<a href="#" class="badge bg-danger" onclick="openModal('deleteModal<?= $row['id']?>')"><i class="align-middle" data-feather="trash"></i></a>
													</td>
												</tr>	
														<!-- View Modal-->
														<div id="viewModal<?= $row['id']?>" class="modal">
															<div class="viewModal-content">
																<span class="close" onclick="closeModal('viewModal<?= $row['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Viewing Comelec <b><?= $row['firstname']?></b></h5>
																</div>
																<hr>
																<div class="row">
																	<div class="col-md-4">
																		<img src="../img/profiles/<?= $row['profile']?>" class="profile">
																	</div>
																	<div class="col-md-3 mt-2 detail-title">
																		<p>Name: </p>
																		<p>Email: </p>
																		<p>Phone Number: </p>
																		<p>Address: </p>
																		<p>Date of Birth: </p>
																	</div>
																	<div class="col mt-2 details">
																		<p><?= $row['firstname']?> <?= $row['lastname']?></p>
																		<p><?= $row['email']?></p>
																		<p><?= $row['phone_number']?></p>
																		<p><?= $row['address']?></p>
																		<p><?= date("M d, Y", strtotime($row['date_of_birth']));?></p>
																	</div>
																</div>
																<hr>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('viewModal<?= $row['id']?>')">Close</button>
																</div>
															</div>
														</div>
														<!-- Delete Modal-->
														<div id="deleteModal<?= $row['id']?>" class="modal">
															<div class="deleteModal-content">
																<span class="close" onclick="closeModal('deleteModal<?= $row['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Delete Confirmation</h5>
																</div>
																<div class="modal-body mt-3">
																	Are you sure you want to delete Comelec <?= $row['firstname']?> <?= $row['lastname']?>?
																</div>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('deleteModal<?= $row['id']?>')">No</button>
																	<form action="" method="POST"> 			
																	<input type="text" value="<?= $row['id']?>" name="id" style="display:none;">													
																	<button type="submit" name="deleteCom" href="comelec.php?delete=<?= $row['id']?>" class="btn btn-danger"><i class="align-middle" data-feather="trash"></i> Yes</button>
																	</form>
																</div>
															</div>
														</div>
											<?php
											}
											?>
										</tbody>
                    				</table>
                				</div>
							</div>
						</div>
					</div>
					</div>
				</div>