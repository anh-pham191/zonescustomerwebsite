<?php
// Ubiquity form: 0002 - Zones - Popout form - Consumer
// Used for the small embedded contact form on Landing Pages
// Sets their Opted Out to No automatically
// Does not set a Privacy value

include '/container/application/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['enq-name']);
$email = cleanData($_POST['enq-email']);
$phone = cleanData($_POST['enq-tel']);
$country = cleanData($_POST['enq-country']);
$campaign = cleanData($_POST['enq-utm']);
$honeypot = cleanData($_POST['enq-website']);
if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="google") {
    $source = "Google AdWords";
} else if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="bing") {
    $source = "Bing";
} else if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="facebook"){
    $source = "Facebook";
} else {
    $source = "Zones Consumer Website";
};
// Set cookies for form part 2
$date_of_expiry = time() + 300;
setcookie("pfirstnamestored", "$firstname", $date_of_expiry, "/");
setcookie("pemailstored", "$email", $date_of_expiry, "/");
setcookie("pphonestored", "$phone", $date_of_expiry, "/");

// Check if fields that shouldn't do contain a URL
$testString = $firstname.$phone;
$isHTTP = strpos($testString, 'http:');
$isHTTPS = strpos($testString, 'https:');
if (($isHTTP !== false) || ($isHTTPS !== false)) {
	$probSpam = "yes";
	echo "ContainsLink";
}
else {
	$probSpam = "no";
}

// Only proceed if no links were found
if ($probSpam != "yes") {
	// If Honeypot filled out send submission to spam and pretend it was successful
	if($honeypot != '') {
		// Trim field length as the database limits will not be applied for emailed submissions
		$firstname = substr($firstname,0,100);
		$email = substr($email,0,100);
		$phone = substr($phone,0,100);
		$country = substr($country,0,100);
		$honeypot = substr($honeypot,0,5000);
		$campaign = substr($campaign,0,100);

		$spamsubject = "SPAM from Zones website form - 0002 Zones Contact - Consumer - Popout stage 1";
		$spammessage = "First name: ".$firstname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: ".$country."\n\n".$honeypot."\n\n"."Campaign: ".$campaign;
		mail($emailtoaddress,$spamsubject,$spammessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
		$goodtogo = "no"; // Do not post to Ubiquity
		echo "EnquirySent"; // Pretend to the spammer that their enquiry was sent
	}
	else {

	$url = "https://api.ubiquity.co.nz/forms/Ew8HFxhNkU-VaAjSg4zJZA/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

	$jsonData = "{
	  \"data\": [
		{
			  \"fieldID\": \"1UiN6GTN_UuzTwjSg4zJdA\",
			  \"value\": \"$firstname\"
			},
			{
			  \"fieldID\": \"G6dd60pubUW_WQjSg4zJdA\",
			  \"value\": \"$email\"
			},
		{
			  \"fieldID\": \"EIsjaK-I4UiczgjSg4zJdA\",
			  \"value\": \"$phone\"
			},
		{
			  \"fieldID\": \"jnxGlTU9j0afHAjSruOGTw\",
			  \"value\": \"$country\"
			},
			{
			  \"fieldID\": \"6Km--a43006tYAjT7r4ndg\",
			  \"value\": \"$source\"
			},
			{
			  \"fieldID\": \"UXV_MK9sJUySJQjS_yNz1w\",
			  \"value\": \"$campaign\"
			},
			{
			  \"fieldID\": \"PNApqmV3NEKB7AjSvny-9A\",
			  \"value\": \"Landscape Enquiry\"
			},
			{
			  \"fieldID\": \"D_zJm46S1U-mcgjSg4zJdA\",
			  \"value\": \"False\"
			}
	  ],
	  \"source\": \"0002 - Zones - Popout form - Consumer\"
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

	// echo $response;

	if (in_array("FailedValidation", $decodedArray)) {
		echo "Your form submission was Invalid. Please go back and try again.";
	}
	elseif ((in_array("UpdatedRow", $decodedArray)) || (in_array("AppendedRow", $decodedArray))) {
		echo "Successful";
	}
	else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones Contact - Consumer - Popout stage 1 - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: ".$country."\n\n"."UTM Campaign: ".$campaign."\n\n"."Opted out setting: False";
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful";
	}
	}
}
}
?>