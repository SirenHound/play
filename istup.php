$user_agent = "IsitupForSlack/1.0 (https://github.com/mccreath/istiupforslack; mccreath@gmail.com)";
$command = $_POST['command'];
$domain = $_POST['text'];
$token = $_POST['token'];
if($token != 'zNvYk1lDMEwvHHhZrWApVhfv'){ 
    $msg = "The token for the slash command doesn't match. Check your script.";
    die($msg);
    echo $msg;
}

# 6mBO4AtK0UcgIMONuUnDUzzh
if($token != '6mBO4AtK0UcgIMONuUnDUzzh'){ 
    $msg = "The token for the slash command doesn't match. Check your script.";
    die($msg);
    echo $msg;
}

$url_to_check = "https://isitup.org/".$domain.".json";
$ch = curl_init($url_to_check);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$ch_response = curl_exec($ch);
curl_close($ch);

$response_array = json_decode($ch_response, TRUE);

if($ch_response === FALSE){

  # isitup.org could not be reached 
  $reply = "Ironically, isitup could not be reached.";

} else {

    if ($response_array['status_code'] == 1){

		$reply = ":thumbsup: I am happy to report that *<".$response_array["domain"].">* is *up*!"

	}else if ($response_array['status_code'] == 2){

		$reply = ":disappointed: I am sorry to report that *<".$response_array["domain"].">* is *down*!"

	}else if($response_array['status_code'] == 3){

		$reply  = ":interrobang: *".$domain."* does not appear to be a valid domain. Please enter both the domain name AND the suffix (example: *amazon.com* or *whitehouse.gov*).";

	}

}

echo $reply;