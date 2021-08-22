<?php 
 echo "hello";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz | Home</title>
	<?php include_once('links.php');?>
	<style type="text/css">
		
		.navbar {
  			background: #1b3e5c;
  			
		}
		.navbar-brand{
			color: white;
		}
		.nav-item: hover{
			background: #0e2e4a;
		}
		.nav-link{
			color: #bdb8d7;
			text-align: center;
		}
		.collapse li:hover{
			background: #0e2e4a;
		}
		a:hover{
			color: #fff;
		}
		
		.red h3{
			font-size: 3em;
		  	font-family: 'Scada-Bold';
		  	color: #1B3E5C;
		}

		.red ul {
		  	padding: 0.5em 0 0;
		}
		.red ul li{
			list-style: none;
			font-size: medium;
		}
	</style>	
</head>
<body>
<!--header-->
<nav class="navbar navbar-expand-md">

  <a class="navbar-brand" href="index.php">ONLINE QUIZ</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span><i class="fas fa-bars" style="color:white;"></i></span>
    
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student/signin.php">Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teacher/signin.php">Teacher</a>
      </li>    
    </ul>
  </div>  
</nav>
<br>
<!--header-->
<!--content-->
	
		<div class="container">	
			<div class="row">
				<div class="col-md-6 come">
					<div class=" welcome">
						<img src="quizo.jpg" alt="" height="300px" width="100%">

					</div>
				</div>

				<div class="col-md-6 red">
					<h3>Mission & Vision</h3>
						<ul>
							<li>To provide a vibrant learning environment in Computer Science and Engineering with focus on industry needs and research, for the students to be successful global professionals contributing to the society.</li>
							<li>To adopt a contemporary teaching learning process with emphasis on hands on and collaborative learning.</li>
							<li>To facilitate skill development through additional training and encourage student forums for enhanced learning.</li>
							<li>To collaborate with Industry partners and Professional Societies and make the students industry ready.</li>
							<li>To encourage innovation through multidisciplinary research and development activities.</li>
							<li>To inculcate human values and ethics in students and groom them to be responsible citizens.</li>
							<li></li>	
						</ul>
				</div>
			</div>
		</div>	
</body>
</html>