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
 <title>Add Complaint</title>
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

echo '<form action="add_complaint.php" method="post">';
$c_title= "";
$c_description= "";
$c_date= "";

//Populate Value from Form Submit - Stickeness

echo '<div class="container">';
echo '<h2>Add Complaint Details</h2>' ;   

echo ' <table border="0"> 

<tr><td><p>Complaint Title: </td><td><input type="text" required name="c_title" size="50" maxlength="50" value="'.$c_title.'" class="textbox"/></p></td></tr>
<tr><td><p>Description: </td><td><textarea cols="48" rows="10" name="c_description">'.$c_description.'</textarea></p></td></tr>
<tr><td><p>Complaint Date: </td><td><input type="text" required name="c_date" size="50" maxlength="50" value="'.$c_date.'" id="datepicker" class="textbox"/><label>(YYYY-MM-DD)</label></td></tr>
</table>';

if (isset($_POST['submitted'])) { 
    $c_title= $_POST["c_title"];
	$c_description= $_POST["c_description"];
	$c_date= $_POST["c_date"];
}

if(!isset($_POST['submitted'])){
    printFormSubmit();
}

//Validate and Submit to the Database
if (isset($_POST['submitted'])) {
    
    $errors = array(); 
    checkIfEmpty($_POST['c_title'],"Please enter title.",$errors);
    checkIfEmpty($_POST['c_description'],"Please enter description.",$errors);
	checkIfEmpty($_POST['c_date'],"Please enter complaint Date.",$errors);

    if (!empty($errors)) { 
         printFormSubmit();
    }else{
        echo '</form></div>';
    }
    
    echo '<div class="Message_bar">';
    if (empty($errors)) { 
	$month = date('F',strtotime($c_date));
	$year = date('Y',strtotime($c_date));
        $query = "INSERT INTO complaints(tenant_id,c_title,c_description,c_date,c_month,c_year,added_date)
      VALUES ('".$_SESSION['id']."','$c_title','$c_description','$c_date','$month','$year',NOW());";
        addTable($dbc,$query);
		echo '<div class="success"><p class="success">Complaint successfully added!</p></div>';
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
