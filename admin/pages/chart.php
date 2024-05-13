					<div class="container-fluid p-0">
						<div class="d-flex justify-content-between mb-2">
							<h1 class="h3">Bar Chart / <span class="text-muted">Votes / Department</span></h1>
							<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=chart&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
                        </div>
						</div>
						<div class="row">
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