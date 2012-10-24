<?php 
	//require_once("chkcat.php");
	require_once("dbconn.php");
	require_once("include.php"); 
	require_once 'ckeckcat.php';
	$cat_id= $_SESSION['cat_id'];
	$cat_name= $_SESSION['cat_name'];
		
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Revels 2012 | Event Registration</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php linker();?>
</head>

<body>
	<div id="body_free">

		<div id="body_cover_free">
		<?php include_header();?>
		<?php include_bar();?>
		<div id="body_rest_free">
		<?php 
		
		
if(isset($_GET['team_members']))
{	extract($_POST);
$team_members=$_GET['team_members'];
	if($team_members>100)
	{
		echo "<br/><center><b>Can't Add More than 100 team members</b></center><br/>";
	}
	else
	{
	$quer="SELECT * FROM `tblEvents` where cat_id ='$cat_id'";
	$resul = mysqli_query($conn,$quer) or die("Unable to get maximum participants");
	while($rows = mysqli_fetch_assoc($resul))
	{
		extract($rows);
	}
	
	
	
		
		echo '<br/><div id="mam_login">
		<div class="mam_login_container">
		<span class="mam_login_top">'.$cat_name.'</span>
		<form action="submit.php" method="POST">';
		
		echo "<br/><center><b>No of Team Members = ".$team_members."</b></center><br/>";
		echo "<br/>";
		$n=$team_members;
		for($i=0;$i<$n;$i++)
		{
		
			echo '<span class="login_field">Delegate Card No. Of Member '.($i+1).' </span><input type="text" name="del_card_no[]" autocomplete="off" required></input>';
		
		}
		echo '<br/><button type="submit" class="loginbutton">Submit</button></form></div><br/>
		</div>';
	}

}

else {
	
	echo '<br/><div class="revels_teamreg_r"><form action="team_reg.php" method="GET">';
	
		$query="SELECT * FROM revels.`tblEvents` where cat_id ='$cat_id'";
		$res = mysqli_query($conn,$query) or die("Unable to get event list");
		echo '<br/><center><b>Enter Number Of Participants:</b></center><br/><center><input type="text" id = "team_members"name="team_members" autocomplete="off" required></input></center><br/>';
		
		
		echo '</center><br/><center><button type="submit">Go</button></center>
		</form></div>';
}
		?>
	
		
		</div>
		<?php footer();?>
	
	</div>
	</div>
</body>

</html>


