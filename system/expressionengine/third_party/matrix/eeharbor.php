<?php

// We can declare ee() in the global namespace here:
namespace {
	if(!function_exists('ee')) {
		function ee() {
			return get_instance();
		}
	}
}

namespace matrix {

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
	$addon_setup = require PATH_THIRD.'matrix/addon.setup.php';

	define('matrix\ADDON_AUTHOR', $addon_setup['author']);
	define('matrix\ADDON_AUTHOR_URL', $addon_setup['author_url']);
	define('matrix\ADDON_NAME', $addon_setup['name']);
	define('matrix\ADDON_DESC', $addon_setup['description']);
	define('matrix\ADDON_VER', $addon_setup['version']);

	// include the right helper, ext file, and upd file
	require_once PATH_THIRD.'matrix/helpers/eeharbor_ee' . substr($app_ver, 0, 1) . '_helper.php';
	require_once PATH_THIRD.'matrix/helpers/ext.eeharbor.php';
	require_once PATH_THIRD.'matrix/helpers/upd.eeharbor.php';
	require_once PATH_THIRD.'matrix/helpers/ft.eeharbor.php';

	class EEHarbor extends \matrix\EEHelper {
		function __construct()
		{
			$params = array("module" => "matrix", "module_name" => "Matrix");

			parent::__construct($params);
		}
	}
}