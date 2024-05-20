<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';

// print_r($_SESSION['VNDR']);
$data["vndid"] = $_SESSION['VNDR']['id'];

$data["method"] = "fetchALLVndVehicles";

// print_r($data);
// print_r($_POST);
// print_r($data['username']);
$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);


$result_data = json_decode($response, true);
// print_r($result_data);
$_SESSION['VNDR']['VEHICLES'] = $result_data;

?>
<style>
    .li-item {
        padding: 8px;
        float: left;
    }

    .li-item:hover {
        background-color: #eee;
    }

    .title {
        width: 70%;
    }

    .remove {
        width: 25%;
    }

    .popup_bal {
        cursor: pointer;
        display: none;
        position: absolute;
        z-index: 10000;
    }

    .popup_bal>div {
        background-color: #fff;
        box-shadow: 10px 10px 60px #555;
        display: inline-block;
        height: auto;
        position: relative;
        border-radius: 8px;
        padding: 15px 7px;
        right: 100px;
    }

    .PopupCloseButton {
        background-color: #fff;
        border-radius: 3px;
        cursor: pointer;
        display: inline-block;
        font-family: arial;
        position: absolute;
        top: 1px;
        right: 1px;
        font-size: 16px;
        line-height: 16px;
        width: 16px;
        height: 16px;
        text-align: center;
    }

    .PopupCloseButton:hover {
        background-color: #eeeeee;
    }

    ul {
        list-style: none;
    }

    p {
        margin: 0px !important;
    }

    .show_popup_bal {
        cursor: pointer;
    }

    .overly_layer {
        background: #ccc;
        width: 100%;
        height: 100%;
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        opacity: 0.1;
    }

    .fixed-table-pagination .pagination a {
        color: #e3b04b;
    }

    .fixed-table-pagination .pagination a:hover {
        color: #e3b04b;
    }

    .pagination>.active>a {
        border: 1px solid #e3b04b;
        background: #e3b04b;
        cursor: pointer;
        color: #fff;
    }

    .pagination>.active>a:hover {
        color: #e3b04b;
        border: 1px solid #e3b04b;
        background: #fff;
    }

    .caret {
        color: #e3b04b;
    }

    .dropdown-menu>.active>a,
    .dropdown-menu>.active>a:focus,
    .dropdown-menu>.active>a:hover {
        background-color: #e3b04b;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(8)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list>span>button::after {
        display: none;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(8)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail {
        min-width: 400px;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(8)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list {
        width: 50%;
    }

    .fixed-table-container thead th .both {
        font-weight: 700 !important;
    }

    .f14 {
        font-size: 14px !important;
    }

    .xenoDd,
    .xenodd {
        padding: 5px 10px;
        background: #e3b04b;
        color: #fff;
        border-radius: 5px;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(8)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list>span>button>span.page-size {
        font-size: 14px !important;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(8)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list>span>ul>li {
        font-size: 14px !important;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(9)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4.mt-5>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list>span>button>span.page-size {
        font-size: 14px !important;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(9)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail {
        margin-left: 10px !important;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(9)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-right.pagination {
        margin-right: 10px !important;
    }

    .src2 {
        border-color: rgb(101, 213, 226) !important;
        margin-left: 20px !important;
    }

    #ipt_fsqm_form_wrap_56>div:nth-child(9)>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4.mt-5>div.bootstrap-table>div.fixed-table-container>div.fixed-table-body>table>thead>tr>th {
        background-color: #f9f4e8 !important;
    }

    .table-hover tbody tr:nth-child(odd)>td {
        /* --bs-table-bg-type: #E0F7F9 !important; */
    }

    #tr-id-tr-class-2>td:nth-child(1) {
        font-weight: 700 !important;
    }

    .fixed-table-container thead th .sortable {
        padding: 8px !important;
    }

    .dashView {
        text-decoration: none !important;
        color: #000 !important;
        font-size: 16px !important;

    }

    .p48 {
        padding: 0px 48px !important;
    }

    @media(max-width:480px) {
        .src2 {
            margin: 0 !important;
        }

        .dash {
            overflow: scroll;
        }
    }

  
    .clb {
        color: #000 !important;
    }

    .bg-danger .clb {
        color: #fff !important;
    }

    td {
        position: relative;
    }

    tr:hover td.bg-danger .clb,
    .clb:hover {
        text-decoration: none !important;
        color: #000 !important;
    }

    .bg-danger {
        --bs-table-bg-type: rgba(var(--bs-danger-rgb), var(--bs-bg-opacity)) !important;
    }

    

    #ipt_fsqm_form_wrap_56>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.pe-5.ps-5.w-auto.p48>div.container.h-auto.me-auto.mh-100.ms-auto.mw-100.w-auto.text-center.mb-4.mt-5.dash>div.bootstrap-table>div.fixed-table-container>div.fixed-table-pagination>div.pull-left.pagination-detail>span.page-list>span>ul>li {
        box-shadow: 0px 0px 2px rgba(0, 0, 0, 0.5);
        background-color: #fff;
    }
</style>
<link rel="stylesheet" href="css/bootstrap-table.min.css">
<script src="js/bootstrap-table.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<form method="post" action="#" id="registration_form" onsubmit="return validate_registration(event);">-->
<div class="container h-auto me-auto mh-100 ms-auto mw-100 pe-5 ps-5 w-auto p48">

    <div class="overly_layer"></div>


    <br>
    <!-- <h3 style="margin:20px 0;">Leads</h3> -->
    <div>
        <h2 class="fw-bolder me-auto ms-auto mt-5 text-primary text-start text-uppercase" data-pg-name="vehiclelist">All Lead</h2>
    </div>
    <div class="container h-auto me-auto mh-100 ms-auto mw-100 w-auto text-center mb-4 mt-5 dash" style=" width: 100%!important; padding: 0; float: left; border: 1px solid #e3b04b; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); border-radius:10px;">
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>

                    <th class="col-xs-1" data-field="Vehicle" data-sortable="true">Lead ID</th>
                    <th class="col-xs-1" data-field="eventdate" data-sortable="true">Event Date</th>
                    <th class="col-xs-1" data-field="quotedprice" data-sortable="true">Quoted Price</th>
                    <th class="col-xs-1" data-field="fname" data-sortable="true">First Name</th>
                    <th class="col-xs-1" data-field="lname" data-sortable="true">Last Name</th>
                    <th class="col-xs-1" data-field="distance" data-sortable="true">Distance</th>
                    <th class="col-xs-1" data-field="duration" data-sortable="true">Duration</th>
                    <th class="col-xs-1" data-field="status" data-sortable="true">Status</th>
                    <th class="col-xs-1" data-field="quotesent" data-sortable="true">Quote Status</th>
                    <th class="col-xs-1" data-field="action" data-sortable="true">Actions</th>

                    <!--   <th class="col-xs-1" data-field="vconfirm" data-sortable="true">Vendor Confirmation</th>
                  <th class="col-xs-1" data-field="Color" data-sortable="true">Lead Source</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
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
                // $_SESSION['VNDR']['allLeads'] = $result_data;

                // foreach ($result_data as $results) {
                //     print_r($results);
                //     echo '<br/>';
                // }
                //echo $result_data->count;
                for ($i = count($result_data) - 2; $i >= 0; $i--) {

                    // print_r($result_data[$i]['agreement_status_c']);
                    // echo '<br/>';
                    // print_r($result_data[$i]['sent_quote_id_c']);
                    $quote_ids = explode(',', $result_data[$i]['sent_quote_id_c']);
                    // print_r($quote_ids);
                    $lastQuoteId = end($quote_ids);
                    if ($lastQuoteId) {
                        $data['quote_id'] = $lastQuoteId;
                        $data["method"] = "singleLeadQuoteDetail";
                        $curl = curl_init($crm_url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_HEADER, false);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt(
                            $curl,
                            CURLOPT_POSTFIELDS,
                            $data
                        );
                        $response = curl_exec($curl);
                        $singleLeadQuoteDetails = json_decode($response, true);
                        // print_r($singleLeadQuoteDetails);
                        // echo '<br/>';
                        $quoteStatus = $singleLeadQuoteDetails['data']['quote_status_c'];
                        $quoteStatusTooltip = $singleLeadQuoteDetails['data']['rejection_reason_c'];
                        if (!$quoteStatusTooltip) {
                            $quoteStatusTooltip = 'Pending';
                        }
                    } else {
                        $quoteStatus = 'No Quote Sent';
                        $quoteStatusTooltip = 'No Quote Sent';
                    }
                    if (
                        $result_data[$i]['status'] == "Dead" ||
                        $result_data[$i]['status'] == "Rejected"
                    ) {
                        $bg = 'bg-danger text-white';
                        $btnDis = '<span id="editBtnOverlay"></span>';
                    } else {
                        $bg = '';
                        $btnDis = '';
                    }



                    // test





                    // tset
                    $dateString = $result_data[$i]['eventdate_c'];
                    $timestamp = strtotime($dateString);
                    $newDateFormat = date('m-d-Y', $timestamp);
                    if ($result_data[$i]['status'] == "New") {
                        $statusToolTip = 'Not Assigned to Sales Rep, Waiting on Quote';
                    } elseif ($result_data[$i]['status'] == "In Process") {
                        $statusToolTip = 'Waiting on Quote';
                    } elseif ($result_data[$i]['status'] == "Assigned") {
                        $data['id'] = $result_data[$i]['assigned_user_id'];
                        $data["method"] = "fetchAssignedUser";
                        $curl = curl_init($crm_url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_HEADER, false);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        $response = curl_exec($curl);
                        // echo $response;
                        // $vendorEmail = json_decode($response, true);
                        $statusToolTip = 'Assigned to Sales Rep';
                    }elseif($result_data[$i]['status'] == "Dead"){
                        $statusToolTip = 'Out Of Date';
                    }

                    echo '<tr id="tr-id-tr-class-2" >';
                    echo '<td style="font-weight:700!important;" class="' . $bg . '">' . $result_data[$i]['opertunityid_c'] . '</td>';
                    echo '<td class="' . $bg . '">' . $newDateFormat . '</td>';
                    echo '<td class="' . $bg . '">' . $result_data[$i]['quoted_c'] . '</td>';
                    echo '<td class="' . $bg . '">' . $result_data[$i]['first_name'] . '</td>';
                    echo '<td class="' . $bg . '">' . $result_data[$i]['last_name'] . '</td>';
                    echo '<td class="' . $bg . '">' . $result_data[$i]['distance_c'] . '</td>';
                    echo '<td class="' . $bg . '">' . $result_data[$i]['duration_c'] . '</td>';
                    echo '<td class="' . $bg . '"><a class="clb" href="lead_quotes.php?opertunity_id=' . $result_data[$i]['opertunityid_c'] . '" title="' . $statusToolTip . '">' . $result_data[$i]['status'] . '</a></td>';
                    // echo '<td class="' . $bg . '">' . $result_data[$i]['sent_lead_count'] . '</td>';
                    echo '<td class="' . $bg . '"><a class="clb" href="lead_quotes.php?opertunity_id=' . $result_data[$i]['opertunityid_c'] . '" title="' . $quoteStatusTooltip . '">' . $quoteStatus . '</a></td>';
                    echo '<td class="d-flex align-items-center  justify-content-center w-100 ' . $bg . '">
                    ' . $btnDis . '
                    <a href="editLead_vendor1.php?opertunityid_c=' . $result_data[$i]['opertunityid_c'] . '" class="edit-button">
  <svg class="edit-svgIcon" viewBox="0 0 512 512">
                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"></path>
                  </svg>
</a>
                    </td>';
                    // echo '<td></td>';
                    //     echo ' <td>

                    //     <a href="editLead_vendor.php?opertunityid_c=' . $result_data[$i]['opertunityid_c'] . '"  class="dashView">
                    //  VIEW
                    //     </a>
                    //     </td>';
                    // <div class="dropdown">
                    //     <ul class="dropdown-menu">
                    //         <li><a href="editLead_vendor.php?data='. $result_data[$i] .'&opertunityid_c='. $result_data[$i]['opertunityid_c'] .'&first_name='. $result_data[$i]['first_name'] .'&last_name='. $result_data[$i]['last_name'] .'&quoted_c='. $result_data[$i]['quoted_c'] .'&eventdate='. $result_data[$i]['eventdate_c'] .'&distance='. $result_data[$i]['distance_c'] .'&duration='. $result_data[$i]['duration_c'] .'" title="Edit '. $vData['name'] .'&vreply='. $result_data[$i]['vreply'] .'" style="margin: 0 auto; display: inline-block; text-align: center;">Edit</a></li>
                    //         <li><a class="vdeletebtn" href="#" title="Delete '. $vData['name'].'" style="margin: 0 auto; display: inline-block; text-align: center; color: red;" data-id="'. $vData['id'].'">Delete</a></li>
                    //     </ul>
                    // </div> 
                    //echo '<td>'.$value['first_name'].'</td>';echo '<td>'.$result_data[$i]['agreement_status_c'].'</td>';
                    // echo '<td>'.$result['last_name'].'</td>';
                    // echo '<td>'.$result['lead_source'].'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>


    </div>


    <?php
    if ($_SESSION['VNDR']['email1'] == "shmai.com@gmail.com") { ?>
        <br>
        <h3>Vendors</h3>
        <div class="card-body">
            <div class="form-group">
                <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type your search query here" />
            </div>
            <!-- <div class="table-responsive" id="dynamic_content">
            
          </div>-->
        </div>
        <script>
            jQuery(document).ready(function() {

                //load_data(1);

                function load_data(page, query = '') { //alert(query);
                    if (query == '') {
                        jQuery('#vcontent').show();
                        jQuery('#dynamic_content').html("");
                    } else {
                        jQuery('#vcontent').hide();
                        jQuery.ajax({
                            url: "getvendors.php",
                            method: "POST",
                            data: {
                                page: page,
                                query: query
                            },
                            success: function(data) {
                                jQuery('#dynamic_content').html(data);
                            }
                        });
                    }
                }

                jQuery(document).on('click', '.page-link', function() {
                    var page = jQuery(this).data('page_number');
                    var query = jQuery('#search_box').val();
                    load_data(page, query);
                });

                jQuery('#search_box').keyup(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    var query = jQuery('#search_box').val();
                    load_data(1, query);
                });

            });
        </script>
        <div class="table-responsive" id="dynamic_content">
        </div>
        <div id="vcontent">
            <?php
            $data["method"] = "MasterVendorGetVendor";
            $curl = curl_init($crm_url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($curl);
            $result_data = json_decode($response, true); //var_dump($result_data);
            //print_r($result_data);

            echo ' <table id="allrecords" data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>
            
                    <th class="col-xs-1" data-field="vname" data-sortable="true"> Name</th>
                   
                </tr>
            </thead>
            <tbody>';
            foreach ($result_data as $results) { //print_r( $results);
                foreach ($results as $key => $result) {
                    $vendorlink = '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id=' . $key . '&name=' . $result . '">' . $result . '</a>';
                    echo '
    <tr id="tr-id-tr-class-2">
      <td>' . $vendorlink . '</td>
    </tr>
    ';
                    // echo '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id='.$key.'&name='.$result.'">'.$result.'</a>';
                }
            }
            ?>
            </tbody>
            </table>
        </div>
    <?php }

    ?>
    <!--</form>-->
</div>
<script>
    jQuery(window).load(function() {
        jQuery('.PopupCloseButton').click(function() {
            jQuery('.popup_bal').hide();
        });
        jQuery('.show_popup_bal').on('click', function() {
            jQuery('.popup_bal').hide();
            jQuery('#popup_' + this.id).show();
            jQuery('.overly_layer').show();
        });
        jQuery('.overly_layer').click(function() {
            jQuery('.popup_bal').hide();
            jQuery('.overly_layer').hide();
        });
        jQuery('.vdeletebtn').click(function() {
            /*return confirm('Are you sure you want to delete this Vehicle?')
                $.ajax({
              url: 'delete.php?vehicle=<?php echo $vData['id']; ?>',
              type: 'DELETE',
              success: function(data) {
                //play with data
              }
            });
            alert(jQuery(this).closest('tr').prop('class'));
            
            jQuery(this).closest('tr').fadeOut();   */
            var vid = jQuery(this).attr('data-id');
            /**/
            if (confirm('Are you sure you want to delete this Vehicle?')) {
                jQuery(this).closest('tr').fadeOut();
                jQuery.ajax({
                    url: 'delete.php?vehicle=' + vid,
                    type: 'DELETE',
                    success: function(data) {
                        //alert(vid);
                        jQuery(this).closest('tr').fadeOut();
                        //play with data
                    }
                });
            }
        });

    });
    /* function deletethis(vid, id){
         //var confirm =  confirm('Are you sure you want to delete this Vehicle?');
         if (confirm('Are you sure you want to delete this Vehicle?')) {
                                 
             jQuery.ajax({
               url: 'delete.php?vehicle='+vid,
               type: 'DELETE',
               success: function(data) {
                 alert(vid);
                 //play with data
               }
             });
         }
         alert(id);

     }*/
</script>

<?php
require './footer.php';
?>