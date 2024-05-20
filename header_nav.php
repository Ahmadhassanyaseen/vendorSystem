<?php
require_once './session.php';

// Your array data


// Accessing the name of the user

$userName = $_SESSION['VNDR']['name'];


                                    // print_r($_SESSION);
                                    $data["vendor_email"] = $_SESSION['VNDR']['username']; //"aslofNH@gmail.com";//"stretchllc.limo@gmail.com";
                                    $data["vendor_id"] = $_SESSION['VNDR']['id'];
                                    $data["method"] = "FetchVndLeads";
                                    $curl = curl_init($crm_url);
                                    curl_setopt($curl, CURLOPT_POST, true);
                                    curl_setopt($curl, CURLOPT_HEADER, false);
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                    $response = curl_exec($curl);
                                    $result_data = json_decode($response, true);
                                    $_SESSION['VNDR']['allLeads'] = $result_data;

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

    #searchTable {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: #fff;
        z-index: 99999;
    }

    #searchTable thead,
    #searchTable thead tr,
    #searchTable tbody,
    #searchTable tbody tr {
        width: 100%;
        display: flex;

    }

    #searchTable tbody {
        flex-direction: column;
    }

    #searchTable thead tr th,
    #searchTable tbody tr td {
        flex: 1;
    }

    #searchTable thead tr th {
        font-size: 16px;
        color: #000;
        background: #f9f4e8 !important;
        padding: 10px 5px;
    }

    #searchTable tbody tr td {
        color: #000;
        font-size: 14px;
        max-height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    #searchTableBody tr td:first-child,
    #searchTableBody tr td:nth-last-child(2),
    #searchTableBody tr td:nth-last-child(3),
    #searchTableBody tr td:nth-last-child(9),
    #searchTableBody tr td:nth-last-child(4) {
        display: none;
    }

    .edit-button {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: rgb(20, 20, 20);
        border: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
        cursor: pointer;
        transition-duration: 0.3s;
        overflow: hidden;
        position: relative;
        text-decoration: none !important;
    }

    .edit-svgIcon {
        width: 17px;
        transition-duration: 0.3s;
    }

    .edit-svgIcon path {
        fill: white;
    }

    .edit-button:hover {
        width: 80px;
        border-radius: 50px;
        transition-duration: 0.3s;
        /* background-color: rgb(255, 69, 69); */
        background-color: #e3b04b;
        align-items: center;
    }

    .edit-button:hover .edit-svgIcon {
        width: 20px;
        transition-duration: 0.3s;
        transform: translateY(60%);
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }

    .edit-button::before {
        display: none;
        content: "Edit";
        color: white;
        transition-duration: 0.3s;
        font-size: 2px;
    }

    .edit-button:hover::before {
        display: block;
        padding-right: 10px;
        font-size: 13px;
        opacity: 1;
        transform: translateY(0px);
        transition-duration: 0.3s;
    }

    #editBtnOverlay {
        width: 35px;
        height: 35px;
        position: absolute;
        background: #fff;
        z-index: 9;
        opacity: 0.4;
        border-radius: 50%;
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
                <!-- <input type="text" placeholder="Lead Search" class="srcIn"> -->
                <input type="text" id="search-input" placeholder="Search..." class="srcIn">

                <table id="searchTable">
                    <thead>
                        <tr>
                            <th>Lead ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Quoted Price</th>
                            <th>Status</th>
                            <th>Event Date</th>
                            <th>Duration</th>
                            <th>Distance</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id="searchTableBody">
                        <tr>

                        </tr>
                    </tbody>
                </table>

                <script>
                    const searchInput = document.getElementById('search-input');
                    const searchResults = document.getElementById('search-results');


                    const items = <?php echo json_encode($_SESSION['VNDR']['allLeads']) ?>;
                    // console.log(items);
                    const dataArray = Object.keys(items).map(key => items[key]);
                    let allLeadDataArray = [];

                    dataArray.forEach((data) => {
                        const dataArray = Object.values(data); // Convert object to array
                        // console.log(dataArray);
                        allLeadDataArray.push(dataArray);
                    });


                    function filterItems(searchTerm) {
                        return allLeadDataArray.filter(innerArray => {
                            // Convert each inner array to a string and check if it includes the searchTerm
                            const stringifiedArray = innerArray.map(item => {
                                // Check if the item is null, if so, return an empty string
                                return item === null ? '' : item.toString().toLowerCase();
                            });
                            return stringifiedArray.join(' ').includes(searchTerm.toLowerCase());
                        });
                    }


                    // function displayResults(results) {
                    //     // Clear previous results
                    //     const tbody = document.querySelector('#searchTableBody');
                    //     const searchTable = document.querySelector('#searchTable');
                    //     tbody.innerHTML = '';

                    //     // Display new results
                    //     results.forEach(result => {
                    //         const tr = document.createElement('tr');
                    //         // Assuming result is an object with properties corresponding to table columns
                    //         Object.values(result).forEach(value => {
                    //             const td = document.createElement('td');
                    //             td.textContent = value;

                    //             tr.appendChild(td);
                    //         });

                    //         // console.log(result[1]);
                    //                                     tbody.appendChild(tr);
                    //     });
                    //     searchTable.style.display = 'block';
                    // }


                    function displayResults(results) {
                        // Clear previous results
                        const tbody = document.querySelector('#searchTableBody');
                        const searchTable = document.querySelector('#searchTable');
                        tbody.innerHTML = '';

                        // Display new results
                        results.forEach(result => {
                            const tr = document.createElement('tr');

                            // Assuming result is an object with properties corresponding to table columns
                            Object.values(result).forEach(value => {
                                const td = document.createElement('td');
                                td.textContent = value;
                                tr.appendChild(td);
                            });

                            // Create a new td element for the custom content
                            const customTd = document.createElement('td');
                            customTd.className = 'd-flex align-items-center justify-content-center w-100 '
                            customTd.innerHTML = `
          
            <a href="editLead_vendor1.php?opertunityid_c=${result[1]}" class="edit-button">
                <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                </svg>
            </a>
        `;
                            tr.appendChild(customTd);

                            tbody.appendChild(tr);
                        });
                        searchTable.style.display = 'block';
                    }




                    // Event listener for input change
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value;
                        if (searchTerm) {
                            const filteredItems = filterItems(searchTerm);
                            displayResults(filteredItems);
                        } else {
                            searchTable.style.display = 'none';
                        }
                    });
                </script>


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
                            <a class="dropdown-item" href="./stats.php">STATISTICS</a>
                            <a class="dropdown-item" href="./calender.php">CALENDAR</a>
                            <!-- <a class="dropdown-item" href="#">BOOKED LEADS</a> -->
                        </div>

                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="border border-secondary d-flex h-100 me-auto mh-100 ms-auto mt-5 mw-100 row" data-bs-toggle="popover">
    </div>
</div>