<?php 
session_start();
if(isset($_SESSION["tenant"])){
	header("location:tenant_dashboard.php");
	exit();
	}
	?>
<?php
if(isset($_POST["username"])&&isset($_POST["password"])){
		
		$tenant=$_POST["username"];
		$password=preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);
include "../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT id FROM tenant WHERE (r_email='$tenant' OR r_contact='$tenant') AND r_password='$password'");
$existCount=mysql_num_rows($sql);
if($existCount == 1){
	while($row=mysql_fetch_array($sql)){
		$id = $row["id"];
		}
		$_SESSION["id"]=$id;
	    $_SESSION["tenant"]=$tenant;
		$_SESSION["password"]=$password;
		header("location:tenant_dashboard.php");
		exit();
}
else{
	echo"That information is incorrect,try again!<a href='tenant_login.php'> Click Here.</a>";
	exit();
}
	}
?>
<html>
<head>
<title>Tenant Log In</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">

</head>
 <body>

  
  <div class="modal-content">
<div class="modal-dialog">
   <fieldset>
<legend align="center">
<img src="../images/icon-admin.png" width="50px" height="50px">
</legend>
    
       <h2>Please Log In </h2>
       <form id="form1"name="form1"method="post"action="tenant_login.php">
          Email/ Phone No:<br/>
           <input name="username"type="text"id="username"size="20"/>
           <br/><br/>
           Password:<br/>
           <input name="password"type="password"id="password"size="20"/>
           <br/><br/><br/>
             <input type="submit"name="button"id="button"value="Log In"/>
         </form>
		 <a href="forget.php">Forgot Password??</a>
		 <a href="../index.php">Home</a></li>
         <p>&nbsp;</p> 
         </fieldset>     
</div>

</div>
  
 
 </body>
 </html>