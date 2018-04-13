<?php
session_start();

include_once 'Scripts/helperScripts.php';
endSession();
header('Location: signin.php');

?>