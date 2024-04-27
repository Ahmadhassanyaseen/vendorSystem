<?php
$page = 'dashboard';
require_once './config.php';
require_once './session.php';
require_once './header.php';
?>
<style>
    .li-item{
        padding: 8px;
        float: left;
    }
    .li-item:hover{
        background-color: #eee;
    }
    .title{
        width: 70%;
    }
    .remove{
        width: 25%;
    }
    .popup_bal{
        cursor:pointer;
        display:none;
        position:absolute;
        z-index:10000;
    }
    .popup_bal > div {
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
    p{
        margin: 0px !important;
    }
    .show_popup_bal{
        cursor: pointer;
    }
    .overly_layer{
        background: #ccc;
        width: 100%;
        height: 100%;
        position: fixed;
        display: none;
        top: 0;
        left: 0;
        opacity: 0.1;
    }
</style>
<link rel="stylesheet" href="css/bootstrap-table.min.css">
<script src="js/bootstrap-table.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<form method="post" action="#" id="registration_form" onsubmit="return validate_registration(event);">-->
<div class="ipt-eform-content ">
    <div data-settings="" class="ipt_fsqm_main_tab ipt_uif_tabs horizontal ui-tabs ui-widget-content ui-corner-all">
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
                        <input type="button" class="btn btn-primary" onclick="window.location.href = 'profile.php';" title="Update Profile | Unlimited Charters Vendor System" value="Update Profile"  style="float: right; padding: 10px 18px; text-transform: uppercase;"  />
                        <div class="clear-both"></div>
                    </div>
                </div>
            </div>
            <div class="clear-both">
            </div>
        </div>
    </div>
    <div class="overly_layer"></div>
    <div class="container text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12)">
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>
                    <th class="col-xs-1" data-field="Passenger" data-sortable="true"><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe7fd;" style="font-size:18px;"></th>
                    <th class="col-xs-4" data-field="Vehicle" data-sortable="true">Vehicle Type</th>
                    <th class="col-xs-1" data-field="Make" data-sortable="true">Make</th>
                    <th class="col-xs-1" data-field="Model" data-sortable="true">Model</th>
                    <th class="col-xs-1" data-field="Color" data-sortable="true">Color</th>
                    <th class="col-xs-1" data-field="Features" data-sortable="true">Features</th>
                    <th class="col-xs-1" data-field="Rates" data-sortable="true">Rates</th>
                    <th class="col-xs-1" data-field="Quantity" data-sortable="true">Qty</th>
                    <th class="col-xs-2" data-field="Action"></th>
                    <th class="col-xs-1" data-field="Photos">Photos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['VNDR']['VEHICLES'])) {//print_r($_SESSION['VNDR']['email1']);
                    $count = 0;
                    foreach ($_SESSION['VNDR']['VEHICLES'] as $vindx => $vData) {
                        ?>  <?php if (!empty($vData['name'])): ?>
                        <tr id="tr-id-<?php echo $count; ?>" class="<?php
                        if ($vData['published_c'] == 'Yes')
                            echo 'tr-class-2';
                        else
                            echo 'danger';
                        ?>">
                      
                            
                        
                            <td><?php echo $vData['vehicle_capacity']; ?></td>
                            <td><?php echo $vData['name'] ?></td>
                            <td><?php echo $vData['vehicle_make']; ?></td>
                            <td><?php echo $vData['vehicle_model']; ?></td>
                            <td><?php echo $vData['vehicle_color']; ?></td>
                            <td>
                                <?php
                                $features_list = '';
                                foreach ($vData['interior_style'] as $ftr) {
                                    if (!empty($ftr)) {
                                        $features_list .= '<li><p><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                    }
                                }
                                foreach ($vData['onboard_luxury'] as $ftr) {
                                    if (!empty($ftr)) {
                                        $features_list .= '<li><p><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                    }
                                }
                                foreach ($vData['media_capability'] as $ftr) {
                                    if (!empty($ftr)) {
                                        $features_list .= '<li><p><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                    }
                                }
                                foreach ($vData['complimentary'] as $ftr) {
                                    if (!empty($ftr)) {
                                        $features_list .= '<li><p><i title="" class="ipticm prefix" data-ipt-icomoon="&#xe8d0;"></i>' . $ftr . '</p></li>';
                                    }
                                }
                                if ($features_list != '') {
                                    ?>
                                    <a class="show_popup_bal" id="feature_<?php echo $count; ?>">VIEW</a>
                                    <div class="popup_bal" id="popup_feature_<?php echo $count; ?>">
                                        <div>
                                            <div class="PopupCloseButton">X</div>
                                            <ul>
                                                <?php echo $features_list; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a class="show_popup_bal" id="rate_<?php echo $count; ?>">VIEW</a>
                                <div class="popup_bal" id="popup_rate_<?php echo $count; ?>">
                                    <div>
                                        <div class="PopupCloseButton">X</div>
                                        <span><strong>Base Hourly: </strong>$<?php echo $vData['base_hourly_rate']; ?></span><br/>
                                        <span><strong>Minimum Hours: </strong><?php echo number_format($vData['base_min_hours'], 0, '.', ','); ?> hour(s)</span><br/>
                                        <span><strong>Additional Hourly: </strong>$<?php echo $vData['base_additional_hourly']; ?></span><br/>
                                        <span><strong>Fuel Surcharge: </strong><?php echo $vData['fuel_surcharge_percentage']; ?>%</span><br/>
                                        <span><strong>Driver Gratuity: </strong><?php echo $vData['driver_gratuity_percentage']; ?>%</span><br/>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $vData['vehicle_quantity']; ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" onclick="">EDIT<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="vehicle.php?vehicle=<?php echo $vData['id']; ?>" title="Edit <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center;">EDIT</a></li>
                                        <li><a class="vdeletebtn" href="#" title="Delete <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center; color: red;" data-id="<?php echo $vData['id']; ?>" >DELETE</a></li>
                                    </ul>
                                </div> <!--delete.php?vehicle=<?php echo $vData['id']; ?>-->
                            </td>
                            <td><?php
                                $images_list = '';
                                foreach ($vData['vehicle_images'] as $img) {
                                    if (file_exists("vehicles/" . $img) && !empty($img)) {
                                        $images_list .= '<img src="vehicles/' . $img . '" width="100" height="100" style="padding:7px; display: inline-block; float: left;" />';
                                    }
                                }
                                if ($images_list != '') {
                                    ?>
                                    <a class="show_popup_bal" id="image_<?php echo $count; ?>">VIEW</a>
                                    <div class="popup_bal" id="popup_image_<?php echo $count; ?>">
                                        <div style="width: 214px;">
                                            <div class="PopupCloseButton">X</div>
                                            <?php echo $images_list; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php endif ?>
                        <?php
                        $count++;
                    }
                }
                ?>
            </tbody>    
        </table>
     
       
    </div>
    
    <br>
<h3 style="margin:20px 0;">Leads</h3>
<div class="container text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12)">
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
                $data["vendor_email"] = $_SESSION['VNDR']['email1'];//"aslofNH@gmail.com";//"stretchllc.limo@gmail.com";
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
                        for($i=count($result_data)-2;$i>=0;$i--){//print_r($result);
                            echo '<tr id="tr-id-tr-class-2">';
                            echo '<td>'.$result_data[$i]['opertunityid_c'].'</td>';
                            echo '<td>'.$result_data[$i]['first_name'].'</td>';
                            echo '<td>'.$result_data[$i]['last_name'].'</td>';
                            echo '<td>'.$result_data[$i]['quoted_c'].'</td>';
                            echo '<td>'.$result_data[$i]['vreply'].'</td>';
                             echo '<td>'.$result_data[$i]['eventdate_c'].'</td>';
                              echo '<td>'.$result_data[$i]['distance_c'].'</td>';
                               echo '<td>'.$result_data[$i]['duration_c'].'</td>';
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
    if($_SESSION['VNDR']['email1'] == "shmai.com@gmail.com"){ ?>
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
  jQuery(document).ready(function(){

    //load_data(1);

    function load_data(page, query = '')
    { //alert(query);
        if(query == ''){
        jQuery('#vcontent').show();
        jQuery('#dynamic_content').html("");
        }else{ 
        jQuery('#vcontent').hide();
      jQuery.ajax({
        url:"getvendors.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          jQuery('#dynamic_content').html(data);
        }
      });}
    }

    jQuery(document).on('click', '.page-link', function(){
      var page = jQuery(this).data('page_number');
      var query = jQuery('#search_box').val();
      load_data(page, query);
    });

    jQuery('#search_box').keyup(function(e){
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
        $result_data = json_decode($response,true);//var_dump($result_data);
        //print_r($result_data);
        
        echo ' <table id="allrecords" data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>
            
                    <th class="col-xs-1" data-field="vname" data-sortable="true"> Name</th>
                   
                </tr>
            </thead>
            <tbody>';
        foreach($result_data as $results){//print_r( $results);
        foreach($results as $key =>$result ){
            $vendorlink = '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id='.$key.'&name='.$result.'">'.$result.'</a>';
            echo '
    <tr id="tr-id-tr-class-2">
      <td>'.$vendorlink.'</td>
    </tr>
    ';
           // echo '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id='.$key.'&name='.$result.'">'.$result.'</a>';
        }}
    ?>
     </tbody>       
    </table>
</div>
   <?php }
    
    ?>
<!--</form>-->
</div>
<script>
        jQuery(window).load(function () {
            jQuery('.PopupCloseButton').click(function () {
                jQuery('.popup_bal').hide();
            });
            jQuery('.show_popup_bal').on('click', function () {
                jQuery('.popup_bal').hide();
                jQuery('#popup_' + this.id).show();
                jQuery('.overly_layer').show();
            });
            jQuery('.overly_layer').click(function () {
                jQuery('.popup_bal').hide();
                jQuery('.overly_layer').hide();
            });
            jQuery('.vdeletebtn').click(function(){
                /*return confirm('Are you sure you want to delete this Vehicle?')
                $.ajax({
              url: 'delete.php?vehicle=<?php echo $vData['id']; ?>',
              type: 'DELETE',
              success: function(data) {
                //play with data
              }
            });
            alert(jQuery(this).closest('tr').prop('class'));
            
            jQuery(this).closest('tr').fadeOut();   */var vid = jQuery(this).attr('data-id');
            /**/if (confirm('Are you sure you want to delete this Vehicle?')) {
                    jQuery(this).closest('tr').fadeOut();                    
                    jQuery.ajax({
                      url: 'delete.php?vehicle='+vid,
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