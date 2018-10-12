<?php

$curlToken = curl_init();

curl_setopt_array($curlToken, array(
  CURLOPT_URL => "https://www.q10academico.com/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "UserName=apihorarios&Password=0c904eca8fb3&grant_type=password&aplentId=F2BD7F9A-10E2-4E1D-8F84-B8A30201F967",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: d696d6e3-961f-4c20-af69-3a6486b3db91",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curlToken);

$token = json_decode($response);
