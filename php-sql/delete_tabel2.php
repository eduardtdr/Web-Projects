<?php
include "connect.php";

if(isset($_POST['submit'])) {
	$sn = mysqli_real_escape_string($conn, $_POST['SN']);
	
	$delete = mysqli_multi_query($conn, " DELETE FROM tabel2 WHERE SN = '$sn'; 
											ALTER TABLE tabel2 auto_increment = 0; 
												UPDATE tabel1 SET status = 'disponibil' WHERE SN = '$sn';");
	
	
	if(!$delete) {
		echo mysqli_error();
	}
	else
	{
		mysqli_close($conn);
		header("location:Tabel2.php");
		exit;
	}
}

mysqli_close($conn);
?>