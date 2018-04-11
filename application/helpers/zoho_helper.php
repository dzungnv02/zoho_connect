<?php
namespace Helper\Zoho;

class ZohoConnect {
  protected static $client;
  public static function connect()
  {
    $client = new \GuzzleHttp\Client();
    echo 'Connected!';
  }
}
?>
