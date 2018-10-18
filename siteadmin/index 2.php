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
$sql=mysql_query("SELECT id FROM landlord_login WHERE  id='$landlordID' AND username='$landlord' AND password='$password' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	header("location:../index.php");
	exit();
		}
?>
 <html>
<head>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
 <title>landlord Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>
 <body>
 <div style="padding-top:10%;"></div>
<div class="container">
 
  
   <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
     <h2>Welcome LandLord, what would you like to do today?</h2> </br>
	 <h3>you can be able to :</h3>
	 <li>View your House Payments</li>
	 <li>View Vacant and Occupied Apartments </li>
	 <li>View Complaints</li>
       <p><a href="landlord_dashboard.php">Click to Proceed</a><br/></p>
       
     </div>
</div>
  
 
 </body>
 </html>