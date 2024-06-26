            <?php 
            if (isset($_GET['voted'])) {
                $_SESSION['p'] = $_GET['voted'];
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
                                        <h5 class="text-center mt-3">for President</h5>
                                        <div class="col p-2">
                                            <center>
                                            <?php 
                                            $myrow = $oop->displayPresCan($date);
                                            foreach ($myrow as $row) {
                                            ?>
                                            <input type="text" value="<?=$row['id']?>" name="candidate_id" style="display: none;">
                                            <a href="?process=p&voted=<?=$row['id']?>" class="btn btn-link">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <?php 
                                                        if (isset($_SESSION['p'])) {
                                                            if ($_SESSION['p'] == $row['id']) {
                                                                echo "<p>Voted!</p>";
                                                            }
                                                        }
                                                        ?>
                                                        <img src="../img/profiles/<?=$row['profile']?>">
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <span class="bold"><?=$row['firstname'].' '.$row['lastname']?></span> <br>
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
                                            if (isset($_SESSION['p'])) {
                                                echo "<a href='?process=evp' class='btn btn-primary btn-lg me-2'>Next <i class='fa-solid fa-caret-right'></i></a>";
                                            }else{
                                                echo "<a href='?process=evp' class='btn btn-secondary btn-lg me-2'>Skip <i class='fa-solid fa-caret-right'></i></a>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>

