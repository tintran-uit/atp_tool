<?php 
	session_start();
	if(isset($_GET['uid']))
	{
		
		$uid = $_GET['uid'];
		$email = $_SESSION['email'];
		$post = $_SESSION['post'];
		$action = $_GET['action'];
		$memo = $_GET['memo'];
		$postid = $_GET['postid'];
		$con=mysqli_connect("localhost","rip5723n_fb","125478","rip5723n_fb");
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$qz = "INSERT INTO `log`(`id`, `uid`, `email`, `action`, `memo`, `postid`, `timeadd`) VALUES (NULL,'".$uid."','".$email."','".$action."','".$memo."','".$postid."',NULL)" ;
			$qz = str_replace("\'","",$qz);
			mysqli_query($con,$qz);
	}
?>