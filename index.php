<?php 
	//require_once("chkcat.php");
	require_once("dbconn.php");
	require_once("include.php"); 
	//$catass = $_SESSION['catass'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Login Panel - Category Heads | Revels 2012</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php linker();?>
</head>

<body>
	<div id="body_free">

		<div id="body_cover_free">
		<?php include_header();?>
		<?php include_bar();?>
		<div id="body_rest_free">
	<br/><br/><div class="login_span">
		<br/><center><b>Select Category:</b></center><br/>
		<?php 
		
		$queryevent = "select * from tblCategories where cat_type = 1";
		$res = mysqli_query($conn,$queryevent) or die("Failed to get category list");
		echo '<center><form action="index.php" method="POST"><select name="category" Id="category">';
		while($row = mysqli_fetch_assoc($res))
		{
			extract($row);
		
		echo '<option name ="cat_name" value="'.$cat_name.'">'.$cat_name.'</option>';
		
		
		}
		echo'<br/><input type="password" name="password" id="password"></input></br>';
		if(isset($_GET['attempt']))
		{
			extract($_GET);
			if($attempt==1)
			{
				echo '<br/><center><span style="color:red">Wrong Password</span></center>';
			}
		}
		if(isset($_GET['logout']))
		{
			extract($_GET);
			if($logout==1)
			{
				echo '<br/><center><span style="color:red">Your Session Expired</span></center>';
			}
		}
		echo '</select ></center><br/><center><button type="submit">Log In</button></center></form></div>';
		?>
		
	<?php 	
		/*
while($row = mysqli_fetch_assoc($res))
{
	extract($row);
	echo "<br><span class='homespan'>".$delcard_no."<br>Team Member : ".$participant_fname." ".$participant_lname;
}*/
	
?>
		</div>
		<?php footer();?>
		</div>

	</div>
	
</body>

</html>

		<?php
if(isset($_POST['category']))
{
	extract($_POST);
	print_r($_POST);
	$password = mysqli_real_escape_string($conn,$password);
	$queryevent = "SELECT cat_id, cat_name FROM tblCategories WHERE cat_name = '$category'";
	$res = mysqli_query($conn,$queryevent) or die("Failed to get category list");
	$row = mysqli_fetch_assoc($res);
	$res=extract($row);
	if($res)
	{
		$queryevent = "select cat_id,password from tblLogin where cat_id='$cat_id' and password='$password'";
		echo $queryevent;
		$res = mysqli_query($conn,$queryevent) or die("Failed to login");
		$count=0;
		while($row = mysqli_fetch_assoc($res))
		{
		$res=extract($row);
		$count++;
		}
		if($count==1)
		{
			session_start();
			$_SESSION['cat_id'] = $cat_id;
			$_SESSION['cat_name'] = $cat_name;
			$query="DELETE FROM `tblTeams` WHERE team_id =0";
			$result=mysqli_query($query);
			$query="DELETE FROM `tblEventReg` WHERE `team_id`=0";
			$result=mysqli_query($query);
			header("Location:home.php");
		}
		else
		{
			header("Location:index.php?attempt=1");
		}
	}
		
	
}

?>