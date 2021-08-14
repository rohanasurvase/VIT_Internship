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
        require('./PHP/header.php')
    ?>
    <?php
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
        if (!is_null($studentDetails['group_id'])) {
            // echo("Yo");
            $selectGroupDetails="SELECT * FROM `group_details` WHERE `group_id`='". $studentDetails['group_id'] ."'";    
            $selectProjectDetails="SELECT `project_id`,`project_name`,`project_desc`,`guideid`,`technologies` FROM `project` WHERE `group_id`='". $studentDetails['group_id'] ."'";
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
                        <div class="form-group">
                            <label for="profile-branch" class="col-form-label">Department</label>
                            <input type="text" class="form-control" id="profile-branch" placeholder="Branch" name="branch" value="<?php 
                                if(isset($userDetails["department"])){
                                    echo $userDetails["department"];
                                }else{
                                    echo "";
                                }
                            ?>">
                        </div>
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
            
                <div class="form-group">
                    <label for="project-name" class="col-form-label">Project Name</label>
                    <input type="text" class="form-control" id="project-name" name="project-name">
                </div>
                <div class="form-group">
                    <label for="project-link" class="col-form-label">Project link</label>
                    <input type="text" class="form-control" id="project-link" name="project-link">
                </div>
                <div class="form-group">
                    <label for="project-technologies" class="col-form-label">Techonologies used</label>
                    <input type="text" class="form-control" id="project-technologies" placeholder="eg: HTML, CSS" data-toggle="tooltip" data-placement="right" title="Use commas for entering multiple Techonologies/languages" name='skills'>
                    <!-- <button class="btn btn-secondary" id='skills-submit'>Add</button> -->
                    <!-- <p class="skills" id='skills-box'> -->
                        
                    </p>
                </div>
                <div class="form-group">
                    <label for="project-guide" class="col-form-label">Guide Name</label>
                    <input type="text" class="form-control" id="project-guide" name="project-guide" placeholder='Enter guide code' data-toggle="tooltip" data-placement="right" title="For eg:Enter RS for Rohana Survase" value="<?php  
                        if(isset($studentDetails['guide_id'])){
                            $GuideName="SELECT `guide_code` FROM `guide` where `guide_id`='". $studentDetails['guide_id'] ."'";
                            $result = mysqli_query($connection, $GuideName);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                echo $row['guide_code'];
                            }
                        }
                    ?>">
                </div>
                <div class="form-group">
                    <label for="member-count" class="col-form-label">Group Member count</label>
                    <input type="number" class="form-control" id="member-count" name="member-count" placeholder="Member count (excluding you)">
                    <p id="error-text"></p>
                </div>
                <div class="row">
                    <div class="col member-input-container hide">
                        <label for="member-1">Member Email</label>
                        <input type="email" class=" form-control" placeholder="Member 1 Email" id="member-1" name="member-1">
                    </div>
                    <div class="col member-input-container hide">
                        <label for="member-2">Member Email</label>
                        <input type="email" class="form-control" placeholder="Member 2 Email" id='member-2' name="member-2">
                    </div>
                </div>
                <!-- <div class="form-group member-input-container">
                    <label for="project-members" class="col-form-label">Group Members</label>
                    <input type="text" class="form-control" id="project-members">
                </div> -->
                <div class="form-group">
                    <label for="project-desc" class="col-form-label">Project Description</label>
                    <textarea class="form-control" id="project-desc" name="project-desc"></textarea>
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
	        <div class="col-lg-4 border-right border-default">
                <div class="container">
                    <img src="<?php
                       echo $userDetails['image'];
                    ?>" alt="Profile" class="img-fluid rounded d-block mx-auto" style="height: 30vh; position:relative;">
                    <!-- Tablet Updates needed -->
                    <div class="profile-details my-2 container mx-auto" style="padding-bottom: 5em;">
                        <div class="d-flex justify-content-center">
                            
                            <div class="text-center pr-lg-3 pl-lg-0 pl-5">
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
                                            echo "<p>Enter Batch</p>";
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
           <div class="col-md-8">
               <div class="container">
                   <!-- <h2>Account Details</h2>  -->
                   
                   <div class="projects">
                        <div class="d-flex justify-content-between align-items-center py-3">
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
                                if($_SESSION["user_id"]===$userID && $userDetails['type']==="student"){
                                    echo 
                                    '<button class="btn btn-outline-secondary my-2" data-toggle="modal" data-target="#addProjectModal">
                                        
                                        <i class="fas fa-plus"></i>
                                        Add Project
                                    </button>';
                                }
                            ?>
                           <!-- <div class="card mb-4">
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
                                    <--<p>Technology used: HTML, CSS, Javascript, SQL, PHP, Python. --
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
                                    <-- <p>Technology used: HTML, CSS, Javascript, SQL, PHP, Python. ->
                                    </p>
                                    <a href="#" class="btn btn-primary">View Project</a>
                                </div>
                           </div> -->
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

