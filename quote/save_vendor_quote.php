<?php
// https://unlimitedcharters.com/betacrm/index.php?entryPoint=get_vendor_quote&
// lead_id=68972b47-6c5c-1e56-72d9-65d7a19df291
// &vendor_id=246335eb-7d78-b0d5-17f6-5d35c2ac010b
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
if(!isset($_REQUEST['lead_id']) || !isset($_REQUEST['vendor_id']) || !isset($_REQUEST['quoted_price_c'])){
	echo "Request not valid";
	die;
}
if(empty($_REQUEST['lead_id']) || empty($_REQUEST['vendor_id']) || empty($_REQUEST['quoted_price_c'])){
	echo "Request not valid";
	die;
}

$lead = BeanFactory::getBean('Leads', $_REQUEST['lead_id']);
if($lead->id == ''){
	echo "Lead not valid";
	die;
}
$vendor = BeanFactory::getBean('VND_Vendors', $_REQUEST['vendor_id']);
if($vendor->id == ''){
	echo "Vendor not valid";
	die;
}


$total_trip_cost_c = (int) $lead->total_trip_cost_c;

$bean = BeanFactory::newBean('tnv_VendorQuote');
$bean->name = $vendor->name .' - ' . $lead->name . ' - ' . $lead->pickuptime_c;
$bean->leads_tnv_vendorquote_1leads_ida = $lead->id;
$bean->vnd_vendors_tnv_vendorquote_1vnd_vendors_ida = $vendor->id;
$bean->vendor_email_c = $vendor->email1;
$bean->vendor_phone_c = (empty($vendor->phone_alternate)) ? $vendor->phone_office : $vendor->phone_alternate;
$bean->quoted_price_c = sprintf('%0.2f', $_REQUEST['quoted_price_c']); 
$bean->vehicle_c = $_REQUEST['vehicle_c'];
$bean->vendor_notes_c = $_REQUEST['vendor_notes_c'];
$bean->prioritize_c = $_REQUEST['prioritize_c'];
$bean->save();
if($lead->status != 'Converted') {
	$vendor_quotes_count = 0;
	if ($lead->load_relationship('leads_tnv_vendorquote_1')) {
		$vendor_quotes = $lead->leads_tnv_vendorquote_1->getBeans();
		$vendor_quotes_count = sizeof($vendor_quotes);
		if(!empty($lead->vnd_vendors_id_c) && $vendor_quotes_count==1){
			foreach ($vendor_quotes as $vendor_quote) {
				$gtotal = (int) $total_trip_cost_c - (int) $vendor_quote->quoted_price_c;
				$lead->total_profit_c = $gtotal;
				$lead->vendor_trip_cost_c = (int) $vendor_quote->quoted_price_c;
				$lead->vendor_email_c = $vendor_quote->vendor_email_c;
				$lead->vendor_phone_c = $vendor_quote->vendor_phone_c;
				$lead->processed = true;
				$lead->save();
			}
		}
		elseif(!empty($lead->vnd_vendors_id_c) && $vendor_quotes_count==0){
			$gtotal = (int) $total_trip_cost_c - (int) $vendor_trip_cost_c;
			$lead->total_profit_c = $gtotal;
			$lead->vendor_trip_cost_c = (int) $vendor_trip_cost_c;
			$lead->vendor_email_c = $vendor_email_c;
			$lead->vendor_phone_c = $vendor_phone_c;
			$sql = "UPDATE leads left join leads_cstm on id= id_c set total_profit_c='" . $gtotal . "', vendor_trip_cost_c = '" . $vendor_trip_cost_c . "', vendor_email_c='".$vendor_email_c."', vendor_phone_c='" .$vendor_phone_c. "'  where id = '" . $lead->id . "'";
			$result = $db->query($sql);
		} 
		elseif($vendor_quotes_count > 1){
			$lead_vendor_selection_strategy = $lead->lowest_quote_strategy_c;
			$lowest_quote_id_simple = get_lowest_quote_vendor_id($lead->id); 
			$lowest_quote_id_priortize = get_priortized_lowest_quote_vendor_id($lead->id);
			$lowest_quote_id = (!empty($lowest_quote_id_priortize)) ? $lowest_quote_id_priortize : $lowest_quote_id_simple;
			$lowest_quote = BeanFactory::getBean('tnv_VendorQuote', $lowest_quote_id);
			$gtotal = (int) $total_trip_cost_c - (int) $lowest_quote->quoted_price_c;
			$lead->total_profit_c = $gtotal;
			$lead->vendor_trip_cost_c = (int) $lowest_quote->quoted_price_c;
			$lead->vendor_email_c = $lowest_quote->vendor_email_c;
			$lead->vendor_phone_c = $lowest_quote->vendor_phone_c;
			$lead->vnd_vendors_id_c = $lowest_quote->vnd_vendors_tnv_vendorquote_1vnd_vendors_ida; 
			$lead->processed = true;
			$lead->save(); 
		}else{
			$lead->vendor_trip_cost_c = $_REQUEST['quoted_price_c'];
			$lead->vnd_vendors_id_c = $_REQUEST['vendor_id'];
			$lead->vendor_phone_c = (empty($vendor->phone_alternate)) ? $vendor->phone_office : $vendor->phone_alternate;
			$lead->vendor_email_c = $vendor->email1;
			$lead->save();
		}
	}

}
echo "<h1>Quote Submitted Successfully</h1>";
$user = BeanFactory::getBean('Users', $lead->assigned_user_id);
if(!empty($user->id)) {
	$emailTemp = new EmailTemplate();
	$emailTemp->retrieve("117699cb-f823-f88c-3bac-6238b74507ca");
	$emailTemp->body_html = str_replace("\$lead_opertunityid_c", $lead->opertunityid_c, $emailTemp->body_html);
	$emailTemp->body_html = str_replace("\$lead_id", $lead->id, $emailTemp->body_html);
	$emailTemp->body_html = str_replace("\$lead_link", 'https://unlimitedcharters.com/betacrm/index.php?module=Leads&action=DetailView&record=' . $lead->id, $emailTemp->body_html);
	$emailSubject = str_replace("lead_opertunityid_c", $lead->opertunityid_c, $emailTemp->subject); 
	$emailObj = new Email();
	$defaults = $emailObj->getSystemDefaultEmail();
	$vmail = new SugarPHPMailer();
	$vmail->From = $defaults['email'];
	$vmail->FromName = $defaults['name'];
	$vmail->setMailerForSystem();
	$vmail->ClearAllRecipients();
	$vmail->ClearReplyTos();
	$vmail->Subject = ($emailSubject);
	$vmail->AddAddress($user->email1);
	$vmail->addCC("quotes@unlimitedcharters.com");
	$vmail->Body = $emailTemp->body_html;
	$vmail->AltBody = $emailTemp->body;
	$attachments = array();
	$vmail->handleAttachments($attachments);
	$vmail->prepForOutbound();
	if (@$vmail->Send()){
	    $emailObj->to_addrs = $user->email1;
	    $emailObj->name = $emailSubject;
	   	$emailObj->date_sent = TimeDate::getInstance()->nowDb();
	    $emailObj->description_html = isset($emailBody) ? $emailBody : "";
	    $emailObj->from_addr = $vmail->From;
	    $emailObj->modified_user_id = '1';
	    $emailObj->created_by = '1';
	    $emailObj->status = 'sent';
	    $s = $emailObj->save();
	}
}


