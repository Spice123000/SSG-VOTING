<div class="container-fluid p-0">
					<div class="d-flex justify-content-between">
                        <div class="first-btns d-flex">
                            <div class="dropdown">
                                <a class="btn btn-success dropdown-toggle me-1" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle me-1" data-feather="user"></i>Position
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php 
                                    $myrow = $oop->displayPos($date);
                                    foreach($myrow as $row){
                                        ?><li><a class="dropdown-item" href="?page=candidate_votes&pos=<?=$row['position_name']?>"><?=$row['position_name']?></a></li><?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php 
                            if (isset($_GET['pos'])) {
                                ?>
                                <div class="dropdown">
                                <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="align-middle me-1" data-feather="user"></i>Candidates
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <?php 
                                    $pos = $_GET['pos'];
                                    $myrow = $oop->displayCanByPos($pos, $date);
                                    foreach($myrow as $row){
                                        ?><li><a class="dropdown-item" href="?page=candidate_votes&pos=<?=$_GET['pos']?>&id=<?=$row['id']?>"><?=$row['firstname']." ".$row['lastname']." / ".$row['party_list'];?></a></li><?php
                                    }
                                    ?>
                                </ul>
                            </div>
                                <?php
                            }
                            ?>
                        </div>
						<div class="dropdown">
							<a class="btn btn-info" href="?page=candidates"><i class="align-middle" data-feather="users"></i> Candidates</a>
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=candidate_votes<?php if (isset($_GET['pos'])) {echo "&pos=".$_GET['pos'];}if (isset($_GET['id'])) {echo "&id=".$_GET['id'];}?>&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
						</div>	
					</div>									
                    <div class="row">
						<div class="col">
							<div class="card shadow p-3 mt-2" style="overflow-y: hidden;">
                                <h4>
								<?php 
                                if (isset($_GET['pos'])) {
                                    echo $_GET['pos'];
                                    if (isset($_GET['id'])) {
                                        $myrow = $oop->displayCanById($_GET['id'],$date);
                                        foreach($myrow as $row){
                                            echo " / <span class='text-muted'>".$row['firstname']." ".$row['lastname']."</span>";
                                        }
                                    }else {
                                        echo " / <span class='text-muted'>Set a Candidate</span>";
                                    }
                                }else {
                                    echo "Set a position";
                                }
                                ?>
                                </h4>
								<div class="data_table">
                                    <table id="printable" class="table table-striped table-bordered">
										<thead class="table">
											<tr>
                                                <th width="20">Count</th>
												<th>Name</th>
												<th>Department</th>
												<th>Year Level</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                            if (isset($_GET['id'])) {
                                                $id = $_GET['id'];
											    $myrow = $oop->displayCanVotes($id, $date);
                                                $i=1;
                                                foreach ($myrow as $row){
                                                    ?>
                                                    <tr>
                                                        <td><?=$i++?></td>
                                                        <td><?= $row['firstname']." ".substr($row['middlename'],0,1)." ".$row['lastname']?></td>
                                                        <td><?= $row['department']?></td>
                                                        <td><?= $row['year_level']?> Year</td>
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
				</div>
