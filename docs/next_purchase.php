<?php
    header('Content-Type: application/json');

	//Get arguments
	$accountNum = (int)$_POST['accountNum'];
	
	$data = array(
		"accountNumber" => $accountNum
	  );
	   
	$post = json_encode($data);
	$headers= array('Accept: application/json','Content-Type: application/json'); 
	//process
	$ch = curl_init("https://syf2020.syfwebservices.com/v1_0/next_purchase");
	
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	
	// output contains the output string
	$output = curl_exec($ch);
	
	
	curl_close($ch);  // Seems like good practice
	echo json_encode($output);

?>