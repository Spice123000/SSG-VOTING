				<?php 
					// INCLUDE DEPARTMENT PROCESS
					require_once('process/department_proc.php');
				?>
				
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
						<h1 class="h3">Department List</h1> 
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=departments&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
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
								$myrow = $oop->toUpdateDept($id);
								foreach ($myrow as $row){
							?>
							<form action="" method="POST">
								<div class="card shadow p-2">
									<span class="mb-3 text-center"><i class="align-middle" data-feather="edit"></i> Update Department</span>
									<label>Department name</label>
									<input type="text" name="department" value="<?=$row['department']?>" class="form-control mb-3" required>
									<button type="submit" name="updateDept" class="btn btn-success mb-2"><i class="align-middle" data-feather="edit"></i> Save</button>
									<a href="?page=departments" class="btn btn-info">Cancel</a>
								</div>
							</form>
							<?php }
							}else{
								?>
								<form action="" method="POST">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="plus"></i> Add Department</span>
										<label>Department name</label>
										<input type="text" name="department" class="form-control mb-3" placeholder="ex. Business Administrator" required>
										<button type="submit" name="addDept" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Add</button>
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
												<th>Department</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											// Display Comelec Data
											$myrow = $oop->displayDept($date);
											foreach ($myrow as $row){
											?>
											<tr>
												<td><?= $row['department']?></td>
												<td>
													<a href="?page=departments&update=<?= $row['id']?>" class="badge bg-success"><i class="align-middle" data-feather="edit"></i></a>
													<a href="#" class="badge bg-danger" onclick="openModal('deleteModal<?= $row['id']?>')"><i class="align-middle" data-feather="trash-2"></i></a>
												</td>
											</tr>
											<!-- Delete Modal-->
											<div id="deleteModal<?= $row['id']?>" class="modal">
															<div class="deleteModal-content">
																<span class="close" onclick="closeModal('deleteModal<?= $row['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Delete Confirmation</h5>
																</div>
																<div class="modal-body mt-3">
																	Are you sure you want to delete department of <b><?= $row['department']?></b>?
																</div>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('deleteModal<?= $row['id']?>')">No</button>
																	<form action="" method="POST">
																	<input type="text" value="<?= $row['id']?>" name="id" style="display:none;">													
																	<button type="submit" name="deleteDept" class="btn btn-danger"><i class="align-middle" data-feather="trash"></i> Yes</button>
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