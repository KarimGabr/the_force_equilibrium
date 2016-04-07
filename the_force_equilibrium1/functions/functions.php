<?php

$con = mysqli_connect("localhost","root","","the_force_equilibrium")
		or die ("ERROR! Connection cannot be established!");


//function for getting topics
function getTopicsForPost()
{
	global $con;

	$get_topics = "select * from topics";		
	$run_topics = mysqli_query($con,$get_topics);	

	while ($row = mysqli_fetch_array($run_topics)) 
	{
		$topic_id = $row['topic_id'];
		$topic_title = $row['topic_title'];

		echo "<option value='$topic_id'>$topic_title</option>";
	}
}

//function for inserting posts
function insertPost()
{
	global $con;
	global $user_id;
	if (isset($_POST['submit_timeline'])) 
	{
		$title = addcslashes($con,$_POST['title']);
		$content = addcslashes($con,$_POST['content']);
		$topic = addcslashes($con,$_POST['topic']);

		$insert = "insert into posts 
					(user_id,topic_id,post_title,post_content,post_date)
					values('$user_id','$topic','$title','$content',NOW())";

		$run = mysqli_query($con,$insert);

		if ($run) 
		{
			echo "<h3>Posted to timeline Successfully</h3>";

			$update = "update users set user_posts='yes' where user_id='$user_id'";
			$run_update = mysqli_query($con,$update);
		}
	}
}

//function for displaying posts
function get_posts()
{
	global $con;


	$per_page = 5;

	if (isset($_GET['page'])) 
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;
	}

	$start_from = ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);

	while ($row_posts = mysqli_fetch_array($run_posts)) 
	{
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread 
		$user = "select * from users where user_id='$user_id' AND user_posts = 'yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);
		$user_username = $row_user['user_username'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo 
		"
			<div id='posts'>
				<p><img src='user/user_images/$user_image' width='50' height='50'></p>
				<h3><a class='star5' href='user_profile.php?user_id=$user_id'>$user_username</a></h3>
				<h3 class='star4'>$post_title</h3>
				<p class='star4'>$post_date</p>
				<p class='star4'>$content</p>
				<a class='star4' href='single.php?post_id=$post_id'><button name='reply'>Reply</button></a>
			</div>
		";
	}
	include("pagination.php");
}

function single_post()
{
	global $con;
	if (isset($_GET['reply'])) 
	{
		$get_id = $_GET['post_id'];

		$get_posts = "select * from posts where post_id='$get_id'";

		$run_posts = mysqli_query($con, $get_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$post_title = $row_posts['post_title'];
		$content = $row_posts['post_content'];
		$post_date = $row_posts['post_date'];

		//getting the user who has posted the thread 
		$user = "select * from users where user_id='$user_id' AND user_posts = 'yes'";

		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);
		$user_username = $row_user['user_username'];
		$user_image = $row_user['user_image'];

		//now displaying all at once
		echo 
		"
			<div id='posts'>
				<p><img href='user_profile.php?user_id=$user_id' src='user/user_images/$user_image' width='50' height='50'></p>
				<h3><a href='user_profile.php?user_id=$user_id'>$user_username</a></h3>
				<h3>$post_title</h3>
				<p>$post_date</p>
				<p>$content</p>
			</div><br/>
			<form action='' method='post'>
			<textarea></textarea>
			<<button name='submit'>Comment</button>
		";
	}
}

?>