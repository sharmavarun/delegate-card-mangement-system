<?php 
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
$team_id_found=1;
$already_reg=0;
$limit_exceeded=0;

if(isset($_GET['event_id']))
			{
				if(isset($_GET['team_id']))
				{
				
					extract($_GET);
					//==============checking if team id is present or not =============
					
					$count=0;
					$q="SELECT * FROM `tblTeams` WHERE team_id = $team_id";
					$r=mysqli_query($conn,$q);
					
					
					
					while ($ro=mysqli_fetch_assoc($r))
					{
						extract($ro);
						$count++;
					}
					
					if($count==0)  // team not in database
					{
						echo '<br/><br/><center><b>No Entry for Team Id. <span class="congrats">'.$team_id.'</span> in the database<br/></b><br/></center>';
						$team_found=0; //team id not found
					}
					
					
						else
						{
					
					
					// ================end of echecking team id=================
					
					
					//=============checking for team members limit================
			
			//print_r($_GET);
			
			$q="SELECT count(del_card_no) as c  FROM tblTeams WHERE team_id = $team_id";
			$r=mysqli_query($conn,$q);
			
			while($rows=mysqli_fetch_assoc($r))
			{
				//$rows=mysqli_fetch_assoc($r);
				extract($rows);
										// team members can be viewed here
			
			}
			

			
			
			$q="SELECT event_id, `event_name`, `event_max_team_number`  FROM `tblEvents` WHERE event_id= $event_id";
			$r=mysqli_query($conn,$q);
			$row=mysqli_fetch_assoc($r);
			extract($row);
			//echo $event_name.' '.$event_max_team_number;
			
			if($c>$event_max_team_number) //Abort immediately situation
			{
				echo '<br/><br/><center><b><span class="congrats">Registration Aborted</span></b></center><br/>';
				echo '<center><br/><b>Maximum Members Allowed In a Team in <b>'.$event_name.'</b> is <span class="congrats">'.$event_max_team_number.'</span> <br/>But Your Team is having <span class="congrats">'.$c.' </span>Members</b><br/><center>';
				//============Now displaying details of team members=================
				$q="SELECT del_card_no FROM `tblTeams` WHERE `team_id` = $team_id";
				$r=mysqli_query($conn,$q);
				echo '<br/><center><b>Delegate Card Numbers Associated with your team are</b><br/></center>';

				while($rows=mysqli_fetch_assoc($r))
				{
					
					extract($rows);
					
					echo ' <b>'.$del_card_no.'</b> , ';
					
				}
			
				
				//=============ending displaying details=================
			}
			
			//==========checking for duplicate entry=========/
			$counting=0;
			$q="SELECT count(distinct event_id) counting FROM `tblEventReg` WHERE `team_id` = $team_id AND event_id= $event_id";
			$r=mysqli_query($conn,$q);
			if($rows=mysqli_fetch_assoc($r))
			{

				extract($rows);

			}
			if($counting>0)
			{
				$already_reg=1;
			}
			
			
			//=========ending checking for duplicate entry=========/ 
			
			
			
			
			
			
			if(($c<=$event_max_team_number)&&($already_reg==0))
			{
			
			$quer ="INSERT INTO `tblEventReg`(`cat_id`, `event_id`, `team_id`, `reg_time`) VALUES ($cat_id,$event_id,$team_id,CURRENT_TIMESTAMP)";
			//echo $quer;
			//print_r($quer);
			$res =mysqli_query($conn,$quer) or die("Unable to enter data");
			if($res)
			{
				echo "<br/><br/><center><b><span class='congrats'>Congratulations</span>,<br/> Your Team is now Registered with ";

				$qu = "SELECT `event_name` FROM `tblEvents` WHERE `event_id` = $event_id";
				$re = mysqli_query($conn,$qu);
				$rows = mysqli_fetch_assoc($re);
				extract($rows);
				echo "<span class='congrats'>".$event_name."</span><br/>";
				//}
			
			}
			
			}
			
			if($already_reg==1)
			{
			echo "<br/><br/><center><b><br/>Your Team is already registered for <span class='congrats'>";
				$qu = "SELECT `event_name` FROM `tblEvents` WHERE `event_id` = $event_id";
				$re = mysqli_query($conn,$qu);
				$rows = mysqli_fetch_assoc($re);
				extract($rows);
				echo "<span class='congrats'>".$event_name."</span><br/>";
			
			}
			
			
		else
		{
	
		
		
			echo '<br/><div class="revels_teamreg_r"><form action="event_reg.php" method="GET">';
		
			$query="SELECT * FROM revels.`tblEvents` where cat_id ='$cat_id'";
			$res = mysqli_query($conn,$query) or die("Unable to get event list");
			echo '<br/><center><b>Enter Team ID:</b></center><br/><center><input type="text" id = "team_id" name="team_id" autocomplete="off" required></input></center><br/>
			<div class="revels_teamreg_container">';
			echo '<span class="reg_check_t"><b>Event Name</b></span><span class="reg_check_t"><b>Maximum Team Members Allowed</b></span><br/>';
			while($row = mysqli_fetch_assoc($res))
			{
				extract($row);
		
		
				echo '<span class="reg_check"><input type="radio" name="event_id" value="'.$event_id.'"/>'.$event_name.'</input></span><span class="reg_check_no">'.$event_max_team_number.'</span><br/>';
			}
		
			if(isset($_GET['team_id']))
			{
				echo '<center><span style="color:red;">Please Select the Event</span></center>';
			}
			echo '<br/><center><button type="submit">Go</button></center>
			</form></div></div>';
		
		
		}
		
		
		
		?>


</div>
		<?php footer();?>
		</div>
	
	</div>

	
</body>

</html>





