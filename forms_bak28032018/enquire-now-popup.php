<?php
// Ubiquity form: 0002 Enquire Now popup eg Enquire now buttons on homepage

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

$url = "https://api.ubiquity.co.nz/forms/iBfQAGvM9kudRAjRBzhHDg/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"BhT8w-2_40-uxgjRBzhHOA\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"MAOgvsICo06DBQjRBzhHOA\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"29__YSgB9kWAQgjRBzhHOA\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"PFbwW7aZHEmK7wjRBzhHOA\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"E15B4fFrVEeFTAjRBzhHOA\",
      \"value\": \"$preftime\"
    },
	{
      \"fieldID\": \"6D3fRbb1wEOy_QjRBzhHOA\",
      \"value\": \"$subject\"
    },
	{
      \"fieldID\": \"Tl-b0Q5J00qgUQjRBzhHOA\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"vl6wzQDBaE2hIgjSruAcpg\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"Nglhp_qv8U2W-gjRBzhHOA\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"aFZs-Fed60uHPgjRBzhHOA\",
      \"value\": \"$subscribe\"
    },
    {
      \"fieldID\": \"uaKPu0Io5ky_3wjT7r7jWw\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"Xifzy0NQxEigDAjUtM5LjA\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"0_p7nUy9fESFMgjTALZPMA\",
      \"value\": \"$campaign\"
    },
    {
        \"fieldID\": \"t59G-lXbVUe6FwjVMnjFqg\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 Enquire Now popup eg Enquire now buttons on homepage\"
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
	$emailsubject = "Submission from 0002 Zones Enquire Now popup eg Enquire now buttons - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy: ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
?>