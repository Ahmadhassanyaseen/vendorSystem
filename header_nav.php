<?php
require_once './session.php';

// Your array data


// Accessing the name of the user

$userName = $_SESSION['VNDR']['name'];




?>
<style>
    .srcIn {
        background: #fff !important;
        border: 2px solid #000 !important;
        border-radius: 25px !important;
        outline: 2px solid #fff !important;
        width: 200px !important;
        text-align: center !important;
        font-size: 16px !important;
        padding: 0px !important;
        height: 30px !important;

    }

    #navbarNavDropdown-23>ul>li.dropdown.d-flex.show>div>a,
    #navbarNavDropdown-23>ul>li.dropdown.d-flex>div>a {
        color: #000;
        font-size: 16px;
        padding: 4px 16px;
    }
</style>
<div class="container h-auto me-auto mh-100 ms-auto mw-100 pe-5 ps-5 w-auto">
    <div class="align-items-center g-0 me-auto ms-auto py-4 row">
        <div class="col">
            <a href="./dashboard.php">

                <img src="./images/Logo-Image2.png" sizes="4000px" width="300">
            </a>
        </div>
        <div class="col-auto">
            <div class="col-auto text-end">
                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="./logout.php" class="text-decoration-none text-right login-cl w-50 fw-bolder"> <i title="" class="login-cl ipticm prefix" data-ipt-icomoon="">
                        </i> Log Out</a>
                    <a href="./profile.php" style="width:40px;height:40px">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="fs-1 w-100 h-100" data-pg-name="profile" title="Profile">
                            <g>
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path d="M2 3.993A1 1 0 0 1 2.992 3h18.016c.548 0 .992.445.992.993v16.014a1 1 0 0 1-.992.993H2.992A.993.993 0 0 1 2 20.007V3.993zM4 5v14h16V5H4zm2 2h6v6H6V7zm2 2v2h2V9H8zm-2 6h12v2H6v-2zm8-8h4v2h-4V7zm0 4h4v2h-4v-2z"></path>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="align-items-center d-inline-flex gap-2 gap-md-3 py-1"> <a href="./profile.php" class="text-decoration-none"> <span class="me-md-1" data-pg-name="Vendor Name"> </span> <span class="d-md-inline d-none fw-bolder text-secondary userName">Welcome, <?php echo $userName; ?></span> </a>
                </div>
            </div>
            <div class="align-items-center d-inline-flex gap-2 gap-md-3 py-1"> <a href="#" class="text-decoration-none d-flex align-items-center justify-content-center"> <span class="me-md-1"> <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M21 16.42v3.536a1 1 0 0 1-.93.998c-.437.03-.794.046-1.07.046-8.837 0-16-7.163-16-16 0-.276.015-.633.046-1.07A1 1 0 0 1 4.044 3H7.58a.5.5 0 0 1 .498.45c.023.23.044.413.064.552A13.901 13.901 0 0 0 9.35 8.003c.095.2.033.439-.147.567l-2.158 1.542a13.047 13.047 0 0 0 6.844 6.844l1.54-2.154a.462.462 0 0 1 .573-.149 13.901 13.901 0 0 0 4 1.205c.139.02.322.042.55.064a.5.5 0 0 1 .449.498z"></path>
                        </svg> </span> <span class="d-md-inline d-none">855.943.1466</span> </a> <a href="#" class="text-decoration-none d-flex align-items-center justify-content-center"> <span class="me-md-1"> <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                            <path d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm9.06 8.683L5.648 6.238 4.353 7.762l7.72 6.555 7.581-6.56-1.308-1.513-6.285 5.439z"></path>
                        </svg> </span> <span class="d-md-inline d-none">vendor@unlimitedcharters.com</span> </a>
            </div>
            <br>

        </div>
    </div>
    <hr class="m-0">
    <nav class="bg-secondary fs-6 fw-semibold me-lg-auto ms-lg-auto navbar navbar-expand-lg navbar-light py-lg-1 text-uppercase">
        <div class="container flex-row-reverse">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown-23" aria-controls="navbarNavDropdown-23" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
            <button class="border-0 btn btn-outline-primary order-lg-1 py-2" type="button" aria-label="search" style="display:flex;align-items:center;justify-content:center;gap:50px;">
                <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24" class="text-dark">
                    <path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"></path>
                </svg>
                <input type="text" placeholder="Lead Search" class="srcIn">
            </button>
            <div class="collapse justify-content-center me-auto ms-auto navbar-collapse ps-5" id="navbarNavDropdown-23">
                <ul class="gap-lg-4 navbar-nav pagination">
                    <li class="nav-item page-item table-active"> <a class="nav-link px-lg-0 py-lg-3" href="./dashboard.php" data-pg-name="Leads">LEADS</a>
                    </li>
                    <li class="nav-item page-item"> <a class="active nav-link px-lg-0 py-lg-3" href="./add_ons.php" data-pg-name="Add Ons">ADD-ONS</a>
                    </li>

                    <li class="dropdown d-flex">
                        <button class="btn nav-item page-item dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            MODULES
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="./vehicle.php">VEHICLES</a>
                            <a class="dropdown-item" href="#">STATISTICS</a>
                            <a class="dropdown-item" href="#">CALENDAR</a>
                            <a class="dropdown-item" href="#">BOOKED LEADS</a>
                        </div>

                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="border border-secondary d-flex h-100 me-auto mh-100 ms-auto mt-5 mw-100 row" data-bs-toggle="popover">
    </div>
</div>