<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quizsid']==0)) {
  header('location:logout.php');
  } else{

  		if(isset($_POST['go'])) 
 		{
    		$ecode=$_POST['ecode'];
    		$sql ="SELECT exam_id FROM schedule WHERE QuizCode=:ecode";
    		$query=$dbh->prepare($sql);
    		$query->bindParam(':ecode',$ecode,PDO::PARAM_STR);	
    		$query->execute();
    		$results=$query->fetchAll(PDO::FETCH_OBJ);
    		if($query->rowCount() > 0)
			{
				foreach ($results as $result) {
					$_SESSION['exam']=$result->exam_id;
				}
		
				echo "<script type='text/javascript'> document.location ='info.php'; </script>";
			} 
			else{
				echo "<script>alert('Invalid Details');</script>";
				echo "<script type='text/javascript'> document.location ='tquiz.php'; </script>";
			}
		}
?>

 


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Take Quiz</title>
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
		<h5>Take Quiz</h5>
		<hr>
		<div class="card">
			<form method="post" action="tquiz.php">
				<label>Enter the quiz code</label>
				<input type="text" id="ecode" name="ecode" required="true">
				<br>
				<button type="submit" id="go" class="btn" name="go">Go</button>
			</form>
		</div>
	</div>	
</div>

</body>
</html><?php }  ?>