<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quiztid']==0)) {
  header('location:logout.php');
  } else{

  	if(isset($_POST['add']))
	{
	$q_no=$_POST['q_no'];
    $question=$_POST['question'];
    $eid=$_SESSION['examid'];

    $options=array();
    $options[1]=$_POST['op1'];
    $options[2]=$_POST['op2'];
    $options[3]=$_POST['op3'];
    $options[4]=$_POST['op4'];

    $corrt=$_POST['corrt'];
    
    
	$sql="Insert Into question(q_no,question,e_id)Values(:q_no,:question,:eid)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':q_no',$q_no,PDO::PARAM_STR);
	$query->bindParam(':question',$question,PDO::PARAM_STR);
	$query->bindParam(':eid',$eid,PDO::PARAM_STR);
	$query->execute();
	$result=$query->fetchAll(PDO::FETCH_OBJ);
	$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			foreach ($options as $option => $value) {
				if($value!=''){
					if($corrt==$option){
						$is_correct=1;
					}else{
						$is_correct=0;
					}
					$sql="Insert Into choices(question_number,is_correct,text)Values(:lastInsertId,:is_correct,:value)";
					$query = $dbh->prepare($sql);
					$query->bindParam(':lastInsertId',$lastInsertId,PDO::PARAM_STR);
					$query->bindParam(':is_correct',$is_correct,PDO::PARAM_STR);
					$query->bindParam(':value',$value,PDO::PARAM_STR);
					$query->execute();
					$result=$query->fetchAll(PDO::FETCH_OBJ);
					$insert_row = $dbh->lastInsertId();
					if($insert_row){
						continue;
					}else{
						echo "<script>alert('Something went wrong.Please try again');</script>";
					}
				}
			}
			 header('location:addquestion.php');
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
	<title>Online Quiz | Add Questions</title>
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
			padding: 10px;
		}
		.wrapper .card .ques_title{
			margin-top: 10px;
			width: 90%;
		}
		.wrapper .card label{
			margin: 5px;
		}
		.wrapper .card input{
			width: 300px;
		}
		.wrapper .card .btnadd{
			transform: translateX(-50%);
			border: none;
			outline: none;
			background: #1b3e5c;
			cursor: pointer;
			font-size: 15px;
			color: white;
			border-radius: 4px;
			transition: .3s;
			float: right;
			width: 60px;
		}
		.wrapper .card .btnadd:hover{
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
	
		<div class="card">
			<form method="post" action="addquestion.php">
				<label>Question Number : </label>
				<input type="Number" name="q_no" required="true" style="width:30px;">
				<input type="text" name="question" id="question" required="true" class="ques_title">
				<br>
				<label>1.</label>
				<input type="text" name="op1" id="op1" required="true">
				<br>
				<label>2.</label>
				<input type="text" name="op2" id="op2" required="true">
				<br>
				<label>3.</label>
				<input type="text" name="op3" id="op3" required="true">
				<br>
				<label>4.</label>
				<input type="text" name="op4" id="op4" required="true">
				<br>
				<label>Correct Option</label>
				<select name="corrt" id="corrt" required="true">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<button type="submit" id="add" class="btnadd" name="add">Add</button>
				
			</form>
		</div>
	</div>	
</div>

</body>
</html><?php }  ?>




		