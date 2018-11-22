<?php if (! defined('BASEPATH')) exit('Invalid file request');

include_once('eeharbor.php');

/**
 * Playa Module CP Class for ExpressionEngine 2 & 3
 *
 * @package		Playa
 * @author		Tom Jaeger <Tom@EEHarbor.com>
 * @copyright	Copyright (c) 2016, Tom Jaeger/EEHarbor
 */
class Playa_mcp {

	/**
	 * Constructor
	 */
	function __construct()
	{

		// -------------------------------------------
		//  Load the helper
		// -------------------------------------------
		$this->foundation = new \playa\EEHarbor;

		if (! class_exists('Playa_Helper'))
		{
			require_once PATH_THIRD.'playa/helper.php';
		}

		$this->helper = new Playa_Helper();
	}

	// --------------------------------------------------------------------

	/**
	 * Filter Entries
	 */
	function filter_entries()
	{
		if (! isset($_POST['field_id']) || ! isset($_POST['field_name'])) exit('Invalid input data');

		$_POST['field_name'] = preg_replace('/[^a-z0-9\-_\[\]]/i', '', $_POST['field_name']);

		// -------------------------------------------
		//  Main params
		// -------------------------------------------

		$params = array();

		$params['show_expired'] = (ee()->input->post('expired') == 'y' ? 'yes' : '');
		$params['show_future_entries'] = (ee()->input->post('future') == 'y' ? 'yes' : '');
		$params['only_show_editable_entries'] = (ee()->input->post('editable') == 'y' ? 'yes' : '');

		if (isset($_POST['site']))          $params['site_id']       = ee()->input->post('site');
		if (isset($_POST['channel']))       $params['channel_id']    = ee()->input->post('channel');
		if (isset($_POST['category']))      $params['category']      = ee()->input->post('category');
		if (isset($_POST['author']))        $params['author_id']     = ee()->input->post('author');
		if (isset($_POST['member_groups'])) $params['member_groups'] = ee()->input->post('member_groups');
		if (isset($_POST['status']))        $params['status']        = ee()->input->post('status');
		if (isset($_POST['keywords']))      $params['keywords']      = ee()->input->post('keywords');

		// -------------------------------------------
		//  Limit or Order
		// -------------------------------------------

		if (isset($_POST['limit']) && $_POST['limit'])
		{
			$params['orderby'] = 'entry_date';
			$params['sort'] = (ee()->input->post('limitby') == 'newest') ? 'DESC' : 'ASC';
			$params['limit'] = ee()->input->post('limit');
		}
		else
		{
			if (isset($_POST['orderby'])) $params['orderby'] = ee()->input->post('orderby');
			if (isset($_POST['sort'])) $params['sort'] = ee()->input->post('sort');
		}

		// -------------------------------------------
		//  Get the entries
		// -------------------------------------------

		$entries = $this->helper->entries_query($params);

		if ($entries)
		{
			// -------------------------------------------
			//  post-query ordering
			// -------------------------------------------

			if (isset($_POST['limit']))
			{
				$this->helper->sort_entries($entries, ee()->input->post('sort'), ee()->input->post('orderby'));
			}

			// -------------------------------------------
			//  Create the list and return
			// -------------------------------------------

			$field_id = $_POST['field_id'];
			$field_name = $_POST['field_name'];

			$selected_entry_ids = isset($_POST['selected_entry_ids']) && is_array($_POST['selected_entry_ids'])
				? $_POST['selected_entry_ids']
				: array();

			$r = ee()->load->view('droppanes_options_list', array(
				'field_id'           => $field_id,
				'field_name'         => $field_name,
				'entries'            => $entries,
				'selected_entry_ids' => $selected_entry_ids
			), TRUE);
		}
		else
		{
			$r = '';
		}

		exit($this->helper->strip_whitespace($r));
	}

}
