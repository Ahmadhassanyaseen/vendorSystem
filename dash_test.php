<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';
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
</style>
<link rel="stylesheet" href="css/bootstrap-table.min.css">
<script src="js/bootstrap-table.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<form method="post" action="#" id="registration_form" onsubmit="return validate_registration(event);">-->
<div class="container h-auto me-auto mh-100 ms-auto mw-100 pe-5 ps-5 w-auto">
    <!-- <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget-content ui-corner-all">
        <?php require_once 'logout_link.php'; ?>
        <div id="ipt_fsqm_form_56_tab_1" class="ipt_fsqm_form_tab_panel ui-tabs-panel ui-widget-content ui-corner-bottom" aria-labelledby="ui-id-2" role="tabpanel" style="" aria-hidden="true">
            <div id="ipt_fsqm_form_56_layout_1_inner" class="ipt-eform-layout-wrapper">
                <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_blank_container" id="ipt_fsqm_form_56_design_8">
                    <div class="ipt_uif_column_inner">
                        <div class="ipt_uif_blank_container">
                            <div class="alert alert-success">
                                <span>WELCOME TO UNLIMITED CHARTERS VENDOR SYSTEM</span>
                            </div>
                        </div>
                        <input type="button" class="btn btn-primary" onclick="window.location.href = 'vehicle.php';" title="Add Vehicle | Unlimited Charters Vendor System" value="Add Vehicle" style="float: left; padding: 10px 18px; text-transform: uppercase;" />
                        <input type="button" class="btn btn-primary" onclick="window.location.href = 'profile.php';" title="Update Profile | Unlimited Charters Vendor System" value="Update Profile" style="float: right; padding: 10px 18px; text-transform: uppercase;" />
                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>
            <div class="clear-both">
            </div>
        </div>
    </div> -->
    <div class="overly_layer"></div>


    <br>
    <h3 style="margin:20px 0;">Leads</h3>
    <div class="container h-auto me-auto mh-100 ms-auto mw-100 w-auto text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12); border-radius:10px;">
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>

                    <th class="col-xs-4" data-field="Vehicle" data-sortable="true">Lead ID</th>
                    <th class="col-xs-1" data-field="fname" data-sortable="true">First Name</th>
                    <th class="col-xs-1" data-field="lname" data-sortable="true">Last Name</th>
                    <th class="col-xs-1" data-field="quotedprice" data-sortable="true">Quoted Price</th>
                    <th class="col-xs-1" data-field="status" data-sortable="true">Status</th>
                    <th class="col-xs-1" data-field="eventdate" data-sortable="true">Event Date</th>
                    <th class="col-xs-1" data-field="distance" data-sortable="true">Distance</th>
                    <th class="col-xs-1" data-field="duration" data-sortable="true">Duration</th>

                    <!--   <th class="col-xs-1" data-field="vconfirm" data-sortable="true">Vendor Confirmation</th>
                  <th class="col-xs-1" data-field="Color" data-sortable="true">Lead Source</th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                $data["vendor_email"] = $_SESSION['VNDR']['email1']; //"aslofNH@gmail.com";//"stretchllc.limo@gmail.com";
                $data["vendor_id"] = $_SESSION['VNDR']['id'];
                $data["method"] = "FetchVndLeads";
                $curl = curl_init($crm_url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                $response = curl_exec($curl);
                $result_data = json_decode($response, true);
                //print_r($result_data);
                //echo $result_data->count;
                for ($i = count($result_data) - 2; $i >= 0; $i--) {
                    // print_r($result);
                    echo '<tr id="tr-id-tr-class-2">';
                    echo '<td>' . $result_data[$i]['opertunityid_c'] . '</td>';
                    echo '<td>' . $result_data[$i]['first_name'] . '</td>';
                    echo '<td>' . $result_data[$i]['last_name'] . '</td>';
                    echo '<td>' . $result_data[$i]['quoted_c'] . '</td>';
                    echo '<td>' . $result_data[$i]['vreply'] . '</td>';
                    echo '<td>' . $result_data[$i]['eventdate_c'] . '</td>';
                    echo '<td>' . $result_data[$i]['distance_c'] . '</td>';
                    echo '<td>' . $result_data[$i]['duration_c'] . '</td>';
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