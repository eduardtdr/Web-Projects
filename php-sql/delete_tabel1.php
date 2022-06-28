<?php
include "connect.php";

if(isset($_POST['submit'])) {
	$id = mysqli_real_escape_string($conn, $_POST['ID']);
	//$id = $_POST['ID'];
	
	$insert = mysqli_multi_query($conn, "DELETE FROM tabel1 WHERE ID = '$id'; 
											ALTER TABLE tabel1 AUTO_INCREMENT =0");

	if(!$insert) {
		echo mysqli_error();
	}
	else
	{
		mysqli_close($conn);
		header("location:Tabel1.php");
		exit;
	}
}

mysqli_close($conn);
?>