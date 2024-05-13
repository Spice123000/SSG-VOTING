<?php 
// CREATE DEPARTMENT
if (isset($_POST['addDept'])) {
    $result = $oop->addDept($_POST['department'],$currentDate);
    if ($result == 1) {
        $msgAlert = $oop->alert('Added successfully','warning','check-circle');
   }elseif ($result == 10) {
       $msgAlert = $oop->alert('Department already exist','danger','x-circle');
   }
}

// UPDATE DEPARTMENT
if (isset($_POST['updateDept'])) {
    $id = $_GET['update']; 
    $result = $oop->updateDept($_POST['department'],$id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// DELETE PARTY LIST
if (isset($_POST['deleteDept'])) {
    $id = $_POST['id'];
    $result = $oop->deleteDept($id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Deleted successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "?page=departments";} setTimeout(redirect, 2000);</script><?php
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}