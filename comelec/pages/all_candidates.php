
                <div class="container-fluid p-0">
					<div class="d-flex justify-content-between mb-2">
                        <div class="d-flex justify-content-start">
                            <h1 class="h3 me-2">All Candidates / <span class='text-muted'><?php if (isset($_GET['pos'])) {echo $_GET['pos'];}else{echo"Set position";}?></span></h1>
                            <div class="dropdown" style="float: end; margin-top: -5px;">
                                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle me-1" data-feather="grid"></i>Position
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php 
                                    $myrow = $oop->displayPos($date);
                                    foreach($myrow as $row){
                                        ?><li><a class="dropdown-item" href="?page=all_candidates&pos=<?=$row['position_name']?>"><?=$row['position_name']?></a></li><?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=all_candidates<?php if (isset($_GET['pos'])) {$pos = $_GET['pos'];echo "&pos=$pos";}?>&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
							<a href="?page=ranking" class="btn btn-info" ><i class="align-middle me-1" data-feather="arrow-left"></i>Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow p-4">
								<div class="data_table">
									<table id="leadingCandidates" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
												<th>Name</th>
												<th>Department</th>
												<th>Partylist</th>
                                                <th>Vote count</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                            if (isset($_GET['pos'])) {
                                                $pos = $_GET['pos'];
                                                $can = $oop->displayCanDetsRanking($pos,$date);
                                                    foreach($can as $c_row){
                                                        ?>
                                                        <tr>
                                                            <td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
                                                            <td><?=$c_row['department']?></td>
                                                            <td><?=$c_row['party_list']?></td>
                                                            <td>
                                                                <?php
                                                                $count = $oop->displayCanCntVotesRanking($c_row['id'],$date);
                                                                foreach ($count as $cnt) {
                                                                    echo $cnt['all_can_votes'];
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <?php
                                                    }   
                                                }
											?>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
					</div>
				</div>
