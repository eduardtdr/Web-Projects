<?php
require_once('connect.php');

function get_username($conn, $term) {
	$query = "SELECT LNAME FROM tabel3 WHERE LNAME like '%".$term."%' ORDER BY USER ASC";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $data;
}

if(isset($_GET['term'])) {
	$getname = get_username($conn, $_GET['term']);
	$lnamelist = array();
	foreach($getname as $name){
		$lnamelist[] = $name['LNAME'];
	}
echo json_encode($lnamelist);
}
?>