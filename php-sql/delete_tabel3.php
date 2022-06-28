<?php
include "connect.php";

if(isset($_POST['submit'])) {
	$id = mysqli_real_escape_string($conn, $_POST['ID']);
	
	$insert = mysqli_multi_query($conn, "DELETE FROM tabel3 WHERE ID = '$id'; 
											ALTER TABLE tabel3 AUTO_INCREMENT =0");
	
	
	if(!$insert) {
		echo mysqli_error();
	}
	else
	{
		mysqli_close($conn);
		header("location:Tabel3.php");
		exit;
	}
}

mysqli_close($conn);
?>