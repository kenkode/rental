
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');
include"../sscripts/connect_to_mysql.php";
		
$building_id = $_POST['building_id'];   // department id

$sql = "SELECT id,unit_no FROM houses WHERE status = 'VACANT' AND building_id=".$building_id;

$result = mysql_query($sql);

$houses_arr = array();

while( $row = mysql_fetch_array($result) ){
    $id = $row['id'];
    $unit_no = $row['unit_no'];

    $houses_arr[] = array("id" => $id, "unit_no" => $unit_no);
}

// encoding array to json format
echo json_encode($houses_arr);
?>