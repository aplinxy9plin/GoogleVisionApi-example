<?php
	$countResult = 5;
	$image = file_get_contents('outputBase64.txt');
	//$imageVar = ;
	//var_dump($imageVar);
	$jsonRequest = '{
  "requests":[
    {
      "image":{
        "content":"'.$image.'"
      },
      "features":[
        {
          "type":"LABEL_DETECTION",
          "maxResults": '.$countResult.'
        }
      ]
    }
  ]
}';
$apikey = '';
                                                                                                                   
$ch = curl_init('https://vision.googleapis.com/v1/images:annotate?key='.$apikey.'');               
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonRequest);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($jsonRequest))                                                                       
);                                                                                                                   
                                                                                                                     
$result = curl_exec($ch);
$resultDecode = json_decode($result);
//$resultDecode = ($resultDecode->responses[0]->labelAnnotations[0]->description);
for ($i=0; $i < $countResult; $i++) { 
	echo "".$i." - "; echo($resultDecode->responses[0]->labelAnnotations[$i]->description); echo "\n";
}