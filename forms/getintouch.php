<?php
// Ubiquity form: 0001 Refresh Contact - Right hand side get in touch stage 1

$firstname = trim(addslashes($_POST['p-enq-firstname']));
$email = trim($_POST['p-enq-email']);
$phone = trim(addslashes($_POST['p-enq-tel']));
$prefam = trim($_POST['p-enq-am']);
$prefpm = trim($_POST['p-enq-pm']);
$subscribe = trim($_POST['p-enq-subscribe']);
$frompage = trim(addslashes($_POST['frompage']));
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
$preftime = "Morning;Afternoon";
if (($prefam == "on") && ($prefpm != "on")) {
	$preftime = "Morning";
	}
elseif (($prefam != "on") && ($prefpm == "on")) {
	$preftime = "Afternoon";
	}
elseif (($prefam != "on") && ($prefpm != "on")) {
	$preftime = NULL;
	}
else {
	$preftime = "Morning;Afternoon";
}


if ($subscribe == "on") {
	$subscribe = "False";
	}
else {
	$subscribe = "True";
	}

$url = "https://api.ubiquity.co.nz/forms/c63Mf62Ev0uSVgjQQWmSLA/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"lzWVUqbdWUe5VAjQQWmSWg\",
      \"value\": \"$firstname\"
    },
    {
      \"fieldID\": \"bE1fKdCh3UeLVwjQQWmSWg\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"MDrKH3UbpkWh2gjQQWmSWg\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"1zNvcmg-fUakkQjQQWmSWg\",
      \"value\": \"$preftime\"
    },
	{
      \"fieldID\": \"YuA7830cfEiSIwjRBdvvJw\",
      \"value\": \"New Zealand\"
    },
  	{
      \"fieldID\": \"zFKcj-sZhEuDRAjRsE3MkQ\",
      \"value\": \"$campaign\"
    },
	{
      \"fieldID\": \"deI53Jt3PEKZqQjUsmS-iQ\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"pge4kGYRtkObNwjUtMl6gg\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"n-yvpVkbBEeWCgjQQWmSWg\",
      \"value\": \"$subscribe\"
    }
  ],
  \"source\": \"0001 Zones Contact - Right hand side get in touch stage 1\"  
}"; 

// perform the curl transaction

if(!preg_match('/\d+/',$firstname) && !preg_match('/\d+/',$lastname)){
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

//echo $response;

$pterror   = 'Please let us know when you would prefer to be contacted';
$pos = strpos($response, $pterror);

if ($pos === false) {
    echo "";
} else {
    echo "NoPrefTime";
}

if (in_array("FailedValidation", $decodedArray)) {
    echo "Your form submission was Invalid. Please go back and try again.";
}
elseif ((in_array("UpdatedRow", $decodedArray)) || (in_array("AppendedRow", $decodedArray))) {
	echo "Successful";
}
else {
	echo "Unuccessful. Your form could not be submitted at this time. Please try again later.";
}
}

//print_r($response);
// Responses
//actionTaken: "UpdatedRow" (existing)
//actionTaken: "AppendedRow" (new)
//actionTaken: "FailedValidation" (error)

?>