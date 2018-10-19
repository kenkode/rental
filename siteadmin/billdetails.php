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
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
 <title>Bill Details</title>
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
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">bill details</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="center" style="margin-center:1px;">
<?php
$result = mysql_query("SELECT * FROM billing");
$i=0;
echo "<table id='users' border='5' style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>TENANT</th>
<th>BUILDING</th>
<th>MONTH</th>
<th>RENT</th>
<th>WATER BILL</th>
<th>ELECTRICITY BILL</th>
<th>GAS BILL</th>
<th>SECURITY BILL</th>
<th>UTILITY BILL</th>
<th>OTHER BILLS</th>
<th>TOTAL</th>
<th>DATE PAID</th>
<th>ACTION</th>
</tr></thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;
$t = mysql_query("SELECT * FROM tenant where id='".$row['tenant_id']."'");
$tenant = mysql_fetch_array($t);

$b = mysql_query("SELECT * FROM building_info where bldid='".$tenant['building_id']."'");
$building = mysql_fetch_array($b);

echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $tenant['r_name'] . "</td>";
echo "<td>" . $building['name'] . "</td>";
echo "<td>" . $row['month'] . "</td>";
echo "<td>" . number_format($row['rent'],2) . "</td>";
echo "<td>" . number_format($row['water_bill'],2) . "</td>";
echo "<td>" . number_format($row['electric_bill'],2) . "</td>";
echo "<td>" . number_format($row['gas_bill'],2) . "</td>";
echo "<td>" . number_format($row['security_bill'],2) . "</td>";
echo "<td>" . number_format($row['utility_bill'],2) . "</td>";
echo "<td>" . number_format($row['other_bill'],2) . "</td>";
echo "<td>" . number_format($row['total_rent'],2) . "</td>";
echo "<td>" . $row['issue_date'] . "</td>";
echo "<td><a class='btn btn-info' href='edit_bills.php?id=".$row['owner_utility_id']."'>Edit</a><br>";
echo "<a class='btn btn-info' href='delete_bills.php?id=".$row['owner_utility_id']."'>Delete</a></td>";
echo "</tr>";
}
echo "</tbody></table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="admin_dashboard.php" class="button">BACK</a>  </ul><hr>
</html>