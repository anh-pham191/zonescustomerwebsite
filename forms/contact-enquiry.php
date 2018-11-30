<?php
// Ubiquity form: 0002 - Zones - Landscape Enquiry

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
$honeypot = trim(addslashes($_POST['website']));
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
if($honeypot != '') {
        // Trim field length as the database limits will not be applied for emailed submissions
        $firstname = substr($firstname,0,100);
        $lastname = substr($lastname,0,100);
        $email = substr($email,0,100);
        $phone = substr($phone,0,100);
        $country = substr($country,0,100);
        $privacy = substr($privacy,0,100);
        $subscribe = substr($subscribe,0,100);
        $subject = substr($subject,0,5000);
        $enquiry = substr($enquiry,0,5000);
        $honeypot = substr($honeypot,0,5000);
        $campaign = substr($campaign,0,100);
        $frompage = substr($frompage,0,100);
    
        $spamsubject = "SPAM from Zones website form - 0002 - Zones - Landscape Enquiry";
        $spammessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand \n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."Page enquiry made on: ".$frompage."\n\n"."Spam field contents: ".$honeypot."\n\n"."Campaign: ".$campaign;
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
$url = "https://api.ubiquity.co.nz/forms/ppWaf0e4gUGZRAjUl4RNdg/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"Ybmel5z5hEyJZQjUl4RNlQ\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"sJF1y8rzyU-bjwjUl4RNlQ\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"Cak4Yn-wPUW8WAjUl4RNlQ\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"hbbN2ByXCUWL8gjUl4RNlQ\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"evkvsujELEyepQjUl4RNlQ\",
      \"value\": \"$preftime\"
    },
	{
      \"fieldID\": \"HmSeFUlkgkWWkwjUl4RNlQ\",
      \"value\": \"$subject\"
    },
	{
      \"fieldID\": \"wIM0lAYo70-BIAjUl4RNlQ\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"qRW2VRfe00S5BQjSrt7yYA\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"QPuw5JijAEq81gjUl4RNlQ\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"2FXJ1xWyv0qElwjUl4RNlQ\",
      \"value\": \"$subscribe\"
    },
    {
      \"fieldID\": \"A6H1Q86jvkSzYgjUl5NEUQ\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"2_pt96eRDUek-QjUtKcMkA\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"iPc20i2IrEKb9AjUl5MsjQ\",
      \"value\": \"$campaign\"
    },
    {
        \"fieldID\": \"ExaSxMVCh0S6MgjVMnkLGw\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 - Zones - Landscape Enquiry\"
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
    //add lead record to log
    $formpage = $frompage;
    include '../includes/log.php';
    
	echo "Successful";
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 - Zones - Landscape Enquiry - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
?>