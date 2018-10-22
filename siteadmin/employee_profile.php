
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');

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

$result = mysql_query("SELECT * FROM employee where eid='".$_SESSION['id']."'");
$row = mysql_fetch_array($result);
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
 <title>Update Profile</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
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
  <div style="padding-top:5%;"></div>
<div class="container">
  <nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad.php");?>
</nav>
  
   <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
<?php 
// Create the form.

echo '<form method="post">';
$eid = "";
$e_name = "";
$e_email = "";
$e_contact= "";
$e_address= "";
$e_nid= "";
$e_designation = "";
$e_date= "";
$e_password= "";
$building_id= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $e_name= $_POST["e_name"];
    $e_email= $_POST["e_email"];
    $e_contact= $_POST["e_contact"];
    $e_address= $_POST["e_address"];
	$e_nid= $_POST["e_nid"];
	$e_password= $_POST["e_password"];

}

echo '<div class="container">';
echo '<h2>Update Profile</h2>' ;   

echo '  <table border="0">
<tr><td><p>employee Name: </td><td><input type="text" required name="e_name" size="50" maxlength="50" value="'.$row['e_name'].'" class="textbox"/></p>
<tr><td><p>Email: </td><td><input type="email" required name="e_email" size="50" maxlength="50" value="'.$row['e_email'].'" class="textbox"/></p>
<tr><td><p>Contact: </td><td><input type="number" required name="e_contact" size="15" maxlength="15" value="'.$row['e_contact'].'" class="textbox"/></p>
<tr><td><p>Address: </td><td><input type="text" required name="e_address" size="50" maxlength="50" value="'.$row['e_address'].'" class="textbox"/></p>
<tr><td><p>National ID: </td><td><input type="text" required name="e_nid" size="50" maxlength="50" value="'.$row['e_nid'].'" class="textbox"/></p>
<tr><td><p>Password: </td><td><input type="text" required name="e_password" size="15" maxlength="15" value="'.$row['e_password'].'" class="textbox"/></p>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['e_name'],"Please enter full name.",$errors);
    checkIfEmpty($_POST['e_email'],"Please enter  email.",$errors);
    checkIfEmpty($_POST['e_contact'],"Please enter  phone number.",$errors);
    checkIfEmpty($_POST['e_address'],"Please enter address.",$errors);
    checkIfEmpty($_POST['e_nid'],"Please enter valid national ID.",$errors);
    checkIfEmpty($_POST['e_password'],"Please enter password.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE employee SET e_name = '$e_name', e_email = '$e_email',e_contact = '$e_contact',e_address = '$e_address',e_nid = '$e_nid',e_password = '$e_password'
                 WHERE eid = '".$_SESSION['id']."'";
        addTable($dbc,$query);
		$_SESSION["employee"]=$_POST['e_email'];
		$_SESSION["password"]=$_POST['e_password'];
		echo '<div class="success"><p class="success">Employee successfully updated!</p></div>';
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
<hr><ul><a href="employee_dashboard.php" class="button">BACK</a>  </ul><hr>';
?>