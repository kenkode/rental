<?php 

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
		
$tenant = mysql_query("SELECT * FROM landlord WHERE ownid='$landlordID'");
$row = mysql_fetch_array($tenant);
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
 
<?php include_once("headerad2.php");?>
</nav>
<br>
<div style="padding-top:2%;"></div>
<div class="container"

   <div id="dinv"><br/>
   
<div>
      <h2 align="center" style="color:#0C3; text-transform:uppercase;">landlord dashboard</h2>
	  <h4 align="center" style="color:#0C3; text-transform:uppercase;">Building:<?php echo $building['name'] ?></h4>
     <HR>
          
<table border="0"width="70%"align="center"><tr><td>
<ul><a href="viewrent.php" class="button">VIEW PAYMENTS</a> </ul>
					<BR>
					<BR>
			</td><td>	
	<ul><a href="occupiedhouses.php" class="button"> VIEW OCCUPIED HOUSES</a>  </ul>
	<BR>
	<BR>
	</td><td>
	<ul><a href="vacanthouses.php" class="button"> VIEW VACANT HOUSES</a></ul>
	
	 <BR>
	 <BR>
	 </td><td>
			<ul><a href="viewcomplaints.php" class="button"> VIEW COMPLAINTS</a>  </ul>
	 <BR>
					<BR>
</td><td>
			<ul><a href="landlord_profile.php" class="button"> PROFILE</a>  </ul>
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