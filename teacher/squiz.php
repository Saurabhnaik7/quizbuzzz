<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quiztid']==0)) {
  header('location:logout.php');
  } else{

  	if(isset($_POST['addq']))
	{
    $qname=$_POST['qname'];
    $num=$_POST['num'];
    $tmarks=$_POST['tmarks'];
    $time=$_POST['time'];
    $qcode=$_POST['qcode'];
    $tid=$_SESSION['quiztid'];
    $ret="select QuizCode from schedule where QuizCode=:qcode";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':qcode', $qcode, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() == 0)
	{
		$sql="Insert Into schedule(QuizName,NumofQues,TotalMarks,Duration,QuizCode,t_id)Values(:qname,:num,:tmarks,:time,:qcode,:tid)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':qname',$qname,PDO::PARAM_STR);
		$query->bindParam(':num',$num,PDO::PARAM_STR);
		$query->bindParam(':tmarks',$tmarks,PDO::PARAM_INT);
		$query->bindParam(':time',$time,PDO::PARAM_STR);
		$query->bindParam(':qcode',$qcode,PDO::PARAM_STR);
		$query->bindParam(':tid',$tid,PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_OBJ);
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			$_SESSION['examid']=$lastInsertId;
			echo "<script type='text/javascript'>document.location ='addquestion.php';</script>";
		}
		else
		{
			echo "<script>alert('Something went wrong.Please try again');</script>";
		}
	}
 	else
	{

		echo "<script>alert('Code already exist. Please create a different code');</script>";
	}
}



 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Schedule Quiz</title>
	<?php include_once('links.php');?>
	<style type="text/css">
		.wrapper h5{
			margin-top: 20px;
			
		}
		.wrapper  hr{
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
			display: inline-block;
			width: 180px;
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
		<h5>Schedule Quiz</h5>
		<hr>
		<div class="card">
			<form method="post">
				<label>Quiz Name :</label>
				<input type="text" name="qname" id="qname" required="true">
				<br>
				<label>Number of Questions :</label>
				<input type="text" name="num" id="num" required="true">
				<br>
				<label>Total Marks :</label>
				<input type="text" name="tmarks" id="tmarks" required="true">
				<br>
				<label>Duration :</label>
				<input type="text" name="time" id="time" required="true" placeholder="in mins">
				<br>
				<label>Create a code :</label>
				<input type="text" name="qcode" id="qcode" required="true" placeholder="6 characters">
				<br>
				<br>
				<button type="submit" id="addq" class="btn" name="addq">Add Questions</button>
				
			</form>
		</div>
	</div>	
</div>

</body>
</html><?php }  ?>