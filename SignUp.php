<?php
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="SignUpStyle.css">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
  

	<section class="container-fluid border border-success">
 		 <div class="SignUp">
    		<form class="form-container d-flex justify-content-center align-items-center" method="POST" >
    			<div class="form-group d-block">

					    <h1 style="padding-bottom: 1em; text-align: center;">Sign Up</h1>
					 	
					 	<label for="username"><b>User name</b></label>
					    <input type="text" placeholder="Enter username" class="Input-first mb-2 d-block" name="username"  required>


              <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="admin">
              <label class="form-check-label" for="flexRadioDefault1">
                Admin
              </label>

              <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="student">
              <label class="form-check-label" for="flexRadioDefault1">
               Student
              </label>

              <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="guide">      
                        <label class="form-check-label" for="flexRadioDefault1">  Guide </label>



					    <label for="email" class="d-block"><b>Email</b></label>
					    <input type="text" placeholder="Enter Email" class="Input-second mb-2 d-block" name="email" required>

					    <label for="psw"><b>Password</b></label>
					    <input type="password" placeholder="Enter Password" class="Input-third mb-2 d-block" name="password" required>

             

					    <!-- <label for="psw-repeat"><b>Repeat Password</b></label> 
					    <input type="password" placeholder="Repeat Password" class="Input-fourth mb-3 d-block" name="psw-repeat" required> -->
					  
   
    <div class="FormFooter"> 
    	<div class="text-center">
      <button type="submit" class="signupbtn btn btn-primary" name="signup-submit">Sign Up</button>
    </div>
  </div>
</form>
	
</body>
</html>

<?php

  // include("functions.php");
  include('./PHP/connect.php');

  if(isset($_POST['signup-submit']))
  {
    //something was posted
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $type =  $_POST['type'];
    $password = $_POST['password'];


    $sql = "INSERT INTO user_info (email,password,type,username) VALUES('". $email ."','". $password ."','". $type ."','". $user_name ."')";


    if ((mysqli_query($connection, $sql))){



      $id=mysqli_insert_id($connection);

       if(!empty($type))
       {
        $newuserid = $type[0].strval($id);
       }

        $query="update user_info set user_id='$newuserid' where id='$id';";
        $run_query=mysqli_query($connection,$query);
        if (!$run_query) 
        {
             echo mysqli_error();
          }
              else
               {
   echo "'your user name is and user id is '.$newuserid.'" ;
    }
  
      //folder banana hai inside Uploads
      //folder  name=userid
      // take them to other page

      //display green Modal

      header('Location:LoginPage.php?account=success');

      echo "New record created successfully";
}
}


