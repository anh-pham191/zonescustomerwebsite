<?php
// Ubiquity form: 0002 Zones - Career Opportunity

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-car-firstname']));
$lastname = trim(addslashes($_POST['p-car-lastname']));
$email = trim($_POST['p-car-email']);
$phone = trim(addslashes($_POST['p-car-tel']));
$privacy = trim($_POST['p-car-privacy']);
$subscribe = trim($_POST['p-car-subscribe']);
$subject = trim(addslashes($_POST['p-car-subject']));
$enquiry = trim(addslashes($_POST['p-car-enquiry']));
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

$url = "https://api.ubiquity.co.nz/forms/YN5J65j0AkuanQjQ9VN0HQ/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"I7qeXyS8l0WTrwjQ9VN0RA\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"fc15uSjgxUqaEwjQ9VN0RA\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"3Hsicc6Un0OKKAjQ9VN0RA\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"qXX45i1iekm-WAjQ9VN0RA\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"5S7bI_davEmO4AjQ9VN0RA\",
      \"value\": \"$subject\"
    },
	{
      \"fieldID\": \"bMGM6mfuwUy3-wjQ9VN0RA\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"XeliweusAEC6tQjRBqVi2g\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"Jr5_meLvE0uZFwjRBqVgOA\",
      \"value\": \"$privacy\"
    },
  {
      \"fieldID\": \"vjD4SQZt3km50gjUsm2IQg\",
      \"value\": \"$campaign\"
    },
	{
      \"fieldID\": \"uwYwi4wI9kuqkwjUsm3Apg\",
      \"value\": \"$source\"
    },
	{
      \"fieldID\": \"qetZGkUD2Uq4mgjQ9VN0RA\",
      \"value\": \"$subscribe\"
    }
  ],
  \"source\": \"0002 Zones - Career Opportunity\"
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
	$emailsubject = "Submission from 0002 Zones - Career Opportunity - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
?>