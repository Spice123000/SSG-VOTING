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
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>
