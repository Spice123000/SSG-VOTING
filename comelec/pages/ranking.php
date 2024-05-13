<div class="container-fluid p-0">
					<div class="d-flex justify-content-between mb-2">
                        <h1 class="h3">Ranking</h1>
                        <div class="dropdown" style="float: end; margin-top: -5px;">
							<a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="align-middle me-1" data-feather="calendar"></i>Election <?=$date?>
							</a>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<?php 
								$myrow = $oop->displayYear();
								foreach($myrow as $row){
									?><li><a class="dropdown-item" href="?page=ranking&year_of=<?=$row['year']?>">Election <?=$row['year']?></a></li><?php
								}
								?>
							</ul>
                            <a href="?page=all_candidates" class="btn btn-info" ><i class="align-middle me-1" data-feather="trending-up"></i>All Candidates</a>
                            <a href="?page=ranking_lead" class="btn btn-info" ><i class="align-middle me-1" data-feather="trending-up"></i>Leading Candidates</a>
                        </div>
                    </div>
                    <div class="row">
                        <!-- PRESIDENT -->
                        <div class="card shadow p-3"> 
                            <div id="presidentChart"></div>
                            <script>
                                // PRESIDENT CHART
                                var options = {
                                series: [{
                                data: [<?php
                                    $can = $oop->displayVotePresDesc($date);
                                    foreach($can as $c_row){
                                        $cnt_p = $oop->displayVoteCntPres($c_row['president'],$date);
                                        foreach($cnt_p as $cnt){
                                            echo $cnt['rank_pres_cnt'].",";
                                        }
                                    }   
                                    ?>]
                                }],
                                chart: {
                                type: 'bar',
                                height: 250
                                },
                                plotOptions: {
                                bar: {
                                    barHeight: '100%',
                                    distributed: true,
                                    horizontal: true,
                                    dataLabels: {
                                    position: 'bottom'
                                    },
                                }
                                },
                                colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                                ],
                                dataLabels: {
                                enabled: true,
                                textAnchor: 'start',
                                style: {
                                    colors: ['#fff']
                                },
                                formatter: function (val, opt) {
                                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                                },
                                offsetX: 0,
                                dropShadow: {
                                    enabled: true
                                }
                                },
                                stroke: {
                                width: 1,
                                colors: ['#fff']
                                },
                                xaxis: {
                                categories: [
                                    <?php 
                                    $can = $oop->displayVotePresDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                                ],
                                },
                                yaxis: {
                                labels: {
                                    show: false
                                }
                                },
                                title: {
                                    text: 'President',
                                    align: 'center',
                                    floating: true
                                },
                                tooltip: {
                                theme: 'dark',
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                    formatter: function () {
                                        return 'Votes:'
                                    }
                                    }
                                }
                                }
                                };

                                var chart = new ApexCharts(document.querySelector("#presidentChart"), options);
                                chart.render();
                            </script>
                        </div>
                       
                        <!-- EXTERNAL VICE PRESIDENT -->
                        <div class="card shadow p-3"> 
                            <div id="evpChart"></div>
                            <script>
                            // EXTERNAL VICE PRESIDENT
                            var options = {
                            series: [{
                            data: [<?php
                                    $can = $oop->displayVoteEvpDesc($date);
                                    foreach($can as $c_row){
                                        $cnt_p = $oop->displayVoteCntEvp($c_row['external_vp'],$date);
                                        foreach($cnt_p as $cnt){
                                            echo $cnt['rank_evp_cnt'].",";
                                        }
                                    }   
                                    ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [ 
                                    <?php 
                                    $can = $oop->displayVoteEvpDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'External Vice President',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#evpChart"), options);
                            chart.render();
                            </script>
                        </div>

                         <!-- INTERNAL VICE PRESIDENT -->
                         <div class="card shadow p-3"> 
                            <div id="ivpChart"></div>
                            <script>
                            // INTERNAL VICE PRESIDENT
                            var options = {
                            series: [{
                            data: [<?php
                                    $can = $oop->displayVoteIvpDesc($date);
                                    foreach($can as $c_row){
                                        $cnt_p = $oop->displayVoteCntIvp($c_row['internal_vp'],$date);
                                        foreach($cnt_p as $cnt){
                                            echo $cnt['rank_ivp_cnt'].",";
                                        }
                                    }   
                                    ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [  
                                    <?php 
                                    $can = $oop->displayVoteIvpDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'Internal Vice President',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#ivpChart"), options);
                            chart.render();



                            </script>
                        </div>

                        <!-- GENERAL SECRETARY -->
                        <div class="card shadow p-3"> 
                            <div id="gsChart"></div>
                            <script>
                            // GENERAL SECRETARY
                            var options = {
                            series: [{
                            data: [<?php
                                    $can = $oop->displayVoteGsecDesc($date);
                                    foreach($can as $c_row){
                                        $cnt_p = $oop->displayVoteCntGsec($c_row['general_sec'],$date);
                                        foreach($cnt_p as $cnt){
                                            echo $cnt['rank_gen_cnt'].",";
                                        }
                                    }   
                                    ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [ 
                                    <?php 
                                    $can = $oop->displayVoteGsecDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'General Secretary',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#gsChart"), options);
                            chart.render();


                            </script>
                        </div>
                        <!-- EXECUTIVE SECRETARY -->
                        <div class="card shadow p-3"> 
                            <div id="esChart"></div>
                            <script>
                        // EXECUTIVE SECRETARY
                        var options = {
                        series: [{
                        data: [<?php
                                $can = $oop->displayVoteEsecDesc($date);
                                foreach($can as $c_row){
                                    $cnt_p = $oop->displayVoteCntEsec($c_row['executive_sec'],$date);
                                    foreach($cnt_p as $cnt){
                                        echo $cnt['rank_esec_cnt'].",";
                                    }
                                }   
                                ?>]
                        }],
                        chart: {
                        type: 'bar',
                        height: 250
                        },
                        plotOptions: {
                        bar: {
                            barHeight: '100%',
                            distributed: true,
                            horizontal: true,
                            dataLabels: {
                            position: 'bottom'
                            },
                        }
                        },
                        colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                        ],
                        dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        style: {
                            colors: ['#fff']
                        },
                        formatter: function (val, opt) {
                            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                        },
                        offsetX: 0,
                        dropShadow: {
                            enabled: true
                        }
                        },
                        stroke: {
                        width: 1,
                        colors: ['#fff']
                        },
                        xaxis: {
                        categories: [    
                                    <?php 
                                    $can = $oop->displayVoteEsecDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                        ],
                        },
                        yaxis: {
                        labels: {
                            show: false
                        }
                        },
                        title: {
                            text: 'Executive Secretary',
                            align: 'center',
                            floating: true
                        },
                        tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },
                        y: {
                            title: {
                            formatter: function () {
                                return 'Votes:'
                            }
                            }
                        }
                        }
                        };

                        var chart = new ApexCharts(document.querySelector("#esChart"), options);
                        chart.render();

                            </script>
                        </div>
                        <!-- AUDITOR -->
                        <div class="card shadow p-3"> 
                            <div id="auChart"></div>
                            <script>
                            // AUDITOR
                            var options = {
                            series: [{
                            data: [<?php
                                $can = $oop->displayVoteAudDesc($date);
                                foreach($can as $c_row){
                                    $cnt_p = $oop->displayVoteCntAud($c_row['auditor'],$date);
                                    foreach($cnt_p as $cnt){
                                        echo $cnt['rank_aud_cnt'].",";
                                    }
                                }   
                                ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [
                                    <?php 
                                    $can = $oop->displayVoteAudDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'Auditor',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#auChart"), options);
                            chart.render();
                            </script>
                        </div>
                        <!-- BUDGETARY -->
                        <div class="card shadow p-3"> 
                            <div id="buChart"></div>
                            <script>
                            // BUDGETARY
                            var options = {
                            series: [{
                            data: [<?php
                                $can = $oop->displayVoteBudgDesc($date);
                                foreach($can as $c_row){
                                    $cnt_p = $oop->displayVoteCntBudg($c_row['budgetary'],$date);
                                    foreach($cnt_p as $cnt){
                                        echo $cnt['rank_budg_cnt'].",";
                                    }
                                }   
                                ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [ 
                                    <?php 
                                    $can = $oop->displayVoteBudgDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'Budgetary',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#buChart"), options);
                            chart.render();
                            </script>
                        </div>
                        <!-- SOCIAL WELFARE OFFICER -->
                        <div class="card shadow p-3"> 
                            <div id="swoChart"></div>
                            <script>
                                // SOCIAL WELFARE OFFICER
                            var options = {
                            series: [{
                            data: [<?php
                                $can = $oop->displayVoteSwoDesc($date);
                                foreach($can as $c_row){
                                    $cnt_p = $oop->displayVoteCntSwo($c_row['social_wo'],$date);
                                    foreach($cnt_p as $cnt){
                                        echo $cnt['rank_swo_cnt'].",";
                                    }
                                }   
                                ?>]
                            }],
                            chart: {
                            type: 'bar',
                            height: 250
                            },
                            plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                position: 'bottom'
                                },
                            }
                            },
                            colors: ['#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                            ],
                            dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                            },
                            stroke: {
                            width: 1,
                            colors: ['#fff']
                            },
                            xaxis: {
                            categories: [
                                    <?php 
                                    $can = $oop->displayVoteSwoDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                            ],
                            },
                            yaxis: {
                            labels: {
                                show: false
                            }
                            },
                            title: {
                                text: 'Social Welfare Officer',
                                align: 'center',
                                floating: true
                            },
                            tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                formatter: function () {
                                    return 'Votes:'
                                }
                                }
                            }
                            }
                            };

                            var chart = new ApexCharts(document.querySelector("#swoChart"), options);
                            chart.render();
                            </script>
                        </div>
                          <!-- SENATOR -->
                          <div class="card shadow p-3"> 
                            <div id="senChart"></div>
                            <script>
                                // SENATOR
                                var options = {
                                series: [{
                                data: [<?php
                                    $can = $oop->displayVoteSenDesc($date);
                                    foreach($can as $c_row){
                                        $cnt_p = $oop->displayVoteCntSen($c_row['senator'],$date);
                                        foreach($cnt_p as $cnt){
                                            echo $cnt['rank_sen_cnt'].",";
                                        }
                                    }   
                                    ?>]
                                }],
                                chart: {
                                type: 'bar',
                                height: 600
                                },
                                plotOptions: {
                                bar: {
                                    barHeight: '100%',
                                    distributed: true,
                                    horizontal: true,
                                    dataLabels: {
                                    position: 'bottom'
                                    },
                                }
                                },
                                colors: ['#33b2df', '#546E7A','#ff2aff','#5faEff','#A59e8f', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564','#33b2df', '#546E7A','#ff2aff','5faEff','#A5978B', '#f48024','#F2f000', '#0F0201','#F20000', '#014f01','#F20aa0', '#000f00','#4C3B4D', '#61C9A8' ,'#9BE564'
                                ],
                                dataLabels: {
                                enabled: true,
                                textAnchor: 'start',
                                style: {
                                    colors: ['#fff']
                                },
                                formatter: function (val, opt) {
                                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                                },
                                offsetX: 0,
                                dropShadow: {
                                    enabled: true
                                }
                                },
                                stroke: {
                                width: 1,
                                colors: ['#fff']
                                },
                                xaxis: {
                                categories: [
                                    <?php 
                                    $can = $oop->displayVoteSenDesc($date); 
                                    foreach($can as $row){
                                        echo "'".$row['firstname']." ".$row['lastname']."',";
                                    }
                                    ?>
                                ],
                                },
                                yaxis: {
                                labels: {
                                    show: false
                                }
                                },
                                title: {
                                    text: 'Senator',
                                    align: 'center',
                                    floating: true
                                },
                                tooltip: {
                                theme: 'dark',
                                x: {
                                    show: false
                                },
                                y: {
                                    title: {
                                    formatter: function () {
                                        return 'Votes:'
                                    }
                                    }
                                }
                                }
                                };

                                var chart = new ApexCharts(document.querySelector("#senChart"), options);
                                chart.render();
                            </script>
                        </div>
					</div>
				</div>