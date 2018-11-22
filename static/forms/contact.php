<?php
// Ubiquity form: 0002 - Zones Brief Enquiry

include '/home/www/trafficnz/zones/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['enq-name']);
$email = cleanData($_POST['enq-email']);
$phone = cleanData($_POST['enq-tel']);
$campaign = "Auckland Franchise Landing Page";

// Check if fields that shouldn't do contain a URL
$testString = $firstname.$phone;
$isHTTP = strpos($testString, 'http:');
if ($isHTTP !== false) {
	$probSpam = "yes";
	echo "ContainsLink";
}
$isHTTPS = strpos($testString, 'https:');
if ($isHTTPS !== false) {
	$probSpam = "yes";
	echo "ContainsLink";
}

// Only proceed if no links were found
if ($probSpam != "yes") {
		
		$url = "https://api.ubiquity.co.nz/forms/MeZ5j5LZP0OciwjSWjgaiw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

		$jsonData = "{
		  \"data\": [
			{
			  \"fieldID\": \"zw_OgUkBQ0qkowjSWjgaoA\",
			  \"value\": \"$firstname\"
			},
			{
			  \"fieldID\": \"QzqQf5KBWUqaZQjSWjgaoA\",
			  \"value\": \"$email\"
			},
			{
			  \"fieldID\": \"eBAdE80tO0KWMgjSWjgaoA\",
			  \"value\": \"$phone\"
			},
			{
			  \"fieldID\": \"VU4wIVMWaEewsgjSWjgaoA\",
			  \"value\": \"False\"
			},
			{
			  \"fieldID\": \"KLT0Gcxs9kCSRAjSrvw-TQ\",
			  \"value\": \"New Zealand\"
			},
			{
			  \"fieldID\": \"8hvrRpd6Z0uC_QjSWjkeMw\",
			  \"value\": \"$campaign\"
			}
		  ],
		  \"source\": \"0002 - Zones Brief Enquiry\"  
		}"; 
		
		if ($goodtogo != "no") {
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
			$emailsubject = "Submission from Zones Auckland Franchise Landing Page contact form - Ubiquity down";
			$emailmessage = "First name: ".$firstname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand";
			mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."CC: ".$emailccaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
			echo "Successful";
			}
		}	
}
?>