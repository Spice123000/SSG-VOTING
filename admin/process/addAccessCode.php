<?php 
// ADD ACCESS CODE
if (isset($_POST['addAC'])) {
    $result = $oop->addAC();
    if ($result == 1) {
        $msgAlert = $oop->alert('Successfully generated 50 access code','warning','check-circle');
    }elseif ($result == 10) {
        $msgAlert = $oop->alert('An error occured','danger','x-circle');
    }
}