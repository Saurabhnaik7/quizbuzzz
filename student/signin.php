<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if(isset($_POST['login'])) 
 {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT std_id FROM tblstd WHERE Email=:email and Password=:password";
    $query=$dbh->prepare($sql);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
	{
		foreach ($results as $result) {
			$_SESSION['quizsid']=$result->std_id;
		}
		$_SESSION['login']=$_POST['email'];
		echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
	} 
	else{
		echo "<script>alert('Invalid Details');</script>";
		echo "<script type='text/javascript'> document.location ='signin.php'; </script>";
	}
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Quiz | Student Signin</title>
	<?php include_once('../links.php');?>
	<style type="text/css">
		
		.navbar {
  			background: #1b3e5c;	
		}
		.logo a:hover{
			color: #fff;
		}
		.navbar-brand{
			color: white;
		}
		.btn1{
			margin: 20px;
			width: 100px;
			height: 27px;
			border: none;
			outline: none;
			background: #1b3e5c;
			cursor: pointer;
			font-size: 15px;
			text-transform: uppercase;
			color: white;
			border-radius: 4px;
		}
		.card{
			
			margin-top: 50px;
			max-width: 100%;
		}
		.card form{
			width: 100%;
			height: 100%;
			padding: 20px;
			background: white;
			border-radius: 4px;
			box-shadow: 0 8px 16px rgba(0, 0, 0, .3);
		}
		.card form h1{
			text-align: center;
			margin-bottom: 24px;
			color: #1b3e5c;
		}
		.card form .form-control{
			width: 100%;
			height: 40px;
			background: white;
			border-radius: 4px;
			border: 1px solid silver;
			margin: 10px 0 18px 0;
			padding: 0 10px;
		}
		.card form .btn{
			margin-left: 50%;
			transform: translateX(-50%);
			width: 120px;
			height: 34px;
			border: none;
			outline: none;
			background: #1b3e5c;
			cursor: pointer;
			font-size: 15px;
			text-transform: uppercase;
			color: white;
			border-radius: 4px;
			transition: .3s;
		}
		.card form .btn:hover{
			opacity: .7;
		}
		.card form p{
			text-align: center;
			margin-top: 5px;
			margin-bottom: 5px;
			font-size: 18px;
		}
	</style>
</head>
<body>
<!--header-->
<nav class="navbar navbar-expand-md logo">
  	<a class="navbar-brand">ONLINE QUIZ</a>
</nav>
<!--header-->
<!--content-->

	<div class="container">
		<div class="row">

			<div class="col-lg-3 col-md-2">
				<a href="../index.php">
				<input type="button" class="btn1" value="Home">
				</a>
			</div>

			<div class="col-lg-6 col-md-8">
				<div class="card">
				<form method="post">
					<h1>Signin</h1>
					<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" required="true" name="email">
					</div>
					<div class="form-group">
					<label for="">Password</label>
					<input type="password" class="form-control" required="true" name="password">
					</div>
					<a href="forgot-password.php" style="float:right; font-size: 18px;">Forgot Password</a>
					<br>
					<button type="submit" class="btn" name="login">Signin</button>
			
					<p>Haven't registered yet?<a href="signup.php">signup</a></p>
				</form>
				</div>
			</div>

			<div class="col-lg-3 col-md-2">
				
			</div>
		</div>
    </div>
</body>
</html>