<?php
$api_url = "https://justanotherpanel.com/api/v2";
$api_key = "YOUR_API_KEY_HERE"; // ← یہاں اپنی API Key لگائیں

function sendRequest($data) {
    global $api_url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
}

function getBalance() {
    global $api_key;
    return sendRequest([
        'key' => $api_key,
        'action' => 'balance'
    ]);
}

function getServices() {
    global $api_key;
    return sendRequest([
        'key' => $api_key,
        'action' => 'services'
    ]);
}

function placeOrder($service, $link, $quantity) {
    global $api_key;
    return sendRequest([
        'key' => $api_key,
        'action' => 'add',
        'service' => $service,
        'link' => $link,
        'quantity' => $quantity
    ]);
}

function checkOrder($order_id) {
    global $api_key;
    return sendRequest([
        'key' => $api_key,
        'action' => 'status',
        'order' => $order_id
    ]);
}
?>