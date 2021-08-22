<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quiztid']==0)) {
  header('location:logout.php');
  } else{



  ?>


<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Details</title>
	<?php include_once('links.php');?>
	<style type="text/css">
		
		.wrapper .table{
			width: 100%;
		}
		.wrapper .table th{
			background-color: #dedede;
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
		<br>
		<br>
		<table class="table table-bordered">
			<tr>
				<th>S.No</th>
				<th>Student Name</th>
				<th>Student Email</th>
				<th>Marks Obtained</th>
				<th>Total Marks</th>
			</tr>
						
			<?php
			$tid=$_SESSION['quiztid'];
			$sql="SELECT * from results join tblstd on results.student=tblstd.std_id where teacher=:tid";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':tid',$tid,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);

			$cnt=1;
			if($query->rowCount() > 0)
			{
				foreach($results as $row)
				{   ?>
					<tr>
						<td><?php echo $cnt;?></td>
						<td><?php  echo $row->FullName;?></td>
						<td><?php  echo $row->Email;?></td>
						<td><?php  echo $row->Marks_obtained;?></td>
						<td><?php  echo $row->Total_marks;?></td>
					</tr>					
			<?php $cnt=$cnt+1;}
			}else{?>
				<tr>
					<td colspan="5">No Result to Display</td>
				</tr>
			<?php } ?>								
		</table>

	</div>	
</div>

</body>
</html><?php }  ?>