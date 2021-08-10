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
	<!-- <header> -->
		<?php
			require('./PHP/header.php');
		?>
	<!-- </header> -->
	<?php
		include('./PHP/connect.php');
		$row='';
		$sql = "SELECT * FROM project where project_id=".$_GET['id']."";
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
	<!-- File Uploaded Successfully Modal -->
	<div class="modal fade" id="success-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content bg-success text-white">
	      <div class="modal-header">
	        <h5 class="modal-title">Success</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>The File was successfully uploaded!</p>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Error Modal -->
	<div class="modal fade" id="error-modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content bg-danger text-white">
	      <div class="modal-header">
	        <h5 class="modal-title">Error!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p id='error-text'></p>
	      </div>
	    </div>
	  </div>
	</div>
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
					<!-- If project is hosted or stored on Github -->
					<a class="btn btn-primary btn-lg" href="#" role="button">View Project</a>
				</p>
			</div>
		</div>
	</div>
	<div class="team-details">
		<div class="container pb-5">
			<h2>Team Profile</h2>
			<!-- Guide Name -->
			<h5>Project Guide: </h5>
			<p>Prof. Deepali Shrikhande</p>
			<hr>
			<!-- Group Member names -->
			<h5>Group Members:</h5>
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
						<td>Project Report</td>
						<!-- Initially dash -->
						<td>12 June 2021</td>
						<td>Shardul Birje</td>
						<td>12.5 kb</td>
						<td>
							<!-- Display to Uploader-->
							<!-- <button type="button" class="btn btn-primary">Upload</button> -->
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Uploader only -->
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
							<!-- Visible to Uploader only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				    <div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						</div>
				      	<div class="modal-body">
				      		<form method="POST" enctype="multipart/form-data" class="d-flex justify-content-stretch w-100">
				      			<div class="input-group mb-3">
				      			  <div class="custom-file">
				      			    <input type="file" name='file' class="custom-file-input" id="fileInput" onchange="displayFile()" multiple>
				      			    <label class="custom-file-label" for="fileInput">Choose file</label>
				      			  </div>
				      			  <div class="input-group-append">
				      			    <button type="submit" class="btn input-group-text" name="submit" id="submit">Upload</span>
				      			  </div>
				      			</div>
				      		</form>
				      		<div id="display_file_name">
				      			
				      		</div>
				      	</div>
				    </div>
			  	</div>
			</div>
			<button type="button" class="upload-btn btn btn-primary" data-toggle="modal" data-target="#exampleModal">Upload Files</button>
					
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
	<?php
		require('./PHP/footer.php');
	?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>	
	<script src="./JS/project_script.js"></script>
</body>
</html>
<!-- File Upload Code -->
<?php
	if(isset($_POST['submit'])){
		//The File
		$file=$_FILES['file'];	
		// File Name
		$fileName=$_FILES['file']['name'];
		// File temporary Name
		$fileTemp=$_FILES['file']['tmp_name'];
		// File Size
		$fileSize=$_FILES['file']['size'];
		//File Error
		$fileError=$_FILES['file']['error'];
		//Type
		$fileType=$_FILES['file']['type'];
		//Extension
		$fileExt=explode('.', $fileName);
		$fileActualExt=strtolower(end($fileExt));
		//Allowed Extensions
		$allowed=array('html','css','js','java','pdf','docx','doc','png','jpeg','jpg','odf','xlsx');
		//Check for extension
		if(in_array($fileActualExt,$allowed)){
			//If no error in file upload
			if($fileError === 0){
				// FileSize less than 15 MB
				if($fileSize < 15000000){
					//Creates unique ID based on the current microseconds
					$fileNameNew = uniqid('',true).'.'.$fileActualExt;
					$target_dir = "Uploads/".$fileNameNew;
					move_uploaded_file($fileTemp, $target_dir);
					echo 
					"<script>$('#success-modal').modal()</script>";
				}
				/*If File size exceeds 15 mb*/
				else{
					echo'
					<script>
						document.getElementById("error-text").innerText="Your File is too big: '.$fileSize.' kbs";
						$("#error-modal").modal()
					</script>
					';
				}
			}else{
				echo'
					<script>
						document.getElementById("error-text").innerText="Error in uploading file.";
						$("#error-modal").modal()
					</script>
					';
			}

		}else{
			echo'
				<script>
					document.getElementById("error-text").innerText="Invalid File Type.";
					$("#error-modal").modal()
				</script>
			';
		}
	}
?>