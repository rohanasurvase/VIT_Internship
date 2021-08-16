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
      

<?php

        $filter_values = $_GET['filterBy'];
        

        $search_values = $_GET['value'];
      

        $searchquery='';
        // $result='';


        // $sql="select * from  where  like '%$search_value%'";

        switch ($filter_values) {
          case 'project':
          $searchquery = "select project_name,project_desc,technologies,project_id from project where project_name like '%".$search_values."%'";
           

          
            // code...
            break;
          case 'technology':
          $searchquery = "select project_name,project_desc,technologies,project_id from project where technologies like '%".$search_values."%'";
          break;


          case 'student':
        
          $searchquery= "SELECT user_id,image,username,type FROM user_info where type='student' and username like '%".$search_values."%'" ;
          break;

          case 'guide':
        
          $searchquery= "SELECT user_id,image,username,type FROM user_info where type='guide' and username like '%".$search_values."%'" ;
          break;

          default:
          echo"";
            // code...
            break;
        }
          if ($filter_values=="project" || $filter_values=="technology") {
            // code...
          
          $result = mysqli_query($connection, $searchquery);
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
          }else{
            //for student and guides
            $result = mysqli_query($connection, $searchquery);
            if (mysqli_num_rows($result) > 0) {
               // output data of each row
              while($row = mysqli_fetch_assoc($result)) 
              {
                echo'
                    <div class="row py-2 border-bottom border-default">
                        <div class="col-2 d-flex justify-content-end">
                            <img src="'.$row["image"].'" alt="Image" style=" max-height:6.2em;">
                        </div>
                        <div class="col-8">
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
            }
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