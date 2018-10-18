<?php
session_start();

if(isset($_SESSION['tenant']))
{
?>
<?php

$_SESSION['tenant']=" ";
session_destroy();
header("location:tenant_login.php");
	exit();
?>
<?php
}
else
{
header("location:tenant_login.php");
	exit();
}
?>