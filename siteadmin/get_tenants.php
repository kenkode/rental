
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');



session_start();
if(!isset($_SESSION["manager"])){
	header("location:admin_login.php");
	exit();
	}
$managerID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$manager=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]); 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE  id='$managerID' AND username='$manager' AND password='$password' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
		
$building_id = $_POST['building_id'];   // department id

$sql = "SELECT id,r_name,r_rent_pm FROM tenant WHERE building_id=".$building_id;

$result = mysql_query($sql);

$tenants_arr = array();

while( $row = mysql_fetch_array($result) ){
    $id = $row['id'];
    $name = $row['r_name'];
	$rent = $row['r_rent_pm'];

    $tenants_arr[] = array("id" => $id, "name" => $name, "rent" => $rent);
}

// encoding array to json format
echo json_encode($tenants_arr);
?>