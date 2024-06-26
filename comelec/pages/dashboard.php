
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3">Dashboard <span class="text-muted">/ Election <?=$date?></span></h1>
					<div class="row">
						<div class="col d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-4">
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Voters</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="edit-2"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
														<?php 
														$myrow = $oop->displayVoteCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_votes'];
														} ?>
												</h1>
												<div class="mb-0">
													<span class="text-muted"> Out of </span>
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>
														<?php 
														$myrow = $oop->displayStudentCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_students']. " students";
														} ?>
													</span>
												</div>
											</div>
										</div>
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Positions</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
														<i class="align-middle" data-feather="grid"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
													<?php 
														$myrow = $oop->displayPosCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_pos'];
														} ?>
												</h1>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Partylist</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
												<?php 
														$myrow = $oop->displayPLCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_pl'];
														} ?>
												</h1>
											</div>
										</div>
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Departments</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="layers"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
													<?php 
														$myrow = $oop->displayDeptCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_dept'];
														} ?>
												</h1>
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Independent</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
												<?php 
														$myrow = $oop->displayIndCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_independent'];
														} ?>
												</h1>
											</div>
										</div>
										<div class="card box-info">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Overall Candidates</h5>
													</div>
													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">
													<?php 
														$myrow = $oop->displayCanCnt($date);
														foreach ($myrow as $cnt){
															echo $cnt['total_candidates'];
														} ?>
												</h1>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
					<div class="row">
						<div class="col">
							<div class="card shadow p-4">
								<p><strong>Voters List</strong></p>
								<div class="data_table">
									<table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Student ID</th>
												<th>Name</th>
												<th>Year Level</th>
												<th>Department</th>
												<th>Date voted</th>
												<th>Reference no.</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$myrow = $oop->displayVoters($date);
											foreach($myrow as $row){
												?>
												<tr>
												<td><?=$row['student_id']?></td>
												<td><?=$row['firstname']." ".substr($row['middlename'], 0, 1)." ".$row['lastname']?></td>
												<td><?=$row['year_level']?> Year</td>
												<td><?=$row['department']?></td>
												<td><?=date("h:i:s a, M d", strtotime($row['time_voted']));?></td>
												<td><?=$row['reference_id']?></td>
												<td><a href="?page=voters" class="badge bg-info"><i class="align-middle" data-feather="eye"></i></a></td>
											</tr>
											<!-- View Modal-->
											<div id="viewModal<?= $row['student_id']?>" class="modal">
															<div class="viewModal-content" >
																<span class="close" onclick="closeModal('viewModal<?= $row['student_id']?>')">&times;</span>
																<div class="modal-header">
																	<h5 class="modal-title fs-4" id="exampleModalLabel">Viewing <b><?= $row['firstname']?>'s Votes</b></h5>
																</div>
																<hr>
																<div class="row" >
																	<div class="col-md-3 mt-2 details" style="font-size: 12px !important;">
																		<b><p>Positions</p></b>
																		<p>President: </p>
																		<p>Internal Vice President: </p>
																		<p>External Vice President: </p>
																		<p>General Secretary: </p>
																		<p>Executive Secretary: </p>
																		<p>Auditor: </p>
																		<p>Budgetary: </p>
																		<p>Social Welfare Officer: </p>
																		<p>Senator: </p>
																	</div>
																	<div class="col-md-4 mt-2 details" style="font-size: 12px !important;">
																		<b><p>Candidate's name</p></b>
																		<?php 
																		$pres = $oop->displayVotedPres($row['student_id'],$currentDate);
																		foreach($pres as $p_row){
																			echo "<p>".$p_row['firstname']." ".$p_row['lastname']."</p>";
																		}
																		$exvp = $oop->displayVotedExPres($row['student_id'],$currentDate);
																		foreach($exvp as $exvp_row){
																			echo "<p>".$exvp_row['firstname']." ".$exvp_row['lastname']."</p>";
																		}
																		$invp = $oop->displayVotedInPres($row['student_id'],$currentDate);
																		foreach($invp as $invp_row){
																			echo "<p>".$invp_row['firstname']." ".$invp_row['lastname']."</p>";
																		}
																		$gsec = $oop->displayVotedGenSec($row['student_id'],$currentDate);
																		foreach($gsec as $gsec_row){
																			echo "<p>".$gsec_row['firstname']." ".$gsec_row['lastname']."</p>";
																		}
																		$esec = $oop->displayVotedExSec($row['student_id'],$currentDate);
																		foreach($esec as $esec_row){
																			echo "<p>".$esec_row['firstname']." ".$esec_row['lastname']."</p>";
																		}
																		$aud = $oop->displayVotedAud($row['student_id'],$currentDate);
																		foreach($aud as $aud_row){
																			echo "<p>".$aud_row['firstname']." ".$aud_row['lastname']."</p>";
																		}
																		$budg = $oop->displayVotedBudg($row['student_id'],$currentDate);
																		foreach($budg as $budg_row){
																			echo "<p>".$budg_row['firstname']." ".$budg_row['lastname']."</p>";
																		}
																		$swo = $oop->displayVotedSwo($row['student_id'],$currentDate);
																		foreach($swo as $swo_row){
																			echo "<p>".$swo_row['firstname']." ".$swo_row['lastname']."</p>";
																		}
																		$sen = $oop->displayVotedSen($row['student_id'],$currentDate);
																		foreach($sen as $sen_row){
																			echo "<p>".$sen_row['firstname']." ".$sen_row['lastname']."</p>";
																		}
																		?>
																	</div>
																	<div class="col mt-2 details" style="font-size: 12px !important;">
																		<b><p>Partylist / Department / Year Level</p></b>
																		<?php 
																		$pres = $oop->displayVotedPres($row['student_id'],$currentDate);
																		foreach($pres as $p_row){
																			echo "<p>".$p_row['party_list']." / ".$p_row['department']." / ".$p_row['year_level']." Year</p>";
																		}
																		$exvp = $oop->displayVotedExPres($row['student_id'],$currentDate);
																		foreach($exvp as $exvp_row){
																			echo "<p>".$exvp_row['party_list']." / ".$exvp_row['department']." / ".$exvp_row['year_level']." Year</p>";
																		}
																		$invp = $oop->displayVotedInPres($row['student_id'],$currentDate);
																		foreach($invp as $invp_row){
																			echo "<p>".$invp_row['party_list']." / ".$invp_row['department']." / ".$invp_row['year_level']." Year</p>";
																		}
																		$gsec = $oop->displayVotedGenSec($row['student_id'],$currentDate);
																		foreach($gsec as $gsec_row){
																			echo "<p>".$gsec_row['party_list']." / ".$gsec_row['department']." / ".$gsec_row['year_level']." Year</p>";
																		}
																		$esec = $oop->displayVotedExSec($row['student_id'],$currentDate);
																		foreach($esec as $esec_row){
																			echo "<p>".$esec_row['party_list']." / ".$esec_row['department']." / ".$esec_row['year_level']." Year</p>";
																		}
																		$aud = $oop->displayVotedAud($row['student_id'],$currentDate);
																		foreach($aud as $aud_row){
																			echo "<p>".$aud_row['party_list']." / ".$aud_row['department']." / ".$aud_row['year_level']." Year</p>";
																		}
																		$budg = $oop->displayVotedBudg($row['student_id'],$currentDate);
																		foreach($budg as $budg_row){
																			echo "<p>".$budg_row['party_list']." / ".$budg_row['department']." / ".$budg_row['year_level']." Year</p>";
																		}
																		$swo = $oop->displayVotedSwo($row['student_id'],$currentDate);
																		foreach($swo as $swo_row){
																			echo "<p>".$swo_row['party_list']." / ".$swo_row['department']." / ".$swo_row['year_level']." Year</p>";
																		}
																		$sen = $oop->displayVotedSen($row['student_id'],$currentDate);
																		foreach($sen as $sen_row){
																			echo "<p>".$sen_row['party_list']." / ".$sen_row['department']." / ".$sen_row['year_level']." Year</p>";
																		}
																		?>
																	</div>
																</div>
																<hr>
																<div class="modal-footer  d-flex align-items-center justify-content-between">
																	<b><p>Reference ID: <span class="badge bg-success fs-4"><?= $row['reference_id']?></span></p></b>
																	<button class="btn btn-info me-2" onclick="closeModal('viewModal<?= $row['student_id']?>')">Close</button>
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

					<div class="row">
						<div class="col">
							<div class="card shadow p-4">
								<p><strong>Candidates List</strong></p>
								<div class="data_table">
									<table id="dashprint" class="table table-striped table-bordered">
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
													<a href="?page=candidates" class="badge bg-info"><i class="align-middle" data-feather="eye"></i></a>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<!-- BAR CHART BY DEPARTMENT -->
							<div class="card shadow p-3"> 
								<div id="deptBarChart"></div>
							</div>
							<script>
									var options = {
									series: [{
									name: '1st year',
									data: [<?php 
									$dept_row = $oop->displayDept($date);
										foreach($dept_row as $row){
											$cnt_dept = $oop->displayVoteDeptCount1st($row['department'],$date);
											foreach($cnt_dept as $cnt){
												echo $cnt['dept_cnt'].",";
											}
										}
									?>]
									}, {
									name: '2nd year',
									data: [<?php 
									$dept_row = $oop->displayDept($date);
										foreach($dept_row as $row){
											$cnt_dept = $oop->displayVoteDeptCount2nd($row['department'],$date);
											foreach($cnt_dept as $cnt){
												echo $cnt['dept_cnt'].",";
											}
										}
									?>]
									}, {
									name: '3rd year',
									data: [<?php 
									$dept_row = $oop->displayDept($date);
										foreach($dept_row as $row){
											$cnt_dept = $oop->displayVoteDeptCount3rd($row['department'],$date);
											foreach($cnt_dept as $cnt){
												echo $cnt['dept_cnt'].",";
											}
										}
									?>]
									}, {
									name: '4th year',
									data: [<?php 
									$dept_row = $oop->displayDept($date);
										foreach($dept_row as $row){
											$cnt_dept = $oop->displayVoteDeptCount4th($row['department'],$date);
											foreach($cnt_dept as $cnt){
												echo $cnt['dept_cnt'].",";
											}
										}
									?>]
									}],
									chart: {
									type: 'bar',
									height: 350,
									stacked: true,
									toolbar: {
										show: true
									},
									zoom: {
										enabled: true
									}
									},
									responsive: [{
									breakpoint: 480,
									options: {
										legend: {
										position: 'bottom',
										offsetX: -10,
										offsetY: 0
										}
									}
									}],
									plotOptions: {
									bar: {
										horizontal: false,
										borderRadius: 10,
										dataLabels: {
										total: {
											enabled: true,
											style: {
											fontSize: '13px',
											fontWeight: 900
											}
										}
										}
									},
									},
									xaxis: {
									type: 'Department',
									categories: [
										<?php 
										$dept_row = $oop->displayDept($date);
										foreach($dept_row as $row){
											echo "'".$row['department']."',";
										}
										?>
									],
									},
									legend: {
									position: 'right',
									offsetY: 100
									},
									fill: {
									opacity: 1
									}
									};

									var chart = new ApexCharts(document.querySelector("#deptBarChart"), options);
									chart.render();
								</script>
							</div>
						</div>
				</div>