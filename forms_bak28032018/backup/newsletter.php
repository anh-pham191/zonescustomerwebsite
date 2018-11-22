<?php
// Ubiquity form: 0002 Zones Newsletter - Footer - Subscribe to newsletter

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['n-enq-firstname']));
$email = trim($_POST['n-enq-email']);
$phone = trim(addslashes($_POST['n-enq-tel']));
$subscribe = "False";

$url = "https://api.ubiquity.co.nz/forms/td2OKzu6iUe_cAjQ9VlWLw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"2ixGLvbKGUuNrwjQ9VlWRQ\",
      \"value\": \"$firstname\"
    },
    {
      \"fieldID\": \"WQkVPUmvVESWZQjQ9VlWRQ\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"GXOgGY4YH0yl_AjQ9VlWRQ\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"sstcA1MPakiuRAjSruLnLw\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"lVaPc7SHB0WkPgjQ9VlWRQ\",
      \"value\": \"$subscribe\"
    }
  ],
  \"source\": \"0002 Zones Newsletter - Footer - Subscribe to newsletter\"
}";

// perform the curl transaction
if(!preg_match('/\d+/',$firstname)){
$ch = curl_init();
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
	echo "Successful";
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones Newsletter - Footer - Subscribe to newsletter - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand"."\n\n"."Opted out setting: ".$subscribe;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}
}
?>