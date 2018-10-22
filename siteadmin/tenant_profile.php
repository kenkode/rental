
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');

session_start();
if(!isset($_SESSION["tenant"])){
	header("location:tenant_login.php");
	exit();
	}
$tenantID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$tenant=$_SESSION["tenant"]; 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM tenant WHERE id='$tenantID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
		
$result = mysql_query("SELECT * FROM tenant where id='".$_SESSION['id']."'");
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
 
<?php include_once("headerad1.php");?>
</nav>
  <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
<?php 
// Create the form.

echo '<form method="post">';
$id = "";
$r_name = "";
$r_email = "";
$r_contact= "";
$r_address= "";
$r_nid= "";
$r_password= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $r_name= $_POST["r_name"];
    $r_email= $_POST["r_email"];
    $r_contact= $_POST["r_contact"];
    $r_address= $_POST["r_address"];
	$r_nid= $_POST["r_nid"];
	$r_password= $_POST["r_password"];
}

echo '<div class="container">';
echo '<h2>Update Profile</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Tenant Name: </td><td><input type="text" required name="r_name" size="50" maxlength="50" value="'.$row['r_name'].'" class="textbox"/></p></td></tr>
<tr><td><p>Email: </td><td><input type="email" required name="r_email" size="50" maxlength="50" value="'.$row['r_email'].'" class="textbox"/></p></td></tr>
<tr><td><p>Contact: </td><td><input type="number" required name="r_contact" size="15" maxlength="15" value="'.$row['r_contact'].'" class="textbox"/></p></td></tr>
<tr><td><p>Address: </td><td><input type="text" required name="r_address" size="50" maxlength="50" value="'.$row['r_address'].'" class="textbox"/></p></td></tr>
<tr><td><p>National ID: </td><td><input type="text" required name="r_nid" size="50" maxlength="50" value="'.$row['r_nid'].'" class="textbox"/></p></td></tr>
<tr><td><p>Password: </td><td><input type="text" required name="r_password" size="15" maxlength="15" value="'.$row['r_password'].'" class="textbox"/></p></td></tr>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['r_name'],"Please enter full name.",$errors);
    checkIfEmpty($_POST['r_email'],"Please enter  email.",$errors);
    checkIfEmpty($_POST['r_contact'],"Please enter  phone number.",$errors);
    checkIfEmpty($_POST['r_address'],"Please enter address.",$errors);
    checkIfEmpty($_POST['r_nid'],"Please enter valid national ID.",$errors);
	checkIfEmpty($_POST['r_password'],"Please enter password.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE tenant SET r_name = '$r_name',r_email = '$r_email',r_contact = '$r_contact',r_address = '$r_address',r_nid = '$r_nid',r_password = '$r_password'
       WHERE id = '".$_SESSION['id']."'";
        addTable($dbc,$query);
		$_SESSION["tenant"]=$_POST['r_email'];
		$_SESSION["password"]=$_POST['r_password'];
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
<hr><ul><a href="tenant_dashboard.php" class="button">BACK</a>  </ul><hr>';
?>