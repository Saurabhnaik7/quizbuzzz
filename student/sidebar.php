<!--verticle navbar -->

<div class="vertical-nav" id="sidebar">
	<ul class="nav flex-column mb-0">
        <li class="nav-item logo">
            <a href="#" class="navbar-brand">
                    ONLINE QUIZ
            </a>
        </li>
    </ul>
	<div class="py-4 px-3 mb-4">
		<div class="media d-flex align-items-center">
			<img src="../profile.jpg" alt="" width="80" height="80" class="mr-3 rounded-circle img-thumbnail">
			<div class="media-body">       
            	<?php
				$sid=$_SESSION['quizsid'];
				$sql="SELECT FullName,Email from  tblstd where std_id=:sid";
				$query = $dbh -> prepare($sql);
				$query->bindParam(':sid',$sid,PDO::PARAM_STR);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				$cnt=1;
				if($query->rowCount() > 0)
				{
				foreach($results as $row)
				{               ?>
				<h4 class="m-0"><?php  echo $row->FullName;?></h4>
				<?php $cnt=$cnt+1;}} ?>
				<p class="mb-0">(Student)</p>
			</div>
        </div>
    </div>

    <ul class="nav flex-column mb-0">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
                <i class="fas fa-home mr-3"></i>
                    Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="profile.php" class="nav-link">
                <i class="fas fa-user-alt mr-3"></i>
                    My Profile
            </a>
        </li>
        <li class="nav-item">
            <a href="tquiz.php" class="nav-link">
                <i class="fas fa-plus mr-3"></i>
                    Take Quiz
            </a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="fas fa-power-off mr-3"></i>
                    Logout
            </a>
        </li>            
    </ul>
</div>
