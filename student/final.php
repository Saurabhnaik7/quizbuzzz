<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quizsid']==0)) {
  header('location:logout.php');
  } else{
  		if(isset($_POST['gtd']))
		{
			$student=$_SESSION['quizsid'];
			$teacher=$_SESSION['teacher'];
  			$exam=$_SESSION['exam'];
  			$score=$_SESSION['score'];
  			$totalmarks=$_SESSION['numofques'];
  			$sql="Insert Into results(student,teacher,exam,Marks_obtained,Total_marks)Values(:student,:teacher,:exam,:score,:totalmarks)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':student',$student,PDO::PARAM_STR);
			$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
			$query->bindParam(':exam',$exam,PDO::PARAM_STR);
			$query->bindParam(':score',$score,PDO::PARAM_STR);
			$query->bindParam(':totalmarks',$totalmarks,PDO::PARAM_STR);
			$query->execute();
			$result=$query->fetchAll(PDO::FETCH_OBJ);
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
			{
				$_SESSION['score']=0;
				 header("Location:dashboard.php");
			}
			else
			{
				echo "<script>alert('Something went wrong.Please try again');</script>";
			}
		}
  			
?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Result Page</title>
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
		
		.container .row .card{
			width: 100%;
			margin-top: 20px;
			border-color: black;
		}
		.container .row .card .card-header{
		    background-color: #dedede;
		}
		.container .row .card p{
			margin: 10px;
		}
		.container .row .btn{
			margin-left: 50%;
			transform: translateX(-50%);
			border: none;
			outline: none;
			background: #1b3e5c;
			cursor: pointer;
			font-size: 15px;
			text-transform: uppercase;
			color: white;
			border-radius: 4px;
			transition: .3s;
			margin-bottom: 20px;
		}
		.container .row .btn:hover{
			opacity: .7;
		}
</style>	
</head>
<body>
<!--header-->
<nav class="navbar navbar-expand-md logo">
  	<a class="navbar-brand">ONLINE QUIZ</a>
</nav>
<!--header-->
<div class="container">
	<div class="row">

		<div class="col-lg-3 col-md-2"></div>

		<div class="col-lg-6 col-md-8">
		<div class="card">
			<div class="card-header">RESULT</div>
			<p>Your Score : <?php  echo $_SESSION['score'];?>/<?php  echo $_SESSION['numofques'];?></p>	
		</div>
		<br>
		<br>
		<form method="post" action="final.php">
		<input type="submit" class="btn" name="gtd" value="Go to Dashboard">
		</form>
		</div>

		<div class="col-lg-3 col-md-2"></div>
		
	</div>	
</div>

</body>
</html><?php }  ?>