<?php 
$page = 'vimage';
require_once './config.php';
$data = $_POST; 
//echo $_REQUEST['vehicle'];
        if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])){
            $data["id"] = trim($_REQUEST['vehicle']);
       
        $data["method"] = "FetchVehicleImages";
        $curl = curl_init($crm_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response, true);
      // print_r($result_data['vehicle_images']);
       $vimages = explode(',',$result_data['vehicle_images']);
        }
        else{
            die();
        }

require './header.php';
?>
<div class="ipt-eform-content ">
    <form id="form" action="updateimages.php"  method="post" enctype="multipart/form-data">
 <div id="images" class="content" style="display: block;">
                    <div id="ipt_fsqm_form_52_layout_5_inner" class="ipt-eform-layout-wrapper">
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_main_heading_column">
                            <div class="ipt_uif_column_inner">
                                <h3 class="ipt_fsqm_main_heading ipt_uif_heading ipt_uif_divider ipt_uif_align_left ipt_uif_divider_no_icon ipt_uif_divider_icon_no_bg">
                                    <span class="ipt_uif_divider_text"> <span class="ipt_uif_divider_text_inner"> PHOTOS</span> </span>
                                </h3>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional">
                            <div class="ipt_uif_column_inner side_margin">
                                <p>
                                    <em>Please include at least <strong>one exterior &amp; one interior photo</strong> of this vehicle.</em>
                                </p>
                                <div class="clear-both">
                                </div>
                            </div>
                        </div>
                        <div class="ipt_uif_column ipt_uif_column_full ipt_uif_conditional ipt_fsqm_container_upload" id="ipt_fsqm_form_52_freetype_15">
                            <div class="ipt_uif_column_inner side_margin">
                                <div class="ipt_uif_container ipt_uif_iconbox" data-opened="1">
                                    <div class="ipt_uif_container_head">
                                        <h3> <i title="" class="ipticm prefix" data-ipt-icomoon="&#xe002;">
                                            </i> <span class="ipt_uif_container_label">Upload Vehicle Photos</span>
                                        </h3>
                                    </div>
                                    <div class="ipt_uif_container_inner" id="append_images">
                                        <?php
                                        $countr = 0;
                                        foreach ($vimages as $img) {
                                            if (file_exists("vehicles/" . $img) && !empty($img)) {
                                                ?>
                                        <div class="image-container" id="img_<?php echo $img; ?>" style="max-width:24%;float:left;display:inline-block;margin-right:5px;">
                                            <input type="hidden" name="uploaded_images[]" id="uploaded_<?php echo $img; ?>" value="<?php echo $img; ?>">
                                            <img src="vehicles/<?php echo $img; ?>" style="max-width:100%;"/>
                                            <a class="image-view" href="vehicles/<?php echo $img; ?>" title="View Image in Full screen" target="_blank">View Full</a>
                                            <button class="image-remove" onclick="return remove_image(event, '<?php echo $img; ?>');">Remove</button>
                                        </div>
                                        <?php
                                                $countr++;
                                                if ($countr % 3 == 0)
                                                    echo '<div class="clear-both"></div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="clear-both"></div>
                                    <div class="ipt_uif_container_inner" id="drop_zone">
                                        <div class="ipt_uif_uploader" data-settings="" data-configuration="" data-formdata="">
                                            <div class="fileinput-dragdrop ui-state-active"> <span>Drag 'n Drop files here</span>
                                            </div>
                                            <div class="ipt_fsqm_fileuploader_list_wrap">
                                                <table role="presentation" class="ipt_fsqm_fileuploader_list">
                                                    <thead>
                                                        <tr>
                                                            <td>
                                                                <div class="fileupload-buttonbar">
                                                                    <div class="fileupload-buttons">
                                                                        <span class="fileinput-button secondary-button large ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button" style="padding: 15px 5px; width: 100%;">
                                                                            <span class="ui-button-text"> <span class="select secondary-button">Select Images</span></span>
                                                                            <input class="ipt_uif_uploader_handle" multiple="multiple" name="vehicle_images[]" id="vehicle_images" accept="image/x-png,image/gif,image/jpeg" type="file">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="files"></tbody>
                                                </table>
                                            </div>
                                            <div class="fileupload-meta">
                                                <p>Max file size: 2 MB. | Allowed file types: gif,jpeg,png,jpg | Max number of files: 6 | Min number of file: 1</p>
                                            </div>
                                            <input type="hidden" value="<?php echo $_REQUEST['vehicle']; ?>" name="vehicle">
                                            <input type="submit" name="uploadimages" value="Update"  style="background:blue;font-size:18px; color:#ffffff;padding:5px 10px;">
                                            
                                           
                                           
                                        </div>
                                        <div class="clear-both"></div> 
                                        <br>
                                       <?php $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);
	
	if (!empty($referer)) {
		
		echo '<p><a href="'. $referer .'" title="Return to the previous page" style="background:blue;font-size:18px; color:#ffffff;padding:5px 10px;">&laquo; Go back</a></p>';
		
	} else {
		
		echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
		
	}
?>
                                    </div>
                                </div>
                                <div class="clear-both"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-both"></div>
                </div>
                <script>
jQuery(document).ready(function($) {
    document.getElementById('vehicle_images').addEventListener('change', preview_images_upload, false);
    document.getElementById('drop_zone').addEventListener('dragover', handleDragOver, false);
    document.getElementById('drop_zone').addEventListener('drop', preview_images_upload, false);
});

        jQuery(window).load(function () {
            
            jQuery("#form").on('submit',(function(e) {
                if (confirm('Are you sure you want to update this Vehicle?')) {
              e.preventDefault();
              jQuery.ajax({
                     url: "updateimages.php",
               type: "POST",
               data:  new FormData(this), 
                contentType: false,
                cache: false,
                processData:false,
               success: function(data) {
                        alert(data);
                       // jQuery(this).closest('tr').fadeOut();
                        //play with data
                      }
                    });
                }
            }));
            
            jQuery('.vupdatebtn').click(function(){
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
            var images = jQuery('input[name="uploaded_images[]"]').map(function(){ 
                    return this.value; 
                }).get();
            //var images =  document.getElementsByName('uploaded_images[]'); //
            
            alert(images);
            /*for (var i = 0; i < images.length; i++) { 
                var a = images[i]; 
               alert( a.value ); 
            } */
            if (confirm('Are you sure you want to update this Vehicle?')) {
                    //jQuery(this).closest('tr').fadeOut();                    
                    jQuery.ajax({
                      url: 'updateimages.php?vehicle='+vid+'&images='+images,
                      type: 'UPDATE',
                      success: function(data) {
                        alert(data);
                       // jQuery(this).closest('tr').fadeOut();
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





    function preview_images_upload(evt) {
    if (evt.type === 'change') {
        var files = evt.target.files;
    } else if (evt.type === 'drop') {
        var files = evt.dataTransfer.files;
        evt.stopPropagation();
        evt.preventDefault();
    } else {
        evt.preventDefault();
        return false;
    }
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {
            continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                var span = document.createElement('span');
                span.innerHTML = [
                    '<div class="image-container" id="img_' + escape(theFile.name) + '"  style="max-width:24%;float:left;display:inline-block;margin-right:5px;">' +
                    '<input type="hidden" name="uploaded_images[]" id="uploaded_' + escape(theFile.name) + '" value="' + escape(theFile.name) + '">' +
                    '<img src="' + e.target.result + '" title="' + escape(theFile.name) + '" style="max-width:100%;">' +
                    '<button class="image-remove" onclick="return remove_image(event, \'' + escape(theFile.name) + '\');">Remove</button>'
                ].join('');

                jQuery('#append_images').append(span);
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

function handleDragOver(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
}




    </script>
    </div>
                
                <?php require './footer.php';?>