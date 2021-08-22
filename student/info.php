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
	<title>Online Quiz | Quiz Information</title>
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
			background-color: #dedede;
			
		}
		.wrapper .card label{
			margin-left: 10px;
			margin-top: 10px;
		}
		.wrapper .card .btn{
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
		.wrapper .card .btn:hover{
			opacity: .7;
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
		<h5>Instructions</h5>
		<hr>
		<div class="card">
			<form method="post">
				<?php
				$exam=$_SESSION['exam'];
				$sql="SELECT * from  schedule where exam_id=:exam";
				$query = $dbh -> prepare($sql);
				$query->bindParam(':exam',$exam,PDO::PARAM_STR);
				$query->execute();
				$result=$query->fetchAll(PDO::FETCH_OBJ);
				$cnt=1;
				if($query->rowCount() > 0)
				{
					foreach($result as $value)
					{ 
		 		?>

				<label>Quiz Name : <?php  echo $value->QuizName;?></label>
				<br>
				<label>All the questions are Multiple Choics Questions</label>
				<br>
				<label>Number of Question : <?php  echo $value->NumofQues;
											$_SESSION['numofques']=$value->NumofQues;
										    $_SESSION['teacher']=$value->t_id;?></label>
				<br>
				<label>Total Marks : <?php  echo $value->TotalMarks;?></label>
				<br>
				<label>Duration : <?php  echo $value->Duration;?> mins</label>
				<br>
				<?php $cnt=$cnt+1;}} ?>


				<?php
				$sql="SELECT qa_id from  question where e_id=:exam";
				$query = $dbh -> prepare($sql);
				$query->bindParam(':exam',$exam,PDO::PARAM_STR);
				$query->execute();
				$result=$query->fetchAll(PDO::FETCH_OBJ);
				$q=$result[0]->qa_id;
				?>


				<button class="btn"><a href="question.php?m=<?php  echo $q;?>&n=1" style="color: white; text-decoration: none;">start</a></button>
			</form>
		</div>
	</div>	
</div>

</body>
</html><?php }  ?>