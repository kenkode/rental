<?php
session_start();

if(isset($_SESSION['landlord']))
{
?>
<?php

$_SESSION['landlord']=" ";
session_destroy();
header("location:landlord_login.php");
	exit();
?>
<?php
}
else
{
header("location:landlord_login.php");
	exit();
}
?>