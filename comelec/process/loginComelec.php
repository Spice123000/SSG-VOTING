<?php 
// COMELEC LOGIN PROCESS
if (isset($_POST['loginComelec'])) {
    $result = $oop->loginComelec($_POST['email'] ,$_POST['password']);
    if ($result == 1) {
        $msgAlert = $oop->alert('Login successfully','warning','check-circle');?>
        <script>function redirect(){window.location = "index.php?page=dashboard";} setTimeout(redirect, 2000);</script><?php
    }elseif ($result == 10) {
        $msgAlert = $oop->alert('Comelec does\'t exist','danger','x-circle');
    }
    elseif ($result == 20) {
        $msgAlert = $oop->alert('Incorrect password','danger','x-circle');
    }
}

if (isset($_POST['send_password'])) {
    $result = $oop->sendPassword($_POST['email'],$randomPass);
    if ($result == 1) {
        $msgAlert = $oop->alert('Your new password was sent to your email','warning','check-circle');?>
        <script>function redirect(){window.location = "?process=login";} setTimeout(redirect, 3000);</script><?php
    }elseif ($result == 10) {
        $msgAlert = $oop->alert('Email does\'t exist','danger','x-circle');
    }
}

