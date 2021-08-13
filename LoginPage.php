<?php 
    session_start();
    require('./PHP/common_files.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
 <body>
          <?php
if(isset($_GET['account'])){
  echo "Success";
}else{

}
  include("./PHP/connect.php");
  //include("functions.php");
if(isset($_POST['login-submit']))
  {
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password))
    {
      //read from database
      $query = "select * from user_info where email = '$email' limit 1";
      $result = mysqli_query($connection, $query);

      // if($result)
      // {
        if($result && mysqli_num_rows($result) > 0)
        {

          echo"working";
         $user_data = mysqli_fetch_assoc($result);
          
          if($user_data['password'] === $password)
          {

            $_SESSION['user_id'] = $user_data['userid'];
            header("Location: index.php");
          //   die;
          }
        }
      // }
      
      // echo "wrong username or password!";
    }else
    {
      echo "wrong username or password!";
    }
  }


        ?>
  

<section class="container-fluid border border-success">
  <div class="Login">
    <form class="form-container d-flex justify-content-center align-items-center" method="POST">
      
      <div class="form-group">
        <h1 style="padding-bottom: 1em">LogIn</h1>
          <label><b>Email: </b></label>
          <input type="text" id="login" class="Input-first mb-2" name="email" placeholder="login">
      <!-- </div>
      <div class="form-group"> -->
      <label><b>Password:</b> </label>
      <input type="text" id="password" class="Input-second mb-3" name="password" placeholder="password">
      <div class="text-center">
        <button type="submit" name="login-submit" class="btn btn-primary"> Log In</button>
        </div>
      </div>
       
    </form>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
         <p><a href="./SignUp.php">Don't have an account?</a></p>
    </div>
    
  </div>
</div>

</body>
</html>
