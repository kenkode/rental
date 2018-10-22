<?php 

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
 <title>DASHBOARD</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
 <body>
 <div style="padding-top:2%;"></div>
<div class="container">
<nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad.php");?>
</nav>
<br>

    <div id="dinv"><br/>
    <div>
      <h2 align="center" style="color:#0C3; text-transform:uppercase;">admin dashboard</h2>
     <HR>
          <BR>
					<BR>
<table border="0"width="70%"align="center"><tr><td>
<ul><a href="add_landlord.php" class="button">REGISTER LANDLORD</a> </ul>
					<BR>
					<BR>
				</td>
				<td>
	<ul><a href="add_tenants.php" class="button"> REGISTER TENANT</a>  </ul>
	<BR>
	<BR>
	</td>
				<td>
	<ul><a href="add_employee.php" class="button"> REGISTER EMPLOYEE</a>  </ul>
	<BR>
	<BR>
	</td>
	<td>
	<ul><a href="add_house.php" class="button"> REGISTER HOUSE</a>  </ul>
	<BR>
	<BR>
	</td>
				</tr>
				<tr>
<td>
<ul><a href="landlorddetails.php" class="button">VIEW LANDLORDS</a> </ul>
					<BR>
					<BR>
				</td>
				<td>
	<ul><a href="tenantdetails.php" class="button"> VIEW TENANTS</a>  </ul>
	<BR>
	<BR>
	</td>
				<td>
	<ul><a href="employeedetails.php" class="button"> VIEW EMPLOYEES</a>  </ul>
	<BR>
	<BR>
	</td>
	<td>
	<ul><a href="housedetails.php" class="button"> VIEW HOUSES</a>  </ul>
	<BR>
	<BR>
	</td>
		
				</tr>
				<tr><td>
<ul><a href="add_floor.php" class="button">REGISTER FLOORS</a> </ul><BR>
	<BR></td>
	<td>
<ul><a href="add_building.php" class="button">REGISTER BUILDING</a> </ul><BR>
	<BR></td>

<td>
<ul><a href="add_bills.php" class="button">ADD BILLS</a> </ul><BR>
	<BR></td>
<td>
<ul><a href="add_salary.php" class="button">ADD Salary</a> </ul><BR>
	<BR></td>

</tr>
<tr>
<td>
<ul><a href="floordetails.php" class="button">VIEW FLOORS</a> </ul><BR>
	<BR></td>
	<td>
<ul><a href="buildingdetails.php" class="button">VIEW BUILDINGS</a> </ul><BR>
	<BR></td>
<td><ul><a href="billdetails.php" class="button">VIEW BILLINGS</a> </ul><BR>
	<BR></td>
	<td>
<ul><a href="salarydetails.php" class="button">VIEW SALARIES</a> </ul><BR>
	<BR></td>
	</tr>
	<tr>
	<td>
			<ul><a href="admin_profile.php" class="button"> PROFILE</a>  </ul>
	 <BR>
					<BR>

</td>
</tr>
</table>
<HR>

 </div>
 <BR>
 <BR>
 <?php
 include_once "../footer.php";
 ?>
 </body>
 </html>