<?php 
// VALIDATING SUBMITED VOTES
if (isset($_POST['save_vote'])) {
    $voter_id = $_SESSION['student_id'];
    $result = $oop->submitVotes($voter_id,$_POST['pres'],$_POST['exvp'],$_POST['invp'],$_POST['gensec'],$_POST['exsec'],$_POST['aud'],$_POST['budg'],$_POST['swo'],$_POST['sen'],$currentDate,$reference_id);
    if ($result == 1) {
        $msgAlert = $oop->voterAlert('Votes Submitted','warning','fa-solid fa-circle-check');?>
        <script>function redirect(){window.location = "reference.php";} setTimeout(redirect, 2000);</script><?php
    }elseif ($result == 10) {
        $msgAlert = $oop->voterAlert('Kindy complete your votes','danger','fa-solid fa-circle-exclamation');
    }elseif ($result == 20) {
        $msgAlert = $oop->voterAlert('You already submitted your vote','danger','fa-solid fa-circle-exclamation');
    }
}

