<?php 
// UPDATE SYSTEM SETTINGS
if (isset($_POST['saveSetting'])) {
    $result = $oop->updateSystem($_POST['systemName'], $scsit, $ssg, $comelec);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// UPDATE SYSTEM SETTINGS
if (isset($_POST['setSetting'])) {
    $result = $oop->updateVotingSetting($_POST['date_start'],$_POST['date_end'],$_POST['time']);
    if ($result == 1) {
        $msgSetAlert = $oop->alertSet('Set successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgSetAlert = $oop->alertSet('An error occured','danger','x-circle');
    }
}