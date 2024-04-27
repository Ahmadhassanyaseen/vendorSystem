<?php
$page = 'getvendors';
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
//require_once './session.php';
$limit = '5';
$page = 1;
$total = 1;
$output='';
   // if($_SESSION['VNDR']['email1'] == "shmai.com@gmail.com"){ ?>
     <?php
    $data["method"] = "MasterVendorGetVendor";
    $data['vname']=$_REQUEST['query'];
        $curl = curl_init($crm_url);
        
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        $result_data = json_decode($response,true);//var_dump($result_data);
        //print_r($result_data); <th>ID</th>
        $output .=   ' <table data-toggle="table" data-classes="table table-hover table-condensed" data-striped="true" data-sort-name="DateEntered" data-sort-order="desc" data-pagination="true">
            <thead>
                <tr>
                    <th class="col-xs-1" data-field="vname" data-sortable="true"> Name</th>
                   
                </tr>
            </thead>
            <tbody>';
        foreach($result_data as $results){//print_r( $results);
        foreach($results as $key =>$result ){$totla++;
            $vendorlink = '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id='.$key.'&name='.$result.'">'.$result.'</a>';
            $output .= '<tr id="tr-id-tr-class-2">
      <td>'.$vendorlink.'</td>
    </tr>';
           // echo '<a href="http://vendor.unlimitedcharters.com/vndvehicles.php?vnd_id='.$key.'&name='.$result.'">'.$result.'</a>';
        }}
        $output .= '</table>';



echo $output;

    ?>
    
    <?php //}?>