<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * Created by phpDesigner 8.1
 * Date  : 8/17/2013
 * Time  : 8:03:47 AM
 * Author: Raymond L King Sr. and Stephen Willis.
 * ------------------------------------------------------------------------
 *
 * Class	Pages	Controller
 *
 * ------------------------------------------------------------------------
 * @package		Package		Yoteyote
 * @subpackage	Subpackage	pages
 * @category	category	pages
 * @author		Raymond L King Sr.
 * @copyright	Copyright (c) 2009 - 2013, Custom Software Designers, LLC.
 * @link		http://www.example.com
 * ------------------------------------------------------------------------
 * To change this template use File | Settings | File Templates.
 * ------------------------------------------------------------------------
 */

class Pages extends Admin_Controller
{
	// -----------------------------------------------------------------------

	/**
	 * __construct()
	 *
	 * Constructor	PHP 5+
	 *
	 * NOTE: Not needed if not setting values or extending a Class.
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		modules::run('auth/restrict_user', 'admin');

		$this->load->model('mdl_pages', 'pages');
	}

	// --------------------------------------------------------------------

	/**
	 * manage()
	 *
	 * Manage the user database records.
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function manage($offset = '')
	{
		// Load the fx_pagination library.
		$this->load->library('fx_pagination');

		// Setup the record limit and get a total count of all table records.
		$limit = 10;
		$count = $this->pages->count_all();

		/**
		 * ----------------------------------------------------------------------
		 * FX Pagination Configuration.
		 * ----------------------------------------------------------------------
		 * The base_url and segment below must be set to the correct URL and the
		 * segment must be set to the correct segment number or it WILL NOT WORK!
		 * ----------------------------------------------------------------------
		 */
		$config = array(
			'base_url'      => base_url('pages/manage/'),
			'uri_segment'   => 3,
			'full_tag_open' => '<div id"content" class="text-center"><ul class="pagination pagination-sm page-manage">',
			'display_pages' => TRUE,
			'per_page'      => $limit,
			'total_rows'    => $count,
			'num_links'     => 4,
			'show_count'    => TRUE,
		);

		// Initialize the fx_pagination configuration.
		$this->fx_pagination->initialize($config);

		// Get the database records with limit and offset.
		$order_by  = 'id asc';
		$query = $this->pages->get_with_limit($limit, $offset, $order_by);

		// Setup the data array and display the view.
		$data = array(
			'data_grid'   => $query->result(),
			'pager_links' => $this->fx_pagination->create_links(),
			'view_file'   => 'manage',
		);

		$this->load->module('template');
		$this->template->render('admin_fluid_dashboard', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * add()
	 *
	 * Add a new user to the database table.
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function add()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules('page_title', 'Page Title', 'required');
		$this->form_validation->set_rules('page_keywords', 'Meta Keywords', 'required');
		$this->form_validation->set_rules('page_description', 'Meta Description', 'required');
		$this->form_validation->set_rules('page_status', 'Page Status', 'required');
		$this->form_validation->set_rules('page_content', 'Page Content', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$data = array(
				'view_file' => 'add',
			);

			$this->load->module('template');
			$this->template->render('admin_fluid_dashboard', $data);
		}

		// Add a new page.
		else
		{
			$data = array(
				'page_title'       => set_value('page_title'),
				'page_slug'        => url_title(set_value('page_title'), 'underscore', TRUE),
				'page_keywords'    => set_value('page_keywords'),
				'page_description' => set_value('page_description'),
				'page_created_at'  => set_now(),
				'page_updated_at'  => set_now(),
				'page_status'      => set_value('page_status'),
				'page_content'     => set_value('page_content'),
			);

			$this->pages->_insert($data);

			redirect('pages/manage');
		}
	}

	// --------------------------------------------------------------------

	/**
	 * edit()
	 *
	 * Description:
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function edit($id)
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules('page_title', 'Page Title', 'required');
		$this->form_validation->set_rules('page_keywords', 'Meta Keywords', 'required');
		$this->form_validation->set_rules('page_description', 'Meta Description', 'required');
		$this->form_validation->set_rules('page_status', 'Page Status', 'required');
		$this->form_validation->set_rules('page_content', 'Page Content', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$query = $this->pages->get_where(array('id' => $id));
			$row   = $query->row_array();

			// Set the page_status selected value.
			$data = array(
				'page_title'       => $row['page_title'],
				'page_slug'        => $row['page_slug'],
				'page_keywords'    => $row['page_keywords'],
				'page_description' => $row['page_description'],
				'page_status'      => $row['page_status'],
				'page_content'     => $row['page_content'],
				'selected_one'     => ($row['page_status'] == 'published') ? TRUE : FALSE,
				'selected_two'     => ($row['page_status'] == 'draft') ? TRUE : FALSE,
				'view_file'        => "edit",
			);

			$this->load->module('template');
			$this->template->render('admin_fluid_dashboard', $data);
		}

		// Update the page.
		else
		{
			$data_record = array(
				'page_title'       => set_value('page_title'),
				'page_slug'        => url_title(set_value('page_title'), 'underscore', TRUE),
				'page_keywords'    => set_value('page_keywords'),
				'page_description' => set_value('page_description'),
				'page_updated_at'  => set_now(),
				'page_status'      => set_value('page_status'),
				'page_content'     => set_value('page_content'),
			);

			$this->pages->_update(array('id' => $id), $data_record);

			$data = array(
				'module'    => 'pages',
				'view_file' => 'edit_success',
			);

			$this->load->module('template');
			$this->template->render('admin_fluid_dashboard', $data);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * delete()
	 *
	 * Description:
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function delete($id)
	{
		$this->pages->_delete(array('id' => $id));

		$data = array(
			'view_file' => 'delete_success',
		);

		$this->load->module('template');
		$this->template->render('admin_fluid_dashboard', $data);
	}

	// --------------------------------------------------------------------

	/**
	 * _check_allow_delete()
	 *
	 * @access	private
	 * @param	string
	 * @return	void
	 */
    private function _check_allow_delete($id)
    {
		$query = $this->pages->get_where(array('id' => $id));
		$row   = $query->row_array();

		return ($row->page_allow_delete == TRUE) ? TRUE : FALSE;
    }

	// -----------------------------------------------------------------------

	/**
	 * _is_special_url()
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	private function _is_special_url($search_value = NULL)
	{
		$special_urls = array(
			32 => 'homepage',
			31 => 'archives',
			23 => 'contactus',
			24 => 'Archives',
			25 => 'thankyou',
			33 => '404',
			36 => 'not-allowed',
			41 => 'Contact-Us',
		);

		if (is_null($search_value))
		{
			return FALSE;
		}

		foreach ($special_urls as $key => $value)
		{
			return ($search_value == $key OR $search_value == $value) ? TRUE : FALSE;
		}
	}

}	// End of Class.

/**
 * ------------------------------------------------------------------------
 * Filename: pages.php
 * Location: ./application/modules/pages/controllers/pages.php
 * ------------------------------------------------------------------------
 */