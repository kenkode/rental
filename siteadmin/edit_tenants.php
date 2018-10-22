
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
		
$result = mysql_query("SELECT * FROM tenant where id='".$_REQUEST['id']."'");
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
 <title>Edit Tenant</title>
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
$r_name = "";
$r_email = "";
$r_contact= "";
$r_address= "";
$r_nid= "";
$house_id= "";
$r_advance= "";
$r_rent_pm= "";
$r_date= "";
$r_password= "";
$building_id= "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $r_name= $_POST["r_name"];
    $r_email= $_POST["r_email"];
    $r_contact= $_POST["r_contact"];
    $r_address= $_POST["r_address"];
	$r_nid= $_POST["r_nid"];
	$house_id= $_POST["house_id"];
    $r_advance= str_replace(',','',$_POST["r_advance"]);
	$r_rent_pm= str_replace(',','',$_POST["r_rent_pm"]);
    $r_date= $_POST["r_date"];
	$r_password= $_POST["r_password"];
	$building_id= $_POST["building_id"];
}

echo '<div class="container">';
echo '<h2>Edit Tenant Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Tenant Name: </td><td><input type="text" required name="r_name" size="50" maxlength="50" value="'.$row['r_name'].'" class="textbox"/></p></td></tr>
<tr><td><p>Email: </td><td><input type="email" required name="r_email" size="50" maxlength="50" value="'.$row['r_email'].'" class="textbox"/></p></td></tr>
<tr><td><p>Contact: </td><td><input type="number" required name="r_contact" size="15" maxlength="15" value="'.$row['r_contact'].'" class="textbox"/></p></td></tr>
<tr><td><p>Address: </td><td><input type="text" required name="r_address" size="50" maxlength="50" value="'.$row['r_address'].'" class="textbox"/></p></td></tr>
<tr><td><p>National ID: </td><td><input type="text" required name="r_nid" size="50" maxlength="50" value="'.$row['r_nid'].'" class="textbox"/></p></td></tr>
<tr><td><p>Building</p></td><td><p>
<select name="building_id" id="building_id" required>';
$result = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE'");
while($r = mysql_fetch_array($result))
{
if ($r['bldid']==$row["building_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$r['bldid'].'" '.$selected.'>'.$r['name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Unit No.</p></td><td><p>
<select name="house_id" id="house_id" required>';
$b = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE' AND bldid='".$row['building_id']."'");
$building = mysql_fetch_array($b);
$result = mysql_query("SELECT * FROM houses WHERE status = 'VACANT' AND building_id='".$building['bldid']."'");
while($h = mysql_fetch_array($result))
{
if ($h['id']==$row["house_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$h['id'].'" '.$selected.'>'.$h['unit_no'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Advance Rent: </td><td><input type="text" required name="r_advance" size="50" maxlength="50" value="'.$row['r_advance'].'" class="textbox"/></p></td></tr>
<tr><td><p>Rent Per Month: </td><td><input type="text" required name="r_rent_pm" size="50" maxlength="50" value="'.$row['r_rent_pm'].'" class="textbox"/></p></td></tr>
<tr><td><p>Rent Date: </td><td><input type="text" required name="r_date" size="50" maxlength="50" value="'.$row['r_date'].'" id="datepicker" class="textbox"/><label>(YYYY-MM-DD)</label></td></tr>
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
	checkIfEmpty($_POST['house_id'],"Please Rented Unit Number.",$errors);
    checkIfEmpty($_POST['r_advance'],"Please enter  House Deposit.",$errors);
    checkIfEmpty($_POST['r_rent_pm'],"Please expected Rent per Month.",$errors);
    checkIfEmpty($_POST['r_date'],"Please starting rent date.",$errors);
	checkIfEmpty($_POST['r_password'],"Please enter password.",$errors);
	checkIfEmpty($_POST['building_id'],"Please enter Buildings ID.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
        $query = "UPDATE tenant SET r_name = '$r_name',r_email = '$r_email',r_contact = '$r_contact',r_address = '$r_address',r_nid = '$r_nid',house_id = '$house_id',r_advance = '$r_advance',r_rent_pm = '$r_rent_pm',r_date = '$r_date',r_password = '$r_password',building_id = '$building_id'
       WHERE id = '".$_REQUEST['id']."'";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Tenant successfully updated!</p></div>';
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

<script>
$(document).ready(function(){

    $("#building_id").change(function(){
        var building_id = $(this).val();

        $.ajax({
            url: 'get_houses.php',
            type: 'post',
            data: {building_id:building_id},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#house_id").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var unit_no = response[i]['unit_no'];
                    
                    $("#house_id").append("<option value='"+id+"'>"+unit_no+"</option>");

                }
            }
        });
    });

});
</script>