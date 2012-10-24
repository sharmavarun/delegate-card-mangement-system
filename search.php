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





		<div id="body_rest_free">
<?php 










if(isset($_POST['delno']))
{



$del_no=$_POST['delno'];
$count=0;
$q="SELECT * FROM `tblStudent` WHERE student_delno = $del_no";
$r=mysqli_query($conn,$q);



	while ($ro=mysqli_fetch_assoc($r))
	{
		extract($ro);
		$count++;
	}

if($count==0)  // del card not in database
{
	echo '<br/><br/><center><b>No Entry for Delegate Card No. <span class="congrats">'.$del_no.'</span> in the database<br/>Contact Delegate Card Infodesk</b><br/></center>';
	$dell_no_found=0; //delegate card entry not found
}

else   // del card is in database

{

$count=0;

/*$query="SELECT DISTINCT t.team_id, `student_delno` , event_name, `student_name` , `student_regno` , `student_email` , `student_phone` , `student_college`
FROM tblEventReg e, tblTeams t, tblStudent s, tblEvents x
WHERE e.team_id = t.team_id
AND s.student_delno = t.del_card_no
AND e.team_id = x.event_id
AND s.student_delno =$del_no";*/
$query="SELECT r.team_id, r.event_id, e.event_name,r.team_id, s.student_delno, s.student_name, s.student_regno, s.student_email, s.student_phone, s.student_college, s.date_of_creation, t.team_id, t.del_card_no FROM tblEventReg as r, tblTeams as t,tblStudent as s,tblEvents as e WHERE r.team_id = t.team_id AND t.del_card_no = s.student_delno AND e.event_id =r.event_id AND  s.student_delno=$del_no";



$result=mysqli_query($conn,$query);

echo '<br/><b><span class="viewhomesmallh">TId</span><span class="viewhomesmallh">DelNo</span><span class="viewhomeh">Student Name</span><span class="viewhomeh">Registration No.</span><span class="viewhomeh">Phone No.</span><span class="viewhomeh_l">Events Registered</span><span class="viewhomeh">College</span></b>';
while($rows = mysqli_fetch_assoc($result))
{
	extract($rows);
	echo '<br/><span class="viewhomesmall">'.$team_id.'</span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome_l">'.$event_name.'</span><span class="viewhome">'.$student_college.'</span>';
	$count++;
}

if($count==0) // if team is not registered with any event
	{	
		
		$query="SELECT DISTINCT  `student_delno` , `student_name` , `student_regno` , `student_email` , `student_phone` , `student_college`
	FROM tblStudent as s WHERE  s.student_delno=$del_no";
		$result=mysqli_query($conn,$query);
		while($rows=mysqli_fetch_assoc($result))
		{
			extract($rows);
			echo '<br/><span class="viewhomesmall"> NA </span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome">'.$student_email.'</span><span class="viewhome">'.$student_college.'</span>';
		}
		echo"<br/><br/><center><span class='congrats'>You Are not registered with any event</span></center>";
	}
}
}







elseif(isset($_POST['team_id']))
{
	$team_id=$_POST['team_id'];
	//=============checking data enrty in database =============//
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



	//=================end checking data entry============//
	else
	{
		$count=0;
		/*$query="SELECT DISTINCT e.team_id,t.team_id, `student_delno` , event_name, `student_name` , `student_regno` , `student_email` , `student_phone` , `student_college`
		FROM tblEventReg e, tblTeams t, tblStudent s, tblEvents x
		WHERE e.team_id = t.team_id
		AND s.student_delno = t.del_card_no
		AND e.team_id = x.event_id
		AND t.team_id =$team_id";*/
		$query="SELECT r.team_id, r.event_id, e.event_name,r.team_id, s.student_delno, s.student_name, s.student_regno, s.student_email, s.student_phone, s.student_college, s.date_of_creation, t.team_id, t.del_card_no FROM tblEventReg as r, tblTeams as t,tblStudent as s,tblEvents as e WHERE r.team_id = t.team_id AND t.del_card_no = s.student_delno AND e.event_id =r.event_id AND r.team_id = $team_id";

		$result=mysqli_query($conn,$query);

		echo '<br/><b><span class="viewhomesmallh">TId</span><span class="viewhomesmallh">DelNo</span><span class="viewhomeh">Student Name</span><span class="viewhomeh">Registration No.</span><span class="viewhomeh">Phone No.</span><span class="viewhomeh">Events Registered</span><span class="viewhomeh">College</span></b><br/>';
		while($rows = mysqli_fetch_assoc($result))
		{
			extract($rows);
			$count++;
			echo '<br/><span class="viewhomesmall">'.$team_id.'</span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome_l">'.$event_name.'</span><span class="viewhome">'.$student_college.'</span>';
		}
		if($count==0) // if team is not registered with any event
		{

			$query="select t.team_id,student_delno , `student_name` , `student_regno` , `student_email` , `student_phone` , `student_college`
			FROM tblStudent as s,tblTeams as t WHERE  t.del_card_no=s.student_delno AND t.team_id=$team_id";
			$result=mysqli_query($conn,$query);
			while($rows=mysqli_fetch_assoc($result))
			{
				extract($rows);
				echo '<br/><span class="viewhomesmall">'.$team_id.'</span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome_l">'.$student_email.'</span><span class="viewhome">'.$student_college.'</span>';
			}
			echo"<br/><br/><br/><center><span class='congrats'>This Team is not registered with any event</span></center>";
		}
	}
}




