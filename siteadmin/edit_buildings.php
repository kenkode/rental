
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

$result = mysql_query("SELECT * FROM building_info where bldid='".$_REQUEST['id']."'");
$row = mysql_fetch_array($result);
?>

<?php 

error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<html>
<head>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
 <title>Edit Building</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen"/>
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
$name = "";
$address = "";
$security_guard_mobile= "";
$building_make_year= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $name= $_POST["name"];
    $address= $_POST["address"];
	$security_guard_mobile= $_POST["security_guard_mobile"];
	$building_make_year= $_POST["building_make_year"];

}

echo '<div class="container">';
echo '<h2>Edit Building Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Name:</td><td> <input type="text" name="name" required size="50" maxlength="50" value="'.$row['name'].'" class="textbox"/></p></td></tr>
<tr><td><p>Address: </td><td><input type="text" required name="address" size="50" maxlength="50" value="'.$row['address'].'" class="textbox"/></p></td></tr>
<tr><td><p>Security Guard Mobile: </td><td><input type="text" name="security_guard_mobile" size="50" maxlength="50" value="'.$row['security_guard_mobile'].'" class="textbox"/></p></td></tr>
<tr><td><p>Building Make Year: </td><td><input type="text" name="building_make_year" size="15" maxlength="15" value="'.$row['building_make_year'].'" class="textbox"/></p></td></tr>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    $errors = array(); 
    checkIfEmpty($_POST['name'],"Please enter full name.",$errors);
    checkIfEmpty($_POST['address'],"Please enter address.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE building_info SET name = '$name',address = '$address',security_guard_mobile = '$security_guard_mobile',building_make_year = '$building_make_year'
      WHERE bldid='".$_REQUEST['id']."'";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Building successfully updated!</p></div>';
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