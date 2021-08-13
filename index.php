<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <title>V-Projects</title>
</head>
<body>
    <?php
        require('./PHP/header.php');
    ?>
    <div class="jumbotron m-0">
        <div class="container">
            <h1 class="text-center">V-Projects</h1>
            <h4 class="text-center">All the final year projects on a single platform!</h4>
            <div class="search-box-container d-flex justify-content-center py-4">
                <!-- <span class="fa fa-search"></span> -->
                    <input type="search" class="form-control rounded search-box" id="search-input" placeholder="Search" />
                    <div class="input-group-append bg-white">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle search-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="true">Search By</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" onclick="filterBy('project')">Project</button>
                                <button class="dropdown-item" onclick="filterBy('student')">Student</button>
                                <button class="dropdown-item" onclick="filterBy('guide')">Guide</button>
                                <button class="dropdown-item" onclick="filterBy('technology')">Technology</button>
                            </div>
                        </div>
                    </div>
            </div>
      <!--       <button id="search-button" type="button" class="btn btn-primary text-center">
                   <i class="fa fa-search"></i> Search     
            </button> -->
        </div>
    </div>
    <?php
        require('./PHP/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./JS/search_script.js"></script>
</body>
</html>