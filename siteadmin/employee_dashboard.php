<?php 

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
 <title>DASHBOARD</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
 <body>
 <div style="padding-top:2%;"></div>
<div class="container">
<nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad3.php");?>
</nav>
<br>

   <div id="dinv"><br/>
    <div>
      <h2 align="center" style="color:#0C3; text-transform:uppercase;">employee dashboard</h2>
     <HR>
          <BR>
					<BR>
<table border="0"width="70%"align="center"><tr><td>
<ul><a href="e_add_landlord.php" class="button">REGISTER LANDLORD</a> </ul>
					<BR>
					<BR>
				</td>
				<td>
	<ul><a href="e_add_tenant.php" class="button"> REGISTER TENANT</a>  </ul>
	<BR>
	<BR>
	</td>
	
				</tr>
				<tr>
<td>
<ul><a href="viewlandlord.php" class="button">VIEW LANDLORD</a> </ul>
					<BR>
					<BR>
				</td>
				<td>
	<ul><a href="viewtenant.php" class="button"> VIEW TENANT</a>  </ul>
	<BR>
	<BR>
	</td>
		
				</tr>
				<tr><td>
<ul><a href="eviewcomplaints.php" class="button">VIEW COMPLAINTS</a> </ul><BR>
	<BR></td>
<td>
<ul><a href="payslip.php" class="button">VIEW PAYSLIP</a> </ul><BR>
	<BR></td>
</tr>
<tr><td>
			<ul><a href="employee_profile.php" class="button"> PROFILE</a>  </ul>
	 <BR>
					<BR></td>
		
				</tr>
 </table>
 </div>
 <BR>
 <?php
 include_once "../footer.php";
 ?>
 </body>
 </html>