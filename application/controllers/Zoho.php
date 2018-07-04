<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Helper\Zoho\ZohoConnect;

class Zoho extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        //$zoho = ZohoConnect::connect();
        echo 'Zoho Connected';
	}

	public function getGrantCode()
	{
        $zoho = new ZohoConnect();
        $res = $zoho->getgetGrantCode();
        var_dump($res->getBody());
		echo 'Zoho Granted Code';
	}
}
