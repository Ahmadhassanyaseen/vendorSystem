<div class="me-auto ms-auto mb-5 allVehicles w-100">
    <div class="text-center" style="width: 100%; padding: 0; float: left; border: 1px solid #ddd; border-top: none; box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12)">
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
                    <th class="col-xs-2" data-field="Action">Actions</th>
                    <th class="col-xs-1" data-field="Photos">Photos</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['VNDR']['VEHICLES'])) { //print_r($_SESSION['VNDR']['email1']);
                    $count = 0;
                    foreach ($_SESSION['VNDR']['VEHICLES'] as $vindx => $vData) {
                ?> <?php if (!empty($vData['name'])) : ?>
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
                                            <span><strong>Base Hourly: </strong>$<?php echo $vData['base_hourly_rate']; ?></span><br />
                                            <span><strong>Minimum Hours: </strong><?php echo number_format($vData['base_min_hours'], 0, '.', ','); ?> hour(s)</span><br />
                                            <span><strong>Additional Hourly: </strong>$<?php echo $vData['base_additional_hourly']; ?></span><br />
                                            <span><strong>Fuel Surcharge: </strong><?php echo $vData['fuel_surcharge_percentage']; ?>%</span><br />
                                            <span><strong>Driver Gratuity: </strong><?php echo $vData['driver_gratuity_percentage']; ?>%</span><br />
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $vData['vehicle_quantity']; ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle xenoDd" type="button" data-toggle="dropdown" onclick="">EDIT<span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="addVehical.php?vehicle=<?php echo $vData['id']; ?>" title="Edit <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center;">EDIT</a></li>
                                            <li><a class="vdeletebtn" href="#" title="Delete <?php echo $vData['name']; ?>" style="margin: 0 auto; display: inline-block; text-align: center; color: red;" data-id="<?php echo $vData['id']; ?>">DELETE</a></li>
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
                                        <a class="show_popup_bal" id="image_<?php echo $count; ?>">

                                            VIEW

                                        </a>
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
</div>