<?php
// Ubiquity form: 0002 Zones - Right hand side get in touch stage 1

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-enq-firstname']));
$lastname = trim(addslashes($_POST['p-enq-lastname']));
$email = trim($_POST['p-enq-email']);
$phone = trim(addslashes($_POST['p-enq-tel']));
$preftime = trim($_POST['p-enq-preftime']);
$privacy = trim($_POST['p-enq-privacy']);
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
// Set cookies for form part 2
$date_of_expiry = time() + 300;
setcookie("gfirstnamestored", "$firstname", $date_of_expiry, "/");
setcookie("glastnamestored", "$lastname", $date_of_expiry, "/");
setcookie("gemailstored", "$email", $date_of_expiry, "/");
setcookie("gphonestored", "$phone", $date_of_expiry, "/");

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

$url = "https://api.ubiquity.co.nz/forms/Cr26VX59s0GOhgjRBz0TtQ/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"Gi4nFdjFNUa19AjRBz0TyA\",
      \"value\": \"$firstname\"
    },
	{
      \"fieldID\": \"4MurYjsa0E-3iwjRBz0TyA\",
      \"value\": \"$lastname\"
    },
    {
      \"fieldID\": \"uSfQUOUh4k6RXAjRBz0TyA\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"03_aBFQm10-kDQjRBz0TyA\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"N_Rk6SZXDE2CSAjRBz0TyA\",
      \"value\": \"$preftime\"
    },
	{
      \"fieldID\": \"eso3ADWgx0ubYQjRBz0TyA\",
      \"value\": \"$privacy\"
    },
	{
      \"fieldID\": \"UwfNCc7Bw0KiDAjSruH1Bw\",
      \"value\": \"New Zealand\"
    },
	{
      \"fieldID\": \"x8oMa9eFdkemngjRBz0TyA\",
      \"value\": \"$subscribe\"
    },
    {
      \"fieldID\": \"0HWBXeOMqUe_9AjT7r85gQ\",
      \"value\": \"$source\"
    },
    {
      \"fieldID\": \"AraBnLKjvkWVqQjUtM_gGw\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"vu9ebM6eBkKNpwjS_-y_Ow\",
      \"value\": \"$campaign\"
    },
    {
        \"fieldID\": \"FTR0XCHg5UKj1gjVMniTPg\",
        \"value\": \"$frompage\"
    }
  ],
  \"source\": \"0002 Zones - Right hand side get in touch stage 1\"
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
	echo "Successful";
}
else {
	// Info was not sent to Ubiquity - send the info in an email to be manually entered
	$emailsubject = "Submission from 0002 Zones - Right hand side get in touch stage 1 - Ubiquity down";
	$emailmessage = "First name: ".$firstname."\n\n"."Last name: ".$lastname."\n\n"."Email: ".$email."\n\n"."Phone: ".$phone."\n\n"."Country: New Zealand\n\n"."Read and accepted Privacy Policy: ".$privacy."\n\n"."Opted out setting: ".$subscribe."\n\n"."UTM Campaign: ".$campaign;
	mail($emailtoaddress,$emailsubject,$emailmessage,"From: ".$emailfromaddress."\r\n"."Content-type: text/plain; charset=utf-8\r\n");	// If any headers come via form input ensure this is sanitised
	echo "Successful"; // So that user sees their info has been collected.
}

?>