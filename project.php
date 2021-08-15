<?php
	$projectID="";
	session_start();
	require('./PHP/common_files.php');
	if(isset($_GET['id'])){
	    $projectID=$_GET['id'];
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="style1.css">
	<title>Project Description</title>
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
		$grouprow='';
		
		$sql = "SELECT * FROM `project` where `project_id`='". $projectID ."'";
		$groupDetails="SELECT `group_member_names` FROM `group_details` WHERE `project_id`='". $projectID ."'";

		// $result = mysqli_query($connection, $sql);
		// echo("ABC ".$result);
		if ($result = mysqli_query($connection,$sql)) {
		  $row = mysqli_fetch_assoc($result);
		  // echo($row['project_name']);
		  // Free result set
		  mysqli_free_result($result);
		}else{
			//query fails
			echo(mysqli_error($connection));
		}
	?>
	<?php
		if ($groupresult = mysqli_query($connection,$groupDetails)) {
		  $grouprow = mysqli_fetch_assoc($groupresult);
		  // echo($row['project_name']);
		  // Free result set
		  mysqli_free_result($groupresult);
		}else{
			//query fails
			echo(mysqli_error($connection));
		}	
	?>
	
	<!-- Project Link Modal -->
	 <div class="modal fade" id="projectLinkModal" tabindex="-1" role="dialog" aria-labelledby="editProjectLinkModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProjectLinkModal">Add Project Link</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
                <div class="form-group">
                    <label for="project-link" class="col-form-label">Link:</label>
                    <input type="text" class="form-control" name="project-link" id="project-link">
                    <p id="error-text"></p>
                </div>
                <button type="submit" name="updateLink" class="btn btn-primary">Update Details</button>
            </form>
          </div>
<!--           <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div> -->
        </div>
      </div>
    </div>
    <?php
    // For Project Link Form
	if (isset($_POST['updateLink'])) {
		// echo $_POST['project-link']."<script>$('#projecLinkModal').modal('hide');</script>";
		$link=$_POST['project-link'];
		$update_sql="UPDATE `project` SET `project_link`=". $link ."WHERE `project_id`=". $projectID;
		if (mysqli_query($connection, $update_sql)) {
			echo'
			  	<script>
					$("#projecLinkModal").modal("hide");
					document.getElementById("sucecss-text").innerText="Updated successfully!";
					$("#success-modal").modal()
				</script>
			';
		}else{
			echo'
				<script>
					document.getElementById("")
				</script>
			';
		}
	}
    /*if(!isset($_SESSION['userid']) && !$_SESSION['loggedin']==true){
        echo "<script> location.href='./loginPage.php'; </script>";
    }*/
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
	        <p id="success-text"></p>
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
	<!-- Details Modal -->
	<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="editDetailModal" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="editDetailModal">Add Other Details</h5>
	            <p>These details include any prizes won, sponsorship details for the project</p>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	            </button>
	          </div>
	          <div class="modal-body">
	            <form method="POST">
	                <div class="form-group">
	                    <!-- <label for="detail-text" class="col-form-label">Add:</label> -->
	                    <input type="text" class="form-control" name="detail-text" id="detail-text" placeholder="Enter Some Text">
	                    <!-- <p id="error-text"></p> -->
	                </div>
	                <button type="submit" name="addDetails" class="btn btn-primary">Update Details</button>
	            </form>
	          </div>
	<!--           <div class="modal-footer">
	            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	            
	          </div> -->
	        </div>
	      </div>
	    </div>
	<div class="project-details">
		<div class="jumbotron">
			<div class="container">
				<!-- Project Name -->
				<h1 class="project-title display-4">
				<?php
					echo $row['project_name'];
				?>
				</h1>
				<p class="project-desc lead text-justify">
				<?php
					echo $row['project_desc'];
				?>	

<!-- 					BookBarn is a website that would allow users to buy, sell as well as rent books all at a single place. The website would further recommend books to the users based on their buying/search history and based on similar user's preferences. Thus, the user would be able to buy new books, sell old books or rent old books all at a single place instead of visiting different sites for the same. -->
				</p>
					<!-- <div class="col">
						<img src="https://images.unsplash.com/photo-1471970471555-19d4b113e9ed?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxhbGx8fHx8fHx8fHwxNjE3MDkyNjA1&ixlib=rb-1.2.1&q=80&w=1080&utm_source=unsplash_source&utm_medium=referral&utm_campaign=api-credit" alt="Project Image" class="img-thumbnail rounded">
					</div> -->
				<!-- Desc -->
				
				<hr class="my-4">
				<p class="lead">
					<!-- Display if user has given a link-->
					<!-- If project is hosted or stored on Github -->
					<?php
						if (is_null($row['project_link'])) {
							echo'<button class="btn btn-secondary btn-lg" data-toggle="modal" data-target="#projectLinkModal">Add Project Link</button>';
						}else{
							echo('<a class="btn btn-primary btn-lg" href="'.$row['project_link'].'" role="button">View Project</a>');
						}
					?>
					
				</p>
			</div>
		</div>
	</div>
	<div class="team-details">
		<div class="container pb-5">
			<h2>Team Profile</h2>
			<!-- Guide Name -->
			<h5>Project Guide: </h5>
			<?php
				/*$select="SELECT guide_name FROM `guide` FULL OUTER JOIN `group_details`
ON table1.column_name = table2.column_name
WHERE condition;"*/
			?>
			<p>Prof. Deepali Shrikhande</p>
			<hr>
			<!-- Group Member names -->
			<h5>Group Members:</h5>
				<?php
					echo"<p>".$grouprow['group_member_names']."</p>";
				?>
				<!-- <p>Shardul Birje, 19101A2001</p>
				<p>Rohana Survase, 19101A2003</p>
				<p>Sayali Khamgaonkar, 19101A2005</p> -->
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
					<?php 
						$selectUser="SELECT  `student_id` FROM `student` WHERE `group_id`='".$row['group_id']."'";
						$selectresult = mysqli_query($connection, $selectUser);
					 	$selectrow='';
					 	if (mysqli_num_rows($selectresult) > 0) {
					 	  $selectrow = mysqli_fetch_assoc($selectresult);
						}	
					 ?>
					<tr>
						<th scope="row">1</th>
						<td>Project Report</td>
						<!-- Initially dash -->
						<td>12 June 2021</td>
						<td>Shardul Birje</td>
						<td>12.5 kb</td>
						<td>
							<!-- Display to Uploader-->
							<?php 
								if($selectrow['student_id']===$_SESSION['user_id']){
									if(is_null($row['blackbook_link'])){
										echo'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileModal">Upload</button>';
									}
								}
							 ?>
							
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Uploader only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Research Paper</td>
						<td>13 June 2021</td>
						<td>Rohana Survase</td>
						<td>121.5 kb</td>
						<td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileModal">Upload</button>
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Uploader only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td>V-ideas Presentation</td>
						<td>13 June 2021</td>
						<td>Rohana Survase</td>
						<td>121.5 kb</td>
						<td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fileModal">Upload</button>
							<button type="button" class="btn btn-success">Download</button>
							<!-- Visible to Uploader only -->
							<button type="button" class="btn btn-danger">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="modal fade" id="fileModal" tabindex="-1" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				    <div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Upload File</h5>
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
<!-- 			<button type="button" class="upload-btn btn btn-primary" data-toggle="modal" data-target="#fileModal">Upload Files</button> -->
					
		</div>
	</div>
	<div class="other-details py-5">
		<div class="container">
			<div class="d-flex justify-content-between align-items-center py-4">
				<h2>Other Details</h2>
				<?php 
					if(is_null($row['other_details'])){
						echo '<button class="btn btn-secondary" data-toggle="modal" data-target="#detailModal">Add Other Details</button>';
					}
				 ?>
			</div>
			<ul class="list-group">
				<l1 class="list-group-item">Winner of A Competition</l1>
				<l1 class="list-group-item">Project Sponsored by Amazon</l1>
			</ul>
		</div>
	</div>
	<?php
		require('./PHP/footer.php');
	?>
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
		$allowed=array('pdf','docx','doc','png','jpeg','jpg','odf');
		//Check for extension
		if(in_array($fileActualExt,$allowed)){
			//If no error in file upload
			if($fileError === 0){
				// FileSize less than 15 MB
				if($fileSize < 15000000){
					//Creates unique ID based on the current microseconds
					$fileNameNew = uniqid('',true).'.'.$fileActualExt;
					$target_dir = "Uploads/".$_SESSION['user_id']."/".$fileNameNew;
					move_uploaded_file($fileTemp, $target_dir);
					echo 
					"<script>
					document.getElementById('success-text').innerText='The File was successfully uploaded!';
					$('#success-modal').modal()</script>
					";
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

