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
 <title>Building Details</title>
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
   <h2 align="center" style="color:#0C3; text-transform:uppercase;">Building details</h2>
     <HR>
          <BR>
					<BR>
  
   <div><br/>
     <div align="left" style="margin-left:1px;">
<?php
$result = mysql_query("SELECT * FROM building_info");
$i = 0;
echo "<table id='users' border='5'style='background-color:#B2FF99'>
<thead>
<tr>
<th>ID</th>
<th>NAME</th>
<th>ADDRESS</th>
<th>SECURITY GUARD MOBILE</th>
<th>BUILDING MAKE YEAR</th>
<th>STATUS</th>
<th>ACTION</th>
</tr>
</thead><tbody>";
while($row = mysql_fetch_array($result))
{
	$i++;
echo "<tr style='width:400px;height:80px'>";
echo "<td>" . $i . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['address'] . "</td>";
echo "<td>" . $row['security_guard_mobile'] . "</td>";
echo "<td>" . $row['building_make_year'] . "</td>";
echo "<td>" . $row['status'] . "</td>";
echo "<td><a class='btn btn-info' href='edit_buildings.php?id=".$row['bldid']."'>Edit</a><br>";
if($row['status'] == 'ACTIVE'){
echo "<a class='btn btn-info' href='inactivate_buildings.php?id=".$row['bldid']."'>Inactivate</a><br>";
}else{
echo "<a class='btn btn-info' href='activate_buildings.php?id=".$row['bldid']."'>Activate</a><br>";
}
echo "<a class='btn btn-info' href='delete_buildings.php?id=".$row['bldid']."'>Delete</a></td>";
echo "</tr>";
}
echo "</tbody></table>";
mysql_close($con);
?>
</div>
<hr><ul><a href="admin_dashboard.php" class="button">BACK</a>  </ul><hr>
</body>
</html>
