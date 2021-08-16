<?php
  session_start();
  require('./PHP/common_files.php');
  require('./PHP/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>All Projects</title>
</head>
<body>
  <?php
  require('./PHP/header.php');

  ?>

  <div class="container my-4">
  <div class="row" id="myItems">
    <div class="col-sm-12 mb-3">
      <?php
          
            $sql = "SELECT project_id, project_name, project_desc, technologies FROM project";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) 
              {
                echo('
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"><a href="project.php?id='.$row["project_id"].'">'. $row["project_name"] .'</a></h5>
                      <h6 class="card-subtitle mb-2 text-muted">'. $row["project_desc"] .'</h6>
                      <p class="card-text">Technologies: '. $row["technologies"].'</p>
                    </div>
                    </div>
                    ');
              }
            } else {
              echo "0 results";
            }

      ?>
     
             
    </div>    
  </div>
</div>
<?php
  require('./PHP/footer.php');
?>
</body>
</html>