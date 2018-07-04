<?php
namespace Helper\Zoho;

class ZohoConnect {
  protected $client;
  public static function connect(){}

  public function getgetGrantCode () {
    $this->client = new \GuzzleHttp\Client([
        'base_uri' => 'https://accounts.zoho.com',
        'timeout'  => 2.0,
    ]);
    $option = [
      'http_errors' => true,
      'query' => [
        'scope' => 'ZohoCRM.modules.ALL',
        'client_id' => '1000.A6WRD8GD1RQI14324L0PSMKXY88TRU',
        'response_type' => 'code',
        'access_type' => 'online',
        'redirect_uri' => 'https://zohoconnect.herokuapp.com/zohoconnected'
      ]
    ];
    $responseBody = $this->client->request('GET','/oauth/v2/auth',$option);
    return $responseBody;
  }
}
?>
