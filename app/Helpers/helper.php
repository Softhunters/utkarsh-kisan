<?php

use App\Models\Websetting;


function webdata()
{
    $web_setting = Websetting::find(1);
    return $web_setting;

}

function sendOtp($number, $otp)
{
    $curl = curl_init();

    $url = 'https://allsms1.dreamitservices.co.in/index.php/smsapi/httpapi/';
    $params = [
        'secret' => 'Pr2e4XjuAgLdRq6KBNsi',
        'sender' => 'UTKISN',
        'tempid' => '1707175377631821028',
        'receiver' => $number,
        'route' => 'TA',
        'msgtype' => '1',
        'sms' => 'Use OTP ' . $otp . ' to log in to your Utkarsh Kisan account. Valid for 10 minutes. Never share your OTP',
    ];

    $fullUrl = $url . '?' . http_build_query($params);

    curl_setopt_array($curl, [
        CURLOPT_URL => $fullUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curlError = curl_error($curl);
    curl_close($curl);


    return;
}
function createSlug($value, string $modelClass, $slugField = 'slug')
{
    $slug = Str::slug($value);
    $original = $slug;
    $i = 1;

    while ($modelClass::where($slugField, $slug)->exists()) {
        $slug = $original . '-' . $i++;
    }

    return $slug;
}