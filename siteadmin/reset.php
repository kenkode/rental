<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset</title>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="modal-content">
<div class="modal-dialog">
<?php
include "../sscripts/connect_to_mysql.php";
if (isset($_POST['reset'])){
	$username=$_POST['email'];
	$pass=$_POST['password'];
	$confirm=$_POST['confirm'];
	
	if ($confirm==$pass){
		
		
		$sql="update admin set password='".$pass."' where email_addr='".$username."'";
		mysql_query($sql);
		
		
		
	}else{
		
		
		echo"the password did not match";
		
		}
	
	
}
?>

<form method="post" action="reset.php">
<table><tr><td>Email Address</td><td>
<input type="email" name ="email" placeholder="---" required></td></tr>
<tr><td>New Password</td><td>
<input type="password" name ="password" placeholder="---" required></td></tr>
<tr><td>Confirm Password</td><td>
<input type="password" name ="confirm" placeholder="confirm Password" required></td></tr>
<tr align="center"><td><input type="submit" value="Reset" name="reset"></td></tr>

</form>
<p align="centre"><a href="admin_login.php">Click Here</a>To Go to Login</p>

</div>
</div>
</body>
</html>