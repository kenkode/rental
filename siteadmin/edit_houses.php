
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
		
$result = mysql_query("SELECT * FROM houses where id='".$_REQUEST['id']."'");
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
 <title>Edit House</title>
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
$id = "";
$floor_id = "";
$unit_no = "";
$building_id= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $floor_id= $_POST["floor_id"];
    $unit_no= $_POST["unit_no"];
	$building_id= $_POST["building_id"];

}

echo '<div class="container">';
echo '<h2>Edit House Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Floor No.</p></td><td><p>
<select name="floor_id" required>';
$result = mysql_query("SELECT * FROM floors");
while($floor = mysql_fetch_array($result))
{
if ($floor['fid']==$row["floor_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$floor['fid'].'" '.$selected.'>'.$floor['floor_no'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>House No: </td><td><input type="text" required name="unit_no" size="50" maxlength="50" value="'.$row['unit_no'].'" class="textbox"/></p></td></tr>
<tr><td><p>Building</p></td><td><p>
<select name="building_id" required>';
$result = mysql_query("SELECT * FROM building_info");
while($r = mysql_fetch_array($result))
{
if ($r['bldid']==$row["building_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$r['bldid'].'" '.$selected.'>'.$r['name'].'</option>';
}
echo '</select></p></td></tr></table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    $errors = array(); 
    checkIfEmpty($_POST['floor_id'],"Please enter full name.",$errors);
    checkIfEmpty($_POST['unit_no'],"Please enter  email.",$errors);
	checkIfEmpty($_POST['building_id'],"Please enter Buildings ID.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE houses SET floor_id = '$floor_id',unit_no = '$unit_no',building_id = '$building_id' WHERE id = '".$_REQUEST['id']."'";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">House successfully updated!</p></div>';
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