<?php 
// Create POSITION
$success= "";
$error= "";
if (isset($_POST['addPos'])) {
    $result = $oop->addPos($_POST['position'],$currentDate);
    if ($result == 1) {
        $msgAlert = $oop->alert('Added successfully','warning','check-circle');
   }elseif ($result == 10) {
       $msgAlert = $oop->alert('Position already exist','danger','x-circle');
   }
}

// UPDATE POSITION
if (isset($_POST['updatePos'])) {
    $id = $_GET['update'];
    $result = $oop->updatePos($_POST['position'],$id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// DELETE POSITION
if (isset($_POST['deletePos'])) {
    $id = $_POST['id'];
    $result = $oop->deletePos($id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Deleted successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "?page=positions";} setTimeout(redirect, 2000);</script><?php
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}