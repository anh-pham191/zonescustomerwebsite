<?php
// Ubiquity form: 0001 Refresh Newsletter - Popup - Subscribe to newsletter

include '/container/application/public/includes/emails.php';

$firstname = trim(addslashes($_POST['p-enq-firstname']));
$lastname = trim(addslashes($_POST['p-enq-lastname']));
$email = trim($_POST['p-enq-email']);
$phone = trim(addslashes($_POST['p-enq-tel']));
$streetnum = trim(addslashes($_POST['p-enq-streetnum']));
$streetname = trim(addslashes($_POST['p-enq-streetname']));
$suburb = trim(addslashes($_POST['p-enq-suburb']));
$city = trim(addslashes($_POST['p-enq-city']));
$postcode = trim(addslashes($_POST['p-enq-postcode']));
$gender = trim($_POST['p-enq-gender']);
$frompage = trim(addslashes($_POST['frompage']));
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
// Set cookies for form part 2
$date_of_expiry = time() + 300;
setcookie("firstnamestored", "$firstname", $date_of_expiry, "/");
setcookie("emailstored", "$email", $date_of_expiry, "/");

$url = "https://api.ubiquity.co.nz/forms/39LvBVPmFUuCtAjQPJtPxg/submit?apiToken=vaxIncJDcdcyEaK6KaIUV8uAtJOKR5uCB2HJhWtd4LGbeh7KORxzeqQNjPIaOREIrsK7he-3zjY8zoG4OJwIQk7ORyCuHgQA4BwqSK2V-2IH3mwvH0rMzrqQscjMLW5rOXUQXgksMjs";

$jsonData = "{
  \"data\": [
    {
      \"fieldID\": \"xDEsTtd8IkykdQjQPJtYrw\",
      \"value\": \"$firstname\"
    },
    {
      \"fieldID\": \"4Ss9TW-glkGHpwjQPJtcCw\",
      \"value\": \"$lastname\"
    },
	{
      \"fieldID\": \"0_b2UwtoTkKO0gjQPJteDQ\",
      \"value\": \"$email\"
    },
	{
      \"fieldID\": \"XK9iW0o_m0CY9QjQPJtgtQ\",
      \"value\": \"$phone\"
    },
	{
      \"fieldID\": \"8gLi4Z5VhUykfwjQPJtlsg\",
      \"value\": \"$streetnum\"
    },
	{
      \"fieldID\": \"teW9zAs_10abKQjQPJtrpQ\",
      \"value\": \"$streetname\"
    },
	{
      \"fieldID\": \"iOdD0e9sO02OSgjQPJtt-A\",
      \"value\": \"$suburb\"
    },
	{
      \"fieldID\": \"fF1D-WKhAU2-VwjQPJtyOw\",
      \"value\": \"$city\"
    },
	{
      \"fieldID\": \"kZymRI5jFkCyGwjQPJt2Bg\",
      \"value\": \"$postcode\"
    },
	{
      \"fieldID\": \"_n2eB6s0EU6C7AjQPJt-1g\",
      \"value\": \"$gender\"
    },
	{
      \"fieldID\": \"_6R0CRJf6EqGGwjQPJvHqg\",
      \"value\": \"False\"
    },
    {
      \"fieldID\": \"ZZ2GnlPyk0Ok7QjUtMwbBQ\",
      \"value\": \"$source\"
    },
  {
      \"fieldID\": \"zHyKx5YHq0mzHwjUtMwioQ\",
      \"value\": \"Zones NZ Consumer Lead\"
    },
	{
      \"fieldID\": \"o2c20g71ZESwBgjUtMwgjw\",
      \"value\": \"$campaign\"
    }
  ],
  \"source\": \"0001 Refresh Newsletter - Popup - Subscribe to newsletter\"
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
// print_r($response);
// Responses
//actionTaken: "UpdatedRow" (existing)
//actionTaken: "AppendedRow" (new)
//actionTaken: "FailedValidation" (error)

?>