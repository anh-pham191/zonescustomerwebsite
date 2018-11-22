<?php

// We can declare ee() in the global namespace here:
namespace {
	if(!function_exists('ee')) {
		function ee() {
			return get_instance();
		}
	}
}

namespace structure {

	/**
	 * EEHarbor foundation
	 *
	 * Bridges the functionality gaps between EE versions.
	 * This file namespaces, and dynamically loads the correct version of the EE helper
	 *
	 * @package			eeharbor_helper
	 * @version			1.4.3
	 * @author			Tom Jaeger <Tom@EEHarbor.com>
	 * @link			https://eeharbor.com
	 * @copyright		Copyright (c) 2016, Tom Jaeger/EEHarbor
	 */

	if(defined('APP_VER')) $app_ver = APP_VER;
	else $app_ver = ee()->config->item('app_version');

	// Pull our addon.setup.php file and define some namespaced constants because DRY.
	$addon_setup = require PATH_THIRD.'structure/addon.setup.php';

	define('structure\ADDON_AUTHOR', $addon_setup['author']);
	define('structure\ADDON_AUTHOR_URL', $addon_setup['author_url']);
	define('structure\ADDON_NAME', $addon_setup['name']);
	define('structure\ADDON_DESC', $addon_setup['description']);
	define('structure\ADDON_VER', $addon_setup['version']);

	// include the right helper, ext file, and upd file
	require_once PATH_THIRD.'structure/helpers/eeharbor_ee' . substr($app_ver, 0, 1) . '_helper.php';
	require_once PATH_THIRD.'structure/helpers/ext.eeharbor.php';
	require_once PATH_THIRD.'structure/helpers/upd.eeharbor.php';
	require_once PATH_THIRD.'structure/helpers/ft.eeharbor.php';

	class EEHarbor extends \structure\EEHelper {
		function __construct()
		{
			$params = array("module" => "structure", "module_name" => "Structure");

			parent::__construct($params);
		}
	}
}