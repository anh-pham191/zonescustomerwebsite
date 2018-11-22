<?php
// Ubiquity form: 0002 Zones Brochure/Voucher Request

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-enq-firstname']));
$lastname = trim(addslashes($_POST['p-enq-lastname']));
$email = trim($_POST['p-enq-email']);
$phone = trim(addslashes($_POST['p-enq-tel']));
$privacy = trim($_POST['p-enq-privacy']);
$subscribe = trim($_POST['p-enq-subscribe']);
$voucherID = trim(htmlentities($_POST['p-enq-voucher']));
$frompage = trim(addslashes($_POST['frompage']));
if (isset($_COOKIE['fromcampaign'])) {
    $campaign = trim($_COOKIE['fromcampaign']);
} else {
    $campaign = "N/A";
};
if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="google") {
    $source = "Google AdWords";
} else if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="bing") {
    $source = "Bing";
} else if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="facebook"){
    $source = "Facebook";
} else {
    $source = "Zones Consumer Website";
};
// If Privacy not checked
if ($privacy == "on") {
	$privacy = "True";
	}
else {
	$goodtogo = "no";
	echo "NoPrivacy";
}
// Set up Opted out value
if ($subscribe == "on") {
	$subscribe = "False"; // Has not opted out
	}
else {
	$subscribe = "True";
	}

$url = "https://api.ubiquity.co.nz/forms/S6aFOhjx2USWjwjRB0gyhw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"dSBLChuglUCb_AjRB0gynw\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"dCDxXIByg0m7tgjRB0gynw\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"Wu1l_rCw10e5-QjRB0gynw\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"sT4KRgtFZ0OUzgjRB0gynw\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"S_KeYLdxB0mOEgjRB0gynw\",
      \"value\": \"$voucherID\"
    },
	{
      \"fieldID\": \"QXcUlYGbPkqBiQjRB0gynw\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"HoBQFBNxVkaxmQjRB0gynw\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"zWANgPdNc0ahOAjRB0gynw\",
      \"value\": \"$subscribe\"
    },
    {
      \"fieldID\": \"QenlU7hoG0qywAjT7r9qOQ\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"E9NrAcYfAkKSvwjUtNCB5Q\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"4u4-pQNzOUeYmAjTALbirQ\",
      \"value\": \"$campaign\"
    }
  ],
  \"source\": \"0002 Zones Brochure/Voucher Request\"
}";

// perform the curl transaction if preftime and privacy were set
if ($goodtogo != "no" && !preg_match('/\d+/',$firstname) && !preg_match('/\d+/',$lastname)) {
	$ch = curl_init();
	}
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

// echo $response;

if (in_array("FailedValidation", $decodedArray)) {
    echo "Your form submission was Invalid. Please go back and try again.";
}
elseif ((in_array("UpdatedRow", $decodedArray)) || (in_array("AppendedRow", $decodedArray))) {
	echo "Successful";
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones Brochure/Voucher Request - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand"."\n\n"."Voucher: ".$voucherID."\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
?>