<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * Editor  : phpDesigner 8.1.2
 * Date    : 11/28/2013
 * Time    : 7:43:19 AM
 * Authors : Raymond L King Sr.
 * ------------------------------------------------------------------------
 *
 * Class	Name
 *
 * ------------------------------------------------------------------------
 * To change this template use File | Settings | File Templates.
 * ------------------------------------------------------------------------
 */

// ------------------------------------------------------------------------

/**
 * set_page_data()
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_page_data'))
{
    function set_page_data($page)
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
			    'description'   => 'YoteyoteUI is a Premium Web App and Admin Template',
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
			    'active_page'   => current_url($page),  // To get the CI current page.
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
        		'name'  => (user_group('admin')) ? 'Dashboard' : 'Profile',
		        'url'   => (user_group('admin')) ? base_url('dashboard') : base_url('profile'),
        		'icon'  => 'fa fa-coffee'
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
}

// ------------------------------------------------------------------------

/**
 * set_admin_data()
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_admin_data'))
{
    function set_admin_data($page)
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
}

// ------------------------------------------------------------------------

/**
 * set_user_data()
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_user_data'))
{
    function set_user_data($page)
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
        		'name'  => (user_group('user')) ? 'Profile' : 'Home',
		        'url'   => (user_group('user')) ? base_url('profile') : base_url('/'),
        		'icon'  => 'fa fa-coffee'
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
		        'url'   => base_url('login'),
        		'icon'  => 'fa fa-power-off'
		    )
		);

		return $data;
    }
}


// ------------------------------------------------------------------------

/**
 * Helper Name
 *
 * Usage:
 *
 * @access	public
 * @param	array
 * @return	mixed	depends on what the array contains
 *//*
if ( ! function_exists(''))
{
	function helper_name()
	{


	}
}
*/

/**
 * ------------------------------------------------------------------------
 * End of file name_helper.php
 * Location: ./application/helpers/name_helper.php
 * ------------------------------------------------------------------------
 */