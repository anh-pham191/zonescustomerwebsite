<?php
// Ubiquity form: 0002 Zones - Business Opportunity

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-bus-firstname']));
$lastname = trim(addslashes($_POST['p-bus-lastname']));
$email = trim($_POST['p-bus-email']);
$phone = trim(addslashes($_POST['p-bus-tel']));
$privacy = trim($_POST['p-bus-privacy']);
$subscribe = trim($_POST['p-bus-subscribe']);
$subject = trim(addslashes($_POST['p-bus-subject']));
$enquiry = trim(addslashes($_POST['p-bus-enquiry']));
$frompage = trim(addslashes($_POST['frompage']));
$honeypot = trim(addslashes($_POST['website']));
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
if (isset($_COOKIE['frommedium'])) {
    $medium = trim($_COOKIE['frommedium']);
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
	// If Honeypot filled out send submission to spam and pretend it was successful
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

		$spamsubject = "SPAM from Zones website form - 0002 Zones - Business Opportunity";
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

$url = "https://api.ubiquity.co.nz/forms/U5_c51wVaEuSxwjQ9VHBsw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"xFl_ucLqFEmy3QjQ9VHBzw\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"N4VpEJknwkGmJgjQ9VHBzw\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"E0EiaNAfEUaFtgjQ9VHBzw\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"uKS3L26W20yecAjQ9VHBzw\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"quWVMtFdbkCSRwjQ9VHBzw\",
      \"value\": \"$subject\"
    },
	{
      \"fieldID\": \"IvlQRPWgu0G0RQjTXvZtKQ\",
      \"value\": \"$enquiry\"
    },
	{
      \"fieldID\": \"pnXrieiBXkGNdQjRBqT4zw\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"fAS-OdAVQ0CjKgjRBqT2JQ\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"22OHSbdxxkCAMAjQ9VHBzw\",
      \"value\": \"$subscribe\"
    },
    {
      \"fieldID\": \"P81_0yAnYE-DGAjT7r8Lrw\",
      \"value\": \"$medium\"
    },
	{
      \"fieldID\": \"lEUJ7o6M2EWMWQjTpnjSYA\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"8xxqO24ig06HPAjUtM9HBg\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"Ll89yFU5tEmOOgjSZ2IT7Q\",
      \"value\": \"Zones Consumer website - $campaign\"
    },
    {
        \"fieldID\": \"CrVhjLaqnEqA0QjVMni3yg\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 Zones - Business Opportunity\"
}";

// perform the curl transaction if privacy was set
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

                //send data to pipedrive
                $deal['b02f1fdf1d4985094631af3a6a4dea9d3acb99f2'] = "0002 Zones - Business Opportunity - used for Franchise Enquiry"; //Form used
                include 'sync-pipedrive.php';

                // Send response.
                echo "Successful";
}
else {
    if(!preg_match('/\d+/',$firstname)&&!preg_match('/\d+/',$lastname)){
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones - Business Opportunity - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."UTM Campaign: ".$campaign."\n\n"."Page enquiry made on: ".$frompage;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
	}
    }
?>