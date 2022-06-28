<?php

include "connect.php";


$type = 0;
if(isset($_POST['type'])){
   $type = $_POST['type'];
}


if($type == 1){
    $searchText = mysqli_real_escape_string($con,$_POST['search']);

    $sql = mysqli_query($conn,"SELECT ID, NUME FROM useri where NUME like '%".$searchText."%' ORDER BY NUME asc limit 15");

    $search_arr = array();

    while($row = mysqli_fetch_array($sql)){
        $id = $fetch['ID'];
        $nume = $fetch['NUME'];

        $search_arr[] = array("ID" => $id, "NUME" => $nume);
    }

    echo json_encode($search_arr);
}
?>