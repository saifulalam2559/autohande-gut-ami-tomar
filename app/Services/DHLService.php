<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Response;
class DHLService
{
   
 
  protected $apiUrl;
  protected $apiliveUrl;
  protected $accountNumber;
  protected $username;
  protected $password;

  protected $DHL_CLIENTID_Return;
  protected $DHL_SECRETKEY_Return;

  protected $DHL_CLIENTID_Create;
  protected $DHL_SECRETKEY_Create;

  protected $DHL_CLIENTID_Delete;
  protected $DHL_SECRETKEY_Delete;

  protected $DHL_CLIENTID_Track;
  protected $DHL_SECRETKEY_Track;


  public function __construct()
  {
      $this->client = new Client();
      $this->apiliveUrl = env('DHL_BASELiveURL');
      $this->apiUrl = "https://api-sandbox.dhl.com/parcel/de";          
      $this->password ="SandboxPasswort2023!";
      $this->DHL_CLIENTID_Return  = "vDolwklEA8vpjMxROKJnbQrrHb3nqGPD";
      $this->DHL_SECRETKEY_Return = "VRHVb4wQlZja4wCN";

      $this->DHL_CLIENTID_Create  = "OFPI1mOr2U4OxrAUreIX25nVKbq6Q5GQ";
      $this->DHL_SECRETKEY_Create = "C1oxPguCjef6nV8a";

      $this->DHL_CLIENTID_Delete  = "OFPI1mOr2U4OxrAUreIX25nVKbq6Q5GQ";
      $this->DHL_SECRETKEY_Delete = "C1oxPguCjef6nV8a";

      $this->DHL_CLIENTID_Track  = "ntcARZzaSl2ZGoFjD3jYB38QCaLY4Tfw";
      $this->DHL_SECRETKEY_Track = "yPxOPsWcGA6R50RX";
  }
  public function getAccessToken($keys)
  {
    $response = $this->client->post($this->apiUrl.'/account/auth/ropc/v1/token', [
      'headers' => [
               'accept' => 'application/json',
              'content-type' => 'application/x-www-form-urlencoded'
      ],
      'form_params' => [
        'grant_type' => 'password',
        'username' => 'user-valid',
        'password' => $this->password,
        'client_id' => $keys['clientID'],
        'client_secret' => $keys['secretKey'],
    ]
  ]);
   return json_decode($response->getBody(), true);
  }
  

  
  public function CreateReturn($data)
  {
    $keys=[
      "clientID" => $this->DHL_CLIENTID_Return,
      "secretKey" => $this->DHL_SECRETKEY_Return,
      "Method" => 'POST'
    ];
    $baseurl=$this->apiUrl .'/shipping/returns/v1/orders';
    $response =$this->curl($keys,$baseurl,$data);
    $response=json_decode($response);
    //dd($response);
    return $response;
  }



public function createShipment($data)
  {
try{ 

$keys=[
"clientID" => $this->DHL_CLIENTID_Create,
"secretKey" => $this->DHL_SECRETKEY_Create,
"Method" => 'POST'
];
$baseurl=$this->apiUrl .'/shipping/v2/orders';
$response =$this->curl($keys,$baseurl,$data);
$response=json_decode($response);
return $response;
} catch (RequestException $e) {
// Handle HTTP request-related errors
Log::error('API error: ' . $e->getMessage());
return response()->json(['error' => 'Failed to fetch external data'], 500);
}
}
public function shipment_delete($data)
{
  $keys=[
    "clientID" => $this->DHL_CLIENTID_Delete,
    "secretKey" => $this->DHL_SECRETKEY_Delete,
    "Method" => 'DELETE',
  ];
  $baseurl=$this->apiUrl .'/shipping/v2/orders?profile=STANDARD_GRUPPENPROFIL&shipment='.$data['shipment'];
  // $baseurl=$this->apiUrl .'/shipping/v2/orders?';
  $response =$this->curl($keys,$baseurl,$data);
  $response=json_decode($response);
  return $response;
}
public function curl($keys,$baseurl,$data)
{
$accessToken=$this->getAccessToken($keys)['access_token'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => $baseurl,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_POST => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST =>$keys['Method'],
CURLOPT_POSTFIELDS =>$data,
CURLOPT_HTTPHEADER => array(
'content-type:application/json',
'Accept-Language:de-DE',
'Authorization:Bearer '.$accessToken,
),
));
$response = curl_exec($curl);
return $response;
}



}
