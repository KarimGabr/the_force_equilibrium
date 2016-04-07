<?php

session_start();
include("includes/connection.php");
include("functions/functions.php");

if (!isset($_SESSION['user_email'])) 
{
	header("location: index.php");
}
else
{

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="styles/home_style.css" media="all"/>
		<link rel="shortcut icon" href="images/shortcut vader.ico"/>
	</head>
	<body>
		<!--Container starts here-->
		<div class="container">
			<!--Header Wrap starts here-->
			<div id="header_wrap">
				<!--Header starts here-->
				<div id="header">
					<ul id="menu">
						<li class="star2"><a href="home.php">Home</a></li>
						<li class="star2"><a href="members.php">Members</a></li>
						<strong class="star3">Topics:</strong>
						<?php

						$get_topics = "select * from topics";		
						$run_topics = mysqli_query($con,$get_topics);	

						while ($row = mysqli_fetch_array($run_topics)) 
						{
							$topic_id = $row['topic_id'];
							$topic_title = $row['topic_title'];

							echo "<li class='star2'><a href='home.php?topic=$topic_id'>$topic_title</a></li>";
						}

						?>						
					</ul>
					<form method="get" action="results.php" id="form1">
						<input type="text" name="user_query" placeholder"Search a topic"/>
						<button name="search">Search</button>
					</form>
				</div>
				<!--Header ends here-->
			</div>
			<!--Header Wrap ends here-->
			<!--Contents area starts here-->
			<div class="content">
				<!--User timeline starts here-->
				<div id="user_timeline">
					<div id="user_details">
						<?php

						$user = $_SESSION['user_email'];
						$get_user = "select * from users where user_email='$user'";
						$run_user = mysqli_query($con,$get_user);
						$row = mysqli_fetch_array($run_user);

						$user_id = $row['user_id'];
						$user_username = $row['user_username'];
						$user_hometown = $row['user_hometown'];
						$user_image = $row['user_image'];
						$user_registerdate = $row['user_registerdate'];
						$user_lastlogin = $row['user_lastlogin'];

						echo 
						"	
							<center><img src='user/user_images/$user_image' width='200' height='200'/></center>
							<div id='user_mention'>	
								<p class='star5'><strong>Name:</strong> $user_username</p>
								<p class='star5'><strong>Home Town:</strong> $user_hometown</p>
								<p class='star5'><strong>Member since:</strong> $user_registerdate</p>
								<p class='star5'><strong>Last Login:</strong> $user_lastlogin</p>

								<p ><a class='star5' href='my_messages.php'>Messages</a><p>
								<p ><a class='star5' href='my_posts.php'>My Posts</a><p>
								<p ><a class='star5' href='edit_profile.php'>Edit Profile</a><p>
								<p ><a class='star5' href='logout.php'>Logout</a><p>
							</div>
						
						";
						?>
					</div>
				</div>
				<!--User timeline ends here-->
				<!--Content timeline stars here-->
				<div id="content_timeline">
					<form action="home.php?id=<?php echo $user_id;?>" method="post" id="form2">
						<h2 class="star1">What's on your mind</h2>
						<input style="margin-top:10px;" type="text" name="title" placeholder="Write a title" size="70"/><br/>
						<textarea cols="70" rows="4" name="content"></textarea><br/>
						<select name="topic">
							<option>Select Topic</option>
							<?php getTopicsforPost(); ?>
						</select>
						<button name="submit_timeline">Post to timeline</button>
					</form>
					<?php insertPost() ?>
					<div id="posts">
						<h2 class="star1">Most Recent Discussions</h2>
						<?php get_posts(); ?> 
					</div>
				</div>
				<!--Content timeline ends here-->
			</div>
			<!--Contents area ends here-->
		</div>
		<!--Container ends here-->
	</body>
</html>
<?php } ?>