
<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

if(!isset($_REQUEST['lead_id']) || !isset($_REQUEST['vendor_id'])) {
	echo "Request not valid";
	die;
}

if(empty($_REQUEST['lead_id']) || empty($_REQUEST['vendor_id'])) {
	echo "Request not valid";
	die;
}

$lead = BeanFactory::getBean('Leads', $_REQUEST['lead_id']);

if($lead->id == '') {
	echo "Lead not valid";
	die;
}
$vendor = BeanFactory::getBean('VND_Vendors', $_REQUEST['vendor_id']);

if($vendor->id == '') {
	echo "Vendor not valid";
	die;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Vendor Quote Pricing</title>
        <!-- Bootstrap core CSS -->
        <link href="custom/css/bootstrap.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template -->
        <link href="pricing.css" rel="stylesheet">
        <style type=text/css>
        
        div .vqf {
            font-size: 18px;
            text-align:left;
        }
        div .vqf input, div .vqf textarea{
            width: 100%;
            height: 40px;
            margin-bottom: .5rem;
        }
        div .vqf textarea{
            height: 75px;
        }
              label {
  display:inline;
  font-weight:bold;
  text-align: right;
  }
    </style>
    </head>
    <body>
        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <p class="h5 my-0 me-md-auto fw-normal">Unlimited Charters - Vendor Quote</p>
            <nav class="my-2 my-md-0 me-md-3">
                <a class="p-2 text-dark" href="tel:855.943.1466">Call Us</a>
                <a class="p-2 text-dark" href="mailto:quotes@unlimitedcharters.com">Support</a>
            </nav>
            <a class="btn btn-light btn-outline-info text-black-50" href="https://unlimitedcharters.com/vendor">Affiliate Vendor Login</a>
        </header>
        <main class="container">
            <div class="container">
                <img src="custom/logo.png" style="display:grid;grid-template-columns:1fr 1fr 1fr;grid-template-rows:100px;" class="img-responsive center-block d-block mx-auto">
            </div>
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-4 text-dark"><b>Vendor Quote Request</b></h1>
                <p class="lead text-info"><b class="text-info">Please reply to this with the quote pricing and any other info we may need. Be sure to include all <span style="color:red">FUEL, MILEAGE, and GRATUITY</span> in this quote. A total, all in trip cost is preferable.</b></p>
            </div>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <div class="col col-lg-12">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 fw-normal">Estimated Itinerary:</h4>
                        </div>
                        <div class="card-body">
<form action="index.php?entryPoint=save_vendor_quote" method="post">
 <div class="row row-cols-2">
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Event Date:</label></div>
  <div class="vqf col-md-9 col-sm-6">
   
    <?php echo $lead->eventdate_c;?>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Event Type:</label></div>
  <div class="vqf col-md-9 col-sm-6">
   
    <?php echo $lead->event_c;?>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Hours:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->servicelength_c;?>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Pick Up Time:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->pickuptime_c;?>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Passenger count :</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->numberofpassengers_c;?>
</div>
<div class="vqf col-md-3 col-sm-6">
    <label>&nbsp;</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <label>&nbsp;</label>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Pickup Location:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->pickuplocation_c;?>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Destination:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->location_c;?>
    </div>
    <div class="vqf col-md-3 col-sm-6">
    <label>&nbsp;</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <label>&nbsp;</label>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Client Notes:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $lead->clientnotes_c;?>
</div>
<div class="vqf col-md-3 col-sm-6">
    <label>&nbsp;</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <label>&nbsp;</label>
</div>

<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Vendor Name:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $vendor->name;?>
</div>

<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Vendor Email:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo $vendor->email1;?>
</div>

<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Vendor Phone:</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <?php echo (empty($vendor->phone_alternate)) ? $vendor->phone_office : $vendor->phone_alternate;?>
</div>
<div class="vqf col-md-3 col-sm-6">
    <label>&nbsp;</label></div>
  <div class="vqf col-md-9 col-sm-6">
    <label>&nbsp;</label>
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Vehicle:</label></div>
  <div class="vqf col-md-9 col-sm-6">
 
    <input type="text" name="vehicle_c" id="vehicle_c">
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Quoted Price ($):</label></div>
  <div class="vqf col-md-9 col-sm-6">
      <span style="position: absolute; margin-left: 1px; margin-top: 6px;">$</span>
    <input type="number" name="quoted_price_c" id="quoted_price_c" style="padding-left: 8px;"  min="100" step="0.01" required> 
    <input type="hidden" name="lead_id" value="<?php echo $_REQUEST['lead_id'];?>">
    <input type="hidden" name="vendor_id" value="<?php echo $_REQUEST['vendor_id'];?>">
    
</div>
<div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Vendor Notes:</label></div>
  <div class="vqf col-md-9 col-sm-6">
 
    <textarea type="text" name="vendor_notes_c" id="vendor_notes_c"></textarea>
</div>
<!-- <div class="vqf col-md-3 col-sm-6" style="text-align:right;">
    <label>Prioritized:</label></div>
  <div class="col-md-3 col-sm-6" style="text-align: left;">
    <input type="checkbox" name="prioritize_c" id="prioritize_c" style="width: 30px;height: 30px;">
</div> -->
<!--<input type="text" id="salary" name="salary"
    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />-->
    
<br/ >
<br/ >
 <button type="submit" class="btn btn-info btn-lg w-100">Submit</button>
</form>
 </div>
  </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="custom/js/popper.min.js"></script>
        <script src="custom/js/bootstrap.min.js"></script>
    </body>
</html>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
    // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}


// // Install input filters.
// setInputFilter(document.getElementById("intTextBox"), function(value) {
//   return /^-?\d*$/.test(value); });
// setInputFilter(document.getElementById("uintTextBox"), function(value) {
//   return /^\d*$/.test(value); });
// setInputFilter(document.getElementById("quoted_price_c"), function(value) {
// return /^\d*$/.test(value) && (parseInt(value) => 99 || parseInt(value) <= 500); });
// setInputFilter(document.getElementById("floatTextBox"), function(value) {
//   return /^-?\d*[.,]?\d*$/.test(value); });
 setInputFilter(document.getElementById("quoted_price_c"), function(value) {
   return /^-?\d*[.,]?\d{0,2}$/.test(value); });
// setInputFilter(document.getElementById("latinTextBox"), function(value) {
//   return /^[a-z]*$/i.test(value); });
// setInputFilter(document.getElementById("hexTextBox"), function(value) {
//   return /^[0-9a-f]*$/i.test(value); });

// $(document).ready(function() {
//     $('#prioritize_c').change(function() {
//       if ($(this).is(':checked')){
//         if (confirm("Are you sure you want to prioritize it?")) {
//             $(this).prop('checked', true);
//         } else {
//             $(this).prop('checked', false);
//         }
//       }
//     });
//   });
</script>