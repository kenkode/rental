<?php 

session_start();
if(!isset($_SESSION["landlord"])){
	header("location:landlord_login.php");
	exit();
	}
$landlordID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$landlord=$_SESSION["landlord"]; 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM landlord WHERE ownid='$landlordID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
		
$landlord = mysql_query("SELECT * FROM landlord where ownid='".$_SESSION['id']."'");
$row = mysql_fetch_array($landlord);
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
 <title>View Complaints</title>
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
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">View Complaints</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="center" style="margin-center:1px;">
<?php
$result = mysql_query("SELECT * FROM complaints left join tenant on complaints.tenant_id = tenant.id where building_id='".$row['building_id']."'");
$i=0;
echo "<table id='users' border='5' style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>TITLE</th>
<th>COMPLAINT</th>
<th>DATE</th>
</tr></thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;

echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $row['c_title'] . "</td>";
echo "<td>" . $row['c_description'] . "</td>";
echo "<td>" . $row['c_date'] . "</td>";
echo "</tr>";
}
echo "</tbody></table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="landlord_dashboard.php" class="button">BACK</a>  </ul><hr>
</html>