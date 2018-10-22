<?php
include ('connect_to_mysql.php');
include ('common_functions.php');

session_start();
if(!isset($_SESSION["employee"])){
	header("location:employee_login.php");
	exit();
	}
$employeeID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$employee=$_SESSION["employee"]; 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM employee WHERE eid='$employeeID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
 <title>Landlord Details</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
<link href="../style/jquery.dataTables.min.css" rel="stylesheet">
<script src="../style/jquery-2.1.1.js"></script>
 <script src="../style/bootstrap.js"></script>
<script src="../style/jquery.dataTables.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $('#users').dataTable();            
  });
   </script>
</head>

 <body>
  <div style="padding-top:0%;"></div>
<div class="container">
<nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad.php");?>
</nav><br><br><br>
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">Landlord details</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="left" style="margin-left:1px;">
<?php
$result = mysql_query("SELECT * FROM landlord");
$i = 0;
echo "<table id='users' border='5'style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>NAME</th>
<th>EMAIL</th>
<th>PHONENUMBER</th>
<th>ADDRESS</th>
<th>NATIONAL ID</th>
<th>PASSWORD</th>
<th>BUILDING ID</th>
<th>STATUS</th>
<th>ACTION</th>
</tr>
</thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;
echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $row['o_name'] . "</td>";
echo "<td>" . $row['o_email'] . "</td>";
echo "<td>" . $row['o_contact'] . "</td>";
echo "<td>" . $row['o_address'] . "</td>";
echo "<td>" . $row['o_nid'] . "</td>";
echo "<td>" . $row['o_password'] . "</td>";
$b = mysql_query("SELECT * FROM building_info WHERE bldid='".$row['building_id']."'");
$building = mysql_fetch_array($b);
echo "<td>" . $building['name'] . "</td>";
echo "<td>" . $row['status'] . "</td>";
echo "<td><a class='btn btn-info' href='e_edit_landlords.php?id=".$row['ownid']."'>Edit</a><br>";
if($row['status'] == 'ACTIVE'){
echo "<a class='btn btn-info' href='e_inactivate_landlords.php?id=".$row['ownid']."'>Inactivate</a><br>";
}else{
echo "<a class='btn btn-info' href='e_activate_landlords.php?id=".$row['ownid']."'>Activate</a><br>";
}
echo "<a class='btn btn-info' href='e_delete_landlords.php?id=".$row['ownid']."'>Delete</a></td>";
echo "</tr>";
}
echo "</tbody></table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="employee_dashboard.php" class="button">BACK</a>  </ul><hr>
</body>
</html>
