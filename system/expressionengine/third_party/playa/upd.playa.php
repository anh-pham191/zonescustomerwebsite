<?php if (! defined('BASEPATH')) exit('Invalid file request');

include_once('eeharbor.php');

if (! defined('PATH_THIRD')) define('PATH_THIRD', EE_APPPATH.'third_party/');
require_once PATH_THIRD.'playa/addon.setup.php';


/**
 * Playa Update Class for ExpressionEngine 2 & 3
 *
 * @package		Playa
 * @author		Tom Jaeger <Tom@EEHarbor.com>
 * @copyright	Copyright (c) 2016, Tom Jaeger/EEHarbor
 */
class Playa_upd {

	var $version = PLAYA_VER;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->foundation = new \playa\EEHarbor;
	}

	// --------------------------------------------------------------------

	/**
	 * Install
	 */
	function install()
	{
		ee()->db->insert('modules', array(
			'module_name'        => 'Playa',
			'module_version'     => PLAYA_VER,
			'has_cp_backend'     => 'n',
			'has_publish_fields' => 'n'
		));

		ee()->db->insert('actions', array(
			'class'  => 'Playa_mcp',
			'method' => 'filter_entries'
		));

		return TRUE;
	}

	/**
	 * Uninstall
	 */
	function uninstall()
	{
		ee()->db->where('module_name', 'Playa')->delete('modules');
		ee()->db->where('class', 'Playa_mcp')->delete('actions');

		return TRUE;
	}

    function update($current = '')
    {
    	// Same version. Don't do anything.
        if (version_compare($current, PLAYA_VER, '='))
        {
            return FALSE;
        }

    	// If EE version is 3 or later, add field_wide to the settings
    	if(! $this->foundation->is_ee2())
    	{
			// Update fields
			$fields = ee('Model')->get('ChannelField')->filter('field_type', '==', 'playa')->all();

			foreach ($fields as $field)
			{
				/**
				 * @var EllisLab\ExpressionEngine\Model\Channel\ChannelField $field
				 */
				$fieldSettings = $field->field_settings;
				$fieldSettings['field_wide'] = true;

				$field->field_settings = $fieldSettings;
				$field->save();
			}
		}

        return TRUE;
    }

}
