				<?php 
					// INCLUDE ADD PARTY LIST
					require_once('process/partylist_proc.php');
				?>
				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
						<h1 class="h3">Party List</h1> 
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=partylist&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
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
								$myrow = $oop->toUpdatePL($id);
								foreach ($myrow as $row){
							?>
								<form action="" method="POST">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="edit"></i> Update Partylist</span>
										<label>Partylist name</label>
										<input type="text" name="party_list" value="<?=$row['party_list_name']?>" class="form-control mb-3">
										<button type="submit" name="updatePL" class="btn btn-success mb-2"><i class="align-middle" data-feather="edit"></i> Save</button>
										<a href="?page=partylist" class="btn btn-info">Cancel</a>
									</div>
								</form>
							<?php }
							}else{
								?>
								<form action="" method="POST">
									<div class="card shadow p-2">
										<span class="mb-3 text-center"><i class="align-middle" data-feather="plus"></i> Add Partylist</span>
										<label>Partylist name</label>
										<input type="text" name="party_list" class="form-control mb-3" placeholder="ex. Dasig">
										<button type="submit" name="addPL" class="btn btn-success"><i class="align-middle" data-feather="plus"></i> Add</button>
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
												<th>Partylist</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											// Display Party List
											$myrow = $oop->displayPL($date);
											foreach ($myrow as $drow){
											?>
												<td><?= $drow['party_list_name']?></td>
												<td>
													<a href="#" class="badge bg-info" onclick="openModal('viewModal<?= $drow['id']?>')"><i class="align-middle" data-feather="eye"></i></a>
													<a href="?page=partylist&update=<?= $drow['id']?>" class="badge bg-success"><i class="align-middle" data-feather="edit"></i></a>
													<a href="#" class="badge bg-danger" onclick="openModal('deleteModal<?= $drow['id']?>')"><i class="align-middle" data-feather="trash-2"></i></a>
												</td>
											</tr>
														<!-- View Modal-->
														<div id="viewModal<?= $drow['id']?>" class="modal">
															<div class="viewModal-content" style="font-size: 12px !important;">
																<span class="close" onclick="closeModal('viewModal<?= $drow['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Viewing party list <b><?= $drow['party_list_name']?></b></h5>
																</div>
																<hr>
																<div class="modal-body mt-3">
																<div class="row">
																		<div class="col">
																			<p><b>Position:</b></p>
																			<p>President: </p>
																			<p>Internal Vice President: </p>
																			<p>External Vice Presidnet: </p>
																			<p>General Secretary: </p>
																			<p>Executive Secreatry: </p>
																			<p>Auditor: </p>
																			<p>Budgetary: </p>
																			<p>Social Welfare Officer: </p>
																			<p>Senators: </p>
																		</div>
																		
																		<div class="col">
																			<p><b>Candidate:</b></p>
																			<?php 
																			$pl = $drow['party_list_name'];
																			$myrow = $oop->displayPLPres($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLIVP($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLEVP($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLGS($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLES($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLAU($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLBU($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLSWO($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLSEN($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['firstname']?> <?=$row['lastname']?></p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			?>
																		</div>
																		<div class="col-md-5">
																			<p><b>Department / Year Level:</b></p>
																			<?php
																			$myrow = $oop->displayPLPres($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLIVP($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLEVP($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLGS($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLES($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLAU($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLBU($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLSWO($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			$myrow = $oop->displayPLSEN($pl, $date);
																			foreach($myrow as $row){
																				if ($row !== null) {
																					?>
																				<p><?=$row['department']?> / <?=$row['year_level']?> Year</p>
																				<?php
																				}else {
																					echo "<p>Blank</p>";
																				}
																			}
																			?>
																		</div>
																	</div>
																</div>
																<hr>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('viewModal<?=$drow['id']?>')">Close</button>
																</div>
															</div>
														</div>

														<!-- Delete Modal-->
														<div id="deleteModal<?= $drow['id']?>" class="modal">
															<div class="deleteModal-content">
																<span class="close" onclick="closeModal('deleteModal<?= $drow['id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Delete Confirmation</h5>
																</div>
																<div class="modal-body mt-3">
																	Are you sure you want to delete Party List <b><?= $drow['party_list_name']?></b>?
																</div>
																<div class="modal-footer mt-3 d-flex align-items-center justify-content-end">
																	<button class="btn btn-info me-2" onclick="closeModal('deleteModal<?= $drow['id']?>')">No</button>
																	<form action="" method="POST">
																	<input type="text" value="<?= $drow['id']?>" name="id" style="display:none;">													
																	<button type="submit" name="deletePL" class="btn btn-danger"><i class="align-middle" data-feather="trash"></i> Yes</button>
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