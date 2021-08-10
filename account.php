<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
        require('./PHP/common_files.php');
    ?>
	<title>Document</title>
</head>
<body>
    <!-- Check if account id==loggedin user id => if true display pencils else no -->
    <?php
        require('./PHP/header.php')
    ?>
    <!-- Profile details update -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="profile-name" class="col-form-label">Name:</label>
                    <input type="text" class="form-control" id="profile-name">
                </div>
                <div class="form-group">
                    <label for="profile-roll" class="col-form-label">Roll Number:</label>
                    <input type="text" class="form-control" id="profile-roll">
                </div>
                <div class="form-group">
                    <label for="profile-location" class="col-form-label">Location:</label>
                    <input type="text" class="form-control" id="profile-location">

                </div>
                <div class="row">
                    <div class="col">
                        <label for="branch">Branch</label>
                        <input type="text" class="form-control" placeholder="Branch" id="branch">
                    </div>
                    <div class="col">
                        <label for="pass-year">Passing Year</label>
                        <input type="number" class="form-control" placeholder="Passing Year" id='pass-year'>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Update Details</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Only 1 project for student -->
    <!-- Add to guide's account -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addProjectModalLabel">Add/Edit Project Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
                <div class="form-group">
                    <label for="project-name" class="col-form-label">Project Name</label>
                    <input type="text" class="form-control" id="project-name">
                </div>
                <div class="form-group">
                    <label for="project-guide" class="col-form-label">Guide Name</label>
                    <input type="text" class="form-control" id="project-guide">
                </div>
                <div class="form-group">
                    <label for="member-count" class="col-form-label">Group Member count</label>
                    <input type="text" class="form-control" id="member-count" placeholder="Member count (excluding you)">
                    <p id="error-text"></p>
                </div>
                <div class="row">
                    <div class="col member-input-container hide">
                        <label for="member-1">Member Name</label>
                        <input type="text" class=" form-control" placeholder="Member 1 Name" id="member-1">
                    </div>
                    <div class="col member-input-container hide">
                        <label for="member-2">Member Name</label>
                        <input type="text" class="form-control" placeholder="Member 2 Name" id='member-2'>
                    </div>
                </div>
                <!-- <div class="form-group member-input-container">
                    <label for="project-members" class="col-form-label">Group Members</label>
                    <input type="text" class="form-control" id="project-members">
                </div> -->
                <div class="form-group">
                    <label for="project-desc" class="col-form-label">Project Description</label>
                    <textarea class="form-control" id="project-desc"></textarea>
                </div>
                
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Update Details</button>
          </div>
        </div>
      </div>
    </div>
	<div class="container-fluid account-section mt-3">
        <div class="row">
	        <div class="col-lg-4 border-md-right border-default">
                <div class="container ">
                    <img src="https://chandanimourya.netlify.app/Images/chandani.jpg" alt="Profile" class="img-fluid rounded d-block mx-auto" style="height: 30vh; position:relative;">
                    <!-- Tablet Updates needed -->
                    <div class="profile-details my-2 container " style="padding-bottom: 5em;">
                        <div class="d-flex justify-content-end">
                            
                            <div class="text-center pr-lg-3 pl-lg-0 pl-5">
                                <h5>Chandani Mourya: 19101A2001</h5>
                                <span><span class="fa fa-map-marker-alt"></span> Mumbai</span>
                                <span class="d-block">Information Technology</span>
                                <p>Batch of 2022</p>
                            </div>
                            <!-- Display Pencil for Editing -->
                            <button class="btn bg-transparent align-self-start" data-toggle="modal" data-target="#editProfileModal"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </div>
                </div>     
           </div>
           <div class="col-md-8">
               <div class="container">
                   <!-- <h2>Account Details</h2>  -->
                   
                   <div class="projects">
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <h2>Project Details</h2>
                            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#addProjectModal">
                                <!-- Only 1 for project -->
                                <i class="fas fa-plus"></i>
                                Add Project
                            </button>
                        </div>
                        <div class="container">
                           <div class="card mb-4">
                                <div class="card-header">
                                   BookBarn: Web Based Book Recommendation and E-commerce System
                                </div>
                                <div class="card-body">
                                   <h5 class="card-title">Guide Name: Deepali Shrikhande</h5>
                                    <p class="card-text">
                                        BookBarn is a website that would allow users to buy, sell as well as rent books all at a single place. The website would further recommend books to the users based on their
                                        buying/search history and based on similar user's preferences.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <p>Group Members: Rohana Survase, Sayali Khamgaonkar</p>
                                    <!-- <p>Technology used: HTML, CSS, Javascript, SQL, PHP, Python. -->
                                    </p>
                                    <a href="#" class="btn btn-primary">View Project</a>
                                </div>
                           </div>
                           <div class="card mb-2">
                                <div class="card-header">
                                   BookBarn: Web Based Book Recommendation and E-commerce System
                                </div>
                                <div class="card-body">
                                   <h5 class="card-title">Guide Name: Deepali Shrikhande</h5>
                                    <p class="card-text">
                                        BookBarn is a website that would allow users to buy, sell as well as rent books all at a single place. The website would further recommend books to the users based on their
                                        buying/search history and based on similar user's preferences.
                                    </p>
                                </div>
                                <div class="card-body">
                                    <p>Group Members: Rohana Survase, Sayali Khamgaonkar</p>
                                    <!-- <p>Technology used: HTML, CSS, Javascript, SQL, PHP, Python. -->
                                    </p>
                                    <a href="#" class="btn btn-primary">View Project</a>
                                </div>
                           </div>
                        </div>         
                   </div>
                </div>
           </div> 
        </div>
    </div>
	<!--<div class="col col-lg-9 border border-danger">
		
	</div> -->
	<!--</div> -->
	<!-- </div> -->
    <?php
        require('./PHP/footer.php')
    ?>		
    <script>
        let count=document.getElementById('member-count');
        count.addEventListener('input', ()=>{
            document.getElementById('error-text').innerText=``;
            //Value
            let count_value=parseInt(count.value);
            //Class refer
            let container_ref=document.getElementsByClassName('member-input-container')
            //So atleast 2 members
            if(count_value>0 && count_value<=2){

                for(let i=1;i<=count_value;i++){
                    container_ref[i-1].classList.remove('hide');
                }
            }
            else{
                for(let i of container_ref){
                    
                    if(!i.classList.contains('hide')){
                        i.classList.add('hide');
                    }
                } 
                if(count_value>2){
                    document.getElementById('error-text').innerText=`Group Member count cannot be more than 2`;
                    // $("#error-modal").modal()
                }

            }
        });
    </script>
</body>
</html>