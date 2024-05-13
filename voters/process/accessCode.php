<?php 
// VALIDATING ACCESS CODE
if (isset($_POST['verify_ac'])) {
    $result = $oop->verifyAC($_POST['access_code'], $voter_id, $currentDate);
    if ($result == 1) {
        $msgAlert = $oop->voterAlert('Proceeding','warning','fa-solid fa-circle-check');?>
        <script>function redirect(){window.location = "voters/?process=vote_now";} setTimeout(redirect, 2000);</script><?php
    }elseif ($result == 10) {
        $msgAlert = $oop->voterAlert('Access code is already used','danger','fa-solid fa-circle-exclamation');
    }
    elseif ($result == 20) {
        $msgAlert = $oop->voterAlert('Invalid access code','danger','fa-solid fa-circle-exclamation');
    }
}

