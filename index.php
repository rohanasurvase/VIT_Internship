<?php
    session_start();
    require('./PHP/common_files.php');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./CSS/index.css">
    <title>V-Projects</title>
</head>
<body>
    <?php
        require('./PHP/header.php');
    ?>

    <?php 
        if (isset($_GET['action'])) {
            echo'<script>
            location.reload();
            location.href="./account.php?userid='.$_GET['id'].'"
            </script>';
        }else if (isset($_GET['result'])) {
            echo'<script>
            location.reload();
            location.href="./project.php?id='.$_GET['project_id'].'"
            </script>';
        }

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
                            <button class="btn btn-outline-secondary dropdown-toggle search-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search By</button>
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
    <!-- <script src="./JS/search_script.js"></script> -->
</body>
</html>