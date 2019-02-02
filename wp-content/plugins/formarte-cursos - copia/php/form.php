<?php

$client = new http\Client;
$request = new http\Client\Request;

$body = new http\Message\Body;
$body->append(new http\QueryString(array(
  'UserName' => 'apihorarios',
  'Password' => '0c904eca8fb3',
  'grant_type' => 'password',
  'aplentId' => 'F2BD7F9A-10E2-4E1D-8F84-B8A30201F967'
)));

$request->setRequestUrl('https://www.q10academico.com/token');
$request->setRequestMethod('POST');
$request->setBody($body);

$request->setHeaders(array(
  'Postman-Token' => '863c9937-1fd2-439b-913e-a9edca1dd763',
  'cache-control' => 'no-cache'
));

$client->enqueue($request)->send();
$response = $client->getResponse();

echo $response->getBody();