elseif(isset($_POST['regno']))
{
	$reg_no=$_POST['regno'];
	$count=0;
	$q="SELECT * FROM `tblStudent` WHERE student_regno = $reg_no";
	$r=mysqli_query($conn,$q);
	
	
	
	while ($ro=mysqli_fetch_assoc($r))
	{
		extract($ro);
		$count++;
	}
	
	if($count==0)  // reg no not in database
	{
		echo '<br/><br/><center><b>No Entry for Registration No. <span class="congrats">'.$reg_no.'</span> in the database</b><br/></center>';
		$dell_no_found=0; //delegate card entry not found
	}
	
	else   // reg no is in database
	
	{
	
		$count=0;
		$query="SELECT r.team_id, r.event_id, e.event_name,r.team_id, s.student_delno, s.student_name, s.student_regno, s.student_email, s.student_phone, s.student_college, s.date_of_creation, t.team_id, t.del_card_no FROM tblEventReg as r, tblTeams as t,tblStudent as s,tblEvents as e WHERE r.team_id = t.team_id AND t.del_card_no = s.student_delno AND e.event_id =r.event_id AND s.student_regno =$reg_no";

		$result=mysqli_query($conn,$query);
	
		echo '<br/><b><span class="viewhomesmallh">TId</span><span class="viewhomesmallh">DelNo</span><span class="viewhomeh">Student Name</span><span class="viewhomeh">Registration No.</span><span class="viewhomeh">Phone No.</span><span class="viewhomeh_l">Events Registered</span><span class="viewhomeh">College</span></b>';
		while($rows = mysqli_fetch_assoc($result))
		{
			extract($rows);
			echo '<br/><span class="viewhomesmall">'.$team_id.'</span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome_l">'.$event_name.'</span><span class="viewhome">'.$student_college.'</span>';
			$count++;
		}
	
		if($count==0) // if student not registered with any event
		{
	
			$query="SELECT DISTINCT  `student_delno` , `student_name` , `student_regno` , `student_email` , `student_phone` , `student_college`
			FROM tblStudent as s WHERE  s.student_regno=$reg_no";
			$result=mysqli_query($conn,$query) or die("Unable to execute query");
			while($rows=mysqli_fetch_assoc($result))
			{
				extract($rows);
				echo '<br/><span class="viewhomesmall"> NA </span><span class="viewhomesmall">'.$student_delno.'</span><span class="viewhome">'.$student_name.'</span><span class="viewhome">'.$student_regno.'</span><span class="viewhome">'.$student_phone.'</span><span class="viewhome">'.$student_email.'</span><span class="viewhome">'.$student_college.'</span>';
			}
			echo"<br/><br/><center><span class='congrats'>You Are not registered with any event</span></center>";
		}
	}
	
	
	
	
	
	
	
	
	
	
}



	
	echo '<br/>
	<div class="search_div">
	<form name="chkdel" action="search.php" method ="post">
	<br/><span class="search_buttons">Enter Delegate No :<br/></span>
	<input type="text" name="delno" autocomplete="off" required>
	<input type="submit" name="enterdel" value="Search From Delegate No.">
	</form>
	<form name="chkdel" action="search.php" method ="post">
	
	<br/><span class="search_buttons">Enter Team No :<br/></span>
	<input type="text" name="team_id" autocomplete="off" required>
	
	<input type="submit" name="enterteam" value="Search From Team Id">
	
	</form>
	<form name="chkreg" action="search.php" method ="post">
	
	<br/><span class="search_buttons">Enter Registration No:<br/></span>
	<input type="text" name="regno" autocomplete="off" required>
	
	<input type="submit" name="enterreg" value="Search From Reg No.">
	</form>
	</div>';

?>


</div>
		
		</div>
	<?php footer();?>
	</div>
	</div>
</body>

</html>
