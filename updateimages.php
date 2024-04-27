<?php
$page = 'updateimages';
//require_once './config.php';
//require_once './session.php';


$counter = 0;
 $vehicle_images = array();
        $errors_images = array();
        $uploadedFiles = array();
        $extension = array("jpeg", "jpg", "png", "gif");
        $bytes = 1024;
        $KB = 2048;
        $totalBytes = $bytes * $KB;
        $UploadFolder = "vehicles";
        foreach ($_POST['uploaded_images'] as $img) {
            if (!empty($img)) {
                if (strpos($img, 'removed_') !== false) {
                    $img_name = str_replace('removed_', '', $img);
                    unlink($UploadFolder . "/" . $img_name);
                } else {
                    if (file_exists($UploadFolder . "/" . $img) == true) {
                        $vehicle_images[] = $img;
                        $counter++;
                    }
                }
            }
        }

        foreach ($_FILES["vehicle_images"]["tmp_name"] as $key => $tmp_name) {

            if ($counter >= 6)
                break;
            $temp = $_FILES["vehicle_images"]["tmp_name"][$key];
            $name_display = $_FILES["vehicle_images"]["name"][$key];
            if (empty($temp))
                break;
            $counter++;
            $UploadOk = true;
            if ($_FILES["vehicle_images"]["size"][$key] > $totalBytes) {
                $UploadOk = false;
                array_push($errors_images, $name_display . " file size is larger than the 2 MB.");
            }
            $ext = pathinfo($name_display, PATHINFO_EXTENSION);
            $name = md5($_FILES["vehicle_images"]["name"][$key] . '_' . date('Y-m-d h:i:s')) . '.' . $ext;
            
            if (file_exists($UploadFolder . "/" . $name) == true) {
                $UploadOk = false;
                array_push($errors_images, $name_display . " file is already exist.");
            }
            //echo $name;
            if ($UploadOk == true) {
                move_uploaded_file($temp, $UploadFolder . "/" . $name);
                $uploadedFiles[$name] = $name_display;
                $vehicle_images[] = $name;
            }
        }
        
$crm_url = 'https://unlimitedcharters.com/betacrm/index.php?entryPoint=VendorSystem';
if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle'])) {
    $data = array();
    //if (isset($_REQUEST['vehicle']) && !empty($_REQUEST['vehicle']))
    $data["id"] = trim($_REQUEST['vehicle']);
    //$data['images'] = $_REQUEST['images'];
    $data["vehicle_images"] = implode(",", $vehicle_images);
    $data["method"] = "UpdateImages";
    $curl = curl_init($crm_url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    $result_data = json_decode($response, true);
    //print_r($result_data);
    if (isset($result_data) && $result_data == 1) {
       // unset($_SESSION['VNDR']['VEHICLES'][$data["id"]]);
       // header("Location:dashboard.php");
       // return $result_data['CURL_RESULT'];
       echo 'Images updated';
    }else{
        echo 'Failed to update vehicle. Try again later or contact Administrator.';
    }
}