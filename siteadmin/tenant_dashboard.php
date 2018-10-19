<?php 

session_start();
if(!isset($_SESSION["tenant"])){
	header("location:tenant_login.php");
	exit();
	}
$tenantID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$tenant=$_SESSION["tenant"]; 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM tenant WHERE id='$tenantID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
	
$tenant = mysql_query("SELECT * FROM tenant where id='".$_SESSION['id']."'");
$row = mysql_fetch_array($tenant);
$h = mysql_query("SELECT * FROM houses where id='".$row['house_id']."'");
$house = mysql_fetch_array($h);
$f = mysql_query("SELECT * FROM floors where fid='".$house['floor_id']."'");
$floor = mysql_fetch_array($f);
$b = mysql_query("SELECT * FROM building_info where bldid='".$row['building_id']."'");
$building = mysql_fetch_array($b);
?>
<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>




 <html>
<head>
 <title>DASHBOARD</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
 <body>

<nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad1.php");?>
</nav>
<br>
 <div style="padding-top:2%;"></div>
<div class="container"

   <div id="dinv"><br/>
    <div>
      <h2 align="center" style="color:#0C3; text-transform:uppercase;">tenant dashboard</h2>
	  <h4 align="center" style="color:#0C3; text-transform:uppercase;">Building:<?php echo $building['name'] ?></h4>
	  <h4 align="center" style="color:#0C3; text-transform:uppercase;">Floor:<?php echo $floor['floor_no'] ?></h4>
	  <h4 align="center" style="color:#0C3; text-transform:uppercase;">House No:<?php echo $house['unit_no'] ?></h4>
     <HR>
          
<table border="0"width="70%"align="center"><tr><td>
<ul><a href="viewbill.php" class="button">VIEW BILLS</a> </ul>
					<BR>
					<BR></td><td>
	<ul><a href="add_complaint.php" class="button"> POST COMPLAINT</a></ul>
	
	 <BR>
	 <BR>
	 </td><td>
			<ul><a href="complaintdetails.php" class="button"> VIEW COMPLAINTS</a>  </ul>
	 <BR>
					<BR>

</td><td>
			<ul><a href="profile.php" class="button"> PROFILE</a>  </ul>
	 <BR>
					<BR>

</td></tr></table>
 
 </div>
 <BR>
 <?php
 include_once "../footer.php";
 ?>
 </body>
 </html>