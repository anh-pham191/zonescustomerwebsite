<?php
// Ubiquity form: 0001 Refresh Newsletter - Popup - Home Renovation Enquiry

include '/container/application/public/includes/emails.php';

// Get cookie values from form part one
$firstname = $_COOKIE['firstnamestored'];
$email = $_COOKIE['emailstored'];
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
$url = "https://api.ubiquity.co.nz/forms/7G-k2tiqBUCzdAjQPKDLxw/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"X9z3bnPdk06jFgjQPKDL3Q\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"lStQRF2ooEKWwQjQPKDL3Q\",
      \"value\": \"$email\"
    },
    {
      \"fieldID\": \"9KuZSMhejUaDSgjRsE_Hmw\",
      \"value\": \"$campaign\"
    },
	{
      \"fieldID\": \"kf-EwtcX9kewGAjUsmay7w\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"ApvQ8rudIkyJEgjUtMvGWA\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"PRY5JQePkkaVDwjQPKD_Pw\",
      \"value\": \"Yes\"
    }
  ],
  \"source\": \"0001 Refresh Newsletter - Popup - Home Renovation Enquiry\"
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
}

// print_r($response);
// Responses
//actionTaken: "UpdatedRow" (existing)
//actionTaken: "AppendedRow" (new)
//actionTaken: "FailedValidation" (error)

?>