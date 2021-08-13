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
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Project Name</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">This is a description for the project</h6>
          <p class="card-text">Keywords: HTML, CSS, Javascript</p>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Two</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Three</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Card Four</h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Five</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Six</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Seven</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card Eight</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
        </div>
      </div>      
    </div>    
  </div>
</div>
<?php
  require('./PHP/footer.php');
?>
</body>
</html>