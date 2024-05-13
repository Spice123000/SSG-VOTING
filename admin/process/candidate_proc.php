<?php 
// Create COMELEC
if (isset($_POST['addCan'])) {
    $result = $oop->addCan($_POST['firstname'], $_POST['lastname'], $_POST['year_level'], $_POST['department'], $_POST['party_list'], $_POST['position'], $file_name, $currentDate);
    if ($result == 1) {
        $msgAlert = $oop->alert('Added successfully','warning','check-circle');
    }elseif ($result == 10) {
        $msgAlert = $oop->alert('Candidate is already exist','danger','x-circle');
    }
}

// DELETE CANDIDATE
if (isset($_POST['deleteCan'])) {
    $id = $_POST['id'];
    $result = $oop->deleteCan($id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Deleted successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "?page=candidates";} setTimeout(redirect, 2000);</script><?php
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// UPDATE CANDIDATE
if (isset($_POST['updateCan'])) {
    $id = $_GET['update'];
    $result = $oop->updateCan($_POST['firstname'], $_POST['lastname'], $_POST['year_level'], $_POST['department'], $_POST['party_list'], $_POST['position'], $file_name,$id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}