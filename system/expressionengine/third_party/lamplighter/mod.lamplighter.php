<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Lamplighter Module Front End File
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Module
 * @author		Masuga Design
 * @link
 */
class Lamplighter
{

	public $return_data;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		//
	}

	/**
	 * This method is a module action that handles all requests made
	 * to the add-on from the Lamplighter app.
	 */
	public function api_request()
	{
		header('Access-Control-Allow-Origin: *');
		ee()->load->add_package_path( PATH_THIRD.'lamplighter/' );
		ee()->load->library('lamplighter_library');
		$api_endpoint = ee()->input->get('api', true);
		header('Content-Type: application/json');
		exit( json_encode(ee()->lamplighter_library->api_request($api_endpoint)) );
	}

}
