
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');



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
		
$result = mysql_query("SELECT * FROM admin where id='".$_SESSION['id']."'");
$row = mysql_fetch_array($result);
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../style/datapicker/css/bootstrap-datepicker.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
 <title>Update Profile</title>
 <script src="../style/jquery-2.1.1.js"></script>
 <script src="../style/bootstrap.js"></script>
<script src="../style/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">

$(function(){
$('#datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    orientation: "bottom"
});
});

</script>
</head>
 <body>
<div class="container">
 <nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad.php");?>
</nav>
  <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
<?php 
// Create the form.

echo '<form method="post">';
$id = "";
$username = "";
$password= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $username= $_POST["username"];
	$password= $_POST["password"];
}

echo '<div class="container">';
echo '<h2>Update Profile</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Username: </td><td><input type="text" required name="username" size="50" maxlength="50" value="'.$row['username'].'" class="textbox"/></p></td></tr>
<tr><td><p>Password: </td><td><input type="text" required name="password" size="15" maxlength="15" value="'.$row['password'].'" class="textbox"/></p></td></tr>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['username'],"Please enter username.",$errors);
	checkIfEmpty($_POST['password'],"Please enter password.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE admin SET username = '$username',password = '$password' WHERE id = '".$_SESSION['id']."'";
        addTable($dbc,$query);
		$_SESSION["manager"]=$_POST['username'];
		$_SESSION["password"]=$_POST['password'];
		echo '<div class="success"><p class="success">Profile successfully updated!</p></div>';
    }else {  
        echo '<div class="error"><p class="error">The following error(s) occurred:<br/><ul>';
		foreach ($errors as $msg) { 
			echo "<li>$msg</li>";
		} 
		echo '</ul></p><p>Please try again.</p>';
    }
    echo '</div>';
}
echo '</div>
<hr><ul><a href="admin_dashboard.php" class="button">BACK</a>  </ul><hr>';
?>