<?php
function getpexels($query, $orientation = 'landscape', $per_page = 20, $page = 1) {
  $curl = curl_init();

  $headers = array(
    'Authorization: 563492ad6f917000010000011efb7b7301da4a20bdcc47dc34c54750',
    'Content-Type: application/json'
  );

  $queryParams = http_build_query(array(
    'query' => $query,
    'orientation' => $orientation,
    'per_page' => $per_page,
    'page' => $page
  ));

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pexels.com/v1/search?$queryParams",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => $headers,
  ));

  $response = curl_exec($curl);

  curl_close($curl);

  $response = json_decode($response, true);

  $large_images = array();

  foreach ($response['photos'] as $photo) {
    $large_image = $photo['src']['large'];
    array_push($large_images, $large_image);
  }

  return $large_images;
}




