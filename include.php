<?php

function linker()
{
	echo '<link rel="stylesheet" type="text/css" href="css.css" /> 
			<link href="js/jquery-1.7.1.min.js" > 
			<link href="js.js" > ';
	
}

function include_header()
{
	echo '<div id="top_margin"></div><a href="home.php"><div id="header">
	<span class="logo"><img src="images/mit.png" alt="mit logo" height="100px" width="100px" />
	</span>
	<span class="heading">Revels 2012 Event Registration</span>
	<span class="manipal"></span>
	</div></a>';
}





function include_bar()
{	
		if (isset($_SESSION))
		{$category_name = $_SESSION['cat_name'];
		}
	echo '<div id="admin_bar">';
	if (isset($_SESSION))
	{
	echo '<span class="icons"><a href="team_reg.php">Team Registration</a></span>
	<span class="icons"><a href="event_reg.php">Event Registration</a></span>
	<span class="icons"><a href="search.php">Search</a></span>
	<span class="icons"><a href="home.php">Live Status</a></span>
	<span class="icons" style="float: right"><a href="destroy.php">logout</a></span>
	<span class="icons" style="float: right"><a href="home.php">'.$category_name.'</a></span>';
	}
	echo '</div>';
}

function include_tinymcelib()
{
	
	echo '<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
	</script>';
}

function footer()
{
	echo '<div class="revels_footer"><br/>
		For Any Queries, Conact:&nbsp;&nbsp;&nbsp;Aditya Arun:9886210911&nbsp;&nbsp;&nbsp;Varun Sharma:9535270244&nbsp;&nbsp;&nbsp;Dinesh Dhakan:8867655854
		</div>';
}
?>

