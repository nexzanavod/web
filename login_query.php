<?php
	session_start();
	require 'conn.php';
	
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$query = mysqli_query($conn, "SELECT * FROM `admin` WHERE `username` = '$username' && `password` = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		if($row > 0){
			$_SESSION['user'] = $fetch['user_id'];
			$_SESSION['status'] = $fetch['status'];
			header("location:home.php");
		}

		else if(empty($_POST["username"]) && empty($_POST["password"]))
		{
			echo "<center><label class='text-danger'>Username & Password is Required</label></center>";
		}

		else
		{
			echo "<center><label class='text-danger'>Invalid Username or Password</label></center>";
		}
	}
?>