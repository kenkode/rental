
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
 <title>Add Bills</title>
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
$tenant_id = "";
$month= "";
$rent= "";
$water_bill= "";
$electric_bill= "";
$gas_bill= "";
$security_bill= "";
$utility_bill= "";
$other_bill= "";
$total_rent= "";
$issue_date = "";

//Populate Value from Form Submit - Stickeness
if (isset($_POST['submitted'])) { 
    $tenant_id= $_POST["tenant_id"];
    $month= $_POST["month"];
    $rent= str_replace(',','',$_POST["rent"]);
	$water_bill= str_replace(',','',$_POST["water_bill"]);
	$electric_bill= str_replace(',','',$_POST["electric_bill"]);
    $gas_bill= str_replace(',','',$_POST["gas_bill"]);
	$security_bill= str_replace(',','',$_POST["security_bill"]);
    $utility_bill= str_replace(',','',$_POST["utility_bill"]);
	$other_bill= str_replace(',','',$_POST["other_bill"]);
	$total_rent= str_replace(',','',$_POST["total_rent"]);
	$issue_date= $_POST["issue_date"];
}

echo '<div class="container">';
echo '<h2>Add Bill Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Tenant</p></td><td><p>
<select name="tenant_id" id="tenant_id" required>';
$result = mysql_query("SELECT * FROM tenant WHERE status = 'ACTIVE'");
while($row = mysql_fetch_array($result))
{
echo '<option value="'.$row['id'].'">'.$row['r_name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Month: </td><td><input type="text" required name="month" size="50" maxlength="50" value="'.$month.'" class="textbox"/></p></td></tr>
<tr><td><p>Rent: </td><td><input type="number" required name="rent" size="15" maxlength="15" value="'.$rent.'" class="textbox"/></p></td></tr>
<tr><td><p>Water Bill: </td><td><input type="text" required name="water_bill" size="50" maxlength="50" value="'.$water_bill?$water_bill:'500'.'" class="textbox"/></p></td></tr>
<tr><td><p>Electricity Bill: </td><td><input type="text" name="electric_bill" size="50" maxlength="50" value="'.$electric_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Gas Bill: </td><td><input type="text" name="gas_bill" size="50" maxlength="50" value="'.$gas_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Security Bill: </td><td><input type="text" required name="security_bill" size="50" maxlength="50" value="'.$security_bill?$security_bill:'200'.'" class="textbox"/></p></td></tr>
<tr><td><p>Utility Bill: </td><td><input type="text" name="utility_bill" size="50" maxlength="50" value="'.$utility_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Other Bill: </td><td><input type="text" name="other_bill" size="50" maxlength="50" value="'.$other_bill.'" class="textbox"/></p></td></tr>
<tr><td><p>Issue Date: </td><td><input type="text" required name="issue_date" size="50" maxlength="50" value="'.$issue_date.'" id="datepicker" class="textbox"/><label>(YYYY-MM-DD)</label></td></tr>
</table>';

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['tenant_id'],"Please select tenant.",$errors);
    checkIfEmpty($_POST['month'],"Please enter month.",$errors);
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
        $query = "INSERT INTO billing(tenant_id,month,rent,water_bill,electric_bill,gas_bill,security_bill,utility_bill,other_bill,issue_date,total_rent,added_date)
      VALUES ('$r_name','$r_email','$r_contact','$r_address','$r_nid','$house_id','$r_advance','$r_rent_pm','$r_date','$r_password','$building_id','ACTIVE');";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Tenant successfully added!</p></div>';
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
