<?php
	$type_detail=$_GET['type'];
	session_start();
	require('./PHP/common_files.php');
    require('./PHP/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php 
		echo ucfirst($type_detail).'s';
	?></title>
</head>
<body>
	<?php
        require('./PHP/header.php')
    ?>
    <div class="users container mx-auto">
        <?php
            if($type_detail==='project_co-ordinator'){
                $type_detail='admin';
            }
            $selectUser="SELECT user_id,image,username,type FROM `user_info` where `type`='". $type_detail ."'";
            $result = mysqli_query($connection, $selectUser);

            if (mysqli_num_rows($result) > 0) {
              // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo'
                    <div class="row py-2 border-bottom border-default">
                        <div class="col-md-2 col-4 d-flex justify-content-end">
                            <img src="'.$row["image"].'" alt="Image" style=" max-height:6.2em;">
                        </div>
                        <div class="col-md-8 col-6">
                            <div class="card border-0">
                              <!-- <h5 class="card-header">User Name</h5> <--></-->
                              <div class="card-body">
                                <a href="./account.php?userid='.$row["user_id"].'"<h5 class="card-title">'.$row["username"].'</h5></a>
                                <p class="card-text">'.ucfirst($row["type"]).'</p>
                              </div>
                            </div>
                            <!-- Details -->
                        </div>
                    </div>';    
                }
            }else {
              echo "0 results";
            }
        ?>
    	
    </div>
    <?php
        require('./PHP/footer.php');
    ?>
    <script>
    	document.getElementsByClassName('users-option')[0].classList.add('active');
    </script>
    <style>
    	.page-footer{
    		position: fixed;
    		bottom: 0;
    		left: 0;
    		width: 100%;
        }
        .users{
            margin-bottom: 25em;
        }
        @media only screen and (min-width: 768px) {
            .users{
                margin-bottom: 15em;
            }    
        }
    </style>
</body>
</html>