<?php
	$type_detail=$_GET['type'];
	session_start();
	require('./PHP/common_files.php');
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
    <div class="container mx-auto">
    	<div class="row py-2 border-bottom border-default">
    		<div class="col-2 d-flex justify-content-end">
    			<img src="https://shardulbirje.netlify.app/Images/Shardul.png" alt="Image" style=" max-height:6.2em;">
    		</div>
    		<div class="col-8">
    			<div class="card border-0">
    			  <!-- <h5 class="card-header">User Name</h5> <--></-->
    			  <div class="card-body">
    			    <h5 class="card-title">Shardul Birje</h5>
    			    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    			  </div>
    			</div>
    			<!-- Details -->
    		</div>
    	</div>
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
    </style>
</body>
</html>