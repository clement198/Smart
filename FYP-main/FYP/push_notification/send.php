<?php
// Set the URL of the FCM API endpoint
$url = 'https://fcm.googleapis.com/fcm/send';

// Set the server key for authentication
$server_key = 'you-server-key-from-firebase';

// Set the message payload
$message = array(
  'data' => array(
    'title' => 'Title',
    'body' => 'This is message body',
    'icon' => 'https://www.clipscutter.com/image/brand/brand-256.png',
    'image' => "https://images.unsplash.com/photo-1514473776127-61e2dc1dded3?w=871&q=80",
    'click_action' => 'https://example.com'
  ),
  'registration_ids' => [
  //  device tokens
  ],
);

// Set additional cURL options
$options = array(
  CURLOPT_URL => $url,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => array(
    'Authorization: key=' . $server_key,
    'Content-Type: application/json',
  ),
  CURLOPT_POSTFIELDS => json_encode($message),
);

// Create a new cURL resource and set the options
$curl = curl_init();
curl_setopt_array($curl, $options);

// Send the HTTP request and get the response
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
  echo 'Error sending message: ' . curl_error($curl);
} else {
  echo 'Message sent successfully';
}

// Close the cURL resource
curl_close($curl);
