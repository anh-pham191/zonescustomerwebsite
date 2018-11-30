<?php
// Ubiquity form: 0002 Zones - Right hand side get in touch stage 2

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['ep-enq-firstname']));
$email = trim($_POST['ep-enq-email']);
$enquiry = trim(addslashes($_POST['ep-enq-enquiry']));
$phone = trim(addslashes($_POST['ep-enq-tel']));
$lastname = trim(addslashes($_POST['ep-enq-lastname']));
$streetaddress = trim(addslashes($_POST['ep-enq-address']));
$suburb = trim(addslashes($_POST['ep-enq-suburb']));
$city = trim(addslashes($_POST['ep-enq-city']));
$postcode = trim(addslashes($_POST['ep-enq-postcode']));
$budget = trim(addslashes($_POST['ep-enq-budget']));
$renotype = $_POST['ep-enq-reno'];
$frompage = trim(addslashes($_POST['frompage']));
$renotypes = "";
if (!(empty($renotype))) {
$N = count($renotype);
// First one with no leading semicolon
$renotypes = $renotype[0];
// Add the rest with semicolons
for($i=1; $i < $N; $i++)
    {
      $renotypes = $renotypes . "; " . $renotype[$i];
    }
}
if (isset($_COOKIE['fromcampaign'])) {
    $campaign = trim($_COOKIE['fromcampaign']);
} else {
    $campaign = "N/A";
};
if (isset($_COOKIE['fromsource'])){
    if ($_COOKIE['fromsource']=="google") {
        $source = "Google AdWords";
    } else if ($_COOKIE['fromsource']=="bing") {
        $source = "Bing";
    } else if ($_COOKIE['fromsource']=="facebook") {
        $source = "Facebook";
    } else if ($_COOKIE['fromsource']=="LinkedIn") {
        $source = "LinkedIn";
    } else if ($_COOKIE['fromsource']=="Social Media Post") {
        $source = "Social Media";
    } else if ($_COOKIE['fromsource']=="Mailout") {
        $source = "Mailout";
    } else if ($_COOKIE['fromsource']=="Local Print Media") {
        $source = "Local Print Media";
    } else if ($_COOKIE['fromsource']=="banner") {
        $source = "Banner";
    } else if ($_COOKIE['fromsource']=="local digital") {
        $source = "Local Digital Campaign";
    } else if ($_COOKIE['fromsource']=="instagram") {
        $source = "Instagram";
    } else if ($_COOKIE['fromsource']=="twitter") {
        $source = "Twitter";
    } else if ($_COOKIE['fromsource']=="pinterest") {
        $source = "Pinterest";
    } else if ($_COOKIE['fromsource']=="renovate") {
        $source = "Renovate Website";
    } else if ($_COOKIE['fromsource']=="promotions") {
        $source = "Competitions";
    } else if ($_COOKIE['fromsource']=="Friend") {
        $source = "Friend Referral";
    } else if ($_COOKIE['fromsource']=="Customer") {
        $source = "Customer Referral";
    } else if ($_COOKIE['fromsource']=="Repeat") {
        $source = "Customer repeat work";
    } else if ($_COOKIE['fromsource']=="Trade") {
        $source = "Trade Referral";
    } else if ($_COOKIE['fromsource']=="Designer") {
        $source = "Designer Referral";
    } else if ($_COOKIE['fromsource']=="Distributor") {
        $source = "Distributor Referral";
    } else if ($_COOKIE['fromsource']=="site sign") {
        $source = "Site Sign";
    } else if ($_COOKIE['fromsource']=="tv") {
        $source = "TV";
    } else if ($_COOKIE['fromsource']=="radio") {
        $source = "Radio";
    } else if ($_COOKIE['fromsource']=="vehicle") {
        $source = "Branded Vehicle";
    } else if ($_COOKIE['fromsource']=="event") {
        $source = "Local Event";
    } else if ($_COOKIE['fromsource']=="network") {
        $source = "Network";
    } else if ($_COOKIE['fromsource']=="outdoor") {
        $source = "Outdoor";
    } else if ($_COOKIE['fromsource']=="sponsorship") {
        $source = "Sponsorship";
    } else if ($_COOKIE['fromsource']=="leaflet") {
        $source = "Letter Box Drop";
    } else if ($_COOKIE['fromsource']=="merchandise") {
        $source = "Branded merchandise";
    } else if ($_COOKIE['fromsource']=="walk in") {
        $source = "Local Office";
    } else if ($_COOKIE['fromsource']=="permanent expo") {
        $source = "Permanent Exhibition Centre";
    } else if ($_COOKIE['fromsource']=="home show") {
        $source = "Home Show";
    } else if ($_COOKIE['fromsource']=="seminar") {
        $source = "Seminars";
    } else{
        $source = "Zones Consumer Website";
    }
}else{
    $source = "Zones Consumer Website";
};
$url = "https://api.ubiquity.co.nz/forms/BChbkuXtsUmI3QjRB0Fn_w/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

