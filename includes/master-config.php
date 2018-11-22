<?php
/**
 * Helper for the Consumer Website configuration.
 *
 * @package
 * @author		Traffic Development Team
 * @copyright
 * @license
 * @link
 * @since		  Version 1.0
 */

// DEFINE GLOBAL VARIABLES.

// Define the application root path.
define('APP_PATH', dirname(dirname(__FILE__)));

// Define the application root and the ee system root as global variables.
define('SYSTEM_PATH', APP_PATH.'/system/');

/**
 * Return all application paths. User by the config.php file.
 * All routes al relative to root folder ../
 *
 * @return Array (
 *  [base_url] => base_url
 *  [base_path] => base_path
 *  [system_path] => system_path
 *  [system_url] => system_url
 *  [themes_path] => themes_path
 *  [themes_url] => themes_url
 *  [images_path] => images_path
 *  [images_url] => images_url
 *  ['show_profiler'] => ''
 *  ['template_debugging'] => ''
 *  ['debug'] => ''
 *  ['disable_all_tracking'] => ''
 *  ['email_debug'] => ''
 *  ['autosave_interval_seconds'] => ''
 *  ['gzip_output'] => ''
 * )
 */
function getMasterConfig() {
  $localConfig = array();

  /* Set the URL base. */

//  $protocol = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") ? "https://" : "http://";
//  $clean_urls = array('zones.co.nz','www.zones.co.nz');
//
//  if ( in_array($_SERVER['SERVER_NAME'], $clean_urls) ) {
//    $localConfig['base_url'] = $protocol.$_SERVER['SERVER_NAME'];
//  } else {
//    $localConfig['base_url'] = $protocol.$clean_urls[0];
//  }

  $localConfig['base_url'] = 'http://zones.local';

  /* Set all system paths. */

  $localConfig['base_path']   = APP_PATH;

  $system_folder              = "system";
  $themes_folder              = "themes";
  $images_folder              = "images";

  $localConfig['system_path'] = $localConfig['base_path'] . "/" . $system_folder . "/";
  $localConfig['system_url']  = $localConfig['base_url'] . "/" . $system_folder . "/";
  $localConfig['themes_path'] = $localConfig['base_path'] . "/" . $themes_folder . "/";
  $localConfig['themes_url']  = $localConfig['base_url'] . "/" . $themes_folder . "/";
  $localConfig['images_path'] = $localConfig['base_path'] . "/" . $images_folder . "/";
  $localConfig['images_url']  = $localConfig['base_url'] . "/" . $images_folder . "/";
  $localConfig['log_path']    = SYSTEM_PATH."expressionengine/logs/";

  $localConfig['user_agent']  = $_SERVER['HTTP_USER_AGENT'];

  /* Debugging and Performance */

  $localConfig['show_profiler']             = 'n'; # y/n
  $localConfig['template_debugging']        = 'n'; # y/n
  $localConfig['debug']                     = '1'; # 0: no PHP/SQL errors shown. 1: Errors shown to Super Admins. 2: Errors shown to everyone.
  $localConfig['disable_all_tracking']      = 'y'; # y/n
  // $config['enable_sql_caching']           = 'n'; # Cache Dynamic Channel Queries?
  $localConfig['email_debug']               = 'n'; # y/n
  $localConfig['autosave_interval_seconds'] = '0'; # Disabling entry autosave
  $localConfig['gzip_output']               = 'n'; # y/n. NO because is causing issues when rendering pages.

  // print_r($localConfig); exit(1);

  return $localConfig;
}

/**
 * Function to retrieve the database connection parameters
 * depending of the current host.
 *
 * @return Array (
 *  [hostname] => mysqlhost
 *  [database] => database
 *  [username] => username
 *  [password] => password
 * )
 */
function getDbParameters() {
  $dbParameters = array();

    $dbParameters['hostname'] = 'localhost';
    $dbParameters['database'] = 'zones';
    $dbParameters['username'] = 'root';
    $dbParameters['password'] = '';

  return $dbParameters;
}

?>
