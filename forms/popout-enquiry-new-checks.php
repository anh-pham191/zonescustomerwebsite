<?php
// Ubiquity form: 0002 - Zones - Popout form - Consumer

include '/container/application/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['popout-firstname']);
$lastname = cleanData($_POST['popout-lastname']);
$email = cleanData($_POST['popout-email']);
$phone = cleanData($_POST['popout-tel']);
$category = $_POST['popout-category'];
$frompage = trim(addslashes($_POST['frompage']));
$thecategory = $category[0];
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
// Set cookies for form part 2
$date_of_expiry = time() + 300;
setcookie("pfirstnamestored", "$firstname", $date_of_expiry, "/");
setcookie("plastnamestored", "$lastname", $date_of_expiry, "/");
setcookie("pemailstored", "$email", $date_of_expiry, "/");
setcookie("pphonestored", "$phone", $date_of_expiry, "/");

// Check if fields that shouldn't do contain a URL
$testString = $firstname.$lastname.$phone;
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
		  \"fieldID\": \"mUV30kdhe0-4-QjSp7btew\",
		  \"value\": \"$lastname\"
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
		  \"fieldID\": \"PNApqmV3NEKB7AjSvny-9A\",
		  \"value\": \"$thecategory\"
		},
		{
		  \"fieldID\": \"jnxGlTU9j0afHAjSruOGTw\",
		  \"value\": \"New Zealand\"
		},
		{
		  \"fieldID\": \"D_zJm46S1U-mcgjSg4zJdA\",
		  \"value\": \"False\"
		},
		{
		  \"fieldID\": \"6Km--a43006tYAjT7r4ndg\",
		  \"value\": \"$source\"
		},
		{
      \"fieldID\": \"2ojdj4c3tUKTxgjUtM0ssw\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
		{
		  \"fieldID\": \"UXV_MK9sJUySJQjS_yNz1w\",
		  \"value\": \"$campaign\"
		},
		{
			\"fieldID\": \"wKcavEQtDki3MgjUydE22g\",
			\"value\": \"$frompage\"
		}
	  ],
	  \"source\": \"0002 - Zones - Popout form - Consumer\"
	}";
		  if(!preg_match('/\d+/',$firstname) && !preg_match('/\d+/',$lastname)){
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
				if ($thecategory == "Franchise Enquiry") {
				echo "FranchiseSuccess";
				}
				else {
				echo "Successful";
				}
			}
			else {
			// Info was not sent to Ubiquity - send the info in an email to be manually entered
			$emailsubject = "Submission from 0002 - Zones - Popout form - Consumer - Ubiquity down";
			$emailmessage = "Name: ".$firstname." ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Contact Type Category: ".$thecategory."\n\n"."Opted out setting: False\n\n"."Country: New Zealand";
			mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
			echo "Successful";
			}
			}
}
?>