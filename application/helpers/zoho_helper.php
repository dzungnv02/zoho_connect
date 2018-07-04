<?php
namespace Helper\Zoho;

class ZohoConnect {
  protected $client;
  public static function connect()
  {
    $this->client = new \GuzzleHttp\Client();
  }

  public function getgetGrantCode () {
    $endpoint = 'https://accounts.zoho.com/oauth/v2/auth?scope=ZohoCRM.modules.ALL&client_id=1000.A6WRD8GD1RQI14324L0PSMKXY88TRU&response_type=code&access_type=online&redirect_uri=https://zohoconnect.herokuapp.com/zohoconnected';
    $option = [
      'http_errors' => true
    ];
    $responseBody = $this->client->request('GET',$endpoint,$option);
    return $responseBody;
  }
}
?>
