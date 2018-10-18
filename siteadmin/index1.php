<?php 
session_start();
if(!isset($_SESSION["tenant"])){
	header("location:tenant_login.php");
	exit();
	}
$tenantID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$tenant=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["tenant"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT id FROM tenant_login WHERE  id='$tenantID' AND username='$tenant' AND password='$password' LIMIT 1");
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
 <title>tenant Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>
 <body>
 <div style="padding-top:10%;"></div>
<div class="container">

   <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
     <h2>Welcome Tenant, what would you like to do today?</h2> </br>
	 <h3>you'll be able to :</h3>
	 <li>View your House Bills</li>
	 <li>Lodge Complaints</li>
	 <li>Post Ad's on our E-Market</li>
	 
       <p><a href="tenant_dashboard.php">Click to Proceed</a><br/></p>
       
     </div>
</div>
  
 
 </body>
 </html>