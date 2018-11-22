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