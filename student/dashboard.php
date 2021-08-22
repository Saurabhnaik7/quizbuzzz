<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quizsid']==0)) {
  header('location:logout.php');
  } else{



  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Student Dashboard</title>
	<?php include_once('links.php');?>
	<style type="text/css">
		
		.wrapper h5{
			margin-top: 20px;
			
		}
		.wrapper hr{
			background-color: black;
			width: 100%;
		}
		.wrapper .card{
			width: 100%;
			border-color: black;
		}
		.wrapper .card .card-header{	
			background-color: #dedede;	
		}
		.wrapper .card p{
			margin: 10px;
			color: black;
		}
</style>	
</head>
<body>

		<?php include_once('sidebar.php');?>

		<div class="page-content p-5" id="content">

			<button id="sidebarCollapse" type="button" class="px-4 mb-4 btn">
				<i class="fas fa-bars"></i>
			</button>

		<div class="row">

		<div class="col-md-12 wrapper">
		<h5>Previous Quizes</h5>
		<hr>

		<?php
		$sid=$_SESSION['quizsid'];
		$sql="SELECT * from  results join schedule on results.exam=schedule.exam_id where student=:sid order by r_id desc";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':sid',$sid,PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
			foreach($result as $value)
			{ 
		?>


		<div class="card">
			<div class="card-header"><?php  echo $value->QuizName;?></div>
			<div>
				<p>Your Score : <?php  echo $value->Marks_obtained;?>/<?php  echo $value->Total_marks;?></p>
			</div>			
		</div>
		<br>
		<br>
		<?php $cnt=$cnt+1;}}
		else{?>
			<p style="color:black;">Nothing to display</p>
		<?php } ?>

		</div>
  </div>
 </div>
</body>
</html><?php }  ?>