<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="SearchStyle.css">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
  <div class="row">
    <div class="col-sm-12 mb-3">
      <input type="text" id="myFilter" class="form-control" onkeyup="myFunction()" placeholder="Search for names..">
    </div>
  </div>
  <div class="row" id="myItems">
    <div class="col-sm-12 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><a href="#">Card One</a></h5>
          <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
          <p class="card-text">Some text.</p>
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

</body>
</html>
<script>
function myFunction() {
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
}
</script>