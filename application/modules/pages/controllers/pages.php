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
		$data = $this->set_admin_data('dashboard');

		$data['data_grid']   = $query->result();
		$data['pager_links'] = $this->fx_pagination->create_links();
		$data['view_file']   = 'pages_manage';

		$this->load->view('pages', $data);
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

	// ------------------------------------------------------------------------

	/**
	 * set_admin_data()
	 *
	 * @access	public
	 * @param	string
	 * @return	mixed
	 */
	public function set_admin_data($page)
    {
    	/**
    	 * -------------------------------------------------------------------
		 * The FreshUI Main Configuration data array.
		 * -------------------------------------------------------------------
		 */

		$data = array(
			'template' => array(
    			'name'          => 'Yoteyote',
			    'version'       => '1.0',
			    'author'        => 'Yoteyote',
			    'title'         => 'YoteyoteUI - Premium Web App and Admin Template',
			    'description'   => 'YoteyoteUI is a Premium Web App and Admin Template.',
				'keywords'      => 'Yoteyote',

			    // ''               empty to remove full width from the page (< 992px: 100%, > 992px: 95%, 1440px max width)
			    // 'full-width'     for a full width page (100%, 1920px max width)
			    'page'          => 'full-width',

			    // 'navbar-default' for a light header
			    // 'navbar-inverse' for a dark header
			    'header_navbar' => 'navbar-default',

			    // 'navbar-fixed-top'     for a top fixed header
			    // 'navbar-fixed-bottom'  for a bottom fixed header
			    'header'        => 'navbar-fixed-top',

			    // ''                  left sidebar will open only from the top left toggle button (better website performance)
			    // 'enable-hover'      will make a small portion of left sidebar visible, so that it can be opened with a mouse hover (> 1200px) (may affect website performance)
			    'sidebar_left'  => 'enable-hover',

			    // ''                  right sidebar will open only from the top right toggle button (better website performance)
			    // 'enable-hover'      will make a small portion of right sidebar visible, so that it can be opened with a mouse hover (> 1200px) (may affect website performance)
			    'sidebar_right'  => '',

			    // ''                                            empty for default behavior
			    // 'sidebar-left-pinned'                         for a left pinned sidebar (always visible > 1200px)
			    // 'sidebar-right-pinned'                        for a right pinned sidebar (always visible > 1200px)
			    // 'sidebar-left-pinned sidebar-right-pinned'    for both sidebars pinned (always visible > 1200px)
			    'navigation'    => '',

			    // All effects apply in resolutions larger than 1200px width
			    // 'fx-none'           remove all effects from main content when one of the sidebars are open (better website performance)
			    // 'fx-opacity'        opacity effect
			    // 'fx-move'           move effect
			    // 'fx-push'           push effect
			    // 'fx-rotate'         rotate effect
			    // 'fx-push-move'      push-move effect
			    // 'fx-push-rotate'    push-rotate effect
			    'content_fx'    => 'fx-opacity',

			    //  Available themes: 'river', 'amethyst' , 'dragon', 'emerald', 'grass' or '' leave empty for the default fresh orange
			    'theme'         => 'dragon',
			    //'theme'         => $this->input->cookie('theme_cookie', TRUE),

			    //'active_page'   => basename($_SERVER['PHP_SELF']),
			    'active_page'   => current_url($page),	// To get the CI current page.
			),
		);

		// ----------------------------------------------------------------------

		/**
		 * ----------------------------------------------------------------------
		 * This data is for the Main navigation menus.
		 * ----------------------------------------------------------------------
		 */

		$data['primary_nav'] = array(
		    array(
        		'name'  => 'Welcome',
		        'url'   => 'header'
		    ),
		    array(
        		'name'  => (user_group('admin')) ? 'Dashboard' : 'Home',
		        'url'   => (user_group('admin')) ? base_url('dashboard') : base_url('/'),
        		'icon'  => 'fa fa-coffee'
		    ),
		    array(
        		'name'  => 'Manage',
		        'url'   => 'header',
		    ),
		    array(
        		'name'  => 'Users',
		        'icon'  => 'fa fa-rocket',
        		'sub'   => array(
		            array(
    		            'name'  => 'Users',
        		        'url'   => base_url('users/manage'),
            		),
		        )
    		),
		    array(
	        	'name'  => 'Pages',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Pages',
		                'url'   => base_url('pages/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Group',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Group',
		                'url'   => base_url('group/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Groups',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Groups',
		                'url'   => base_url('groups/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'I Want',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'I Want',
		                'url'   => base_url('iwant/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'I Will',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'I Will',
		                'url'   => base_url('iwill/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Logs',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Logs',
		                'url'   => base_url('logs/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Menus',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Menus',
		                'url'   => base_url('menus/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Profiles',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Profiles',
		                'url'   => base_url('profiles/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Settings',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Settings',
		                'url'   => base_url('settings/manage'),
        		    ),
		        )
		    ),
		    array(
	        	'name'  => 'Widgets',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Widgets',
		                'url'   => base_url('widgets/manage'),
        		    ),
		        )
		    ),
		    array(
        		'name'  => 'User Interface',
		        'url'   => 'header',
		    ),
		    array(
        		'name'  => 'Elements',
		        'icon'  => 'fa fa-rocket',
        		'sub'   => array(
		            array(
    		            'name'  => 'Typography',
        		        'url'   => base_url('home/page_elements_typography'),
            		),
	            	array(
    	            	'name'  => 'Blocks - Grid',
	        	        'url'   => base_url('home/page_elements_blocks_grid'),
    	        	),
	    	        array(
    	    	        'name'  => 'Navigation - Extras',
        	    	    'url'   => base_url('home/page_elements_navigation_extras'),
	            	),
		            array(
    		            'name'  => 'Buttons - Dropdowns',
        		        'url'   => base_url('home/page_elements_buttons_dropdowns'),
            		),
		            array(
    		            'name'  => 'Progress - Loading',
        		        'url'   => base_url('home/page_elements_progress_loading'),
            		)
		        )
    		),
		    array(
	        	'name'  => 'Tables',
    		    'icon'  => 'fa fa-th',
		        'sub'   => array(
        		    array(
                		'name'  => 'Styles',
		                'url'   => base_url('home/page_tables_styles'),
        		    ),
		            array(
        		        'name'  => 'Datatables',
                		'url'   => base_url('home/page_tables_datatables'),
		            ),
        		    array(
                		'name'  => 'Editable',
		                'url'   => base_url('home/page_tables_editable'),
        		    )
		        )
		    ),
		    array(
        		'name'  => 'Forms',
		        'icon'  => 'fa fa-pencil-square-o',
        		'sub'   => array(
		            array(
        		        'name'  => 'General',
		                'url'   => base_url('home/page_forms_general'),
        		    ),
		            array(
        		        'name'  => 'Components',
                		'url'   => base_url('home/page_forms_components'),
		            ),
        		    array(
                		'name'  => 'Validation',
		                'url'   => base_url('home/page_forms_validation'),
        		    ),
		            array(
        		        'name'  => 'Wizard',
                		'url'   => base_url('home/page_forms_wizard'),
		            )
        		)
		    ),
		    array(
        		'name'  => 'Icon Packs',
		        'icon'  => 'fa fa-gift',
        		'sub'   => array(
		            array(
        		        'name'  => 'Font Awesome',
                		'url'   => base_url('home/page_icons_fontawesome'),
		            ),
        		    array(
                		'name'  => 'Glyphicons Pro',
		                'url'   => base_url('home/page_icons_glyphicons_pro'),
        		    )
		        )
		    ),
		    array(
        		'name'  => 'Extras',
		        'url'   => 'header',
		    ),
		    array(
        		'name'  => 'Components',
		        'icon'  => 'fa fa-gear',
        		'sub'   => array(
		            array(
						'name'  => 'Animations',
		                'url'   => base_url('home/page_comp_animations'),
        		    ),
		            array(
        		        'name'  => 'Carousel',
                		'url'   => base_url('home/page_comp_carousel'),
		            ),
        		    array(
                		'name'  => 'Gallery',
		                'url'   => base_url('home/page_comp_gallery'),
        		    ),
		            array(
        		        'name'  => 'Calendar',
                		'url'   => base_url('home/page_comp_calendar'),
		            ),
        		    array(
                		'name'  => 'Charts',
		                'url'   => base_url('home/page_comp_charts'),
        		    ),
		            array(
        		        'name'  => 'Syntax Highlighting',
                		'url'   => base_url('home/page_comp_syntax_highlighting'),
		            ),
        		    array(
                		'name'  => 'Maps',
		                'url'   => base_url('home/page_comp_maps'),
        		    )
		        )
		    ),
		    array(
        		'name'  => 'Pages',
		        'icon'  => 'fa fa-file',
        		'sub'   => array(
		            array(
        		        'name'  => 'Blank',
                		'url'   => base_url('home/page_ready_blank'),
		            ),
        		    array(
                		'name'  => '404 Error',
		                'url'   => base_url('home/page_ready_404'),
        		    ),
		            array(
        		        'name'  => 'Search Results',
                		'url'   => base_url('home/page_ready_search_results'),
		            ),
        		    array(
                		'name'  => 'Pricing Tables',
		                'url'   => base_url('home/page_ready_pricing_tables'),
        		    ),
		            array(
        		        'name'  => 'FAQ',
                		'url'   => base_url('home/page_ready_faq'),
		            ),
        		    array(
                		'name'  => 'Invoice',
		                'url'   => base_url('home/page_ready_invoice'),
        		    ),
		            array(
        		        'name'  => 'Article',
                		'url'   => base_url('home/page_ready_article'),
		            ),
        		    array(
                		'name'  => 'Forum',
		                'url'   => base_url('home/page_ready_forum'),
        		    )
		        )
		    ),
		    array(
		        'name'  => '3 Level Menu',
        		'icon'  => 'glyphicon-tint',
		        'sub'   => array(
        		    array(
                		'name'  => 'Link 1',
		                'url'   => '#'
        		    ),
		            array(
        		        'name'  => 'Submenu 1',
                		'sub'   => array(
		                    array(
        		                'name'  => 'Link',
                		        'url'   => '#'
		                    ),
        		            array(
                		        'name'  => 'Link',
                        		'url'   => '#'
		                    ),
        		            array(
                		        'name'  => 'Link',
                        		'url'   => '#'
		                    )
        		        )
		            ),
        		    array(
                		'name'  => 'Link 2',
		                'url'   => '#'
        		    ),
		            array(
        		        'name'  => 'Submenu 2',
                		'sub'   => array(
		                    array(
        		                'name'  => 'Link',
                		        'url'   => '#'
		                    ),
        		            array(
                		        'name'  => 'Link',
                        		'url'   => '#'
		                    )
        		        )
		            )
        		)
		    ),
		    array(
        		'name'  => 'Special',
		        'url'   => 'header',
		    ),
		    array(
        		'name'  => 'Timeline',
		        'url'   => base_url('home/page_special_timeline'),
        		'icon'  => 'fa fa-clock-o'
		    ),
		    array(
        		'name'  => 'User Profile',
		        'url'   => base_url('home/page_special_user_profile'),
        		'icon'  => 'fa fa-pencil-square'
		    ),
		    array(
        		'name'  => 'Message Center',
		        'url'   => base_url('home/page_special_message_center'),
		        'icon'  => 'fa fa-envelope-o'
		    ),
		    array(
        		'name'  => 'Yoteyote Page',
		        'url'   => base_url('home/page_ready_yoteyote_blank'),
		        'icon'  => 'fa fa-envelope-o'
		    ),
		    array(
        		'name'  => 'Login &amp; Register',
		        //'url'   => base_url('home/page_special_login'),
		        'url'   => base_url('login'),
        		'icon'  => 'fa fa-power-off'
		    )
		);

		return $data;
    }

}	// End of Class.

/**
 * ------------------------------------------------------------------------
 * Filename: pages.php
 * Location: ./application/modules/pages/controllers/pages.php
 * ------------------------------------------------------------------------
 */