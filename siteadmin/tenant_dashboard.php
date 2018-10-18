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
$sql=mysql_query("SELECT * FROM tenant_login WHERE  id='$tenantID' AND username='$tenant' AND password='$password' LIMIT 1");
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

<nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad1.php");?>
</nav>
<br>
 <div style="padding-top:2%;"></div>
<div class="container"

   <div id="dinv"><br/>
    <div>
      <h2 align="center" style="color:#0C3; text-transform:uppercase;">tenant dashboard</h2>
     <HR>
          

<ul><a href="agentregistrationform.php" class="button">VIEW BILLS</a> </ul>
					<BR>
					<BR>
				
	<ul><a href="agentdetails.php" class="button"> BILLS HISTORY</a>  </ul>
	<BR>
	<BR>
	<ul><a href="landlorddetails.php" class="button"> POST COMPLAINT</a></ul>
	
	 <BR>
	 <BR>
			<ul><a href="deleteagents.html" class="button"> POST AD'S</a>  </ul>
	 <BR>
					<BR>


 
 </div>
 <BR>
 <?php
 include_once "../footer.php";
 ?>
 </body>
 </html>