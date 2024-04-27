<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');



if(isset($_REQUEST['name'])) {
$name = $_REQUEST['name'];
}
if(isset($_REQUEST['website'])) {
$website = $_REQUEST['website'];
}
if(isset($_REQUEST['email1'])) {
$email1 = $_REQUEST['email1'];
}
if(isset($_REQUEST['phone_alternate'])) {
$phone_alternate = $_REQUEST['phone_alternate'];
}
if(isset($_REQUEST['service_radius'])) {
$service_radius = $_REQUEST['service_radius'];
}
if(isset($_REQUEST['vnd_vendors_type'])) {
$vnd_vendors_type = $_REQUEST['vnd_vendors_type'];
}
if(isset($_REQUEST['status'])) {
$status = $_REQUEST['status'];
}
if(isset($_REQUEST['billing_address_street'])) {
$billing_address_street = $_REQUEST['billing_address_street'];
}
if(isset($_REQUEST['billing_address_city'])) {
$billing_address_city = $_REQUEST['billing_address_city'];
}
if(isset($_REQUEST['billing_address_state'])) {
$billing_address_state = $_REQUEST['billing_address_state'];
}
if(isset($_REQUEST['billing_address_postalcode'])) {
$billing_address_postalcode = $_REQUEST['billing_address_postalcode'];
}
if(isset($_REQUEST['billing_address_country'])) {
$billing_address_country = $_REQUEST['billing_address_country'];
}
if(isset($_REQUEST['address_lat_c'])) {
$address_lat_c = $_REQUEST['address_lat_c'];
}
if(isset($_REQUEST['address_lng_c'])) {
$address_lng_c = $_REQUEST['address_lng_c'];
}

$vend_id = '';
if(isset($_REQUEST['vend_id'])) {
	if(!empty($_REQUEST['vend_id'])) {
		$vend_id = $_REQUEST['vend_id'];
	}
}

if(!empty($vend_id)) {
	$bean = BeanFactory::getbean('VND_Vendors',$vend_id);
} else {
	$bean = BeanFactory::newBean('VND_Vendors');
}
$bean->name = $name;
$bean->website = $website;
$bean->email1 = $email1;
$bean->phone_alternate = $phone_alternate;
$bean->service_radius = $service_radius;
$bean->vnd_vendors_type = $vnd_vendors_type;
$bean->status = $status;
$bean->billing_address_street = $billing_address_street;
$bean->billing_address_city = $billing_address_city;
$bean->billing_address_state = $billing_address_state;
$bean->billing_address_postalcode = $billing_address_postalcode;
$bean->billing_address_country = $billing_address_country;
$bean->address_lat_c = $address_lat_c;
$bean->address_lng_c = $address_lng_c;
$bean->save();

echo '1';