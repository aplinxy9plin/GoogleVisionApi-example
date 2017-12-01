<?php
$countResult = 5;
$image = file_get_contents('outputBase64.txt');
function createJSON($type){
  global $image;
  $request = '{
    "requests":[
      {
        "image":{
          "content":"'.$image.'"
        },
        "features":[
          {
            "type":"'.$type.'",
            "maxResults": 5
          }
        ]
      }
    ]
  }';
  return $request;
}
function request($jsonRequest){
  $apikey = 'AIzaSyCy5byxzoigmevVSNOlQe0HSabmpxOsNOU';
                                                                                                                   
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
  return $resultDecode;
}
$json = array(createJSON('LOGO_DETECTION'), createJSON('WEB_DETECTION'), createJSON('TEXT_DETECTION'));
for ($i=0; $i < 3; $i++) { 
  var_dump(request($json[$i]));
}