<?php
include ('connect_to_mysql.php');
include ('common_functions.php');

session_start();
if(!isset($_SESSION["landlord"])){
	header("location:landlord_login.php");
	exit();
	}
$landlordID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$landlord=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["landlord"]); 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM landlord WHERE ownid='$landlordID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
		
$l = mysql_query("SELECT * FROM landlord WHERE ownid='$landlordID'");
$landlord = mysql_fetch_array($l);
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
 
<?php include_once("headerad2.php");?>
</nav><br><br><br>
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">bill details</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="center" style="margin-center:1px;">
<?php
$result = mysql_query("SELECT * FROM billing left join tenant on billing.tenant_id = tenant.id WHERE building_id = '".$landlord['building_id']."'");
$i=0;

$rent = 0;
$water_bill = 0;
$electric_bill = 0;
$gas_bill = 0;
$security_bill = 0;
$utility_bill = 0;
$other_bill = 0;
$total_rent = 0;

echo "<table id='users' border='5' style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>TENANT</th>
<th>HOUSE NO.</th>
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
</tr></thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;

$h = mysql_query("SELECT * FROM houses where id='".$row['house_id']."'");
$house = mysql_fetch_array($h);

$rent = $rent + $row['rent'];
$water_bill = $water_bill + $row['water_bill'];
$electric_bill = $electric_bill + $row['electric_bill'];
$gas_bill = $gas_bill + $row['gas_bill'];
$security_bill = $security_bill + $row['security_bill'];
$utility_bill = $utility_bill + $row['utility_bill'];
$other_bill = $other_bill + $row['other_bill'];
$total_rent = $total_rent + $row['total_rent'];

echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $row['r_name'] . "</td>";
echo "<td>" . $house['unit_no'] . "</td>";
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
echo "</tr>";
}
echo "</tbody>
<tfoot>
<tr>
<td colspan = '4'><strong>Total</strong></td>
<td><strong>".number_format($rent,2)."</strong></td>
<td><strong>".number_format($water_bill,2)."</strong></td>
<td><strong>".number_format($electric_bill,2)."</strong></td>
<td><strong>".number_format($gas_bill,2)."</strong></td>
<td><strong>".number_format($security_bill,2)."</strong></td>
<td><strong>".number_format($utility_bill,2)."</strong></td>
<td><strong>".number_format($other_bill,2)."</strong></td>
<td><strong>".number_format($total_rent,2)."</strong></td>
<td></td>
</tr>
</tfoot>
</table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="landlord_dashboard.php" class="button">BACK</a>  </ul><hr>
</html>