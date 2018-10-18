<?php
session_start();

if(isset($_SESSION['employee']))
{
?>
<?php

$_SESSION['employee']=" ";
session_destroy();
header("location:employee_login.php");
	exit();
?>
<?php
}
else
{
header("location:employee_login.php");
	exit();
}
?>