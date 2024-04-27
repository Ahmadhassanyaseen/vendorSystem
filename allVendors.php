<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';

// print_r($_SESSION['VNDR']);
// $data["vndid"] = $_SESSION['VNDR']['id'];
$data['vndid'] = "8eee462b-5a6b-5237-64ef-5e66ddee6022";
$data["method"] = "fetchAllVendors";

// print_r($data);
// print_r($_POST);
// print_r($data['username']);
$curl = curl_init($crm_url);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($curl);


$vendors = json_decode($response, true);
// print_r($vendors);
// $_SESSION['VNDR']['VEHICLES'] = $result_data;

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
        --bs-table-bg-type: #E0F7F9 !important;
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
        <h2 class="fw-bolder me-auto ms-auto mt-5 text-primary text-start text-uppercase" data-pg-name="vehiclelist">All Leads<input class="srcIn src2" placeholder="Vendor Search" data-pg-name="super admin search"></h2>
    </div>
    <div class="container h-auto me-auto mh-100 ms-auto mw-100 w-auto text-center mb-4 mt-5 dash" style=" width: 100%!important; padding: 0; float: left; border: 1px solid #e3b04b; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); border-radius:10px;">
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>

                    <th class="col-xs-1" data-field="Vehicle" data-sortable="true">Vendor ID</th>
                    <th class="col-xs-1" data-field="eventdate" data-sortable="true">Status</th>
                    <th class="col-xs-1" data-field="quotedprice" data-sortable="true">Email</th>
                    <th class="col-xs-1" data-field="fname" data-sortable="true">Username</th>
                    <th class="col-xs-1" data-field="lname" data-sortable="true">Password</th>
                  

                  
                </tr>
            </thead>
            <tbody>
                <?php

                foreach($vendors['data'] as $key => $vendor){
                    echo '<tr id="tr-id-tr-class-2">';
                    echo '<td style="font-weight:700!important;">' . $vendor['id'] . '</td>';
                    echo '<td>' . $vendor['status'] . '</td>';
                    echo '<td>' . $vendor['username'] . '</td>';
                    echo '<td>' . $vendor['name'] . '</td>';
                    echo '<td>' . $vendor['password'] . '</td>';
                    
                    // echo '<td>' . $vendor['last_name'] . '</td>';


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