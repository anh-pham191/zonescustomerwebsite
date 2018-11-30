<?php
// Ubiquity form: 0002 - Zones - Popout form Stage 2 - Consumer

include '/container/application/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['pp-enq-firstname']);
$email = cleanData($_POST['pp-enq-email']);
$enquiry = cleanData($_POST['pp-enq-enquiry']);
$phone = cleanData($_POST['pp-enq-tel']);
$lastname = cleanData($_POST['pp-enq-lastname']);
$streetaddress = cleanData($_POST['pp-enq-address']);
$suburb = cleanData($_POST['pp-enq-suburb']);
$city = cleanData($_POST['pp-enq-city']);
$postcode = cleanData($_POST['pp-enq-code']);
$budget = cleanData($_POST['pp-enq-budget']);
$renotype = $_POST['pp-enq-reno'];
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
$url = "https://api.ubiquity.co.nz/forms/7rdt-SvQmk2U8AjSp7n9jw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"Oa1f6lRAfkaOuQjSp7n9rw\",
      \"value\": \"$firstname\"
    },
    {
      \"fieldID\": \"kGAR_iAQp0GrcwjSp7n9rw\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"BClKA-M5rEOQEgjSp7qFHA\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"bPmE68sUfESELAjSp7n9rw\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"ZT3Zhil_Rk68kQjSp7n9rw\",
      \"value\": \"$lastname\"
    },
	{
      \"fieldID\": \"BsuIqeD6mUuMKAjSp7pbOg\",
      \"value\": \"$streetaddress\"
    },
	{
      \"fieldID\": \"zdoIrblhIUelVwjSp7pjcg\",
      \"value\": \"$suburb\"
    },
	{
      \"fieldID\": \"9FwkPEZcA0OIvQjSp7pnMQ\",
      \"value\": \"$city\"
    },
	{
      \"fieldID\": \"OlOIJr8uCUaFVwjSp7p9Jg\",
      \"value\": \"$postcode\"
    },
	{
      \"fieldID\": \"AxB3Rzqq4EOwfAjSp7pzNw\",
      \"value\": \"$budget\"
    },
	{
      \"fieldID\": \"9B5n5TbkI0iEfgjSp7q78w\",
      \"value\": \"$renotypes\"
    },
  {
      \"fieldID\": \"b_sJmVcmaUG-nwjUtM11sw\",
      \"value\": \"$source\"
    },
  {
      \"fieldID\": \"J2IV8XOFPk-PtAjUtM2CTQ\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"5fGDBSNcnUCbwwjUtM1-_g\",
      \"value\": \"$campaign\"
    },
    {
        \"fieldID\": \"l3NeqNG970qIzAjVMnjzfQ\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 - Zones - Popout form Stage 2 - Consumer\"
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
			echo "Successful";
			}
			else {
			// Info was not sent to Ubiquity - send the info in an email to be manually entered
			$emailsubject = "Submission from 0002 - Zones - Popout form Stage 2 - Consumer - Ubiquity down";
			$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Street address: ".$streetaddress."\n\n"."Suburb: ".$suburb."\n\n"."City: ".$city."\n\n"."Postcode: ".$postcode."\n\n"."Enquiry: ".$enquiry."\n\n"."Budget: ".$budget."\n\n"."Renovation types: ".$renotypes;
			mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
			echo "Successful";
			}
    }

// Remove cookie values and set expiry to past
setcookie("pfirstnamestored","",time()-10, "/");
setcookie("plastnamestored","",time()-10, "/");
setcookie("pemailstored","",time()-10, "/");
setcookie("pphonestored","",time()-10, "/");
?>