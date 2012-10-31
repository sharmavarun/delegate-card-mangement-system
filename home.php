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
if(isset($_GET['event_details']))
		{
			extract($_GET);
			$query="SELECT r.team_id, r.event_id, e.event_name,r.team_id, s.student_delno, s.student_name, s.student_regno, s.student_email, s.student_phone, s.student_college, s.date_of_creation, t.team_id, t.del_card_no FROM tblEventReg as r, tblTeams as t,tblStudent as s,tblEvents as e WHERE r.team_id = t.team_id AND t.del_card_no = s.student_delno AND r.event_id =e.event_id AND r.event_id = $event_details  ORDER BY t.team_id";
			$result=mysqli_query($conn,$query) or die("Error query");
			$count=0;
			echo '<br/><b><span class="viewhomesmallh">TId</span><span class="viewhomesmallh">DelNo</span><span class="viewhomeh">Student Name</span><span class="viewhomeh">Registration No.</span><span class="viewhomeh">Phone No.</span><span class="viewhomeh_l">Email Id.</span><span class="viewhomeh">College</span></b>';
			while($rows = mysqli_fetch_assoc($result))
			{
				extract($rows);
				echo '<br/><span class="viewhomesmall">'.$team_id.'</span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome_l">'.$student_email.'</span><span class="viewhome">'.$student_college.'</span>';
				$count++;
			}
			if($count==0)
			{
				echo '<br/><center><span class="congrats">No Registrations Yet :( </span></center>';
			}
		}
		
else
		{
			
		echo '<br/><center>Event Registrations Current Status:</center>';
		 

		
		$queryevent = "select * from tblEvents where cat_id = '$cat_id'";
		$res = mysqli_query($conn,$queryevent) or die("Failed to get events");
		
		
		
while($row = mysqli_fetch_assoc($res))
{
	extract($row);
	$q="SELECT count(distinct `team_id`) c FROM `tblEventReg` WHERE `team_id`!=0 and `event_id` = $event_id";
	$r=mysqli_query($conn,$q) or die("Unable to get total teams registered");
	$ro=mysqli_fetch_assoc($r);
	extract($ro);
	echo "<br><a href='home.php?event_details=$event_id'<span class='homespan'><strong>".$event_name."</strong><br><br/>No. Of Teams Registered : ".$c." &nbsp;<br>Maximum Team Members Allowed:".$event_max_team_number."</span></a>";
}
		}
?>
		</div>
		<?php footer();?>
		</div>
	
	</div>
	
</body>

</html>
