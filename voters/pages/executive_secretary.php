<?php 
            if (isset($_GET['voted'])) {
                $_SESSION['est'] = $_GET['voted'];
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
                            <div class="running-candidates">
                                    <div class="row">
                                        <h5 class="text-center mt-3">for Executive Secretary</h5>
                                        <div class="col p-2">
                                            <center>
                                            <?php 
                                            $myrow = $oop->displayEstCan($date);
                                            foreach ($myrow as $row) {
                                            ?>
                                            <a href="?process=est&voted=<?=$row['id']?>" class="btn btn-link">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <?php 
                                                        if (isset($_SESSION['est'])) {
                                                            if ($_SESSION['est'] == $row['id']) {
                                                                echo "<p>Voted!</p>";
                                                            }
                                                        }
                                                        ?>
                                                        <img src="../img/profiles/<?=$row['profile']?>">
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <span><?=$row['firstname'].' '.$row['lastname']?></span> <br>
                                                        <span><?=$row['department']?></span> <br>
                                                        <span><?=$row['party_list']?></span>
                                                    </div> 
                                                </div>
                                            </a>
                                            <?php
                                            }
                                            ?>
                                            </center>
                                        </div>
                                        <div class="buttons text-center">
                                            <?php 
                                            if (isset($_SESSION['est'])) {
                                                echo "<a href='?process=gst' class='btn btn-secondary btn-lg me-2'><i class='fa-solid fa-backward'></i> Back</a>
                                                <a href='?process=aud' class='btn btn-primary btn-lg me-2'>Next <i class='fa-solid fa-caret-right'></i></a>";
                                            }else{
                                                echo "
                                                <a href='?process=gst' class='btn btn-secondary btn-lg me-2'><i class='fa-solid fa-backward'></i> Back</a>
                                                <a href='?process=aud' class='btn btn-secondary btn-lg me-2'>Skip <i class='fa-solid fa-caret-right'></i></a>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>