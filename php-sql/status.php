<?php
include "connect.php";

	session_start();
	if(isset($_SESSION['id']) && $_SESSION['id'] != '')
		echo true;
	else
		echo false;
?> 
