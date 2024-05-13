                <div class="container-fluid p-0">
					<div class="d-flex justify-content-between mb-2">
                        <h1 class="h3">Leading Candidates</h1>
						<div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=ranking_lead&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
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
												<th>#</th>
												<th>Position</th>
												<th>Name</th>
												<th>Department</th>
												<th>Partylist</th>
                                                <th>Vote count</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$can = $oop->displayVotePresLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>1</td>
													<td>President</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntPresLead($c_row['president'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_pres_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}   
											$can = $oop->displayVoteEvpLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>2</td>
													<td>External Vice President</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntEvpLead($c_row['external_vp'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_evp_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}   
											$can = $oop->displayVoteIvpLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>3</td>
													<td>Internal Vice President</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntIvpLead($c_row['internal_vp'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_ivp_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteGsecLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>4</td>
													<td>General Secretary</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntGsecLead($c_row['general_sec'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_gsec_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteEsecLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>5</td>
													<td>Executive Secretary</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntEsecLead($c_row['executive_sec'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_esec_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteAudLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>6</td>
													<td>Auditor</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntAudLead($c_row['auditor'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_aud_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteBudgLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>7</td>
													<td>Budgetary</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntBudgLead($c_row['budgetary'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_budg_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteSwoLead($date);
											foreach($can as $c_row){
												?>
												<tr>
													<td>8</td>
													<td>Social Welfare Officer</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntSwoLead($c_row['social_wo'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_swo_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											$can = $oop->displayVoteSenLead($date);
											$i=1;
											foreach($can as $c_row){
												?>
												<tr>
													<td>sen <?=$i++?></td>
													<td>Senator</td>
													<td><?=$c_row['firstname']." ".$c_row['lastname']?></td>
													<td><?=$c_row['department']?></td>
													<td><?=$c_row['party_list']?></td>
													<td><?php
														$cnt_p = $oop->displayVoteCntSenLead($c_row['senator'],$date);
														foreach($cnt_p as $cnt){
															echo $cnt['rank_sen_cnt'];
														}
													?> Votes</td>
												</tr>
												<?php
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
					</div>
				</div>
