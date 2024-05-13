$(document).ready(function(){
    setInterval(function(){
        $("#timer").load('countdown.php');
    },1000);
});
