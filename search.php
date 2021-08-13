<?php
  session_start();
  require('./PHP/common_files.php');
  require('./PHP/connect.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Search</title>
  <link rel="stylesheet" href="SearchStyle.css">
  
</head>
<body>
  <?php
  require('./PHP/header.php');

  ?>
  <div class="container my-4">
  <!-- <div class="row">
    <div class="col-sm-12 mb-3">
      <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search for names..">
    </div>
  </div> -->
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
<script>
/*function myFunction() {
    var input, filter, cards, cardContainer, h5, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("card");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-body h5.card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}*/
</script>