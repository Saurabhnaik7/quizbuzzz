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
	<title>Online Quiz | Student Profile</title>
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
		.wrapper .card h6{

			margin-left: 10px;
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
		<h5>Profile</h5>
		<hr>
		<div class="card">
			<?php
			$sid=$_SESSION['quizsid'];
			$sql="SELECT * from  tblstd where std_id=:sid";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':sid',$sid,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $row)
			{               ?>
			<h6>Name : <?php  echo $row->FullName;?></h6>
			<br>
			<h6>Email : <?php  echo $row->Email;?></h6>
			<br>
			<h6>Mobile Number : <?php  echo $row->MobileNumber;?></h6>
			
			<?php $cnt=$cnt+1;}} ?>
		</div>
	</div>	
</div>

</body>
</html><?php }  ?>