            <main class="content" >
                <div class="container-fluid">
                    <div class="row d-flex align-items-center justify-content-center" style="height: 90vh;">
                        <div class="col">
                            <div class="contents">
                                <form action="" method="POST" autocomplete="off">
                                <center>
                                    <?php 
                                    $myrow = $oop->displaySystem();
                                    foreach($myrow as $row){?>
                                            <img src="../img/logo/<?=$row['scsit_logo'];?>" alt="SCSIT LOGO">
                                            <img src="../img/logo/<?=$row['ssg_logo'];?>" alt="SSG LOGO">
                                            <img src="../img/logo/<?=$row['comelec_logo'];?>" alt="COMELEC LOGO">
                                            <h4 class="text-center fw-bold mt-2">Welcome to</h4>
                                            <h2 class="text-center fw-bold"><?=$row['system_name']. " " . date('Y')?></h2>
                                    <?php
                                    }
                                    ?>
                                    <a href="?process=p" class="btn btn-primary mt-2 btn-lg mb-5">Vote Now!</a>

                                    <div class="reminder">
                                            <p class="text-center">
                                            Reminder: <br> <b>Your timer is starting.</b>
                                            </p>
                                        </div>
                                </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </main>