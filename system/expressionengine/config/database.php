<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Include the master configuration helper file.
include_once APP_PATH.'/includes/master-config.php';

$active_group = 'expressionengine';
$active_record = TRUE;
$dbParameters = getDbParameters();

$db['expressionengine']['hostname'] = $dbParameters['hostname'];
$db['expressionengine']['database'] = $dbParameters['database'];
$db['expressionengine']['username'] = $dbParameters['username'];
$db['expressionengine']['password'] = $dbParameters['password'];
$db['expressionengine']['dbdriver'] = 'mysqli';
$db['expressionengine']['pconnect'] = FALSE;
$db['expressionengine']['dbprefix'] = 'exp_';
$db['expressionengine']['swap_pre'] = 'exp_';
$db['expressionengine']['db_debug'] = TRUE;
$db['expressionengine']['cache_on'] = FALSE;
$db['expressionengine']['autoinit'] = FALSE;
$db['expressionengine']['char_set'] = 'utf8';
$db['expressionengine']['dbcollat'] = 'utf8_general_ci';
$db['expressionengine']['cachedir'] = SYSTEM_PATH."expressionengine/cache/db_cache/";

/* End of file database.php */
/* Location: ./system/expressionengine/config/database.php */
