<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * AB Pagination Extension
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Extension
 * @author		Bjørn Børresen
 * @link		http://www.addonbakery.com
 */

class Ab_pagination_ext {

	public $settings 		= array();
	public $description		= 'ExpressionEngine Pagination Fixed';
	public $docs_url		= 'http://wedoaddons.com/addon/ab-pagination/documentation';
	public $name			= 'AB Pagination';
	public $settings_exist	= 'y';
	public $version			= '1.6.7';

	private $EE;

	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = '')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;
	}

	// ----------------------------------------------------------------------

	/**
	 * Settings Form
	 *
	 * If you wish for ExpressionEngine to automatically create your settings
	 * page, work in this method.  If you wish to have fine-grained control
	 * over your form, use the settings_form() and save_settings() methods
	 * instead, and delete this one.
	 *
	 * @see http://expressionengine.com/user_guide/development/extensions.html#settings
	 */
	public function settings()
	{
		return array(
			'ab_pagination_tag_prefix' => array('i', '', 'abp_'),
            'ab_pagination_strict_urls' => array('r', array('y' => "Yes", 'n' => "No"), 'y'),
            'ab_pagination_enable_query_strings' => array('r', array('y' => "Yes", 'n' => "No"), 'n'),
		);
	}

	// ----------------------------------------------------------------------

	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://codeigniter.com/user_guide/database/index.html for
	 * more information on the db class.
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		// Setup custom settings in this array.
		$this->settings = array();

		$hooks = array(
            'template_post_parse' => 'on_template_post_parse',
		);


        if (version_compare(APP_VER, '2.8', '>=')) {
            $hooks['pagination_create']	= 'on_pagination_create';
        } else {
            // PRE 2.8.0 we hook onto channel_module_create_pagination
            $hooks['channel_module_create_pagination']	= 'on_pagination_create';
        }

		foreach ($hooks as $hook => $method)
		{
			$data = array(
				'class'		=> __CLASS__,
				'method'	=> $method,
				'hook'		=> $hook,
				'settings'	=> serialize($this->settings),
				'version'	=> $this->version,
				'enabled'	=> 'y'
			);

			ee()->db->insert('extensions', $data);
		}
	}

	// ----------------------------------------------------------------------


    /**
     *
     * This will only run in EE 2.4+
     *
     * @param $template
     * @param $sub
     * @param $site_id
     */

    public function on_template_post_parse($template, $sub, $site_id)
    {

       if($this->EE->extensions->last_call) {
            $template = $this->EE->extensions->last_call;
        }

        $tag_prefix = isset($this->settings['ab_pagination_tag_prefix']) ? $this->settings['ab_pagination_tag_prefix'] : 'abp_';
        $tag_name = $tag_prefix.'pagination_html';

        if(isset($this->EE->config->_global_vars[$tag_name])) {

            $pagination_html = $this->EE->config->_global_vars[$tag_name];

            $template = $this->EE->TMPL->advanced_conditionals(str_replace('{'.$tag_name.'}', $pagination_html, $template ));

            if(isset($this->EE->config->_global_vars[$tag_prefix.'_all_vars'])) {
                $all_vars = unserialize($this->EE->config->_global_vars[$tag_prefix.'_all_vars']);
                foreach($all_vars as $var_name => $var_value) {
                    if(!is_array($var_value)) {
                        $template = $this->EE->TMPL->advanced_conditionals(str_replace('{'.$var_name.'}', $var_value, $template ));
                    }
                }
            }
        } else {
            $template = $this->EE->TMPL->advanced_conditionals(str_replace('{'.$tag_name.'}', '', $template )); // if no entries, we clear the {abp_pagination_html} variable
        }

        return $template;
    }

	/**
	 * on_channel_module_create_pagination
	 *
	 * @param $ref reference to EE_Pagination class
     * @param count total_items
	 * @return
	 */
	public function on_pagination_create($ref, $count=FALSE)
	{
        $tag_prefix = isset($this->settings['ab_pagination_tag_prefix']) ? $this->settings['ab_pagination_tag_prefix'] : 'abp_';
        $ab_enable_query_strings = isset($this->settings['ab_pagination_enable_query_strings']) && $this->settings['ab_pagination_enable_query_strings'] == 'y';
        $this->EE->config->_global_vars[$tag_prefix.'pagination_html'] = '';
        $paginate_location = ee()->TMPL->fetch_param('paginate');


        $template_data_key = 'template_data';

        // stuff needed for PRE 2.8.0 installs
        if(version_compare(APP_VER, '2.8', '<')) {

            // for backwards compatibility with 2.3
            $pre_24 = version_compare(APP_VER, '2.4', '<');

            if($pre_24)
            {
                // pre 2.4.0 $ref->template_data was called paginate_data
                $template_data_key = 'paginate_data';

                if($ref->pager_sql == '')
                {
                    return;
                }

                $q = $this->EE->db->query($ref->pager_sql);
                $count  = (isset($q->num_rows)) ? $q->num_rows : false;
            }
            else
            {
                if(isset($ref->type) && $ref->type != 'Channel') {  // only channel entries pagination for now
                    return FALSE;
                }
            }

            if(!$count) {
                if(isset($ref->pager_sql) && $ref->pager_sql != '') // this was put back in in 2.5
                {
                    $q = $this->EE->db->query($ref->pager_sql);
                    $count  = (isset($q->num_rows)) ? $q->num_rows : false;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        // EOF stuff needed PRE 2.8.0

        $offset = (!ee()->TMPL->fetch_param('offset') OR !is_numeric(ee()->TMPL->fetch_param('offset'))) ? '0' : ee()->TMPL->fetch_param('offset');
        $count  = $count - $offset;
        $per_page = ee()->TMPL->fetch_param('limit', 100);
        $paginate_base = ee()->TMPL->fetch_param('paginate_base');

        $query_string = $_SERVER['QUERY_STRING'];
        $request_uri = $_SERVER['REQUEST_URI'];

        // Pre 2.6 the global 'enable_query_strings' could be set in the config but after 2.6 this will be reset to FALSE by EE.
        // So we've added our own setting for this here
        if(($ab_enable_query_strings || $this->EE->config->item('enable_query_strings')) && $query_string)
        {
            $query_string = '?'.$query_string;
            $request_uri = str_replace($query_string, '', $request_uri);
        }
        else
        {
            $query_string = '';     // empty it if we don't have enable_query_strings set
        }

        $qm = ($this->EE->config->item('force_query_string') == 'y') ? '?' : '';

        if($this->EE->config->item('index_page') != '' && strpos($request_uri,$this->EE->config->item('index_page').$qm.'/') !== FALSE)
        {
            $strip_index = $this->EE->config->item('index_page').$qm.'/';
            $current_uri_string = trim(str_replace($strip_index, '', $request_uri),'/');
        }
        else if($this->EE->config->item('index_page') != '' && strpos($request_uri,$this->EE->config->item('index_page').$qm) !== FALSE)
        {
            $strip_index = $this->EE->config->item('index_page').$qm;
            $current_uri_string = trim(str_replace($strip_index, '', $request_uri),'/');
        }
        else
        {
            $current_uri_string = trim($request_uri,'/');
        }

        /**
         * If we have "session ID only" enabled in the CP the currrent_uri_string will be prefixed with S=blabla. We
         * strip that out here (it will be added by EE later)
         */
        if(strpos($current_uri_string,'S=') === 0) {
            $current_uri_string = substr($current_uri_string, strpos($current_uri_string,'/')+1);
        }

        $current_uri_arr = explode('/', $current_uri_string);

        $last_segment = array_pop($current_uri_arr);
        /**
         * If we have a ? then we need to strip those get variables (last_segment will be e.g. P10?sort=order at this point)
         */
        $q_pos = strpos($last_segment,'?');
        if($q_pos) {
            $last_segment = substr($last_segment, 0, $q_pos);
        }

        $site_url_arr = explode('/', trim($this->EE->config->item('site_url'),'/'));

        if(count($current_uri_arr) > 0 && $current_uri_arr[0] == array_pop($site_url_arr))
        {
            $remove_segment = $current_uri_arr[0].'/';
            if(strpos($current_uri_string,$remove_segment) !== FALSE && strpos($current_uri_string,$remove_segment) == 0)
            {
                $current_uri_string = substr($current_uri_string, strlen($remove_segment));
            }
        }

        $current_page_num = 0;

        if(substr($last_segment,0,1) == 'P') // might be a pagination page indicator
        {
            $end = substr($last_segment, 1, strlen($last_segment));
            if ((preg_match( '/^\d*$/', $end, $matches) == 1))
            {
                $current_uri_string = substr($current_uri_string, 0, strrpos($current_uri_string,'/'));
                $current_page_num = $matches[0] / $per_page;
            }


        }

        if($current_page_num > ($count/$per_page)) {
            $ref->$template_data_key = '';
            if(isset($this->settings['ab_pagination_strict_urls']) && $this->settings['ab_pagination_strict_urls'] == 'y') {
                $ref->template_data = $this->EE->TMPL->parse($this->EE->TMPL->fetch_template('', '', FALSE));      // 404
            }

            return;
        }

        $this->EE->load->library('abpaginationlib');

        // in 2.9.3 $ref->template_data became an array (size=1) '0b916d15631a2e77fe7704f0bbd4dade' => string => '<div class="page-nav">
        $template_data_arr = array();
        if(version_compare(APP_VER, '2.9.2', '>') && is_array($ref->$template_data_key)) {
            $parsed_template = FALSE;

            foreach($ref->$template_data_key as $hash => $template_partial) {

                $parsed_template = $this->EE->abpaginationlib->render_pagination(
                    $tag_prefix,
                    $paginate_base,
                    $current_uri_string,
                    $count,
                    $per_page,
                    $current_page_num,
                    $query_string,
                    $paginate_location,
                    $template_partial
                );

                $template_data_arr[$hash] = $parsed_template;

            }
            $ref->template_data = $template_data_arr;

        } else {
            // pre 2.9.3 EE_Pagination->template_data was just a string
            $ref->$template_data_key = $this->EE->abpaginationlib->render_pagination(
                $tag_prefix,
                $paginate_base,
                $current_uri_string,
                $count,
                $per_page,
                $current_page_num,
                $query_string,
                $paginate_location,
                $ref->$template_data_key
            );

        }
	}

	// ----------------------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * This method removes information from the exp_extensions table
	 *
	 * @return void
	 */
	function disable_extension()
	{
		$this->EE->db->where('class', __CLASS__);
		$this->EE->db->delete('extensions');
	}

	// ----------------------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * This function performs any necessary db updates when the extension
	 * page is visited
	 *
	 * @return 	mixed	void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}

        if ($current < '1.6.4') {
            $this->EE->db->where('class', __CLASS__)->delete('extensions'); // remove any old hooks
            $this->activate_extension();    // activate extension again.
        }
	}	
	
	// ----------------------------------------------------------------------
}

/* End of file ext.ab_pagination.php */
/* Location: /system/expressionengine/third_party/ab_pagination/ext.ab_pagination.php */