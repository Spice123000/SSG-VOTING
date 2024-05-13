<?php 
// CREATE PARTY LIST
if (isset($_POST['addPL'])) {
    $result = $oop->addPL($_POST['party_list'],$currentDate);
    if ($result == 1) {
        $msgAlert = $oop->alert('Added successfully','warning','check-circle');
   }elseif ($result == 10) {
       $msgAlert = $oop->alert('Party List already exist','danger','x-circle');
   }
}

// UPDATE PARTY LIST
if (isset($_POST['updatePL'])) {
    $id = $_GET['update'];
    $result = $oop->updatePL($_POST['party_list'],$id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Updated successfully','warning','check-circle');
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}

// DELETE PARTY LIST
if (isset($_POST['deletePL'])) {
    $id = $_POST['id'];
    $result = $oop->deletePL($id);
    if ($result == 1) {
        $msgAlert = $oop->alert('Deleted successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "?page=partylist";} setTimeout(redirect, 2000);</script><?php
    }
    elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}