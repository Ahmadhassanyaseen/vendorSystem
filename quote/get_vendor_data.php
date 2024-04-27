<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

if(!isset($_REQUEST['vendor_id'])) {
	echo "Request not valid";
	die;
}

$vendor = BeanFactory::getBean('VND_Vendors', $_REQUEST['vendor_id']);

$result = array();


$result['vend_id'] = $vendor->id;
$result['name'] = $vendor->name;
$result['website'] = $vendor->website;
$result['email1'] = $vendor->email1;
$result['phone_alternate'] = $vendor->phone_alternate;
$result['service_radius'] = $vendor->service_radius;
$result['vnd_vendors_type'] = $vendor->vnd_vendors_type;
$result['status'] = $vendor->status;
$result['billing_address_street'] = $vendor->billing_address_street;
$result['billing_address_city'] = $vendor->billing_address_city;
$result['billing_address_state'] = $vendor->billing_address_state;
$result['billing_address_postalcode'] = $vendor->billing_address_postalcode;
$result['billing_address_country'] = $vendor->billing_address_country;
$result['address_lat_c'] = $vendor->address_lat_c;
$result['address_lng_c'] = $vendor->address_lng_c;

echo json_encode($result);