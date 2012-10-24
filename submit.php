<?php 
	require_once("dbconn.php");
	require_once("include.php"); 
	require_once 'ckeckcat.php';
	$cat_id= $_SESSION['cat_id'];
	$cat_name= $_SESSION['cat_name'];
	if(isset($_GET['evid']))
	{
		$event_id = $_GET['evid'];	
	}
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
if($_POST)
{
	extract($_POST);
	$dell_no_found=1; // assuming deligate card no is present in database
	$duplicate_found=0; // assuming no duplicate team enrty is present in database
	
	
	foreach ($del_card_no as $one_value) 
	{
			//$str="(".$new_team_id.",".$one_value.",CURRENT_TIMESTAMP),";
			//$newstr=$newstr.$str;
			$one_value = mysqli_real_escape_string($conn,$one_value);
			$q="SELECT * FROM `tblStudent` WHERE student_delno = $one_value";
			$r=mysqli_query($conn,$q);
		
			if(mysqli_fetch_assoc($r))
			{
					while ($ro=mysqli_fetch_assoc($r))
					{
						extract($ro);
						echo $student_name.'<br/>';
					}
			}
			else
			{
				echo '<br/><br/><center><b>No Entry for Delegate Card No. <span class="congrats">'.$one_value.'</span> in the database<br/>Contact Delegate Card Infodesk</b><br/></center>';
			$dell_no_found=0; //delegate card entry not found
			}
		
	}
	
	
	
	
	
	if($dell_no_found==0) //if delegate card entry not found
	{
		echo '<br/><center><b><span class="congrats">Team Not Registered</span></b></center><br/>';
	}
	
	
	if(($dell_no_found==1)&&($duplicate_found==0)) //if delegate card entry found
	{
			
			
			//echo $del_card_no.'<br>';
			$query = "SELECT team_id FROM `tblTeams` ORDER BY team_id DESC LIMIT 1";
			$result = mysqli_query($conn,$query);
			while($rows = mysqli_fetch_assoc($result))
			{
				extract($rows);
			}
			$new_team_id = $team_id +1;
			$count=0;
			$newstr="";
			foreach ($del_card_no as $one_value)
			{
				$count++;
				$str="(".$new_team_id.",".$one_value.",CURRENT_TIMESTAMP),";
				$newstr=$newstr.$str;
			}
			//echo $str;
			$quer ="INSERT INTO `tblTeams`(`team_id`, `del_card_no`, `reg_time`) VALUES $newstr (NULL,NULL,NULL)";
			//print_r($quer);
			$res =mysqli_query($conn,$quer) or die("Unable to enter data");
			//echo $count;
			//echo $newstr;
			echo "<br/><br/><center><b>Your Team is now Registered.<br/>Your Team ID is <span class='team_id_span'>".$new_team_id."</span><br/>";
	}
}
else 
{
echo "<center><b>Nothing to submit</b></center>";
}
?>





		</div>
		<?php footer();?>
		</div>
	
	</div>
	
</body>

</html>