<!-- For Profile Details -->
<?php 
    if (isset($_POST['details-submit'])) {
        $firstName = $_POST['first-name'];
        $lastName=$_POST['last-name'];
        $name=$firstName.' '.$lastName;     
        $dept=$_POST['department'];
        $year='';
        $query="UPDATE `user_info` SET `username`='". $name ."', `department`='". $dept ."', WHERE `user_id`='". $userID ."'";
        if (mysqli_query($connection, $query)) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . mysqli_error($connection);
        }
        if($userDetails["type"]==="student"){
            $year=$_POST['pass-year'];
            $studentQuery="UPDATE `student` SET `batch`='". $year ."' WHERE `student_id`='". $userID ."'";
            if (mysqli_query($connection, $studentQuery)) {
              echo "<script>
                $('#editProfileModal').modal('hide');
              </script>";
            } else {
              echo "Error updating record: " . mysqli_error($connection);
            }
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
        $technologies=explode($technologies,',');
        $count=$_POST['member-count'];
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
            
            //print_r($guideRow);
            // Only One Member
            if($count==1){
                $memberCheck="SELECT `user_id` FROM `user_info` WHERE `email`='". $member1 ."'";
                $memberResult = mysqli_query($connection, $memberCheck);
                if(mysqli_num_rows($memberResult) > 0){
                     $memberRow = mysqli_fetch_array($memberResult, MYSQLI_NUM);
                    //$memberRow = mysqli_fetch_assoc($memberResult);
                    array_push($value,$memberRow[0]);
                    //$value=$memberRow;
                    // $updateStudent="UPDATE TABLE `student` SET `guide_id`=";
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
                }else if (mysqli_num_rows($memberResult1)==2) {
                    //$memberRow1 = mysqli_fetch_assoc($memberResult1);
                    $memberRow1 = mysqli_fetch_array($memberResult1, MYSQLI_NUM);
                    for ($i=0; $i<2; $i++) { 
                        array_push($value,$memberRow1[$i]);
                    }
                    
                    //$value=;
                }
                else{
                    echo"Member Account doesn't exist";
                }
            }
            
        }
        // Guide account doesn't exist
        else{
            echo"Guide Account Doesn't Exist";  
        }
        array_push($value,$userID);
        // print_r($value);
        //print_r(array_count_values($value));
        // $group_id='';
        $group_id=$value[0].''.$value[1].''.$guideRow['guide_id'];

        $group_id=str_replace('s', '', $group_id);
        $updateStudent='';
        $group_member_ids='';
        $select_usernames='';
        $selectRow='';
        if(count($value)==2){
            $group_member_ids=$value[0].','.$value[1];
            $select_usernames="SELECT `username` from `user_info` WHERE `user_id` IN('". $value[0] ."','". $value[1] ."')";
            $selectResult=mysqli_query($connection, $select_usernames);
            if (mysqli_num_rows($selectResult) > 0) {
                $selectRow = mysqli_fetch_array($selectResult,MYSQLI_NUM);
            }
            $group_member_names=$selectRow[0].','.$selectRow[1];
            $updateStudent="UPDATE `student` SET `group_id`='". $group_id ."',`guide_id`='". $guideRow['guide_id'] ."' WHERE `student_id` IN ('". $value[0] ."','". $value[1] ."')";

        }else{
            if(isset($value[2])){
                $group_member_ids=$value[0].','.$value[1].','.$value[2];
                $select_usernames="SELECT `username` from `user_info` WHERE `user_id` IN('". $value[0] ."','". $value[1] ."','". $value[2] ."')";
                $selectResult=mysqli_query($connection, $select_usernames);
                if (mysqli_num_rows($selectResult) > 0) {
                    $selectRow = mysqli_fetch_array($selectResult,MYSQLI_NUM);
                }
                $group_member_names=$selectRow[0].','.$selectRow[1].','.$selectRow[2];
                $updateStudent="UPDATE `student` SET `group_id`='". $group_id ."',`guide_id`='". $guideRow['guide_id'] ."' WHERE `student_id` IN('". $value[0] ."','". $value[1] ."','". $value[2] ."')";
            }
        }
        

        if (mysqli_query($connection, $updateStudent)) {
            
        }else {
            echo "Error updating record: " . mysqli_error($connection);
        } 
        $ProjectChecker="SELECT  `project_id` FROM `project` WHERE `group_id`='". $group_id ."'";
        $ProjectCheckerresult = mysqli_query($connection, $ProjectChecker);        
        //Update in morning (INSERT and UPDATE to PROJECT)
        if(!mysqli_num_rows($ProjectCheckerresult) > 0){
            $projectInsert="INSERT INTO `project`( `project_name`, `project_desc`, `guideid`, `group_id`, `project_link`, `technologies`) VALUES ('". $project_name ."',[value-6],[value-7],[value-9],[value-10],[value-11])";
        }else{
            $row = mysqli_fetch_assoc($ProjectCheckerresult);
            $projectUpdate="UPDATE TABLE `project` SET `project_name`, `project_desc`, `guideid`, `group_id`, `project_link`, `technologies` WHERE project_id='". $row['project_id'] ."'";
            
        }
        // Verify if group already exists.
        $GroupChecker="SELECT  `group_id` FROM `group_details` WHERE `project_id`='". $row['project_id'] ."'";
        $GroupCheckerresult = mysqli_query($connection, $GroupChecker);
        $insertGroup="INSERT INTO `group_details`(`group_id`, `group_member_count`, `group_member_ids`, `group_member_names`, `guide_id`, `project_id`) VALUES ('". $group_id ."','". $count+1 ."','". $group_member_ids ."','". $group_member_names ."','". $guideRow['guide_id'] ."',[value-6])";
        /*
        if(is_null($studentDetails["group_id"])){
            
            $groupId=
            $insertGroup="INSERT INTO `group_details`(`group_id`, `group_member_count`, `group_member_ids`, `group_member_names`, `guide_id`, `project_id`) VALUES ()";    
        }*/
        
        
        // $studentQuery="UPDATE `student` SET ``"
    }
?>
  