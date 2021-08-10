<?php
	$type_detail=$_GET['type'];
	session_start();
	require('./PHP/common_files.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php 
		echo ucfirst($type_detail).'s';
	?></title>
</head>
<body>
	<?php
        require('./PHP/header.php')
    ?>
    <div class="container mx-auto">
    	<div class="row border border-success">
    		<div class="col-2" style=" border: 1px solid red;">
    			<img src="https://shardulbirje.netlify.app/Images/Shardul.png" alt="Image" style=" max-height:6.2em;">
    		</div>
    		<div class="col-8">
    			<div class="card">
    			  <!-- <h5 class="card-header">User Name</h5> <--></-->
    			  <div class="card-body">
    			    <h5 class="card-title">Special title treatment</h5>
    			    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    			  </div>
    			</div>
    			<!-- Details -->
    		</div>
    	</div>
    </div>
    <?php
        require('./PHP/footer.php')
    ?>
    <script>
    	document.getElementsByClassName('users-option')[0].classList.add('active');
    </script>
</body>
</html>