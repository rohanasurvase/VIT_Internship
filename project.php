<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style1.css">
	<title>Homepage</title>
</head>
<body>
	<header>
		<?php
			include('./PHP/header.php');
		?>
	</header>
	<?php
		include('./PHP/connect.php');
		$row='';
		$sql = "SELECT * FROM project where pro_id=".$_GET['id']."";
		// $result = mysqli_query($conn, $sql);20
		// echo("ABC ".$result);
		if ($result = mysqli_query($connection,$sql)) {
		  $row = mysqli_fetch_assoc($result);
		  #echo($row['Pro_id']);
		  // Free result set
		  mysqli_free_result($result);
		}else{
			//query fails
			echo("Yo");
		}
	?>
	<div class="project-details">
		<div class="jumbotron">
			<div class="container">
				<!-- Project Name -->
				<h1 class="project-title display-4">BookBarn</h1>
				<p class="project-desc lead text-justify">
					BookBarn is a website that would allow users to buy, sell as well as rent books all at a single place. The website would further recommend books to the users based on their buying/search history and based on similar user's preferences. Thus, the user would be able to buy new books, sell old books or rent old books all at a single place instead of visiting different sites for the same.
				</p>
					<!-- <div class="col">
						<img src="https://images.unsplash.com/photo-1471970471555-19d4b113e9ed?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxhbGx8fHx8fHx8fHwxNjE3MDkyNjA1&ixlib=rb-1.2.1&q=80&w=1080&utm_source=unsplash_source&utm_medium=referral&utm_campaign=api-credit" alt="Project Image" class="img-thumbnail rounded">
					</div> -->
				<!-- Desc -->
				
				<hr class="my-4">
				<p class="lead">
					<!-- Black Book -->
					<a class="btn btn-primary btn-lg" href="#" role="button">Project Report</a>
				</p>
			</div>
		</div>
	</div>
	<div class="team-details">
		<div class="container">
			<h2>Team Profile</h2>
			<!-- Guide Name -->
			<p>Project Guide: </p>
			<p>Prof. Deepali Shrikhande</p>
			<!-- Group Member names -->
			<p>Group Members:</p>
				<p>Shardul Birje, 19101A2001</p>
				<p>Rohana Survase, 19101A2003</p>
				<p>Sayali Khamgaonkar, 19101A2005</p>
		</div>
	</div>
	<div class="project-table">
		<div class="container">
			<h2>Project Documents</h2>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Sr.</th>
						<th scope="col">Name</th>
						<th scope="col">Modification Date</th>
						<th scope="col">Modified By</th>
						<th scope="col">File Size</th>
						<th scope="col">Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>HTML code</td>
						<td>12 June 2021</td>
						<td>Shardul Birje</td>
						<td>12.5 kb</td>
						<td>
							<!-- <button type="button" class="btn btn-primary">Upload</button> -->
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Students only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Javascript code</td>
						<td>13 June 2021</td>
						<td>Rohana Survase</td>
						<td>121.5 kb</td>
						<td>
							<!-- <button type="button" class="btn btn-primary">Upload</button> -->
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Students only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
			<button type="button" class="btn btn-primary">Upload File</button>
					
		</div>
	</div>
	<div class="other-details my-5">
		<div class="container">
			<h2>Other Details</h2>
			<ul class="list-group">
				<l1 class="list-group-item">Winner of A Competition</l1>
				<l1 class="list-group-item">Project Sponsored by Amazon</l1>
			</ul>
		</div>
	</div>
	<footer class="page-footer">
		<div class="container">
			<div class="text-center text-md-left">
			    <!-- Grid row -->
			    <div class="row">
			    	<!-- Grid column -->
					<div class="col-md-6 mt-md-0 mt-3">
						<!-- Content -->
						<h5 class="text-uppercase">VIT Project Hub</h5>
						<p>A Single Place for all Final Year Projects!</p>
					</div>
					<!-- Grid column -->
				    <!-- Grid column -->
				    <div class="col-md-6 mb-md-0 mb-3">
				        <!-- Links -->
				        <h5 class="text-uppercase text-right">Other Links</h5>
				        <ul class="list-unstyled text-right">
							<li>
								<a href="https://www.vit.edu.in" target="_blank">College Website</a>
							</li>
							<li>
								<a href="https://erp.mycollege.edu.in" target="_blank">ERP</a>
							</li>
							<li>
								<a href="#!">VLive</a>
							</li>
				        </ul>
			    	</div>
			      <!-- Grid column -->
			    </div>
			    <!-- Grid row -->
			</div>
		 	 <!-- Footer Links -->
			<div class="text-center py-3">
				<a href="vit.edu.in/">Vidyalankar Institute of Technology</a>
		  	</div>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
</body>
</html>