<?php
$rest_url = "https://openlibrary.org/subjects/textbooks.json";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $rest_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
echo $response;
?>