// Note privacy set to True below - to retain user acceptance from stage 1 form

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"A2cHFUTcUkK04AjRB0FoLQ\",
      \"value\": \"$firstname\"
    },
    {
      \"fieldID\": \"pPL9Dc30i0y0hQjRB0FoLQ\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"a18a1Q5ZaUmDfQjRB0FoLQ\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"Rrm1lnVM3EOe2QjRB0FoLQ\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"suEcn2Oc5USbdgjRB0FoLQ\",
      \"value\": \"$lastname\"
    },
	{
      \"fieldID\": \"GU6hLzcVPk6Y0AjRB0FoLQ\",
      \"value\": \"$streetaddress\"
    },
	{
      \"fieldID\": \"Odz95ZFBe0WIIwjRB0FoLQ\",
      \"value\": \"$suburb\"
    },
	{
      \"fieldID\": \"Jg-PSPT_ekKHRgjRB0FoLQ\",
      \"value\": \"$city\"
    },
	{
      \"fieldID\": \"nODEl9LznEexiwjRB0FoLQ\",
      \"value\": \"$postcode\"
    },
	{
      \"fieldID\": \"jnV6hgEoN0ig9gjRB0FoLQ\",
      \"value\": \"$budget\"
    },
	{
      \"fieldID\": \"4EBKVNvL7EyVlAjRB0FoLQ\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"lGrb_C8MAE6lzgjRB0FoLQ\",
      \"value\": \"True\"
    },
	{
      \"fieldID\": \"XqSCXwW7VUSFhQjRB0FoLQ\",
      \"value\": \"$renotypes\"
    },
  {
      \"fieldID\": \"A1jzBUutSE6--gjUtNAurA\",
      \"value\": \"$source\"
    },
  {
      \"fieldID\": \"HXK9FuGf2ECi6QjUtNA0dA\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"2dhOSDbXpUi9JQjUtNAyAQ\",
      \"value\": \"$campaign\"
    },
    {
        \"fieldID\": \"_DRLbrRqikWlAQjVMniEyQ\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 Zones - Right hand side get in touch stage 2\"
}";

// perform the curl transaction
if(!preg_match('/\d+/',$firstname) && !preg_match('/\d+/',$lastname)){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData))
);

$response = curl_exec($ch);
$decodedArray = json_decode($response,true);

//echo $response;

if (in_array("FailedValidation", $decodedArray)) {
    echo "Your form submission was Invalid. Please go back and try again.";
}
elseif ((in_array("UpdatedRow", $decodedArray)) || (in_array("AppendedRow", $decodedArray))) {
	echo "Successful";
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones Contact - Right hand side get in touch stage 2 - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Street address: ".$streetaddress."\n\n"."Suburb: ".$suburb."\n\n"."City: ".$city."\n\n"."Postcode: ".$postcode."\n\n"."Enquiry: ".$enquiry."\n\n"."Budget: ".$budget."\n\n"."Renovation types: ".$renotypes;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
}
// Remove cookie values and set expiry to past
setcookie("gfirstnamestored","",time()-10, "/");
setcookie("glastnamestored","",time()-10, "/");
setcookie("gemailstored","",time()-10, "/");
setcookie("gphonestored","",time()-10, "/");

?>