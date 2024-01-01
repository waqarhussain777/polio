<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Polio Drive</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <?php if ($this->session->userdata('role')=="admin"): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Divisions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_division'); ?>">Add Division</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('division_listing'); ?>">View Divisios</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Districts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_district'); ?>">Add District</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('district_listing'); ?>">View Districts</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tehsils
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_tehsil'); ?>">Add Tehsil</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('tehsil_listing'); ?>">View Tehsils</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Union Councils
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_unioncouncil'); ?>">Add Union Council</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('unioncouncil_listing'); ?>">View Union Councils</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Households
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_household'); ?>">Add Household</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('household_listing'); ?>">View Households</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Households Members
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('add_householdmember'); ?>">Add Household Member</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('householdmember_listing'); ?>">View House Members</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Polio Workers
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" aria-current="page" href="<?php echo base_url('view_workers'); ?>">View Worker</a></li>
                        <li><a class="dropdown-item" aria-current="page" href="<?php echo base_url('assign'); ?>">Assign Polio Worker</a></li>
                        <li><a class="dropdown-item" aria-current="page" href="<?php echo base_url('view_vaccination_records'); ?>">View Vaccination Records</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo base_url('regions'); ?>">All Regions</a>
                </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('role')=="polioworker"): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('add_vaccination_record'); ?>">Add Vaccination Record</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('vaccination_record'); ?>">View Vaccination Record</a>
                </li>
            <?php endif; ?>
            <?php if (!$this->session->userdata('logged_in')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('user/login'); ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('user/register'); ?>">Register</a>
                </li>
            <?php endif; ?>
        </ul>
        <?php if ($this->session->userdata('logged_in')): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo site_url('user/logout'); ?>">Logout</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>