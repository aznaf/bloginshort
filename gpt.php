
<?php
// include('autoload.php');
// echo gpt('hi');
function gpt($prompt) {
  $API_KEY = 'Authorization: Bearer '.$_ENV['openai_key'];
$curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.openai.com/v1/chat/completions',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(array(
        "model" => "gpt-3.5-turbo",
        "messages" => array(array("role" => "user", "content" => $prompt))
      )),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        $API_KEY        
      ),
    ));


$response = curl_exec($curl);

curl_close($curl);
// echo $response;


$json_response = json_decode($response, true);
$content = $json_response['choices'][0]['message']['content'];

return $content;  

}


