<?php
   if($_POST["opzione"]==="spotify"){
   $client_id = "";
   $client_secret = "";
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
   curl_setopt($curl, CURLOPT_POST, 1);
   curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
   $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($curl);
   curl_close($curl);
   $token = json_decode($result)->access_token;
   $data = http_build_query(array("q" => $_POST['posts'], "type" => "album"));
   $curl = curl_init();
   curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
   $headers = array("Authorization: Bearer ".$token);
   curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($curl);
   echo $result;
   curl_close($curl);
   }

   else{
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, "http://api.giphy.com/v1/gifs/search?q=".urlencode($_POST['posts'])."&api_key=TrtuAq0z8mPxO6XH9rFLMkmbSgqcVxRv");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $api_return = curl_exec($ch);
     echo $api_return;
     curl_close($ch);
   }
   
   ?>


