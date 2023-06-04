<?php
function getpixabay($query) {

    $key = '3522345-f6cf38662eb1caa6cf4cadaf5';
    $query = $query;
    $orientation = 'horizontal';
    $safe_search = true;
    $order = 'latest';
    $per_page = 20;

    $url = "https://pixabay.com/api/?key=$key&q=$query&orientation=$orientation&safesearch=$safe_search&order=$order&per_page=$per_page";


    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: __cf_bm=RYTApY2jB8JFY0qPQdmx94mt8x7GdkOmX1tP..qICFY-1685857929-0-Ab+DG675RmSS6GGu+5o/1y1mVRv8eikKE6fTGpQ7Yb4u4TrnosV4AIymUEdWQqeWHPGjALK6Ds/LVUj9vrQeTj8=; anonymous_user_id=None; csrftoken=79q7rLkDdVmieO782lSQ8dZBCDSUb31VwoH3CgK3CLkVzp0AZdJjW677nC42EVyT; dwf_strict_media_search=True; g_rated=permanent'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $json_data = json_decode($response, true); // convert JSON string to associative array
    $largeimage_urls = array(); // initialize empty array to store URLs
    foreach ($json_data['hits'] as $hit) {
        $largeimage_urls[] = $hit['largeImageURL']; // add large image URL to array
    }

    return $largeimage_urls;
}
