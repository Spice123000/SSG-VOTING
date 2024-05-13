<?php 
require_once('../inc/function.php');


    $from_time1 = date('Y-m-d H:i:s');
    $to_time1 = $_SESSION['end_time'];
    
    $timefirst = strtotime($from_time1);
    $timesecond = strtotime($to_time1);
    
    $differenceinseconds = $timesecond - $timefirst;
    
    $countdown = gmdate('H:i:s', $differenceinseconds);
        if ($countdown > '00:60:00') {
            echo $countdown."<span style='font-size: 11px;'>hrs</span>";
        }elseif($countdown <= '00:00:59'){
            echo $countdown."<span style='font-size: 11px;'>secs</span>";
        }else{
            echo $countdown."<span style='font-size: 11px;'>mins</span>";
        }
        
    $myrow = $oop->displayTimer();
    foreach ($myrow as $row) {
        $time_set = date('H:i:s',strtotime($row['time']));
        if ($countdown > $time_set) {
            unset($_SESSION['end_time']);
            unset($_SESSION['access_code']);
        }
    }

        if($countdown == '00:00:00'){
            unset($_SESSION['end_time']);
            unset($_SESSION['access_code']);
        }
        ?>

    <script>
        count = '<?=$countdown?>';
        time_set = '<?=$time_set?>';
        if(count == '00:00:00'){
            window.location="timeout.php";
        }
        if (count > time_set) {
            window.location="timeout.php";
        }
    </script>
