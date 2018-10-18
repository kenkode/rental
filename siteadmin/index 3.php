<?php 
session_start();
if(!isset($_SESSION["employee"])){
	header("location:employee_login.php");
	exit();
	}
$employeeID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$employee=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["employee"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT id FROM employee_login WHERE  id='$employeeID' AND username='$employee' AND password='$password' LIMIT 1");
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
 <title>employee Area</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>
 <body>
 <div style="padding-top:10%;"></div>
<div class="container">
 
  
   <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
     <h2>Welcome Employee, what would you like to do today?</h2> </br>
	 <h3>you can be able to :</h3>
	 <li>Register and Delete Landlords</li>
	 <li>Register and Delete Tenants</li>
	 <li>Collect Rent and Update Billings </li>
	 <li>View Complaints</li>
       <p><a href="employee_dashboard.php">Click to Proceed</a><br/></p>
       
     </div>
</div>
  
 
 </body>
 </html>