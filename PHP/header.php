<?php	
    echo '<div class="navbar navbar-expand-lg navbar-light bg-default border-bottom border-default">
		<a class="navbar-brand" href="./index.html">V-Projects</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Projects</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Users
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Guides</a>
                  <a class="dropdown-item" href="#">Students</a>
                  <a class="dropdown-item" href="#">Project Co-ordinators</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
            </ul>
            <div class=" d-flex justify-content-center">
                <!-- <span class="fa fa-search"></span> -->
                    <input type="search" class="form-control rounded " placeholder="Search" />
                    <div class="input-group-append bg-white">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Search By</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Project</a>
                                <a class="dropdown-item" href="#">Student</a>
                                <a class="dropdown-item" href="#">Guide</a>
                                <a class="dropdown-item" href="#">Technology</a>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
            </form> -->
            
            <a href="LoginPage.html" class="btn btn-outline-success mx-4">
                Sign In
            </a>

        </div>
	</div>
    ';
?>