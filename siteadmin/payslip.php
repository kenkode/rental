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
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
 <title>Payslip</title>
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
 
<?php include_once("headerad3.php");?>
</nav><br><br><br>
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">payslip</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="center" style="margin-center:1px;">
<?php
$result = mysql_query("SELECT * FROM employee_salary_setup WHERE employee_id = '".$_SESSION['id']."'");
$i=0;

$amount = 0;

echo "<table id='users' border='5' style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>MONTH</th>
<th>YEAR</th>
<th>AMOUNT</th>
<th>DATE PAID</th>
</tr></thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;

$amount = $amount + $row['amount'];

echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $row['month'] . "</td>";
echo "<td>" . $row['xyear'] . "</td>";
echo "<td>" . number_format($row['amount'],2) . "</td>";
echo "<td>" . $row['issue_date'] . "</td>";
echo "</tr>";
}
echo "</tbody>
<tfoot>
<tr>
<td colspan = '3'><strong>Total</strong></td>
<td><strong>".number_format($amount,2)."</strong></td>
</tr>
</tfoot>
</table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="admin_dashboard.php" class="button">BACK</a>  </ul><hr>
</html>