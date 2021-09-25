<?php
  session_start();
  require('./PHP/common_files.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create Guide/Admin Account</title>
</head>
<body>
     <?php 
        require('./PHP/header.php');
     ?>
    <div class="mt-5 d-flex align-items-center">
      	<section class="container-fluid">
     		<div class="SignUp">
        		<h1 style="padding-bottom: 1em; text-align: center;">Guide/Admin Sign Up</h1>
                <form class="form-container d-flex justify-content-center align-items-center" method="POST" >
        			<div class="form-group">
    					<label for="name-details"><b>Enter Name</b></label>
                        <div class="input-group" id="name-details">
                            
                            <!-- declaration for first field -->
                            <input type="text" id="firstname" class="form-control" placeholder="First Name" name="firstName" required/>
                            <!-- declaration for second field -->
                            <input type="text" class="form-control" placeholder="Last Name" name="lastName" required/>
                        </div>
                        <label for="account-type" class="d-block"><b>Select Type</b></label>
                        <!-- <div class="form-check form-check-inline" id="account-type">
                            <input class="form-check-input" type="radio" name="type" id="type1" value="student">
                            <label class="form-check-label" for="type1">Student</label>
                        </div> -->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="type2" value="guide">
                            <label class="form-check-label" for="type2">Guide</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="type3" value="admin">
                            <label class="form-check-label" for="type3">Project Co-ordinator</label>
                        </div>

					    <label for="email" class="d-block"><b>Email</b></label>
					    <input type="text" placeholder="Enter Email" class=" form-control Input-second mb-2 d-block" name="email" required>

					    <label for="psw"><b>Password</b></label>
					    <input type="password" placeholder="Enter Password" class=" form-control Input-third mb-2 d-block" id="password" name="password" required>  
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="myFunction()">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>       
                        <!-- <div class="FormFooter">  -->
                          <button type="submit" class="signupbtn btn btn-primary" name="signup-submit">Sign Up</button>
                          
                        <!-- </div> -->
                    </div>
                    
                </form>
                <div id="formFooter">
                    <p><a href="./LoginPage.php">Already have an account?</a></p>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        function myFunction() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        } 
    </script>
</body>
</html>
<?php

  // include("functions.php");
  include('./PHP/connect.php');

  if(isset($_POST['signup-submit']))
  {
    //something was posted
    $firstName = $_POST['firstName'];
    $lastName=$_POST['lastName'];
    $user_name=$firstName.' '.$lastName;
    $email = $_POST['email'];
    $type =  $_POST['type'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user_info (email,password,type,username) VALUES('". $email ."','". $password ."','". $type ."','". $user_name ."')";


    if ((mysqli_query($connection, $sql))){
        // echo("Done");


      $id=mysqli_insert_id($connection);
      // echo($id);
       if(!empty($type))
       {
        $newuserid = $type[0].strval($id);
       }

        $query="UPDATE `user_info` set `user_id`='". $newuserid ."' where `id`='". $id ."'";
        $run_query=mysqli_query($connection,$query);
        if (!$run_query) 
        {
             echo mysqli_error($connection);
        }
        else
        {
            if($type[0]=='g') {
                //For guide
                $insert="INSERT INTO guide (guide_id) VALUES ('". $newuserid ."')";
                if(mysqli_query($connection, $insert)){
                    $a=mkdir('./Uploads/'.$newuserid,0777,true);
                    $_SESSION['user_id']=$newuserid;
                    echo'<script>location.href="./account.php?userid='.$newuserid.'"</script>';
                }else{
                    echo(mysqli_error($connection));
                }
            }else{
                // For admin
                $a=mkdir('./Uploads/'.$newuserid,0777,true);
                $_SESSION['user_id']=$newuserid;
                echo'<script>location.href="./account.php?userid='.$newuserid.'"</script>';
            }
            
            // echo "'your user name is and user id is '.$newuserid.'" ;
        }   
      // echo "New record created successfully";
    }else{
        echo(mysqli_error($connection));
    }
  }else{
    // echo "Error";
  }
?>

