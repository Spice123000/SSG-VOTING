                <?php 
					// INCLUDE ADD DEPARTMENT
					require_once('process/updateSystem.php');
				?>
                <div class="container-fluid p-0">
                    <h1 class="h3"><i class="align-middle" data-feather="settings"></i> System Settings</h1>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-5">
                            <div class="card shadow p-3" style="overflow-y: hidden;">
                            <?=$msgSetAlert?>
                                <?php 
                                $myrow = $oop->displayTimer();
                                foreach($myrow as $row){
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <h4 class="text-center mb-4"><i class="align-middle" data-feather="edit"></i> Set Voting Settings</h4>
                                    <label>Voting Start Date</label>
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" name="date_start" value="<?=$row['date_start']?>" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    </div>
                                    <label>Voting End Date</label>
                                    <div class="input-group mb-3">
                                        <input type="datetime-local" class="form-control" name="date_end" value="<?=$row['date_end']?>" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                    </div>
                                    <label>Voting Countdown Timer</label>
                                    <div class="input-group mb-3">
                                        <input type="number" value="<?=$row['time']?>" class="form-control" name="time" aria-label="Recipient's username" aria-describedby="basic-addon2" required>
                                        <span class="input-group-text" id="basic-addon2">minutes</span>
                                    </div>
                                    <button type="submit" name="setSetting" class="btn btn-success form-control">Set</button>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card shadow p-3" style="overflow-y: hidden;">
                            <?=$msgAlert?>
                                <?php 
                                $myrow = $oop->displaySystem();
                                foreach($myrow as $row){
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <h4 class="text-center mb-4"><i class="align-middle" data-feather="edit"></i> Change System Settings</h4>
                                    <label>System Name</label>
                                    <input type="text" name="systemName" value="<?= $row['system_name']?>" class="form-control mb-2" required>
                                    <label>SCSIT Logo</label>
                                    <input type="text" name="oldSCSIT" value="<?= $row['scsit_logo']?>" style="display: none;" >
                                    <input type="file" name="scsit" class="form-control mb-2">
                                    <label>SSG Logo</label>
                                    <input type="text" name="oldSSG" value="<?= $row['ssg_logo']?>" style="display: none;" >
                                    <input type="file" name="ssg" class="form-control mb-2">
                                    <label>Comelec Logo</label>
                                    <input type="text" name="oldCOMELEC" value="<?= $row['comelec_logo']?>" style="display: none;" >
                                    <input type="file" name="comelec" class="form-control mb-3">
                                    <button type="submit" name="saveSetting" class="btn btn-success form-control">Save</button>
                                </form>
                                <?php } ?>
                            </div>
                        </div>
					</div>
				</div>