<?php
require_once('connect.php');

function get_username($conn, $term) {
	$query = "SELECT DISTINCT USER FROM tabel2 WHERE USER like '%".$term."%' ORDER BY USER ASC";
	$result = mysqli_query($conn, $query);
	$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $data;
}

if(isset($_GET['term'])) {
	$getname = get_username($conn, $_GET['term']);
	$snlist = array();
	foreach($getname as $name){
		$snlist[] = $name['USER'];
	}
echo json_encode($snlist);
}
?>