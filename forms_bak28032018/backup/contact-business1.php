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
if (isset($_COOKIE['fromcampaign'])) {
    $campaign = cleanData($_COOKIE['fromcampaign']);
} else {
    $campaign = "N/A";
};
if (isset($_COOKIE['fromsource'])&& $_COOKIE['fromsource']=="google") {
    $source = "Google AdWords";
} else {
    $source = "Zones Consumer Website";
};
if (isset($_COOKIE['frommedium'])) {
    $medium = cleanData($_COOKIE['frommedium']);
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
      \"fieldID\": \"Ll89yFU5tEmOOgjSZ2IT7Q\",
      \"value\": \"Zones Consumer website - $campaign\"
    }
  ],
  \"source\": \"0002 Zones - Business Opportunity\"
}";

// perform the curl transaction if privacy was set
if ($goodtogo != "no") {
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
                // Buffer all upcoming output...
                ob_start();

                // Send response.
                echo "Successful";

                // Get the size of the output.
                $size = ob_get_length();

                // Disable compression (in case content length is compressed).
                header("Content-Encoding: none");

                // Set the content length of the response.
                header("Content-Length: {$size}");

                // Close the connection.
                header("Connection: close");

                // Flush all output.
                ob_end_flush();
                ob_flush();
                flush();

                // Close current session (if it exists).
                if (session_id())
                    session_write_close();

                //send data to pipedrive
                $deal['b02f1fdf1d4985094631af3a6a4dea9d3acb99f2'] = "0002 Zones - Business Opportunity - used for Franchise Enquiry"; //Form used
                include 'sync-pipedrive.php';
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones - Business Opportunity - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy : ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."Message subject: ".$subject."\n\n"."Enquiry: ".$enquiry."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
	}
?>