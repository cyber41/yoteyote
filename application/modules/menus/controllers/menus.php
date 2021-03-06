<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------------
 * Created by phpDesigner 8.1.2
 * Date  : 8/17/2013
 * Time  : 6:28:14 AM
 * Author: Raymond L King Sr.
 * ------------------------------------------------------------------------
 *
 * Class	Menus	Controller
 *
 * ------------------------------------------------------------------------
 * @package		Package		Yoteyote
 * @subpackage	Subpackage	menu
 * @category	category	menu
 * @author		Raymond L King Sr.
 * @copyright	Copyright (c) 2009 - 2012, Custom Software Designers, LLC.
 * @link		http://www.example.com
 * ------------------------------------------------------------------------
 * To change this template use File | Settings | File Templates.
 * ------------------------------------------------------------------------
 */

class Menus extends Auth_Controller
{
	/**
	 * -----------------------------------------------------------------------
	 * Class variables - public, private, protected and static.
	 * -----------------------------------------------------------------------
	 */


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

		// Load the Menu models.
		$this->load->model('mdl_menu', 'menu');
		$this->load->model('mdl_menuitem', 'menuitem');

		//$this->load->libaray('lib_menu');

		//log_message('debug', "Class Menu Controller Initialized");
	}

    // --------------------------------------------------------------------

    /**
     * build_menu()
     *
     * Description:
     *
     * builds the Dynaminc Menu System for Yoteyote.
     *
     * @param	string
     * @param	string
     * @return	string	-	$html_out using CodeIgniter anchor tags.
     */
    public function build_menu($menu, $menu_id)
    {
        $menus = array();

		//echo 'Build_Menu Method!'; exit;

		/**
		 * ----------------------------------------------
		 * Menu Types.	( 1, 2, etc; )
		 * ----------------------------------------------
		 * (1, 'Top Menu'),
		 * (2, 'Header Menu',
		 * (3, 'Sidebar Left Menu',
		 * (4, 'Sidebar Right Menu',
		 * (5, 'Slideout Left Menu',
		 * (6, 'Slideout Right Menu',
		 * (7, 'Footer Menu', 'footer_menu');
		 * ----------------------------------------------
		 */

        // use active record to get the database menu.
        $where     = array('menu_id' => $menu_id);
		$order_by  = 'menu_id asc';

        // Load the page model.
        $this->load->model('menus/mdl_menuitem', 'menuitem');

		//$rows = $this->db->get('menu_items');

		$rows = $this->menuitem->get_where(array('menu_id' => $menu_id));

		//var_debug($rows); exit;

		// Check to see if we have menu records.
        if ($rows)
        {
            $k  = 0;

			// Loop through and build the menu.
            foreach ($rows->result() as $row)
            {
                $menus[$k]['id']             = $row->id;              // The menuitem record id
                $menus[$k]['menu_id']        = $row->menu_id;         // The menuitem id
                $menus[$k]['menu_parent_id'] = $row->menu_parent_id;  // The menuitem parent id
                $menus[$k]['menu_name']      = $row->menu_name;       // The menuitem name
                $menus[$k]['menu_icon']      = $row->menu_icon;       // The menuitem icon
                $menus[$k]['menu_url']       = $row->menu_url;        // The menuitem url
                $menus[$k]['menu_link_type'] = $row->menu_link_type;  // The menuitem link type
                $menus[$k]['menu_is_parent'] = $row->menu_is_parent;  // The menuitem is a parent menu
                $menus[$k]['menu_is_sub']    = $row->menu_is_sub;     // The menuitem is a sub menu

                $k++;
            }
        }

		//var_debug($menus); exit;

        // ----------------------------------------------------------------------

        // now we will build the dynamic menus.

        $html_out  = "";

        /**
         * check $type for the type of menu to display.
         *
         * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
         */
        // return $menu;

        // loop through the $menu array() and build the parent menus.
        $menu_count = count($menus);

        for ($i = 0; $i < $menu_count; $i++)
        {
            if (is_array($menus[$i]))    // must be by construction but let's keep the errors home
            {
           	    // are we allowed to see this menu?
                if ($menus[$i]['menu_parent_id'] == 0)
                {
                    if ($menus[$i]['menu_is_parent'] == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "<li ".$this->p_avec_p.">".
							anchor("javascript:;", '<i class="'.$menus[$i]['menu_icon'].'"></i><span>'.$menus[$i]['menu_name'].'</span><b class="caret"></b>', $this->p_lien_e);
                    }
                    else
                    {
                        $html_out .= "<li ".$this->p_sans_p.">".
							anchor($menus[$i]['menu_url'], '<i class="'.$menus[$i]['menu_icon'].'"></i><span>'.$menus[$i]['menu_name'].'</span>');

                    }

                    // loop through and build all the child sub-menus.
                    $html_out .= $this->get_children($menus, $menus[$i]['menu_parent_id']);

                    //a chaque fin de ligne
                    $html_out .= '</li>'."\n";
                }
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $i));
            }
        }

        $html_out .= "".'' . "";

		//var_debug($html_out); exit;

        //return $html_out;
    }

     // --------------------------------------------------------------------

    /**
     * get_children($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child sub-menus using a recurse method call.
     *
     * @param    mixed     $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    private function get_children($menus, $menu_parent_id)
    {
        $has_subcats = TRUE;

        $html_out  = '<ul class="dropdown-menu">';
        $html_out .= "".''."";
        $html_out .= "".''."";

		$menu_count = count($menus);

        for ($i = 1; $i <= $menu_count; $i++)
        {
       	    // are we allowed to see this menu?
            if ($menus[$i]['menu_parent_id'] == $menu_parent_id)
            {
                $has_subcats = TRUE;

                if ($menus[$i]['menu_is_parent'] == TRUE)
                {

                    $html_out .= "<li ".$this->e_avec_p.">".anchor('javascript:;', ''.$menus[$i]['menu_name']).'';
                }
                else
                {
                    $html_out .= "<li ".$this->e_sans_p.">".anchor($menus[$i]['menu_url'], ''.$menus[$i]['menu_name']).'';
                }

                // Recurse call to get more child sub-menus.
                $html_out .= $this->get_children($menus, $menus[$i]['menu_parent_id']);

                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "</ul>".'' . "";

        return ($has_subcats) ? $html_out : FALSE;
    }

	// -----------------------------------------------------------------------

	/**
	 * manage_menu()
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    public function manage_menu()
    {

    }

	// -----------------------------------------------------------------------

	/**
	 * manage_menuitem()
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    public function manage_menuitem()
    {

    }

	// -----------------------------------------------------------------------

	/**
	 * menu_run()
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    public function menu_run($menu_name)
    {

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

/* ------------------------------------------------------------------------
 * Filename: menus.php
 * Location: ./application/modules/menus/controllers/menus.php
 * ------------------------------------------------------------------------
 */