<?php 
    session_start();
    require('./PHP/common_files.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <?php
        if(isset($_GET['account'])){
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            Success!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          ';
        }
        include("./PHP/connect.php");
    ?>
    <div class="h-100 d-flex align-items-center">
        <section class="container w-md-25">
            <!-- <div class="Login"> -->
                <h1 class="pb-2 text-center">LogIn</h1>
                <form class="form-container d-flex justify-content-center align-items-center" method="POST">
                    <div class="form-group">
                        <label for="login"><b>Email: </b></label>
                        <input type="email" id="login" class="form-control mb-2" name="email" placeholder="Enter Email">
                        <label for="password"><b>Password:</b></label>
                        <input type="password" id="password" class="form-control mb-3" name="password" placeholder="Password">
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="myFunction()">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                          </div>
                        <button type="submit" name="login-submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="#">Forgot Password?</a>
                    <p><a href="./SignUp.php">Don't have an account?</a></p>
                </div>
            
            <!-- </div> -->
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
    if(isset($_POST['login-submit']))
    {
      //something was posted
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password))
        {
            //read from database
            $query = "select * from `user_info` where `email`='". $email ."' limit 1";
            $result = mysqli_query($connection, $query);
            if(mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password)
                {
                    $_SESSION['user_id'] = $user_data['user_id'];

                    header("Location: account.php?userid=".$user_data['user_id']);
                //   die;
                }else{
                    echo "Wrong password";
                }
            }else{
                echo "Account doesn't exist!";
            }
        }
        else
        {
            echo "Wrong username or password!";
        }
    }else{
        // echo"button issue";
    }
?>