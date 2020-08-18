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

 if(isset($result['token'])){
    $token=$result['token'];
  

	    $url = "http://localhost:8000/api/getAllStatus";
	    $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 80);
      curl_setopt($ch, CURLOPT_HTTPHEADER, 
	    array(
     'Authorization:Bearer '.$token,
	   'Content-Type:application/json'
   ));
   
   $response = curl_exec($ch);
   
   //var_dump($response);
	
   
   if(curl_error($ch)){
	      $response=-1;
   }
 }


  
    
  header("Content-type:application/json");    
    
     echo $response;
      
  }catch(Exception $e) {
    echo 0;
  }

?>