<?php
header('Access-Control-Allow-Origin: *');
session_start();


$Name=$_POST['Name'];


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
if(isset($result['token'])){

  $data = array(
    'Name' => $Name
  );
  
  $payload = json_encode($data);
  
  // Prepare new cURL resource
  $ch = curl_init('http://localhost:8000/api/addStatus/');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLINFO_HEADER_OUT, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
   
   curl_setopt($ch, CURLOPT_HTTPHEADER, 
	array(
	   'Authorization:Bearer '.$result['token'],
	   'Content-Type:application/json'
   ));
  
  // Set HTTP Header for POST request 
  
  // Submit the POST request
  $response = curl_exec($ch);
  
  $response=json_decode($response,true);
 
}

    
  header("Content-type:application/json");    
 
     echo json_encode($response);
      
  }catch(Exception $e) {
    echo 0;
  }

?>