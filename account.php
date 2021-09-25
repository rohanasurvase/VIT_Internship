<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
        $userID='';
        session_start();
        require('./PHP/common_files.php');
        require('./PHP/connect.php');
        if(isset($_GET['userid'])){
            $userID=$_GET['userid'];    
        }
    ?> 
	<title>Account</title>
</head>
<body>
    <!-- Check if account id==loggedin user id => if true display pencils else no -->
    <?php
        if(!isset($_SESSION['user_id'])){
            echo "<script> location.href='./LoginPage.php'; </script>";
        }
        require('./PHP/header.php');
    ?>
    <?php
    //SELECT PROJECT
        $selectDetails="SELECT * FROM `user_info` WHERE `user_id`='". $userID ."'";
        $queryResult = mysqli_query($connection, $selectDetails);
        $userDetails = mysqli_fetch_assoc($queryResult);
        $studentDetails='';
        if($userDetails['type']==="student"){
            $selectStudentDetails="SELECT * FROM `student` WHERE `student_id`='". $userID ."'";
            $studentQueryResult = mysqli_query($connection, $selectStudentDetails);
            $studentDetails = mysqli_fetch_assoc($studentQueryResult);
        }                           
        // echo($userDetails);
    ?>
    <?php 
    $selectProjectResult='';
    if($userDetails['type']==="student"){
        if (!is_null($studentDetails['group_id'])) {
            // echo("Yo");
            $selectGroupDetails="SELECT * FROM `group_details` WHERE `group_id`='". $studentDetails['group_id'] ."'";
            $selectGroupResult=mysqli_query($connection, $selectGroupDetails);    
            $groupDetails=mysqli_fetch_assoc($selectGroupResult);
            $groupMember1ID='';
            $groupMember2ID='';
            $groupids=$groupDetails['group_member_ids'];
            $groupids=explode(',', $groupids);
            $index=array_search($userID, $groupids);
            array_splice($groupids,$index,1);
            if($groupDetails['group_member_count']==2){
                $groupMember1ID=$groupids[0];
            }else{
                $groupMember1ID=$groupids[0];
                $groupMember2ID=$groupids[1];
            }
            $selectProjectDetails="SELECT `project_id`,`project_name`,`project_desc`,`guideid`,`technologies`,`project_link` FROM `project` WHERE `group_id`='". $studentDetails['group_id'] ."'";
            $selectProjectResult=mysqli_query($connection, $selectProjectDetails);    
            $projectDetails=mysqli_fetch_assoc($selectProjectResult);
        }
    }else{
        // For Guide
        //$selectProjectDetails="SELECT `project_id`,`project_name`,`project_desc`,`technologies` FROM `project` WHERE `guideid`='". $userID ."'";
        $selectGuideProjectDetails="SELECT `project_name`,`project_desc`,`technologies`,`project_id` 
        FROM `project`
        WHERE `guideid`='".$userID."'";

        
    }
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
                    <p style="color:red">Items marked <b>*</b> cannot be updated once inserted</p>
                    <form method="POST" action="">
                        <div class="row">
                            
                            <div class="col">
                                <label for="first-name">First Name</label>
                                <input type="text" class=" form-control" placeholder="First Name" id="first-name" name="first-name" value="<?php 
                                if(isset($userDetails["username"])){
                                    $text=explode(" ",$userDetails["username"]);
                                    echo $text[0];
                                }else{
                                    echo "";
                                }
                            ?>">
                            </div>
                            <div class="col">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id='last-name' name="last-name" value="<?php 
                                if(isset($userDetails["username"])){
                                    $text=explode(" ",$userDetails["username"]);
                                    echo $text[1];
                                }else{
                                    echo "";
                                }
                            ?>">
                            </div>
                        </div>
 <!--                        <div class="form-group">
                            <label for="image">Enter Profile Image</label>
                            <div class="custom-file">
                              <input type="file" name='file' class="custom-file-input" id="fileInput">
                              <label class="custom-file-label" for="fileInput">Choose profile image</label>
                            </div>
                        </div> -->
                        <div class="form-group">
                            
                            <?php
                                $department='';
                                $readonly=""; 
                                if(!is_null($userDetails["department"])){
                                    $department=$userDetails["department"];
                                    $readonly="readonly";
                                }else{
                                    $department='';
                                    $readonly="";
                                }
                                echo'
                                <label for="profile-branch" class="col-form-label">Department <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="profile-branch" placeholder="Enter Department code" name="department" data-toggle="tooltip" data-placement="right" title="eg-INFT/CMPN" value="'.$department.'" '.$readonly.'>';
                             ?>
                            
                        </div>
                        
                        <?php
                            $division='';
                            $readonly="";
                            if(isset($studentDetails["division"]) && $studentDetails["division"]!=0){
                                $readonly="readonly";
                                $division=$studentDetails["division"];
                            }else{
                                $division="";
                                $readonly="";
                            }
                            if($userDetails["type"]==="student"){
                                echo'<div class="form-group">
                                <label for="profile-division" class="col-form-label">Division <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="profile-division" placeholder="Enter Division" name="division" data-toggle="tooltip" data-placement="right" title="eg-1/2" value="'.$division.'"'.$readonly.'>
                                </div>
                                ';
                            }else if($userDetails["type"]==="guide"){
                                $guideCodeRow='';
                                $SelectGuideCode="SELECT `guide_code` FROM `guide` WHERE `guide_id`='". $userID ."'";
                                $GuideCodeResult=mysqli_query($connection,$SelectGuideCode);
                                if(mysqli_num_rows($GuideCodeResult)>0){
                                    $guideCodeRow=mysqli_fetch_assoc($GuideCodeResult);
                                    $guideCode=$guideCodeRow['guide_code'];
                                }else{
                                    $guideCode='';
                                }
                                echo'<div class="form-group">
                                <label for="profile-guide-code" class="col-form-label">Guide Code</label>
                                <input type="text" class="form-control" id="profile-guide-code" placeholder="Enter Code" name="guide-code" data-toggle="tooltip" data-placement="right" title="eg-IJA, RB, DJS" value="'.$guideCode.'">
                                </div>
                                ';
                            }
                        ?>
                        <?php
                            $batchVal='';
                            if(isset($studentDetails["batch"])){
                                $batchVal=$studentDetails["batch"];
                            }else{
                                $batchVal="";
                            }
                            if($userDetails["type"]==="student"){
                                echo'<div class="form-group">
                                    <label for="pass-year" class="col-form-label">Passing Year:</label>
                                    <input type="text" class="form-control" id="pass-year" name="pass-year" placeholder="eg: 2022"
                                    value="'.$batchVal.'">
                                    </div>';
                            }
                        ?>
                        
                        <button type="submit" class="btn btn-primary" name="details-submit">Update Details</button>
                    </form>
                </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                
              </div>
          <!-- </form> -->
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
          <form method="POST" action="">
          <div class="modal-body">
                <p style="color:red">Items marked <b>*</b> cannot be updated once inserted</p>
                <div class="form-group">
                    <label for="project-name" class="col-form-label">Project Name</label>
                    <input type="text" class="form-control" id="project-name" name="project-name" value="<?php 
                        if(isset($projectDetails['project_name'])){
                            echo $projectDetails['project_name'];
                        }else{
                            echo('');
                        } ?>" required>
                </div>
                <div class="form-group">
                    <label for="project-link" class="col-form-label">Project link</label>
                    <input type="text" class="form-control" id="project-link" name="project-link" value="<?php 
                        if(isset($projectDetails['project_link'])){
                            echo $projectDetails['project_link'];
                        }else{
                            echo('');
                        }?>">
                </div>
                <div class="form-group">
                    <label for="project-technologies" class="col-form-label">Techonologies used</label>
                    <input type="text" class="form-control" id="project-technologies" placeholder="eg: HTML, CSS" data-toggle="tooltip" data-placement="right" title="Use commas for entering multiple Techonologies/languages" name='skills' value="<?php
                        if(isset($projectDetails['technologies'])){
                            echo $projectDetails['technologies'];
                        }else{
                            echo('');
                        }

                    ?>" required>
                    <!-- <button class="btn btn-secondary" id='skills-submit'>Add</button> -->
                    <!-- <p class="skills" id='skills-box'> -->
                        
                    </p>
                </div>
                <div class="form-group">
                    <?php 
                        $guide_code='';
                        $readonly="";
                        if(isset($studentDetails['guide_id'])){
                            $GuideName="SELECT `guide_code` FROM `guide` where `guide_id`='". $studentDetails['guide_id'] ."'";
                            $result = mysqli_query($connection, $GuideName);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $readonly="readonly";
                                $guide_code=$row["guide_code"];
                            }else{
                                $guide_code="";
                                $readonly="";
                            } 
                        }
                        echo'
                        <label for="project-guide" class="col-form-label">Guide Code <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="project-guide" name="project-guide" placeholder="Enter guide code" data-toggle="tooltip" data-placement="right" title="For eg:IJA, RB, DJS" value="'.$guide_code.'" '.$readonly.' required>';
                    ?>
                    
                </div>
                <div class="form-group">
                    <?php 
                        $mem_count='';
                        $readonly="";
                        if(isset($groupDetails['group_member_count']) && $groupDetails['group_member_count']!=0){
                            $readonly="readonly";
                            $mem_count=$groupDetails["group_member_count"]-1;
                        }else{
                            $mem_count="";
                            $readonly="";
                        }
                        echo'
                        <label for="member-count" class="col-form-label">Group Member count <span style="color:red">*</span></label>
                    <input type="number" class="form-control" id="member-count" name="member-count" min="1" max="2" placeholder="Member count (excluding you)" value="'.$mem_count.'" '.$readonly.' required>';

                     ?>                  
                    <p id="error-text"></p>
                </div>
                <div class="row">
                    <div class="col member-input-container hide" >
                        <label for="member-1">Member Email <span style="color:red">*</span></label>
                        <input type="email" class=" form-control" placeholder="Member 1 Email" id="member-1" name="member-1" value="<?php
                            if(isset($groupMember1ID)){
                                $selectMember1email="SELECT `email` FROM `user_info` WHERE `user_id`='". $groupMember1ID ."'";
                                $Member1result = mysqli_query($connection, $selectMember1email);
                                if (mysqli_num_rows($Member1result) > 0){
                                    $row = mysqli_fetch_assoc($Member1result);
                                    echo($row['email']);    
                                }else{
                                    echo '';
                                }
                            }else{
                                echo('');
                            }
                        ?>">
                    </div>
                    <div class="col member-input-container hide">
                        <label for="member-2">Member Email <span style="color:red">*</span></label>
                        <input type="email" class="form-control" placeholder="Member 2 Email" id='member-2' name="member-2" value="<?php
                            if(isset($groupMember2ID)){
                                $selectMember2email="SELECT `email` FROM `user_info` WHERE `user_id`='". $groupMember2ID ."'";
                                $Member2result = mysqli_query($connection, $selectMember2email);
                                if (mysqli_num_rows($Member2result) > 0){
                                    $row = mysqli_fetch_assoc($Member2result);
                                    echo($row['email']);    
                                }else{
                                    echo '';
                                }
                            }else{
                                echo('');
                            }
                        ?>">
                    </div>
                </div>
                <!-- <div class="form-group member-input-container">
                    <label for="project-members" class="col-form-label">Group Members</label>
                    <input type="text" class="form-control" id="project-members">
                </div> -->
                <div class="form-group">
                    <label for="project-desc" class="col-form-label">Project Description</label>
                    <textarea class="form-control" id="project-desc" name="project-desc" 
                     required><?php 
                        if(isset($projectDetails['project_desc'])){
                            echo $projectDetails['project_desc'];
                        }else{
                            echo('');
                        }?>
                    </textarea>
                </div>
                
                
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name='project-submit' class="btn btn-primary">Update Details</button>
            
          </div>
          </form>  
        </div>
      </div>
    </div>
    
	<div class="container-fluid account-section mt-3">
        <div class="row my-4">
	        <div class="col-lg-4 col-12 border-right border-default">
                <div class="container text-center">
                    <img src="<?php
                       echo $userDetails['image'];
                    ?>" alt="Profile" class="img-fluid rounded d-block mx-auto" style="height: 30vh; position:relative;">
                    <?php 
                        if($_SESSION["user_id"]===$userID){
                            echo '<button class="btn btn-outline-secondary mt-3" data-toggle="modal" data-target="#profileModal"><i class="fas fa-camera"></i></button>';
                        }
                     ?>
                    
                    <div class="profile-details my-2 container mx-auto" style="padding-bottom: 5em;">
                        <div class="d-flex justify-content-center">
                            
                            <div class="text-center">
                                <h5><?php
                                    echo $userDetails['username']; //19101A2001
                                ?></h5>
                                <!-- <span><span class="fa fa-map-marker-alt"></span> Mumbai</span> -->
                                <span class="d-block">
                                    <?php
                                        echo $userDetails['department'];
                                    ?>
                                </span>
                                <?php
                                    if($userDetails["type"]==="student"){
                                        if($studentDetails["batch"]==0){
                                            echo "";
                                        }else{
                                            echo "<p>Batch of ".$studentDetails['batch']."</p>";
                                        }
                                    }
                                 ?>
                                <?php
                                        //check session variable
                                        if($_SESSION["user_id"]===$userID){
                                        // Display Pencil for Editing
                                            echo'<button class="btn btn-outline-secondary align-self-start my-2" data-toggle="modal" data-target="#editProfileModal"><i class="fas fa-plus"></i> Edit Details</i></button>';
                                        }
                                    ?>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>     
           </div>
           <!-- Upload Image  -->
           <div class="modal fade" id="profileModal" tabindex="-1" role="dialog">
               <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title">Change Profile Image</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <p style="color:red">Note: Select a square image</p>
                           <form method="post" enctype="multipart/form-data" class="d-flex justify-content-stretch w-100">
                               <div class="input-group mb-3">
                                   <div class="custom-file">
                                       <input type="file" name='file' class="custom-file-input" id="profileInput" onchange="displayImage()">
                                       <label class="custom-file-label" for="profileInput">Choose Image</label>
                                   </div>
                                   <div class="input-group-append">
                                       <button type="submit" class="btn input-group-text" name="profile-submit" id="profile-submit">Upload</button>
                                   </div>
                               </div>
                           </form>
                           <div id="display_image_name">
                               
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-lg-8">
               <div class="container">
                   <!-- <h2>Account Details</h2>  -->
                   
                   <div class="projects">
                        <div class="d-lg-flex justify-content-between align-items-center py-3">
                            <h2>Project Details</h2>
                            
                        </div>
                        <div class="container">
                            <?php

                                /*$selectProject="SELECT `project_id`,`project_name`,`project_desc`,`guideid`,`technologies` FROM `project` WHERE `group_id`='".:
                                $selectProject='';
                                if($userDetails['type']==="student"){
                                    $selectProject="SELECT"
                                }else{

                                }
                                $check="";                            
                                $selectProject="SELECT `group_id` FROM `student` WHERE `student_id`='" .$userID. "'";
                                $selectResult = mysqli_query($connection, $selectID);
                                if(mysqli_num_rows($selectResult) > 0){
                                    $details = mysqli_fetch_assoc($selectResult);
                                    $check=is_null($details['group_id']);
                                }
                                else{
                                    //Do not Display any projects
                                    // echo "No Rows Found";
                                }*/
                                // Type=student
                                if($_SESSION["user_id"]===$userID && $userDetails['type']==="student" && !is_null($userDetails["department"])){
                                    echo 
                                    '<button class="btn btn-outline-secondary my-2" data-toggle="modal" data-target="#addProjectModal">
                                        
                                        <i class="fas fa-plus"></i>
                                        Add Project
                                    </button>';
                                }
                            ?>
                            <?php 
                                if($userDetails['type']==="student"){
                                    if(!is_null($studentDetails['group_id'])){
                                        $GuideName="SELECT `username` FROM `user_info` where `user_id`='". $studentDetails['guide_id'] ."'";
                                        $Guideresult = mysqli_query($connection, $GuideName);
                                        $Guiderow='';
                                        if (mysqli_num_rows($Guideresult) > 0) {
                                            $Guiderow = mysqli_fetch_assoc($Guideresult);
                                        }
                                        echo'
                                        <div class="card mb-4">
                                            <div class="card-header">
                                            '.$projectDetails["project_name"].'
                                            </div>
                                            <div class="card-body">
                                               <h5 class="card-title">Guide Name: '.$Guiderow["username"].'</h5>
                                                <p class="card-text">
                                                    '.$projectDetails["project_desc"].'
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <p>Group Members: '.$groupDetails["group_member_names"].'</p>
                                                <p>Technology used: '.$projectDetails["technologies"].'
                                                </p>
                                                <a href="./project.php?id='.$projectDetails["project_id"].'" class="btn btn-primary">View Project</a>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }else{
                                   $selectProjectResult=mysqli_query($connection, $selectGuideProjectDetails);    
                                    // $SelectGroupMembers="SELECT `group_member_names` FROM `group_details` WHERE `guide_id`='"$userID"'";
                                    // $selectGroupResult=mysqli_query($connection, $selectGroupMembers);
                                    if (mysqli_num_rows($selectProjectResult) > 0) {

                                        while($projectDetails=mysqli_fetch_assoc($selectProjectResult)){
                                            // <!--<p>Group Members: '.$projectDetails["group_member_names"].'</p>-->
                                            echo'
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                '.$projectDetails["project_name"].'
                                                </div>
                                                <div class="card-body">
                                                   <h5 class="card-title">Guide Name: '.$userDetails["username"].'</h5>
                                                    <p class="card-text">
                                                        '.$projectDetails["project_desc"].'
                                                    </p>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <p>Technology used: '.$projectDetails["technologies"].'
                                                    </p>
                                                    <a href="./project.php?id='.$projectDetails["project_id"].'" class="btn btn-primary">View Project</a>
                                                </div>
                                            </div> ';   
                                        }
                                    }

                                }
                             ?>
                        </div>         
                   </div>
                   <?php
                       if($_SESSION["user_id"]===$userID){
                           echo'<form method="POST" class="container d-flex justify-content-end">
                               <button class="btn btn-outline-secondary" name="logout" type="submit">Log Out</button> 
                           </form>';
                        }
                    ?>
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
    <script src="./JS/project_script.js"></script>
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
                    container_ref[i-1].required=true;
                }
            }
            else{
                for(let i of container_ref){
                    
                    if(!i.classList.contains('hide')){
                        i.classList.add('hide');
                        i.required=false;
                    }
                } 
                if(count_value>2){
                    document.getElementById('error-text').innerText=`Group Member count cannot be more than 2`;
                    // $("#error-modal").modal()
                }

            }
        });
        /*let skillsReference=document.getElementById('skills-submit');
        skills.addEventListener('click',()=>{
            let skills=document.getElementById('project-technologies').value;
            let arr=skills.split(',');
            for(let i of arr){
                document.getElementById('skills-box').innerHTML+=i;
            }
        });*/ 
    </script>
    <?php
    if(isset($_POST['logout'])){
        unset($_SESSION['user_id']);
        // $_SESSION['loggedin']=false;
        session_destroy();
        echo '<script> location.href="./index.php";</script>';
        // header('Location:./index.php'); 
        exit;
    }
    ?>
