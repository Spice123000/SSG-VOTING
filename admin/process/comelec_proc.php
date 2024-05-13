<?php 
// Create COMELEC
if (isset($_POST['createCom'])) {
    $result = $oop->createCom($_POST['firstname'], $_POST['lastname'], $hashed, $_POST['email'], $_POST['pNumber'], $_POST['address'], $_POST['dateOB'], $file_name, $randomPass, $currentDate);
    if ($result == 1) {
         $msgAlert = $oop->alert('Added successfully','warning','check-circle');
    }elseif ($result == 10) {
        $msgAlert = $oop->alert('This comelec already exist','danger','x-circle');
    }
}

// UPDATE COMELEC
if (isset($_POST['updateCom'])) {
    $id = $_GET['update'];
    $result = $oop->updateCom($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['pNumber'], $_POST['address'], $_POST['dateOB'], $file_name,$id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// DELETE COMELEC
if (isset($_POST['deleteCom'])) {
    $id = $_POST['id'];
    $result = $oop->deleteCom($id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Deleted successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "?page=comelec";} setTimeout(redirect, 2000);</script><?php
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}