<?php

	if (! defined('PLAYA_NAME'))
	{
		define('PLAYA_NAME', 'Playa');
		define('PLAYA_VER',  '5.1.2');
		define('PLAYA_DESC', 'The proverbial multiple relationships field');
		define('PLAYA_DOCS', 'https://eeharbor.com/playa/documentation');
	}

	return array(
		'name'        => PLAYA_NAME,
		'version'     => '5.1.2',
		'description' => PLAYA_DESC,
		'namespace'   => 'Playa',
		'author'      => 'EEHarbor',
		'author_url'  => 'https://eeharbor.com/playa',
		'docs_url'    => PLAYA_DOCS,
		'settings_exist' => false,
		'fieldtypes' => array(
		  'playa' => array(
		    'name' => 'Playa'
		  )
		)
	);