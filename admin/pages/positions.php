				<?php 
					// INCLUDE ADD POSITION
					require_once('process/position_proc.php');
				?>
				
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
						<h1 class="h3">Position List</h1> 
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=positions&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
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
								$myrow = $oop->toUpdatePos($id);
								foreach ($myrow as $row){
							?>
								<form action="" method="POST">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="edit"></i> Update Position</span>
										<label>Position</label>
										<input type="text" name="position" value="<?=$row['position_name']?>" class="form-control mb-3" required>
										<button type="submit" name="updatePos" class="btn btn-success mb-2"><i class="align-middle" data-feather="edit"></i> Save</button>
										<a href="?page=positions" class="btn btn-info">Cancel</a>
									</div>
								</form>
							<?php }
							}else{
								?>
								<form action="" method="POST">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="plus"></i> Add Position</span>
										<label>Position</label>
										<input type="text" name="position" class="form-control mb-3" placeholder="ex. Executive Secretary" required> 
										<button type="submit" name="addPos" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Add</button>
									</div>
								</form>
								<?php
							}
							?>
							
                        </div>
						<div class="col">
							<div class="card shadow p-4">
								<?=$msgAlert?>
								<div class="data_table">
									<table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Position</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// Display Comelec Data
											$myrow = $oop->displayPos($date);
											foreach ($myrow as $row){
											?>
											<tr>
												<td><?=$row['position_name']?></td>
												<td>
													<a href="#" class="badge bg-info" onclick="openModal('viewModal<?= $row['id']?>')"><i class="align-middle" data-feather="eye"></i></a>
													<a href="?page=positions&update=<?=$row['id']?>" class="badge bg-success"><i class="align-middle" data-feather="edit"></i></a>
													<a href="#" class="badge bg-danger" onclick="openModal('deleteModal<?= $row['id']?>')"><i class="align-middle" data-feather="trash-2"></i></a>
												</td>
											</tr>
											<!-- View Modal-->
											<div id="viewModal<?= $row['id']?>" class="modal">
															<div class="viewModal-content" style="font-size: 12px !important;">
																<span class="close" onclick="closeModal('viewModal<?= $row['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Viewing <b><?= $row['position_name']?></b> Candidates</h5>
																</div>
																<hr>
																<div class="modal-body mt-3">
																<div class="row">
																		<div class="col">
																			<p><b>Position:</b></p>
																			<p><?= $row['position_name']?></p>
																		</div>
																		
																		<div class="col">
																			<p><b>Candidate:</b></p>
																			<?php 
																			$pos = $row['position_name'];
																			$myrow = $oop->displayPosCan($pos, $date);
																			foreach($myrow as $pcrow){ 
																				?>
																				<p><?=$pcrow['firstname']?> <?=$pcrow['lastname']?></p>
																				<?php
																			}
																			?>
																		</div>
																		<div class="col-md-5">
																			<p><b>Party List / Department / Year Level:</b></p>
																			<?php 
																			$myrow = $oop->displayPosCan($pos, $date);
																			foreach($myrow as $pcrow){
																				?>
																				<p><?=$pcrow['party_list']?> / <?=$pcrow['department']?> / <?=$pcrow['year_level']?> Year</p>
																				<?php
																			}
																			?>
																		</div>
																		
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
																	Are you sure you want to delete Position <b><?= $row['position_name']?></b>?
																</div>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('deleteModal<?= $row['id']?>')">No</button>
																	<form action="" method="POST">
																	<input type="text" value="<?= $row['id']?>" name="id" style="display:none;">													
																	<button type="submit" name="deletePos" class="btn btn-danger"><i class="align-middle" data-feather="trash"></i> Yes</button>
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