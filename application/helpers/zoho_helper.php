<?php
namespace Helper\Zoho;
class ZohoConnect {
  protected static $client;
  public static function connect()
  {
    self::$client = new \GuzzleHttp\Client();
    echo 'Connected!';
  }
}
?>
