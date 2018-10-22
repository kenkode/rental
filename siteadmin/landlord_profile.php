
<?php
include ('connect_to_mysql.php');
include ('common_functions.php');



session_start();
if(!isset($_SESSION["landlord"])){
	header("location:landlord_login.php");
	exit();
	}
$landlordID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$landlord=$_SESSION["landlord"]; 
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include"../sscripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM landlord WHERE ownid='$landlordID' LIMIT 1");
$existCount=mysql_num_rows($sql);
if($existCount == 0){
	echo "Your login session data is not on record in the database";
	exit();
		}
		
$landlord = mysql_query("SELECT * FROM landlord where ownid='".$_SESSION['id']."'");
$row = mysql_fetch_array($landlord);
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
 <title>Update Profile</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
</head>
 <body>
  <div style="padding-top:5%;"></div>
<div class="container">
 <nav class="nav navbar-inverse navbar-fixed-top">
 
<?php include_once("headerad2.php");?>
</nav>
  
   <div id="dinv"><br/>
     <div align="left" style="margin-left:24px;">
<?php 
// Create the form.

echo '<form method="post">';
$ownid = "";
$o_name = "";
$o_email = "";
$o_contact= "";
$o_address= "";
$o_nid= "";
$o_password= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $o_name= $_POST["o_name"];
    $o_email= $_POST["o_email"];
    $o_contact= $_POST["o_contact"];
    $o_address= $_POST["o_address"];
	$o_nid= $_POST["o_nid"];
	$o_password= $_POST["o_password"];

}

echo '<div class="container">';
echo '<h2>Update Profile</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Landlord Name:</td><td> <input type="text" name="o_name" required size="50" maxlength="50" value="'.$row['o_name'].'" class="textbox"/></p></td></tr>
<tr><td><p>Email:</td><td> <input type="email" required name="o_email" size="50" maxlength="50" value="'.$row['o_email'].'" class="textbox"/></p></td></tr>
<tr><td><p>Contact: </td><td><input type="number" required name="o_contact" size="15" maxlength="15" value="'.$row['o_contact'].'" class="textbox"/></p></td></tr>
<tr><td><p>Address: </td><td><input type="text" required name="o_address" size="50" maxlength="50" value="'.$row['o_address'].'" class="textbox"/></p></td></tr>
<tr><td><p>National ID: </td><td><input type="text" required name="o_nid" size="50" maxlength="50" value="'.$row['o_nid'].'" class="textbox"/></p></td></tr>
<tr><td><p>Password: </td><td><input type="text" required name="o_password" size="15" maxlength="15" value="'.$row['o_password'].'" class="textbox"/></p></td></tr>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    $errors = array(); 
    checkIfEmpty($_POST['o_name'],"Please enter full name.",$errors);
    checkIfEmpty($_POST['o_email'],"Please enter  email.",$errors);
    checkIfEmpty($_POST['o_contact'],"Please enter  phone number.",$errors);
    checkIfEmpty($_POST['o_address'],"Please enter address.",$errors);
    checkIfEmpty($_POST['o_nid'],"Please enter valid national ID.",$errors);
	checkIfEmpty($_POST['o_password'],"Please enter password.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE landlord SET o_name = '$o_name',o_email = '$o_email',o_contact = '$o_contact',o_address = '$o_address',o_nid = '$o_nid',o_password = '$o_password'
      WHERE ownid = '".$_SESSION['id']."'";
        addTable($dbc,$query);
		$_SESSION["landlord"]=$_POST['o_email'];
		$_SESSION["password"]=$_POST['o_password'];
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
<hr><ul><a href="landlord_dashboard.php" class="button">BACK</a>  </ul><hr>';
?>