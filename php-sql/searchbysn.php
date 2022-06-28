<?php
require_once('connect.php');

function get_username($conn, $term) {
	$query = "SELECT SN FROM tabel1 WHERE SN like '%".$term."%' ORDER BY SN ASC";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $data;
}

if(isset($_GET['term'])) {
	$getname = get_username($conn, $_GET['term']);
	$snlist = array();
	foreach($getname as $name){
		$snlist[] = $name['SN'];
	}
echo json_encode($snlist);
}
?>