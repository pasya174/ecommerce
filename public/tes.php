<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://indonesian-identification-card-ktp.p.rapidapi.com/api/v3/check?nik=3578101202010003",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: indonesian-identification-card-ktp.p.rapidapi.com",
        "X-RapidAPI-Key: 2b126ac62fmsh0e6ca06c39751b7p1a8abcjsnae81f60bac1b"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
