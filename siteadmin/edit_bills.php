
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
		
$result = mysql_query("SELECT * FROM billing where owner_utility_id='".$_REQUEST['id']."'");
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
 <title>Edit Bills</title>
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

echo '<form action="add_bills.php" method="post">';
$tenant_id = $row['tenant_id'];
$month= $row['month'];
$rent= $row['rent'];
$water_bill= $row['water_bill'];
$electric_bill= $row['electric_bill'];
$gas_bill= $row['gas_bill'];
$security_bill= $row['security_bill'];
$utility_bill= $row['utility_bill'];
$other_bill= $row['other_bill'];
$total_rent= $row['total_rent'];
$issue_date = $row['issue_date'];

//Populate Value from Form Submit - Stickeness

echo '<div class="container">';
echo '<h2>Edit Bill Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Building</p></td><td><p>
<select name="building_id" id="building_id" required>';
$bresult = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE'");
echo mysql_num_rows($bresult);
$tb = mysql_query("SELECT * FROM tenant WHERE id='".$row['tenant_id']."'");
$rtb = mysql_fetch_array($tb);
while($r = mysql_fetch_array($bresult))
{
if ($r['bldid']==$rtb["building_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$row['bldid'].'" '.$selected.'>'.$row['name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Tenant</p></td><td><p>
<select name="tenant_id" id="tenant_id" required>';
$b = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE' LIMIT 1");
$building = mysql_fetch_array($b);
$tresult = mysql_query("SELECT * FROM tenant WHERE status = 'ACTIVE'  AND building_id='".$building['bldid']."'");

$t = mysql_query("SELECT * FROM tenant WHERE status = 'ACTIVE' AND building_id='".$building['bldid']."' LIMIT 1");
$tenant = mysql_fetch_array($t);
while($t = mysql_fetch_array($tresult))
{
if ($t['id']==$row["tenant_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['r_name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Rent: </td><td><input type="text" required name="rent" id="rent" size="15" maxlength="15" value="'.$rent.'" class="textbox"/></p></td></tr>
<tr><td><p>Water Bill: </td><td><input type="text" required name="water_bill" size="50" maxlength="50" value="'.$water_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Electricity Bill: </td><td><input type="text" name="electric_bill" size="50" maxlength="50" value="'.$electric_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Gas Bill: </td><td><input type="text" name="gas_bill" size="50" maxlength="50" value="'.$gas_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Security Bill: </td><td><input type="text" required name="security_bill" size="50" maxlength="50" value="'.$security_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Utility Bill: </td><td><input type="text" name="utility_bill" size="50" maxlength="50" value="'.$utility_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Other Bill: </td><td><input type="text" name="other_bill" size="50" maxlength="50" value="'.$other_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Issue Date: </td><td><input type="text" required name="issue_date" size="50" maxlength="50" value="'.$issue_date.'" id="datepicker" class="textbox"/><label>(YYYY-MM-DD)</label></td></tr>
</table>';

if (isset($_POST['submitted'])) { 
    $tenant_id= $_POST["tenant_id"];
    $rent= str_replace(',','',$_POST["rent"]);
	$water_bill= str_replace(',','',$_POST["water_bill"]);
	$electric_bill= str_replace(',','',$_POST["electric_bill"]);
    $gas_bill= str_replace(',','',$_POST["gas_bill"]);
	$security_bill= str_replace(',','',$_POST["security_bill"]);
    $utility_bill= str_replace(',','',$_POST["utility_bill"]);
	$other_bill= str_replace(',','',$_POST["other_bill"]);
	$issue_date= $_POST["issue_date"];
}


if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['tenant_id'],"Please select tenant.",$errors);
    checkIfEmpty($_POST['rent'],"Please enter rent amount.",$errors);
    checkIfEmpty($_POST['water_bill'],"Please enter water bill.",$errors);
    checkIfEmpty($_POST['security_bill'],"Please enter security Bill.",$errors);
	checkIfEmpty($_POST['issue_date'],"Please enter Issue Date.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
	$month = date('F-Y',strtotime($issue_date));
	$total_rent = $rent + $water_bill + $electric_bill + $gas_bill + $security_bill + $utility_bill + $other_bill;
        $query = "UPDATE billing SET tenant_id = '$tenant_id',month = '$month',rent = '$rent',water_bill = '$water_bill',electric_bill = '$electric_bill',gas_bill = '$gas_bill',security_bill = '$security_bill',utility_bill = '$utility_bill',other_bill = '$other_bill',issue_date = '$issue_date',total_rent = '$total_rent'
        WHERE owner_utility_id = '".$_REQUEST['id']."'";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Bill successfully updated!</p></div>';
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
            url: 'get_tenants.php',
            type: 'post',
            data: {building_id:building_id},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#tenant_id").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
					var rent = response[0]['rent'];
                    
                    $("#tenant_id").append("<option value='"+id+"'>"+name+"</option>");
					$("#rent").val(rent);
                }
            }
        });
    });

    $("#tenant_id").change(function(){
        var tenant_id = $(this).val();

        $.ajax({
            url: 'get_tenant.php',
            type: 'post',
            data: {tenant_id:tenant_id},
            dataType: 'json',
            success:function(response){

                var len = response.length;
				
				var rent = response['r_rent_pm'];

                $("#rent").val(rent);
                
            }
        });
    });

});
</script>
