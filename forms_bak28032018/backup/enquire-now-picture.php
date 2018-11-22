<?php
// Ubiquity form: 0002 Enquire Now Lets discuss your project banner eg on Gallery page

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-enq-firstname']));
$lastname = trim(addslashes($_POST['p-enq-lastname']));
$email = trim($_POST['p-enq-email']);
$phone = trim(addslashes($_POST['p-enq-tel']));
$preftime = trim($_POST['p-enq-preftime']);
$privacy = trim($_POST['p-enq-privacy']);
$subscribe = trim($_POST['p-enq-subscribe']);
$subject = trim(addslashes($_POST['p-enq-subject']));
$enquiry = trim(addslashes($_POST['p-enq-enquiry']));
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
// If no preferred time selected
if ($preftime == "") {
	$goodtogo = "no";
	echo "NoPrefTime";
}
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

$url = "https://api.ubiquity.co.nz/forms/tciTQ5SQbkmpeQjRBqc2oA/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"FGTX4OMgMEanLAjRBqc21w\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"svGRmHi2h0-KawjRBqc21w\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"9Qqhxz3KvUiE2AjRBqc21w\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"bvilQgehbEikjwjRBqc21w\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"mTRze1F40kSyagjRBqc21w\",
      \"value\": \"$preftime\"
    },
	{
      \"fieldID\": \"VsAXAfrHmke-GwjRBqc21w\",
      \"value\": \"$subject\"
    },
	{
      \"fieldID\": \"JA9ngDZNiEeW6wjRBqc21w\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"_3J_ufKAXkW86wjSrt-ciA\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"Cvt0UAvEXkuiiAjRBqc21w\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"e2HKH8IPPECtRQjRBqc21w\",
      \"value\": \"$subscribe\"
    },
  {
      \"fieldID\": \"C2EG612NWEmpuwjT7r64sg\",
      \"value\": \"$source\"
    },
	{
      \"fieldID\": \"f7QpB6ogXU-PRQjTALaZ3g\",
      \"value\": \"$campaign\"
    }
  ],
  \"source\": \"0002 Enquire Now Lets discuss your project banner eg on Gallery page\"
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
	$emailsubject = "Submission from 0002 Zones Enquire Now Lets discuss your project banner - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
?>