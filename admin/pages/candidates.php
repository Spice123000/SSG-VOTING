				<?php 
					// INCLUDE CANDIDATE PROCESS
					require_once('process/candidate_proc.php');
				?>
				
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
						<h1 class="h3">Candidate List</h1> 
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-info" href="?page=candidate_votes"><i class="align-middle" data-feather="file-text"></i> Candidate votes</a>
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=candidates&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
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
								$myrow = $oop->toUpdateCan($id);
								foreach ($myrow as $rowCan){
							?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="edit"></i> Update Candidate</span>
										<label>Firstname</label>
										<input type="text" name="firstname" value="<?=$rowCan['firstname']?>" class="form-control mb-1" required>
										<label>Lastname</label>
										<input type="text" name="lastname" value="<?=$rowCan['lastname']?>" class="form-control mb-1" required>
											<label>Year Level</label>
											<select class="form-select mb-1" name="year_level" aria-label="Default select example" required>
												<option value="<?=$rowCan['year_level']?>" selected><?=$rowCan['year_level']?> Year</option>
												<option value="1st">1st Year</option>
												<option value="2nd">2nd Year</option>
												<option value="3rd">3rd Year</option>
												<option value="4th">4th Year</option>
											</select>
											<label>Department</label>
											<select class="form-select mb-1" name="department" aria-label="Default select example" required>
												<option value="<?=$rowCan['department']?>" selected><?=$rowCan['department']?></option>
												<?php 
												$myrow = $oop->displayDept($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['department']?>"><?=$row['department']?></option>
												<?php }?>
											</select>
											<label>Partylist</label>
											<select class="form-select mb-1" name="party_list" aria-label="Default select example" required>
												<option value="<?=$rowCan['party_list']?>" selected><?=$rowCan['party_list']?></option>
												<?php 
												$myrow = $oop->displayPL($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['party_list_name']?>"><?=$row['party_list_name']?></option>
												<?php }?>
												<option value="Independent">Independent</option>
											</select>
											<label>Position</label>
											<select class="form-select mb-1" name="position" aria-label="Default select example" required>
												<option value="<?=$rowCan['position']?>" selected><?=$rowCan['position']?></option>
												<?php 
												$myrow = $oop->displayPos($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['position_name']?>"><?=$row['position_name']?></option>
												<?php }?>
											</select>
											<div class="dflex"><label>Candidate Picture</label> <span style="float:right;"> <?=substr($rowCan['profile'], 0, 9)?>...</span></div>
											<input type="text" name="oldProfile" value="<?=$rowCan['profile']?>" style="display:none;">
											<input type="file" name="newProfile" accept="image/*" class="form-control mb-3" >
											<button type="submit" name="updateCan" class="btn btn-success mb-2"><i class="align-middle" data-feather="edit"></i> Save</button>
											<a href="?page=candidates" class="btn btn-info">Cancel</a>
									</div>
								</form>
							<?php }
							}else{
								?>
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="plus"></i> Add Candidate</span>
										<label>Firstname</label>
										<input type="text" name="firstname" class="form-control mb-1" required>
										<label>Lastname</label>
										<input type="text" name="lastname" class="form-control mb-1" required>
											<label>Year Level</label>
											<select class="form-select mb-1" name="year_level" aria-label="Default select example" required>
												<option value="1st" selected>1st Year</option>
												<option value="2nd">2nd Year</option>
												<option value="3rd">3rd Year</option>
												<option value="4th">4th Year</option>
											</select>
											<label>Department</label>
											<select class="form-select mb-1" name="department" aria-label="Default select example" required>
												<?php 
												$myrow = $oop->displayDept($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['department']?>"><?=$row['department']?></option>
												<?php }?>
											</select>
											<label>Partylist</label>
											<select class="form-select mb-1" name="party_list" aria-label="Default select example" required>
												<?php 
												$myrow = $oop->displayPL($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['party_list_name']?>"><?=$row['party_list_name']?></option>
												<?php }?>
												<option value="Independent">Independent</option>
											</select>
											<label>Position</label>
											<select class="form-select mb-1" name="position" aria-label="Default select example" required>
												<?php 
												$myrow = $oop->displayPos($date);
												foreach ($myrow as $row){
													?>
												<option value="<?=$row['position_name']?>"><?=$row['position_name']?></option>
												<?php }?>
											</select>
											<label>Candidate Picture</label>
											<input type="file" name="newProfile" accept="image/*" class="form-control mb-3" required>
										<button tyoe="submit" name="addCan" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Add</button>
									</div>
								</form>
							<?php
							}
							?>
                        </div>
						<div class="col">
							<div class="card shadow p-3" style="overflow-y: hidden;">
								<?= $msgAlert?>
								<div class="data_table">
									<table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Name</th>
												<th>Year Level</th>
												<th>Department</th>
												<th>Partylist</th>
												<th>Position</th>
												<th width="70px">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$myrow = $oop->displayCan($date);
											foreach ($myrow as $row){
											?>
											<tr>
												<td><?= $row['firstname']?> <?= $row['lastname']?></td>
												<td><?= $row['year_level']?> Year</td>
												<td><?= $row['department']?></td>
												<td><?= $row['party_list']?></td>
												<td><?= $row['position']?></td>
												<td>
													<a href="#" class="badge bg-info" onclick="openModal('viewModal<?= $row['id']?>')"><i class="align-middle" data-feather="eye"></i></a>
													<a href="?page=candidates&update=<?= $row['id']?>" class="badge bg-success"><i class="align-middle" data-feather="edit"></i></a>
													<a href="#" class="badge bg-danger" onclick="openModal('deleteModal<?= $row['id']?>')"><i class="align-middle" data-feather="trash-2"></i></a>
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
																		<p>Year Level: </p>
																		<p>Department: </p>
																		<p>Party List: </p>
																		<p>Position: </p>
																	</div>
																	<div class="col mt-2 details">
																		<p><?= $row['firstname']?> <?= $row['lastname']?></p>
																		<p><?= $row['year_level']?> Year</p>
																		<p><?= $row['department']?></p>
																		<p><?= $row['party_list']?></p>
																		<p><?= $row['position']?></p>
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
																	Are you sure you want to delete Candidate <?= $row['firstname']?> <?= $row['lastname']?>?
																</div>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('deleteModal<?= $row['id']?>')">No</button>
																	<form action="" method="POST"> 			
																	<input type="text" value="<?= $row['id']?>" name="id" style="display:none;">													
																	<button type="submit" name="deleteCan" class="btn btn-danger"><i class="align-middle" data-feather="trash"></i> Yes</button>
																	</form>
																</div>
															</div>
														</div>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
