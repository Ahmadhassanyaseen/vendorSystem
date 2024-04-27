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
   
    
    <br>

    
    
    <?php 
    if($_SESSION['VNDR']['email1'] == "shmai.com@gmail.com"){ ?>
    
       
      <h3 style="margin:20px 0;">Vendor Vehicles</h3>
      
<div class="container text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12)">
        <a class="btn btn-primary" style="color:#ffffff;" href="https://unlimitedcharters.com/betacrm/index.php?module=VND_Vendors&offset=3&return_module=VND_Vendors&action=EditView&record=<?php echo $_REQUEST['vnd_id'];?>" target="_blank">Edit Vendor</a>
        <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>
                    <th class="col-xs-4" data-field="Vendor" data-sortable="true">Vendor Name</th>
                    <th class="col-xs-4" data-field="Vehicle" data-sortable="true">Vehicle Name</th>
                    <th class="col-xs-1" data-field="Make" data-sortable="true">Images</th>
                    <th class="col-xs-1" data-field="Model" data-sortable="true"></th>
                    <!--<th class="col-xs-1" data-field="Color" data-sortable="true">Lead Source</th>-->
                </tr>
            </thead>
            <tbody>  
        <?php 
        $data["method"] = "MasterVendor";
        $data['id'] = $_REQUEST['vnd_id'];
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response,true);//var_dump($result_data);
        //print_r($result_data);
        $count = 0;
        foreach($result_data as $results){
        foreach($results as $key =>$result ){
        
            //print_r($result['vndname']);?>
            <tr id="tr-id-<?php echo $count; ?>  class="tr-class-2">
            <td><?php echo $_REQUEST['name'];?></td>
            <td><?php echo $result['name'];?></td>
            <td><?php
                                $images_list = '';
                                //$images = explode(' ', $result['images']);
                                $images = explode(',',$result['images']);//print_r($images);echo 'images';
                                foreach ($images as $img) {
                                    if (file_exists("vehicles/" . $img) && !empty($img)) {
                                        $images_list .= '<img src="vehicles/' . $img . '" width="50" height="50" style="padding:7px; display: inline-block; float: left;" />';
                                    }
                                }
                                if ($images_list != '') {
                                    ?>
                                    <!--<a class="show_popup_bal" id="image_<?php echo $count; ?>">VIEW</a>
                                    <div class="popup_bal" id="popup_image_<?php echo $count; ?>">
                                        <div style="width: 214px;">
                                            <div class="PopupCloseButton">X</div>-->
                                            <?php echo $images_list; ?>
                                       <!-- </div>
                                    </div>-->
                                    <?php
                                }
                                ?>
                            </td>
                            <td><a href="http://vendor.unlimitedcharters.com/vimages.php?vehicle=<?php echo $key?>">Edit</a></td>
                            </tr>
            <?php $count++;}
            
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