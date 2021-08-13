<?php	
    echo '
    <div class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark border-bottom border-default">
		<a class="navbar-brand" href="./index.php">V-Projects</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item home-option">
                <a class="nav-link" href="./index.php">Home</a>
              </li>
              <li class="nav-item projects-option">
                <a class="nav-link" href="./all_projects.php">Projects</a>
              </li>
              <li class="nav-item dropdown users-option">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Users
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="./all_users.php?type=guide">Guides</a>
                  <a class="dropdown-item" href="./all_users.php?type=student">Students</a>
                  <a class="dropdown-item" href="./all_users.php?type=project co-ordinator">Project Co-ordinators</a>
                </div>
              </li>
              <!--<li class="nav-item about-option">
                <a class="nav-link" href="#">About</a>
              </li>-->
            </ul>
            <div class=" d-flex justify-content-center">
                <!-- <span class="fa fa-search"></span> -->
                    <input type="search" class="form-control rounded search-box" placeholder="Search" />
                    <div class="input-group-append bg-white">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle search-dropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>Search By</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <button class="dropdown-item" onclick="filterBy(`project`)">Project</button>
                                <button class="dropdown-item" onclick="filterBy(`student`)">Student</button>
                                <button class="dropdown-item" onclick="filterBy(`guide`)">Guide</button>
                                <button class="dropdown-item" onclick="filterBy(`technology`)">Technology</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form> -->
            '.((isset($_SESSION["user_id"]))?'<a href="account.php?userid='.$_SESSION["user_id"].'" class="btn btn-outline-primary mx-4">My Account</a>':'<a href="LoginPage.php" class="btn btn-outline-success mx-4">Sign In</a>').'
            

        </div>
	</div>
    ';
?>