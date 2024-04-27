<?php
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
// $lead_email = 'ahmadhassan795294@gmail.com';
// $first = 'Ahmad';
// $last = 'Hassan';
// print_r($_GET);
// if(isset($_GET['lead_email'])) {
//     $lead_email = $_GET['lead_email'];
// }
// else{
//     header("location: https://unlimitedcharters.com");
// }

$lead_email = $_GET['lead_email'];
$first = $_GET['first'];
$last = $_GET['last'];


if(isset($_GET['page'])) {
$page = $_GET['page'];
}
else{
    $page = 1;
}
// $page = $_GET['page'] ? $_GET['page'] : 1;
$data["lead_email"] = $lead_email;
$data["method"] = "fetchLeadsByEmail";
$curl = curl_init($crm_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);
// echo $response;
$result_data = json_decode($response, true);

// print_r($result_data);
// $data = array(/* Your array data here */);
$result_data['leads'] = array_reverse($result_data['leads']);

$subArrays = array_chunk($result_data['leads'], 20);

// print_r(count($subArrays));
// echo '<br>';
// echo '<br>';
// echo '<br>';
// echo '<br>';

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Leads</title>
    <link href="./css/tailwind.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="images/ico.jpg" type="image/jpeg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        th,
        td {
            /* border: 1px solid rgba(0, 0, 0, 0.3); */
            /* box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.3); */
            /* border-inline-end-width: 1px;
            border-bottom-width: 1px; */
            border-width: 1px;
        }
    </style>
</head>

<body>

    <div class="border-b-2 flex flex-wrap mx-auto">
        <div class="mx-auto pl-10 pr-0 pt-10 w-1/2">
            <img src="./images//Logo-Image2.png" class="w-1/2" sizes="100vw,
(min-width: 640px) 296px,
(min-width: 768px) 59vw,
(min-width: 1280px) 616px,
(min-width: 1536px) 744px,
(min-width: 2400px) 31vw">
        </div>

        <div class="mx-auto pl-10 pr-0 pt-10 w-1/2 flex items-center justify-center">
            <h2 class=" text-3xl w-max"><b class="h-auto mx-auto w-auto"><?php echo $first . " " . $last; ?></b></h2>
        </div>
    </div>
    <!-- Header End Here -->







    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" class="w-[25%]  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                            </div>
                        </form>
                    </div>

                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Sr#</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Lead ID</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Event Date</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Lead Vehicle</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Lead Route</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Price</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Status</th>
                                <th scope="col" class="px-4 py-3 border-e border-neutral-200">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($page == '1') {
                                $i = 1;
                            } elseif ($page == '2') {
                                $i = 21;
                            } elseif ($page == '3') {
                                $i = 41;
                            } elseif ($page == '4') {
                                $i = 61;
                            } elseif ($page == '5') {
                                $i = 81;
                            } elseif ($page == '6') {
                                $i = 101;
                            } elseif ($page == '7') {
                                $i = 121;
                            } elseif ($page == '8') {
                                $i = 141;
                            } elseif ($page == '9') {
                                $i = 161;
                            } elseif ($page == '10') {
                                $i = 181;
                            } elseif ($page == '11') {
                                $i = 201;
                            }
                            // foreach ($result_data['leads'] as $data) {
                            $loopControl = $page - 1;
                            foreach ($subArrays[$loopControl] as $data) {

                                // print_r($data);
                                $data["lead_id"] = $data['bean_id'];
                                $data["method"] = "fetchSingleLeadById";
                                $curl = curl_init($crm_url);
                                curl_setopt($curl, CURLOPT_POST, true);
                                curl_setopt($curl, CURLOPT_HEADER, false);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                $response = curl_exec($curl);
                                // echo $response;
                                $lead = json_decode($response, true);
                                // print_r($lead);
                                if ($lead && isset($lead)) {
                                    // if (isset($lead[0]['opertunityid_c']) && isset($lead[0]['eventdate_c']) && isset($lead[0]['vechiles_name_c']) && isset($lead[0]['location_c']) && isset($lead[0]['quoted_c']) && isset($lead[0]['status']) && $lead[0]['opertunityid_c'] && $lead[0]['eventdate_c'] && $lead[0]['vechiles_name_c'] && $lead[0]['location_c'] && $lead[0]['quoted_c'] && $lead[0]['status']) {
                                    if (isset($lead[0]['opertunityid_c']) && $lead[0]['opertunityid_c']) {
                                        $opertunityid = $lead[0]['opertunityid_c'];
                                    } else {
                                        $opertunityid = "";
                                    }
                                    if (isset($lead[0]['eventdate_c']) && $lead[0]['eventdate_c']) {
                                        $eventdate = $lead[0]['eventdate_c'];
                                    } else {
                                        $eventdate = "";
                                    }
                                    if (isset($lead[0]['vechiles_name_c']) && $lead[0]['vechiles_name_c']) {
                                        $vechiles_name = $lead[0]['vechiles_name_c'];
                                    } else {
                                        $vechiles_name = "";
                                    }
                                    if (isset($lead[0]['location_c']) && $lead[0]['location_c'] && $lead[0]['pickuplocation_c'] && isset($lead[0]['pickuplocation_c'])) {
                                        $location = $lead[0]['pickuplocation_c'] .' <b>To</b> ' . $lead[0]['location_c'];
                                    } else {
                                        $location = "";
                                    }
                                    if (isset($lead[0]['quoted_c']) && $lead[0]['quoted_c']) {
                                        $quoted = $lead[0]['quoted_c'];
                                    } else {
                                        $quoted = "";
                                    }
                                    if (isset($lead[0]['status']) && $lead[0]['status']) {
                                        $status = $lead[0]['status'];
                                    } else {
                                        $status = "";
                                    }


                                    echo '<tr class="border-b dark:border-gray-700">
                         <td class="px-4 py-3">' . $i . '</td>
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . $opertunityid . '</th>
                                <td class="px-4 py-3">' . $eventdate . '</td>
                                <td class="px-4 py-3">' . $vechiles_name . '</td>
                                <td class="px-4 py-3">' . $location . '</td>
                                <td class="px-4 py-3">' . $quoted . '</td>
                                <td class="px-4 py-3">' . $status . '</td>
                                <td class="px-4 py-3"><a href="./index.php?lead_id=' . $lead[0]['id_c'] . '">View</a></td>
                             
                            </tr>';
                                    // }
                                    // echo '<br>';
                                    // echo '<br>';
                                    $i++;
                                }
                            }

                            ?>


                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        <?php
                        $max = $page * 20;
                        $min = $max - 19;
                        if ($max > count($result_data['leads'])) {
                            $max = count($result_data['leads']);
                        }

                        ?>
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo $min . "-" . $max ?></span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white"><?php echo count($result_data['leads']);  ?></span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <?php
                            if ($page > 1) {
                                $pre = $page - 1;
                            } else {
                                $pre = 1;
                            }
                            ?>
                            <a href="./all_Leads.php?page=<?php echo $pre ?>" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <?php
                        $i = 1;
                        foreach ($subArrays as $data) {
                            echo ' <li>
                            <a href="./all_Leads.php?page=' . $i . '" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">' . $i . '</a>
                        </li>';
                            $i++;
                        }


                        ?>
                        
                        <li>
                            <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>


</body>

</html>