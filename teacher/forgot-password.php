<?php
session_start();
error_reporting(0);
include('../dbconnection.php');

if(isset($_POST['reset']))
  {
    $email=$_POST['email'];
	$mobno=$_POST['mobno'];
	$newpassword=md5($_POST['newpassword']);
  	$sql ="SELECT Email FROM tbltch WHERE Email=:email and MobileNumber=:mobno";
	$query= $dbh -> prepare($sql);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':mobno', $mobno, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{
		$con="update tbltch set Password=:newpassword where Email=:email and MobileNumber=:mobno";
		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':mobno', $mobno, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		echo "<script>alert('Your Password has been changed succesfully');</script>";
		echo "<script type='text/javascript'> document.location ='signin.php'; </script>";
	}
	else {
		echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
	}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Quiz | Forgot Password</title>

	<script type="text/javascript">
	function valid()
	{
		if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
	{
	alert("New Password and Confirm Password Field do not match  !!");
	document.chngpwd.confirmpassword.focus();
	return false;
	}
	return true;
	}
	</script>
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
		<form method="post" name="chngpwd" onSubmit="return valid();" accept="forgot-password.php">
			<h1>Reset Password</h1>
			<div class="form-group">
				<label>Email</label>
				<input id="email" type="email" class="form-control" name="email" required="true">
			</div>
			<div class="form-group">
				<label>Mobile Number</label>
				<input id="mobno" type="text" class="form-control" name="mobno" maxlength="10" pattern="[0-9]+" required="true">
			</div>
			<div class="form-group">
				<label>New Password</label>
				<input type="password" class="form-control" name="newpassword" required="true">
			</div>
			<div class="form-group">
				<label>Confirm Password</label>
			   <input type="password" class="form-control" name="confirmpassword" required="true">
			</div>
				<button type="submit" class="btn" name="reset">Reset</button>			
		</form>
		</div>
		<div class="col-lg-3 col-md-2"></div>
	</div>
</div>
</body>
</html>