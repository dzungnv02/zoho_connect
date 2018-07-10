<?php
namespace Helper\Zoho;

if (!defined('ZOHO_APP_REFRESH_CODE')) define('ZOHO_APP_REFRESH_CODE', '1000.79d14d8ab6ca250fa2d222ab10995a7d.a8ee5718937e9a6dca918f3aa63be949');
if (!defined('ZOHO_APP_CLIENT_ID')) define('ZOHO_APP_CLIENT_ID', '1000.A6WRD8GD1RQI14324L0PSMKXY88TRU');
if (!defined('ZOHO_APP_CLIENT_SECRET')) define('ZOHO_APP_CLIENT_SECRET', '0fb497a88dae0583b1177f03b669d104a70ba6a414');


class ZohoCrmConnect {
  protected $zoho_account_client;
  protected $zoho_crm_client;

  const ZOHO_ACCOUNT_BASE_URL = 'https://accounts.zoho.com';
  const ZOHO_CRM_BASE_URL = 'https://www.zohoapis.com';

  public function __construct () {
    $this->connect();
  }

  private function connect(){
    $this->zoho_account_client = new \GuzzleHttp\Client([
        'base_uri' => self::ZOHO_ACCOUNT_BASE_URL,
        'timeout'  => 2.0,
    ]);

    $this->zoho_crm_client = new \GuzzleHttp\Client([
      'base_uri' => self::ZOHO_CRM_BASE_URL,
      'timeout'  => 2.0,
    ]);
  }

  public function getAccessToken () {
    $options = [
      'http_errors' => true,
      'query' => [
        'refresh_token' => ZOHO_APP_REFRESH_CODE,
        'client_id' => ZOHO_APP_CLIENT_ID,
        'client_secret' => ZOHO_APP_CLIENT_SECRET,
        'grant_type' => 'refresh_token',
      ]
    ];

    $response = $this->zoho_account_client->request('POST','/oauth/v2/token',$options);
    if ($response->getStatusCode() == 200) {
      $data = json_decode($response->getBody());
      return $data;
    }
    else {
      return false;
    }
  }

  public function getAllRecords($module) {
    $records = [];
    if ($module !== '') {
      $uri = '/crm/v2/'.$module;
      $access_token = $this->getAccessToken();

      $options = [
        'http_errors' => true,
        'headers' => [
          'Authorization' => 'Zoho-oauthtoken '. $access_token->access_token
        ]
      ];

      $response = $this->zoho_crm_client->request('GET', $uri, $options);
      if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody());
        $records = $data->data;
        return $records;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }
  }

  public function getRecordById($module, $id) {
    $record = [];
    if ($module !== '' && $id !== '') {
      $uri = '/crm/v2/'.$module.'/'.$id;
      $access_token = $this->getAccessToken();

      $options = [
        'http_errors' => true,
        'headers' => [
          'Authorization' => 'Zoho-oauthtoken '. $access_token->access_token
        ]
      ];

      $response = $this->zoho_crm_client->request('GET', $uri, $options);
      if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody());
        $record = $data->data[0];
        return $record;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }    
  }

  public function search($module, $field, $value) {
    $records = [];
    if ($module !== '' && $id !== '') {
      $uri = '/crm/v2/'.$module.'/search';
      $access_token = $this->getAccessToken();

      $options = [
        'http_errors' => true,
        'query' => [
          $field => $value
        ],
        'headers' => [
          'Authorization' => 'Zoho-oauthtoken '. $access_token->access_token
        ]
      ];

      $response = $this->zoho_crm_client->request('GET', $uri, $options);
      if ($response->getStatusCode() == 200) {
        $data = json_decode($response->getBody());
        $records = $data->data;
        return $records;
      }
      else {
        return false;
      }
    }
    else {
      return false;
    }   
  }

  public function searchRecordByEmail($module, $email) {
    return $this->search($module,'email', $email);   
  }

  public function searchRecordByPhone($module, $phone) {
    return $this->search($module,'phone', $phone);   
  }

  public function insertRecord($module, $data) {
    if ($module !== '' && $data !== null) {
      $uri = '/crm/v2/'.$module;
      $access_token = $this->getAccessToken();

      $options = [
        'http_errors' => true,
        'json' => $data,
        'headers' => [
          'Authorization' => 'Zoho-oauthtoken '. $access_token->access_token
        ]
      ];
        $response = $this->zoho_crm_client->request('POST', $uri, $options);
        if ($response->getStatusCode() == 201) {
          $data = json_decode($response->getBody());
          $record = $data->data[0];
          return $record;
        }
        else {
          return false;
        }
    }
    else {
      return false;
    }  
  }

}
?>
