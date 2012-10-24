<?php
session_start();
if(!isset($_SESSION['cat_id']))
{
	header("Location:index.php?logout=1");
}


?>
