            <?php 
            include('process/vote_proc.php');
            if (isset($_GET['voted'])) {
                $_SESSION['sen'] = $_GET['voted'];
            }
            ?>
            <main class="content" >
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <div class="col">
                            <div class="voting-contents mt-5">
                                <center>
                                    <?php 
                                    $myrow = $oop->displaySystem();
                                    foreach($myrow as $row){?>
                                            <img src="../img/logo/<?=$row['scsit_logo'];?>" alt="SCSIT LOGO">
                                            <img src="../img/logo/<?=$row['ssg_logo'];?>" alt="SSG LOGO">
                                            <img src="../img/logo/<?=$row['comelec_logo'];?>" alt="COMELEC LOGO">
                                            <h1 class="text-center fw-bold"><?=$row['system_name']. " " . date('Y')?></h1>
                                    <?php
                                    }
                                    ?>
                                </center>
                            </div>
                            <div class="voted-candidates">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-4">
                                        <form method="POST">
                                        <div class="card mb-4" style="overflow: hidden;">
                                            <div class="card-body">
                                                <center><?=$msgAlert?></center>
                                                <h4 class="text-center text-dark"><i class="fa-solid fa-list-ul"></i> Review your votes</h4>

                                                <span class="text-dark fw-bolder">President</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="pres" value="<?php if(isset($_SESSION['p'])){echo $_SESSION['p'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['p'])){
                                                        $pres_id = $_SESSION['p'];
                                                        $row1 = $oop->votedExvp($pres_id,$currentDate);
                                                        foreach($row1 as $row_pres){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_pres['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_pres['firstname']." ".$row_pres['lastname']?></span>
                                                                <a href="?process=p" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=p' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">External Vice President</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="exvp" value="<?php if(isset($_SESSION['evp'])){echo $_SESSION['evp'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['evp'])){
                                                        $exvp_id = $_SESSION['evp'];
                                                        $row2 = $oop->votedExvp($exvp_id,$currentDate);
                                                        foreach($row2 as $row_exvp){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_exvp['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_exvp['firstname']." ".$row_exvp['lastname']?></span>
                                                                <a href="?process=evp" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=evp' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">Internal Vice President</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1 w-100">
                                                    <input type="text" name="invp" value="<?php if(isset($_SESSION['ivp'])){echo $_SESSION['ivp'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['ivp'])){
                                                        $invp_id = $_SESSION['ivp'];
                                                        $row3 = $oop->votedInvp($invp_id,$currentDate);
                                                        foreach($row3 as $row_invp){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_invp['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_invp['firstname']." ".$row_invp['lastname']?></span>
                                                                <a href="?process=ivp" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=ivp' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">General Secretary</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="gensec" value="<?php if(isset($_SESSION['gst'])){echo $_SESSION['gst'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['gst'])){
                                                        $gst_id = $_SESSION['gst'];
                                                        $row4 = $oop->votedGst($gst_id,$currentDate);
                                                        foreach($row4 as $row_gst){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_gst['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_gst['firstname']." ".$row_gst['lastname']?></span>
                                                                <a href="?process=gst" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=gst' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">Executive Secretary</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="exsec" value="<?php if(isset($_SESSION['est'])){echo $_SESSION['est'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['est'])){
                                                        $est_id = $_SESSION['est'];
                                                        $row5 = $oop->votedEst($est_id,$currentDate);
                                                        foreach($row5 as $row_est){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_est['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_est['firstname']." ".$row_est['lastname']?></span>
                                                                <a href="?process=est" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=est' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">Auditor</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="aud" value="<?php if(isset($_SESSION['aud'])){echo $_SESSION['aud'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['aud'])){
                                                        $aud_id = $_SESSION['aud'];
                                                        $row6 = $oop->votedAud($aud_id,$currentDate);
                                                        foreach($row6 as $row_aud){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_aud['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_aud['firstname']." ".$row_aud['lastname']?></span>
                                                                <a href="?process=aud" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=aud' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">Budgetary</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="budg" value="<?php if(isset($_SESSION['budg'])){echo $_SESSION['budg'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['budg'])){
                                                        $budg_id = $_SESSION['budg'];
                                                        $row7 = $oop->votedBudg($budg_id,$currentDate);
                                                        foreach($row7 as $row_budg){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_budg['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_budg['firstname']." ".$row_budg['lastname']?></span>
                                                                <a href="?process=budg" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=budg' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>

                                                <span class="text-dark fw-bolder">Social Welfare Officer</span>
                                                <div class="d-flex justify-space-between align-items-center border-bottom p-1">
                                                    <input type="text" name="swo" value="<?php if(isset($_SESSION['swo'])){echo $_SESSION['swo'];} ?>" style="display: none;">
                                                    <?php 
                                                    if(isset($_SESSION['swo'])){
                                                        $swo_id = $_SESSION['swo'];
                                                        $row7 = $oop->votedSwo($swo_id,$currentDate);
                                                        foreach($row7 as $row_swo){
                                                            ?>
                                                            <div class="candidate-details d-flex align-items-center">
                                                                <img src="../img/profiles/<?=$row_swo['profile']?>" alt="Candidate Picture" class="me-4">
                                                                <span class="text-dark me-4"><?=$row_swo['firstname']." ".$row_swo['lastname']?></span>
                                                                <a href="?process=swo" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo"
                                                        <div class='candidate-details d-flex align-items-center'>
                                                        <span class='text-dark me-4'>Blank</span>
                                                        <a href='?process=swo' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                        </div>";
                                                    }
                                                    ?>
                                                </div>
                                                <span class="text-dark fw-bolder">Senator</span>
                                                <input type="text" name="sen" value="<?php if(isset($_SESSION['sen'])){echo $_SESSION['sen'];} ?>" style="display: none;">
                                                <?php 
                                                if(isset($_SESSION['sen'])){
                                                    $sen_id = $_SESSION['sen'];
                                                    $row7 = $oop->votedSen($sen_id,$currentDate);
                                                    foreach($row7 as $row_sen){
                                                        ?>
                                                        <div class="candidate-details d-flex align-items-center">
                                                            <img src="../img/profiles/<?=$row_sen['profile']?>" alt="Candidate Picture" class="me-4">
                                                            <span class="text-dark me-4"><?=$row_sen['firstname']." ".$row_sen['lastname']?></span>
                                                            <a href="?process=sen" class="btn btn-success btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                        </div>
                                                        <?php
                                                    }
                                                }else{
                                                    echo"
                                                    <div class='candidate-details d-flex align-items-center'>
                                                    <span class='text-dark me-4'>Blank</span>
                                                    <a href='?process=sen' class='btn btn-success btn-sm'><i class='fa-regular fa-pen-to-square'></i> Edit</a>
                                                    </div>";
                                                }
                                                ?>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                <p></p>
                                                <button type="submit" name="save_vote" class="btn btn-primary"><i class="fa-regular fa-paper-plane"></i> Submit Vote</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>