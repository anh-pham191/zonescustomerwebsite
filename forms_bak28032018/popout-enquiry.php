<?php
// Ubiquity form: 0002 - Zones - Popout form - Consumer

include '/container/application/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['popout-name']);
$email = cleanData($_POST['popout-email']);
$phone = cleanData($_POST['popout-tel']);
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
		  \"value\": \"New Zealand\"
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
      \"fieldID\": \"2ojdj4c3tUKTxgjUtM0ssw\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
		{
		  \"fieldID\": \"D_zJm46S1U-mcgjSg4zJdA\",
		  \"value\": \"False\"
		},
		{
			\"fieldID\": \"wKcavEQtDki3MgjUydE22g\",
			\"value\": \"$frompage\"
		}
	  ],
	  \"source\": \"0002 - Zones - Popout form - Consumer\"
	}";
		 if(!preg_match('/\d+/',$firstname)){
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($jsonData)));

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
			$emailsubject = "Submission from 0002 - Zones - Popout form - Consumer - Ubiquity down";
			$emailmessage = "Name: ".$firstname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Opted out setting: ".$subscribe."\n\n"."Country: New Zealand";
			mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
			echo "Successful";
			}
		 }
}
?>