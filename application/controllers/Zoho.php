<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Helper\Zoho\ZohoCrmConnect;

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
		$zoho = new ZohoCrmConnect();
		$lead = $zoho->getRecordById('Leads','2672639000000206003');
		var_dump($lead->id);
		var_dump($lead->Email);
	}

	public function insertLead () {
		$record = new \stdClass;
		$lead = new \stdClass;
		$lead->Last_Name = 'Test 1';
		$lead->First_Name = 'User';
		$lead->Company = 'i3 Viet Nam';
		$lead->Email = 'test1@i3vietnam.com';
		$lead->Phone = '0988765453';
		$lead->api_name = 'Leads';
		$record->data = [$lead];
		$record->trigger = ["approval"];

		$zoho = new ZohoCrmConnect();
		$inserted = $zoho->insertRecord('Leads', $record);
		var_dump($inserted);
	}

	public function getGrantCode()
	{

		echo 'Zoho Granted Code';
	}
}
