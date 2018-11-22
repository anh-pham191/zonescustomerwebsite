<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Accessory for Structure
 *
 * This file must be in your /system/third_party/structure directory of your ExpressionEngine installation
 *
 * @package             Structure for EE2 & EE3
 * @author              EEHarbor <help@eeharbor.com>
 * @copyright           Copyright (c) 2016 EEHarbor
 * @link                http://buildwithstructure.com
 */

require_once PATH_THIRD.'structure/eeharbor.php';
require_once PATH_THIRD.'structure/config.php';
require_once PATH_THIRD.'structure/mod.structure.php';

class Structure_acc
{

	var $name = STRUCTURE_NAME;
	var $id	= 'structure-acc';

	var $version = STRUCTURE_VERSION;

	var $description = 'Access your Structure Assets anywhere';
	var $sections = array();

	var $structure;
	var $installed = FALSE;
	var $data = array();

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->foundation = new \structure\EEHarbor;

	    if ( ! isset($this->cache['module_id_query']))
		{
			$results = ee()->db->query("SELECT module_id FROM exp_modules WHERE module_name = 'Structure'");
	    	$this->cache['module_id_query'] = $results;
		}

		if ($this->cache['module_id_query']->num_rows > 0)
			$this->installed = TRUE;

		if ($this->installed === FALSE)
			return;

		$this->structure = new Structure();
	}


	function set_sections()
	{
		if ($this->installed === FALSE)
		{
			$this->sections['Not Installed'] = "Structure is not installed.";
		} else {
			$this->sections['Assets'] = $this->get_assets();
		}
	}


	/**
	 * Get Assets
	 *
	 * @access	public
	 * @return	string
	 */
	function get_assets()
	{
		$data['theme_url'] = $this->foundation->getAddonThemesDir();
		$data['asset_data']	= $this->structure->get_structure_channels('asset');

		if ( ! is_array($data['asset_data']))
			$data['asset_data'] = array();

		$data['foundation'] = $this->foundation;

		return $this->foundation->view('accessory', $data, TRUE);
	}
}