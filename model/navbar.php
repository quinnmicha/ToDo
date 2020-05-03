<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">My Planner</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <span class="nav-link text-success" onclick="addClass()"><i class="far fa-plus"></i> Add Class</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href='classes.php'><i class="far fa-tasks-alt"></i> Edit Classes</a>
            </li>
            <li>
                <a class="nav-link" href='settings.php'><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item d-block d-ml-none d-lg-none d-xl-none">
                <a class="nav-link text-danger" href="index.php?action=false"><i class="fas fa-sign-out"></i> Logout</a>
            </li>
            
            
        </ul>
    </div>
    <div class="nav-item col-1 d-none d-ml-block d-lg-block d-xl-block" style="text-align: center;border: red 3px solid; border-radius:10px;">
        <a class=" text-danger" href="index.php?action=false"><b>Log Out</b></a>
    </div>
</nav>