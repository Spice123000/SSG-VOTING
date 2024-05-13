				<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
                    	<h1 class="h3"><i class="align-middle" data-feather="code"></i> Student Access Code</h1>
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=access_code&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
						</div>	
					</div>
                    <div class="row" style="width: 100%;">
                        <div class="col">
                            <div class="card shadow p-2">
							<?=$msgAlert?>
								<div class="data_table">
								<table id="printable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Access Code</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody id="load">
									<?php
									$myrow = $oop->displayAC($date);
									foreach ($myrow as $row){
									?>
										<tr>
											<td><?= $row['id']?></td>
											<td><?= $row['access_code']?></td>
											<td><?= $row['status']?> / <?= $row['used_by']?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								</div>  
                            </div>
                        </div>
					</div>
				</div>