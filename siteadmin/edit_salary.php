
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
		
$result = mysql_query("SELECT * FROM employee_salary_setup where emp_id='".$_REQUEST['id']."'");
$row = mysql_fetch_array($result);

$eb = mysql_query("SELECT * FROM employee WHERE eid='".$row['employee_id']."' LIMIT 1");
$ebld = mysql_fetch_array($eb);
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
 <title>Edit Salary</title>
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
$employee_id = "";
$month= "";
$year= "";
$amount= $row['amount'];
$issue_date = $row['issue_date'];

//Populate Value from Form Submit - Stickeness

echo '<div class="container">';
echo '<h2>Edit Salary Details</h2>' ;   

echo ' <table border="0"> 
<tr><td><p>Building</p></td><td><p>
<select name="building_id" id="building_id" required>';
$result = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE'");
while($r = mysql_fetch_array($result))
{
if ($r['bldid']==$ebld["building_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$r['bldid'].'" '.$selected.'>'.$r['name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Employee</p></td><td><p>
<select name="employee_id" id="employee_id" required>';

$b = mysql_query("SELECT * FROM building_info WHERE status = 'ACTIVE' AND bldid='".$row['building_id']."'");
$building = mysql_fetch_array($b);
$result = mysql_query("SELECT * FROM employee WHERE eid='".$row['employee_id']."'");

while($e = mysql_fetch_array($result))
{
if ($e['eid']==$row["employee_id"]) {
	 $selected = "selected";
} else {
	 $selected = "";
}
echo '<option value="'.$e['eid'].'" '.$selected.'>'.$e['e_name'].'</option>';
}
echo '</select></p></td></tr>
<tr><td><p>Amount: </td><td><input type="text" required name="amount" id="amount" size="15" maxlength="15" value="'.$amount.'" class="textbox"/></p></td></tr>
<tr><td><p>Issue Date: </td><td><input type="text" required name="issue_date" size="50" maxlength="50" value="'.$issue_date.'" id="datepicker" class="textbox"/><label>(YYYY-MM-DD)</label></td></tr>
</table>';

if (isset($_POST['submitted'])) { 
    $employee_id= $_POST["employee_id"];
    $amount= str_replace(',','',$_POST["amount"]);
	$issue_date= $_POST["issue_date"];
}

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['employee_id'],"Please select employee.",$errors);
    checkIfEmpty($_POST['amount'],"Please enter amount.",$errors);
	checkIfEmpty($_POST['issue_date'],"Please enter Issue Date.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
	$month = date('F',strtotime($issue_date));
	$year = date('Y',strtotime($issue_date));
        $query = "UPDATE employee_salary_setup SET employee_id = '$employee_id',month = '$month',xyear = '$year',amount = '$amount',issue_date = '$issue_date' WHERE emp_id = '".$_REQUEST['id']."'";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Salary successfully updated!</p></div>';
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
            url: 'get_employees.php',
            type: 'post',
            data: {building_id:building_id},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#employee_id").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#employee_id").append("<option value='"+id+"'>"+name+"</option>");
					$("#rent").val(rent);
                }
            }
        });
    });

});
</script>
