<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	session_destroy();
	unset($_SESSION['usr_id']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>