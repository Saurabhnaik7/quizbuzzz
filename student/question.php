<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quizsid']==0)) {
  header('location:logout.php');
  } else{

  		$real_num=(int)$_GET['n'];
  		$reel_num=(int)$_GET['m'];
  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Questions</title>
	<?php include_once('links.php');?>
	<style type="text/css">
		.row .wrapper h5{
			margin-top: 20px;
			
		}
		.row .wrapper .card{
			width: 100%;
			border-color: black;		
		}
		.row .wrapper .card .card-header{
		    background-color: #dedede;
		}
		.row .wrapper .card ul li{
			list-style: none;
			
		}
		.row .wrapper .card ul input{
			margin-top: 10px;
		}
		.wrapper .btn{
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
		.wrapper .btn:hover{
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
	
		<div class="current"><h5>Question <?php  echo $real_num;?> of <?php  echo $_SESSION['numofques'];?></h5></div>
		<br>
		<?php
		$exam=$_SESSION['exam'];
		$sql="SELECT * from  question where e_id=:exam and qa_id=:reel_num";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':exam',$exam,PDO::PARAM_STR);
		$query->bindParam(':reel_num',$reel_num,PDO::PARAM_STR);
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
			foreach($result as $value)
			{ 
		 ?>

		<div class="card">
			<div class="card-header"><?php  echo $value->question;?></div>
			<?php  $qno=$value->qa_id;?>
			<form method="post" action="process.php">
				<ul class="choices">
					<?php
					$sql="SELECT * from  choices where question_number=:qno";
					$query = $dbh -> prepare($sql);
					$query->bindParam(':qno',$qno,PDO::PARAM_STR);
					$query->execute();
					$result=$query->fetchAll(PDO::FETCH_OBJ);
					$cnti=1;
					if($query->rowCount() > 0)
					{
					foreach($result as $row)
					{ 
		 			?>
					<li>
						<input type="radio" name="choice" value="<?php  echo $row->a_id;?>"><?php  echo $row->text;?></li>
					<?php $cnti=$cnti+1;}} ?>
				</ul>
		</div>	
		<br>
		<br>
		<?php $cnt=$cnt+1;}} ?>
		<input type="submit" class="btn" name="submit" value="next">
		<input type="hidden" name="reel_num" value="<?php  echo $reel_num;?>">
		<input type="hidden" name="real_num" value="<?php  echo $real_num;?>">
		</form>
	</div>	
</div>

</body>
</html><?php }  ?>