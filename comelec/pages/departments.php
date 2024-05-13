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
						<div class="col">
							<div class="card shadow p-4">
								<?=$msgAlert?>
								<div class="data_table">
									<table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Department</th>
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
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					</div>
				</div>