</body>
</html>
<!-- Profile Image -->
<?php 
if (isset($_POST["profile-submit"])) {
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
    $allowed=array('png','jpeg','jpg');
    //Check for extension
    if(in_array($fileActualExt,$allowed)){
        //If no error in file upload
        if($fileError === 0){
            // FileSize less than 10 MB
            if($fileSize < 10000000){
                //Creates unique ID based on the current microseconds
                $fileNameNew = 'profile'.'.'.$fileActualExt;
                $target_dir = "Uploads/".$_SESSION['user_id']."/".$fileNameNew;
                $insertDocument="UPDATE `user_info` SET `image`='./".$target_dir."' WHERE `user_id`='".$userID."'";
                $del='';
                if (mysqli_query($connection, $insertDocument)) {
                    if(file_exists('./Uploads/'.$_SESSION['user_id'].'/profile.png')){
                        $del=unlink('./Uploads/'.$_SESSION['user_id'].'/profile.png');
                    }else if (file_exists('./Uploads/'.$_SESSION['user_id'].'/profile.jpg')) {
                        $del=unlink('./Uploads/'.$_SESSION['user_id'].'/profile.jpg');
                    }else if (file_exists('./Uploads/'.$_SESSION['user_id'].'/profile.jpeg')){
                        $del=unlink('./Uploads/'.$_SESSION['user_id'].'/profile.jpeg');
                    }
                    move_uploaded_file($fileTemp, $target_dir);
                    echo 
                    "<script>
                    document.getElementById('success-text').innerText='The File was successfully uploaded!';
                    $('#success-modal').modal()</script>
                    ";
                    echo '
                    <script type="text/javascript">
                    location.href="./index.php?action=success&id='.$userID.'";
                    </script>';
                } else {
                  echo "Error in updating file record";
                }               
                
            }

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
<!-- For Profile Details -->
<?php 
    if (isset($_POST['details-submit'])) {
            
        $firstName = $_POST['first-name'];
        $lastName=$_POST['last-name'];
        $name=$firstName.' '.$lastName;     
        $dept=$_POST['department'];
        $division_info='';
        $year='';
        $query="UPDATE `user_info` SET `username`='". $name ."', `department`='". $dept ."' WHERE `user_id`='". $userID ."'";
        if (mysqli_query($connection, $query)) {
          // echo "Record updated successfully";
        } else {
          echo "Error updating record: " . mysqli_error($connection);
        }
        if($userDetails["type"]==="student"){
            $division_info=$_POST['division'];
            $year=$_POST['pass-year'];
            $studentQuery="UPDATE `student` SET `batch`='". $year ."', `division`='". $division_info ."' WHERE `student_id`='". $userID ."'";
            if (!mysqli_query($connection, $studentQuery)) {
                echo "Error updating record: " . mysqli_error($connection);  
            }else{
                echo '
                <script type="text/javascript">
                location.href="./index.php?action=success&id='.$userID.'";
                </script>';
            }
        }else if($userDetails["type"]==="guide"){
            $guideCode=$_POST['guide-code'];
            $guideQuery="UPDATE `guide` SET `guide_code`='".$guideCode."' WHERE `guide_id`='".$userID."'";
            
            if (!mysqli_query($connection, $guideQuery)) {
                echo "Error updating record: " . mysqli_error($connection);  
            }else{
                echo '
                <script type="text/javascript">
                location.href="./index.php?action=success&id='.$userID.'";
                </script>';
            }
        }else{
            echo '
                <script type="text/javascript">
                location.href="./index.php?action=success&id='.$userID.'";
                </script>';
        }
        // $studentQuery="UPDATE `student` SET ``"
        
    }else{
        // echo "Button Error";
    }

?>
<!-- Project -->
<?php 
    if (isset($_POST['project-submit'])) {
        $projectName=$_POST['project-name'];
        $projectLink=$_POST['project-link'];
        $projectDesc=$_POST['project-desc'];
        $projectGuide=$_POST['project-guide'];
        $technologies=$_POST['skills'];
        /*if(isset($technologies)){
            $technologies=explode($technologies,',');
        }*/
        $count=(int)$_POST['member-count'];
        echo($count);
        $member2='';
        $memberCheck='';
        $member1=$_POST['member-1'];
        // Select Guide Id
        $guideSelect="SELECT `guide_id` FROM `guide` WHERE `guide_code`='".$projectGuide."'";
        $guideResult = mysqli_query($connection, $guideSelect);
        $guideRow='';
        $value=[];
        if(mysqli_num_rows($guideResult) > 0){
            $guideRow = mysqli_fetch_assoc($guideResult);
            //echo $count;
            // Only One Member
            if($count===1){
                //Selects ID of member based on email
                $memberCheck="SELECT `user_id` FROM `user_info` WHERE `email`='". $member1 ."'";
                // ..
                $memberResult = mysqli_query($connection, $memberCheck);
                if(mysqli_num_rows($memberResult) > 0){
                    $memberRow = mysqli_fetch_array($memberResult, MYSQLI_NUM);
                    $memberVerify="SELECT `group_id` FROM `student` WHERE `student_id`='". $memberRow[0] ."'";
                    $memberVerifyResult = mysqli_query($connection, $memberVerify);
                    //Check if the member is already part of a group
                    if(mysqli_num_rows($memberVerifyResult) > 0){
                        $memberVerifyRow = mysqli_fetch_array($memberVerifyResult, MYSQLI_NUM);
                        if(is_null($memberVerifyRow[0])){
                            array_push($value,$memberRow[0]);    
                        }else{
                            echo "Member is already part of another group.";    
                        }
                        
                    }
                    //$memberRow = mysqli_fetch_assoc($memberResult);
                    
                }else{
                    echo"Member Account doesn't exist";
                }
            }
            // Two members
            else{
                $member2=$_POST['member-2'];
                $memberCheck1="SELECT `user_id` FROM `user_info` WHERE `email` IN ('".$member1."','".$member2."')";
                $memberResult1 = mysqli_query($connection, $memberCheck1);
                if(mysqli_num_rows($memberResult1)==1){
                    $memberRow1 = mysqli_fetch_array($memberResult1, MYSQLI_NUM);
                    //$memberRow1 = mysqli_fetch_assoc($memberResult1);
                    if(in_array($member1, $memberRow1)){
                        echo $member2." doesn't exist";
                    }else{
                        echo $member1." doesn't exist";
                    }
                    //$memberRow1 = mysqli_fetch_assoc($memberResult1);
                    // $updateStudent="UPDATE TABLE `student` SET `guide_id`=";
                }else if(mysqli_num_rows($memberResult1)==2) {

                    //$memberRow1 = mysqli_fetch_assoc($memberResult1);
                    //if both members exist push ids into array
                    // $memberRow1 = mysqli_fetch_array($memberResult1, MYSQLI_NUM);
                    $flag=0;
                    $arr=[];
                    while($memberRow1 = mysqli_fetch_assoc($memberResult1)){
                    // for ($i=0; $i<2; $i++) {
                        $memberVerify1="SELECT `group_id` FROM `student` WHERE `student_id`='". $memberRow1['user_id'] ."'";
                        $memberVerifyResult1 = mysqli_query($connection, $memberVerify1);    
                        if(mysqli_num_rows($memberVerifyResult1) > 0){
                            $memberValues=mysqli_fetch_assoc($memberVerifyResult1);
                            if(!is_null($memberValues['group_id'])){
                                $flag++;    
                            }else{
                                array_push($arr,$memberRow1['user_id']);
                            } 
                        }
                    }
                    print_r($arr);
                    //Both members belong to a group
                    if($flag==2){
                        echo($member1.' and '.$member2.' both already belong to a group');
                        // goto breaker;
                    }else if ($flag==1) {
                        //One member belongs to another group
                        echo("One of the member's already belongs to a group" );
                        // goto breaker;
                    }else{
                        for ($i=0; $i<2; $i++) {
                            array_push($value,$arr[$i]);
                        }
                    }
                    
                    print_r($value);
                    //$value=;
                }
                else{
                    echo"Member Account doesn't exist";
                    // goto breaker;
                }
            }
            
        }
        // Guide account doesn't exist
        else{
            echo"Guide Account Doesn't Exist";  
        }
        //push loggedin user's ID
        array_push($value,$userID);
        // print_r(count($value));
        // print_r($value);
        //print_r(array_count_values($value));
        // $group_id='';
        // $group_id=$value[0].''.$value[1].''.$guideRow['guide_id'];

        // $group_id=str_replace('s', '', $group_id);
        $updateStudent='';
        $group_member_ids='';
        $select_usernames='';
        $selectRow='';
        $updateStudent='';
        $group_member_names='';
        //Check if 2 ids exist inside array(logged in user and group member)
        if(count($value)==2){
            //group member Ids
            $group_member_ids=$value[0].','.$value[1];
            //Selects Usernames 
            $select_usernames="SELECT `username` from `user_info` WHERE `user_id` IN('". $value[0] ."','". $value[1] ."')";
            // print_r($select_usernames);
            $selectResult=mysqli_query($connection, $select_usernames);
            if (mysqli_num_rows($selectResult) > 0) {
                while($selectRow = mysqli_fetch_array($selectResult,MYSQLI_NUM)){
                    //Group Member Names
                    $group_member_names=$group_member_names.$selectRow[0].'  ';    
                }
                //Remove Extra space at end (Added purposefully in previous line)
                $group_member_names=trim($group_member_names);
                //replace central space with comma(user-a,user-b)
                $group_member_names=str_replace('  ', ',', $group_member_names);
                //print_r($group_member_names);

                //$group_member_names.implode(',', ',');
            }
            //Check if group already exists
            $GroupChecker="SELECT  `group_id` FROM `group_details` WHERE `group_member_ids`='". $group_member_ids ."'";
            $GroupCheckerresult = mysqli_query($connection, $GroupChecker);
            // Insert or Update Group table
            if(mysqli_num_rows($GroupCheckerresult)>0){
                //$count=$count+1;
                echo"Cannot Update Group Details";
                //$insertGroup="UPDATE `group_details` SET  `group_member_count`='". $count."', `guide_id`'". $guideRow['guide_id']."' WHERE `group_member_ids`='".$group_member_ids."'";

            }else{
                $count=$count+1;
                $insertGroup="INSERT INTO `group_details`(`group_member_count`, `group_member_ids`, `group_member_names`, `guide_id`) VALUES (". $count .",'". $group_member_ids ."','". $group_member_names ."','". $guideRow['guide_id'] ."')";

                if (mysqli_query($connection, $insertGroup)) {
                    $groupId=mysqli_insert_id($connection);
                    $newGroupId="Gr".$groupId;
                    $updateGroup="UPDATE `group_details` SET `group_id`='". $newGroupId ."' WHERE `gid`='".$groupId."'";    
                    if(mysqli_query($connection, $updateGroup)){
                        $updateStudent="UPDATE `student` SET `group_id`='". $newGroupId ."',`guide_id`='". $guideRow['guide_id'] ."' WHERE `student_id` IN ('". $value[0] ."','". $value[1] ."')";
                    }else{
                        echo"Error in updating group dets";
                    }
                } else {
                    //print_r($insertGroup);
                    // Error while inserting data in group table
                    echo "Error here: " . $insertGroup . "<br>" . mysqli_error($connection);
                }
                
            }
            
        }else{
            if(isset($value[2])){
                $group_member_ids=$value[0].','.$value[1].','.$value[2];
                $select_usernames="SELECT `username` from `user_info` WHERE `user_id` IN('". $value[0] ."','". $value[1] ."','". $value[2] ."')";
                $selectResult=mysqli_query($connection, $select_usernames);
                if (mysqli_num_rows($selectResult) > 0) {
                    while($selectRow = mysqli_fetch_array($selectResult,MYSQLI_NUM)){
                        $group_member_names=$group_member_names.$selectRow[0].'  ';
                    }
                    $group_member_names=trim($group_member_names);
                    $group_member_names=str_replace('  ', ',', $group_member_names);
                }
                $GroupChecker="SELECT  `group_id` FROM `group_details` WHERE `group_member_ids`='". $group_member_ids ."'";
                $GroupCheckerresult = mysqli_query($connection, $GroupChecker);
                // Insert or Update Group table
                if(mysqli_num_rows($GroupCheckerresult)>0){
                    echo "Cannot Update Group Details";
                    //$count=$count+1;
                    //$insertGroup="UPDATE `group_details` SET  `group_member_count`='". $count."', `guide_id`'". $guideRow['guide_id']."' WHERE `group_member_ids`='".$group_member_ids."'";
                }else{
                    $count=$count+1;
                    $insertGroup="INSERT INTO `group_details`(`group_member_count`, `group_member_ids`, `group_member_names`, `guide_id`) VALUES (". $count .",'". $group_member_ids ."','". $group_member_names ."','". $guideRow['guide_id'] ."')";
                   if (mysqli_query($connection, $insertGroup)) {
                        $groupId=mysqli_insert_id($connection);
                        $newGroupId="Gr".$groupId;
                        $updateGroup="UPDATE `group_details` SET `group_id`='". $newGroupId ."'WHERE `gid`='".$groupId."'";
                        if(mysqli_query($connection, $updateGroup)){
                            $updateStudent="UPDATE `student` SET `group_id`='". $newGroupId ."',`guide_id`='". $guideRow['guide_id'] ."' WHERE `student_id` IN('". $value[0] ."','". $value[1] ."','". $value[2] ."')";
                        }
                        else{
                            echo"Error in updating groups";
                        }
                   } else {
                       // Error while inserting data in group table
                       echo "Error: " . $insertGroup . "<br>" . mysqli_error($connection);
                   } 
                }
                
            }
        }
        if($updateStudent!=''){
            if (mysqli_query($connection, $updateStudent)) {
                //If student and group table is successfully updated
                /*$ProjectChecker="SELECT  `project_id` FROM `project` WHERE `group_id`='". $newGroupId ."'";
                $ProjectCheckerresult = mysqli_query($connection, $ProjectChecker);        
                //Update Project
                if(mysqli_num_rows($ProjectCheckerresult) > 0){
                    $row = mysqli_fetch_assoc($ProjectCheckerresult);
                    $projectUpdate="UPDATE TABLE `project` SET `project_name`='". $projectName ."', `project_desc`='". $projectDesc ."', `project_link`='". $projectLink ."', `technologies`='". $technologies ."' WHERE project_id='". $row['project_id'] ."'";
                    if (mysqli_query($connection, $projectUpdate)) {
                      echo "Updated successfully";
                    } else {
                      echo "Error: " . $projectUpdate . "<br>" . mysqli_error($connection);
                    }
                }*/
                //Insert into project (for new users)
                // else{
                    $projectInsert='';
                    if(isset($project_link)){
                        $projectInsert="INSERT INTO `project`( `project_name`, `project_desc`, `guideid`, `group_id`, `project_link`, `technologies`) VALUES ('". $projectName ."','". $projectDesc ."','". $guideRow['guide_id'] ."','". $newGroupId ."','". $projectLink ."','". $technologies ."')";

                        if (mysqli_query($connection, $projectInsert)) {
                            // echo "New record created successfully";
                            $projectId=mysqli_insert_id($connection);
                            $deptName=$userDetails["department"];
                            $divisionChar=$studentDetails["division"];
                            if($divisionChar==1){
                                $divisionChar="A";
                            }else if($divisionChar==2){
                                $divisionChar="B";
                            }else{
                                $divisionChar="C";
                            }
                            //ITA1
                            //CPA1
                            //ETA1
                            $newProjectId=$deptName[0].$deptName[3].$divisionChar.$projectId;
                            //Update Project Id in Project table and group table
                            $updateProject="UPDATE `project` SET `project_id`='". $newProjectId ."' WHERE `group_id`='". $newGroupId ."'";
                            if (mysqli_query($connection, $updateProject)) {
                                $updateGroup="UPDATE `group_details` SET `project_id`='". $newProjectId ."' WHERE `group_id`='". $newGroupId ."'";
                                if(mysqli_query($connection, $updateGroup)){
                                    echo"Success";
                                    // echo '
                                    // <script type="text/javascript">
                                    // location.href="./index.php?action=success&id='.$userID.'";
                                    // </script>';
                                }else{
                                    echo"Error in updating group";
                                }
                            }else{
                                echo("Error in updating project");
                            }
                            
                        } else {
                            // Error in inserting project
                            echo "Error: " . $projectInsert . "<br>" . mysqli_error($connection);
                        }
                        
                    }else{
                        $projectInsert="INSERT INTO `project`( `project_name`, `project_desc`, `guideid`, `group_id`, `technologies`) VALUES ('". $projectName ."','". $projectDesc ."','". $guideRow['guide_id'] ."','". $newGroupId ."','". $technologies ."')";
                        if (mysqli_query($connection, $projectInsert)) {
                            // echo "New record created successfully";
                            $projectId=mysqli_insert_id($connection);
                            $deptName=$userDetails["department"];
                            $divisionChar=$studentDetails["division"];
                            if($divisionChar==1){
                                $divisionChar="A";
                            }else if($divisionChar==2){
                                $divisionChar="B";
                            }else{
                                $divisionChar="C";
                            }
                            //ITA1
                            //CPA1
                            //ETA1
                            $newProjectId=$deptName[0].$deptName[3].$divisionChar.$projectId;
                            //Update Project Id in Project table and group table
                            $updateProject="UPDATE `project` SET `project_id`='". $newProjectId ."' WHERE `group_id`='". $newGroupId ."'";
                            if (mysqli_query($connection, $updateProject)) {
                                $updateGroup="UPDATE `group_details` SET `project_id`='". $newProjectId ."' WHERE `group_id`='". $newGroupId ."'";
                                if(mysqli_query($connection, $updateGroup)){
                                    echo"Success";
                                    // echo '
                                    //     <script type="text/javascript">
                                    //     location.href="./index.php?action=success&id='.$userID.'";
                                    //     </script>';
                                }else{
                                    echo"Error in updating group";
                                }
                            }else{
                                echo("Error in updating project");
                            }
                            
                        } else {
                            // Error in inserting project
                            echo "Error: " . $projectInsert . "<br>" . mysqli_error($connection);
                        }
                    }
                // }
            }else {
                echo "Error updating record:";
            }
        }else{
            $ProjectChecker="SELECT  `project_id` FROM `project` WHERE `group_id`='". $studentDetails['group_id'] ."'";
            $ProjectCheckerresult = mysqli_query($connection, $ProjectChecker);        
            //Update Project
            if(mysqli_num_rows($ProjectCheckerresult) > 0){
                $row = mysqli_fetch_assoc($ProjectCheckerresult);
                $projectUpdate="UPDATE `project` SET `project_name`='". $projectName ."', `project_desc`='". $projectDesc ."', `project_link`='". $projectLink ."', `technologies`='". $technologies ."' WHERE project_id='". $row['project_id'] ."'";
                if (mysqli_query($connection, $projectUpdate)) {
                  echo '
                      <script type="text/javascript">
                      location.href="./index.php?action=success&id='.$userID.'";
                      </script>';
                } else {
                  echo "Error: " . $projectUpdate . "<br>" . mysqli_error($connection);
                }
            }    
        } 
        
    }
?>