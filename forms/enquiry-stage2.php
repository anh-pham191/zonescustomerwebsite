<?php

include '../includes/emails.php';

function cleanData($input) {
  $output = trim($input);
  $output = stripslashes($input);
  //$output = htmlspecialchars($output, ENT_NOQUOTES, 'UTF-8'); // Disallows code tags
  return $output;
}

$firstname = cleanData($_POST['firstName-s2']);
$lastname = cleanData($_POST['lastName-s2']);
$email = cleanData($_POST['email-s2']);
$mobile = cleanData($_POST['mobile-s2']);
$phone = cleanData($_POST['landline-s2']);
$enquiry = cleanData($_POST['enquiry-s2']);
$day = cleanData($_POST['day-s2']);
if($day == ""){
  $day = date("D"); 
}
$month = date_parse(cleanData($_POST['month-s2']));
$mth = $month['month'];
$year = cleanData($_POST['year-s2']);
if($year == ""){
  $year = date('Y');
}
$streetaddress = cleanData($_POST['streetaddress-s2']);
$city = cleanData($_POST['city-s2']);
$province = cleanData($_POST['stateprovince-s2']);
$postcode = cleanData($_POST['postcode-s2']);
$country = cleanData($_POST['country-s2']);
$budget = cleanData($_POST['budget-s2']);
$projectTypeList = cleanData($_POST['projectTypeList-s2']);
$sourceList= cleanData($_POST['sourceList-s2']);
$longitude = cleanData($_POST['longitude-s2']);
$latitude = cleanData($_POST['latitude-s2']);
$honeypot = cleanData($_POST['form-website']);

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

// Check if fields that shouldn't do contain a URL
$testString = $firstname.$lastname.$mobile;
$isHTTP = strpos($testString, 'http:');
$isHTTPS = strpos($testString, 'https:');
if (($isHTTP !== false) || ($isHTTPS !== false)) {
	$probSpam = "yes";
	echo "ContainsLink";
}else {
	$probSpam = "no";
}



// Only proceed if no links were found
if ($probSpam != "yes") {
	// If Honeypot filled out send submission to spam and pretend it was successful
	if($honeypot != '') {
		// Trim field length as the database limits will not be applied for emailed submissions
		$firstname = substr($firstname,0,100);
		$lastname = substr($lastname,0,100);
		$email = substr($email,0,100);
		$mobile = substr($mobile,0,100);
		$enquiry = substr($enquiry,0,5000);
		$honeypot = substr($honeypot,0,5000);
		$campaign = substr($campaign,0,100);

		$spamsubject = "SPAM from Refresh website form - Stage 2 Enquiry form";
		$spammessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Enquiry: ".$enquiry."\n\n"."Spam field contents: ".$honeypot."\n\n"."Campaign: ".$campaign;
		mail($emailtoaddress,$spamsubject,$spammessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
		$goodtogo = "no"; // Do not post to Ubiquity
		echo "Successful"; // Pretend to the spammer that their enquiry was sent

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
          echo 'Successful';
          exit;
        }

	// Otherwise, carry on as for a human and submit to database :-)
	else {

    
		$url = "https://api.ubiquity.co.nz/forms/1G9zCU_I5kS9vgjVXNjQ6g/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

		$jsonData = "{
	  \"data\": [
		{
		  \"fieldID\": \"pE8e8kvFSkmW6AjVXNjRJQ\",
		  \"value\": \"$firstname\"
		},
		{
		  \"fieldID\": \"c__HSyaK8EiV1AjVXNjRJQ\",
		  \"value\": \"$lastname\"
		},
		{
		  \"fieldID\": \"OFavUQAcp0uqLAjVXNjRJQ\",
		  \"value\": \"$email\"
		},
		{
		  \"fieldID\": \"45Y8cmbpzUKNRAjVXNjRJg\",
		  \"value\": \"$mobile\"
		},
		{
		  \"fieldID\": \"W4QiLW0N8E-yXgjVXNmUMA\",
		  \"value\": \"$phone\"
		},
		{
		  \"fieldID\": \"V6F9h77T4UWFNAjVXNjRJg\",
		  \"value\": \"$country\"
		},
		{
		  \"fieldID\": \"NWxI5yBQMEynHgjVXNjRJg\",
		  \"value\": \"$enquiry\"
		},
		{
		  \"fieldID\": \"m99PfHyZCkGZggjVXNjRJg\",
		  \"value\": \"$source\"
		},
		{
          \"fieldID\": \"vVl-IprkgUmengjVXNjRJg\",
          \"value\": \"Zones NZ Consumer Lead\"
        },
		{
		  \"fieldID\": \"dggFcIEchE6s3gjVXNjRJg\",
		  \"value\": \"$campaign\"
		},
		{
		  \"fieldID\": \"fcQxcbGE_0-FGQjVXNjRJg\",
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
			\"fieldID\": \"sNPKEs21sE2mZgjVXNle1w\",
			\"value\": \"$postcode\"
		},
		{
			\"fieldID\": \"iHqhtf6el0yMPAjVXNlasQ\",
			\"value\": \"$city\"
		},
		{
			\"fieldID\": \"nBst1YlTHEayQAjVXNmA-A\",
			\"value\": \"$province\"
		},
		{
			\"fieldID\": \"F2lf2E-iREqAzAjVXNlSsQ\",
			\"value\": \"$streetaddress\"
		},
		{
			\"fieldID\": \"3hcEL_gcZkSWegjVXNn7og\",
			\"value\": \"$budget\"
		},
		{
			\"fieldID\": \"qW0g5ODstUu5-wjVXNooyw\",
			\"value\": \"$day $mth $year\"
		},
		{
			\"fieldID\": \"lJOIU7WslUeFfwjVXNnLUg\",
			\"value\": \"$projectTypeList\"
		},
		{
			\"fieldID\": \"oUd3LqChYEqPnwjVXNqQ4g\",
			\"value\": \"$sourceList\"
		}
	  ],
	  \"source\": \"0002 - Zones - Stage 2 form - Consumer\"
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

            // echo $response;
            // exit;

			if (in_array("FailedValidation", $decodedArray)) {
			echo "Your form submission was Invalid. Please go back and try again.";
			}
			elseif ((in_array("UpdatedRow", $decodedArray)) || (in_array("AppendedRow", $decodedArray))) {
				//add lead record to log
				$formpage = "Stage 2 form";
				$source = "N/A";
				$medium = "N/A";
				$campaign = "N/A";
				include '../includes/log.php';

				echo "Successful";
             }
        }else{
        // Info was not sent to Refresh Control - send the info in an email to be manually entered
        $pagecountry = cleanData($_POST['pagecountry']);
       
        $emailsubject = "Submission from Stage 2 Enquiry form - Ubiquity down";
		 	  $emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Mobile Country Code: ".$countrycode."\n\n"."Phone: ".$phone."\n\n"."Mobile: ".$mobile."\n\n"."Address: ".$streetaddress.", ".$city.", ".$province.", ".$postcode.", ".$country."\n\n"."Country: [".$pagecountry."]\n\n"."Enquiry: ".$enquiry."\n\n"."Expected Start Date: ".$year."-".$month['month']."-".$day."\n\n"."Project Budget: ".$budget."\n\n"."Project type(s) g: ".$projectTypeList."\n\n"."Seen Heard of Refresh: ".$sourceList;
			  mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");
        echo "Successful";
			}
	}
}

?>
