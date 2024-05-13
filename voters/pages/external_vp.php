<?php 
            if (isset($_GET['voted'])) {
                $_SESSION['evp'] = $_GET['voted'];
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
                                        <h5 class="text-center mt-3">for External Vice President</h5>
                                        <div class="col d-flex align-items-center justify-content-center p-2">
                                        <center>
                                           <?php 
                                            $myrow = $oop->displayEvpCan($date);
                                            foreach ($myrow as $row) {
                                            ?>
                                            <a href="?process=evp&voted=<?=$row['id']?>" class="btn btn-link">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <?php 
                                                        if (isset($_SESSION['evp'])) {
                                                            if ($_SESSION['evp'] == $row['id']) {
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
                                            if (isset($_SESSION['evp'])) {
                                                echo "<a href='?process=p' class='btn btn-secondary btn-lg me-2'><i class='fa-solid fa-backward'></i> Back</a>
                                                <a href='?process=ivp' class='btn btn-primary btn-lg me-2'>Next <i class='fa-solid fa-caret-right'></i></a>";
                                            }else{
                                                echo "
                                                <a href='?process=p' class='btn btn-secondary btn-lg me-2'><i class='fa-solid fa-backward'></i> Back</a>
                                                <a href='?process=ivp' class='btn btn-secondary btn-lg me-2'>Skip <i class='fa-solid fa-caret-right'></i></a>
                                                ";
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>