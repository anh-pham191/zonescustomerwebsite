<?php
// Ubiquity form: 0002 - Zones - Stage 1 form - Consumer

include '/container/application/public/includes/emails.php';

function cleanData($input) {
    $output = trim($input);
	$output = addslashes($input); // Needed for Ubiquity
	$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
    return $output;
}

$firstname = cleanData($_POST['firstName']);
$lastname = cleanData($_POST['lastName']);
$email = cleanData($_POST['email']);
$phone = cleanData($_POST['mobile']);
$category = cleanData($_POST['category']);
$honeypot = cleanData($_POST['website']);
$preftime = cleanData($_POST['preftime']);
$formpage = trim(addslashes($_POST['formpage']));
$enquiry = trim(addslashes($_POST['enquiry']));
$privacy = trim($_POST['privacy']);
$subscribe = trim($_POST['subscribe']);
$honeypot = trim(addslashes($_POST['website']));
// $thecategory = $category[0];
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
if (isset($_COOKIE['frommedium'])) {
	$medium = trim($_COOKIE['frommedium']);
};

// Set cookies for form part 2
$date_of_expiry = time() + 300;
setcookie("pfirstnamestored", "$firstname", $date_of_expiry, "/");
setcookie("plastnamestored", "$lastname", $date_of_expiry, "/");
setcookie("pemailstored", "$email", $date_of_expiry, "/");
setcookie("pphonestored", "$phone", $date_of_expiry, "/");
setcookie("penquiry", "$enquiry", $date_of_expiry, "/");

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

// If Privacy not checked
if ($privacy == "on" || $category != "") {
	$privacy = "True";
	$goodtogo = "yes";
}else{
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

if($honeypot != "") {
	// Trim field length as the database limits will not be applied for emailed submissions
	$firstname = substr($firstname,0,100);
	$lastname = substr($lastname,0,100);
	$email = substr($email,0,100);
	$phone = substr($phone,0,100);
	$privacy = substr($privacy,0,100);
	$subscribe = substr($subscribe,0,100);
	$honeypot = substr($honeypot,0,5000);
	$campaign = substr($campaign,0,100);
	$formpage = substr($formpage,0,100);

	$spamsubject = "SPAM from Zones website form - 0002 Zones Contact - Stage 1 form";
	$spammessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Page Enquiry Made On: ".$formpage."\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$enquiry."\n\n"."Spam field contents: ".$honeypot."\n\n"."Campaign: ".$campaign;
	mail($emailtoaddress,$spamsubject,$spammessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	$goodtogo = "no"; // Do not post to Ubiquity
	echo "EnquirySent"; // Pretend to the spammer that their enquiry was sent
	exit;
}
include '../includes/reCAPTCHA.php';
        if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
          }
        
          if(!$captcha){
            echo 'NoCaptcha';
            exit;
          }
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo 'EnquirySent';
          exit;
        }

// echo "goodtogo:".$goodtogo."\n\n probSpam:".$probSpam;
// Only proceed if no links were found
if ($probSpam != "yes" && $goodtogo == "yes") {

		$url = "https://api.ubiquity.co.nz/forms/KWGyB1vkukmgrQjVW_QRZA/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

		$jsonData = "{
	  \"data\": [
		{
		  \"fieldID\": \"KgBbVUkqfUqX-AjVW_SBfQ\",
		  \"value\": \"$firstname\"
		},
		{
		  \"fieldID\": \"-stLrI-dQE2YjwjVW_SEAg\",
		  \"value\": \"$lastname\"
		},
		{
		  \"fieldID\": \"D8l7XQYcuE6WUwjVW_SPFg\",
		  \"value\": \"$email\"
		},
		{
		  \"fieldID\": \"xVCwyfel9km2pAjVW_SjGw\",
		  \"value\": \"$phone\"
		},
		{
		  \"fieldID\": \"71Htnw8MC0GDZwjVW_XKFA\",
		  \"value\": \"$category\"
		},
		{
		  \"fieldID\": \"-QDJELbn9U6jgQjVW_SyIA\",
		  \"value\": \"New Zealand\"
		},
		{
		  \"fieldID\": \"HFua6ddVkUmwEQjVW_Ssbg\",
		  \"value\": \"$enquiry\"
		},
		{
		  \"fieldID\": \"NFfLO-gHQESYlgjVW_U1Kg\",
		  \"value\": \"$source\"
		},
		{
      \"fieldID\": \"bjwU41yUvkGEJQjVW_WXCg\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
		{
		  \"fieldID\": \"oaEardP1_02DxwjVW_Vuhg\",
		  \"value\": \"$campaign\"
		},
		{
		  \"fieldID\": \"PMhn__Pqu0G4oAjVW_VMnA\",
		  \"value\": \"$medium\"
		},
		{
			\"fieldID\": \"J8CFUId4NUyiIwjVW_V2IA\",
			\"value\": \"$formpage\"
		},
		{
			\"fieldID\": \"-TTyOZz0SE2IvAjVW_THVQ\",
			\"value\": \"$subscribe\"
		},
		{
			\"fieldID\": \"A3wBq5-l-EGh9wjVW_TONA\",
			\"value\": \"$privacy\"
		},
		{
			\"fieldID\": \"nX-N8uwZNU-R_QjVXA_BcQ\",
			\"value\": \"$preftime\"
		}
	  ],
	  \"source\": \"0002 - Zones - Stage 1 form - Consumer\"
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
				
				//add lead record to log
				include '../includes/log.php';

				echo "Successful";
			
			}
			else {
			// Info was not sent to Ubiquity - send the info in an email to be manually entered
			$emailsubject = "Submission from 0002 - Zones - Stage 1 form - Consumer - Ubiquity down";
			$emailmessage = "Name: ".$firstname." ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Contact Type Category: ".$thecategory."\n\n"."Opted out setting: False\n\n"."Country: New Zealand";
			mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
			echo "Successful";
			}
			}
}
?>