function get_lowest_quote_vendor_id($lead_id){
	global $db;
	$sql = "SELECT
				tnv_vendorquote.id,
				tnv_vendorquote_cstm.quoted_price_c
			FROM
				tnv_vendorquote
				INNER JOIN tnv_vendorquote_cstm ON tnv_vendorquote_cstm.id_c = tnv_vendorquote.id 
			WHERE
				tnv_vendorquote.deleted = 0 
				AND tnv_vendorquote.id IN ( SELECT leads_tnv_vendorquote_1_c.leads_tnv_vendorquote_1tnv_vendorquote_idb FROM leads_tnv_vendorquote_1_c WHERE leads_tnv_vendorquote_1_c.leads_tnv_vendorquote_1leads_ida = '{$lead_id}' AND leads_tnv_vendorquote_1_c.deleted = 0 ) 
			ORDER BY
				tnv_vendorquote_cstm.quoted_price_c";
	$result = $db->query($sql);
	$data = array();
	while($row = $db->fetchByAssoc($result)){
		$data[$row['id']] = $row['quoted_price_c'];
	}
	if(empty($data)){
		return "";
	}
	$test = array_keys($data, min($data));
	return $test[0];
}
function get_priortized_lowest_quote_vendor_id($lead_id){
	global $db;
	$sql = "SELECT
				tnv_vendorquote.id,
				tnv_vendorquote_cstm.quoted_price_c
			FROM
				tnv_vendorquote
				INNER JOIN tnv_vendorquote_cstm ON tnv_vendorquote_cstm.id_c = tnv_vendorquote.id 
			WHERE
				tnv_vendorquote.deleted = 0 
				AND tnv_vendorquote_cstm.prioritize_c=1
				AND tnv_vendorquote.id IN ( SELECT leads_tnv_vendorquote_1_c.leads_tnv_vendorquote_1tnv_vendorquote_idb FROM leads_tnv_vendorquote_1_c WHERE leads_tnv_vendorquote_1_c.leads_tnv_vendorquote_1leads_ida = '{$lead_id}' AND leads_tnv_vendorquote_1_c.deleted = 0 ) 
			ORDER BY
				tnv_vendorquote_cstm.quoted_price_c";
	$result = $db->query($sql);
	$data = array();
	while($row = $db->fetchByAssoc($result)){
		$data[$row['id']] = $row['quoted_price_c'];
	}
	if(empty($data)){
		return "";
	}
	$test = array_keys($data, min($data));
	return $test[0];
}