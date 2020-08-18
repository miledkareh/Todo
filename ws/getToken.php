<?php

session_start();

try {
$data = array(
  'username' => $_SESSION['Username'],
  'password' => $_SESSION['Password']
);

$payload = json_encode($data);

// Prepare new cURL resource
$ch = curl_init('http://localhost:8000/api/Authenticate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

// Submit the POST request
$result = curl_exec($ch);

$result=json_decode($result,true);


    
  header("Content-type:application/json");    
 
     echo json_encode($result);
      
  }catch(Exception $e) {
    echo 0;
  }

?>