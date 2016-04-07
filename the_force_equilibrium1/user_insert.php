<?php
		include("includes/connection.php");
		
		if (isset($_POST['sign_up']))
		{
			$username = mysqli_real_escape_string($con,$_POST['u_username']);
			$password = mysqli_real_escape_string($con,$_POST['u_password']);
			$firstname = mysqli_real_escape_string($con,$_POST['u_firstname']);
			$lastname = mysqli_real_escape_string($con,$_POST['u_lastname']);
			$email = mysqli_real_escape_string($con,$_POST['u_email']);
			$phonenumber = mysqli_real_escape_string($con,$_POST['u_phonenumber']);
			$gender = mysqli_real_escape_string($con,$_POST['u_gender']);
			$martialstatus = mysqli_real_escape_string($con,$_POST['u_martialstatus']);
			$hometown = mysqli_real_escape_string($con,$_POST['u_hometown']);
			$birthday = mysqli_real_escape_string($con,$_POST['u_birthday']);
			$aboutme = mysqli_real_escape_string($con,$_POST['u_aboutme']);
			$forceside = mysqli_real_escape_string($con,$_POST['u_forceside']);
			$status = "unverified";
			$posts = "no";

			$get_email = "select * from users where user_email = '$email' ";
			$run_email = mysqli_query($con,$get_email);
			$check_email = mysqli_num_rows($run_email);

			$get_username = "select * from users where user_username = '$username'";
			$run_username = mysqli_query($con,$get_username);
			$check_username = mysqli_num_rows($run_username);

			if($check_username == 1)
			{
				echo "<script>alert('This Username is already registered!')</script>";
				exit();
			}

			if(strlen($password) < 8)
			{
				echo "<script>alert('Password must be minimum 8 characters!')</script>";
				exit();
			}

			if($check_email == 1)
			{
				echo "<script>alert('This Email is already registered!')</script>";
				exit();
			}

			else
			{
				$insert = "insert into users 
				(user_username,user_password,user_firstname,user_lastname,user_email,user_phonenumber,user_gender,user_martialstatus,user_hometown,user_birthday,user_aboutme,user_forceside,user_image,user_registerdate,user_lastlogin,user_status,user_posts)
				values ('$username','$password','$firstname','$lastname','$email','$phonenumber','$gender','$martialstatus','$hometown','$birthday','$aboutme','$forceside','default.jpg',NOW(),NOW(),'$status','$posts')";

				$run_insert = mysqli_query($con,$insert);

				if ($run_insert) 
				{
					$_SESSION['user_email'] = $email;
					echo "<script>alert('Registration Successful!')</script>";
					echo "<script>window.open('home.php','_self')</script>";
				}

				else
				{
					echo "<script>alert('Registration Unsuccessful!')</script>";
				}
			}
		}
?>
