<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// --------------------------------------------------------------------

/**
 * bread_crumbs()
 *
 * Display's a list of bread crumbs in the current page.
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('bread_crumbs'))
{
	function bread_crumbs()
	{
		$html = '';
        $html = '<li><i class="fa fa-file-o"></i></li>'."\n";

		$i = 1;

		$_ci = get_instance();

		// Get all the uri segments.
		$segs = $_ci->uri->segment_array();

		$num_segs = count($segs);

		if (empty($segs))
		{
			$html .= '<li ><a href="/">Home</a></li>'."\n";
		}

		// Loop through the segements and create the html output.
		foreach ($segs as $segment)
		{
			if ($num_segs == $i)
			{
				$html .= '<li ><a href="">'.$segment.'</a></li>'."\n";
			}
			else
			{
				$html .= '<li>'.$segment.'</li>'."\n";
			}

			$i++;
		}

		return $html;
	}
}

// --------------------------------------------------------------------

/**
 * set_theme()
 *
 * @access	public
 * @param	string
 * @return	mixed
 */
if ( ! function_exists('set_theme'))
{
	function set_theme($params)
	{
		/**
		 * ----------------------------------------------------------------------
		 *
		 * $params = array(
		 *  'name'          => '',
		 * 	'version'       => '',
		 * 	'author'        => '',
		 * 	'title'         => '',
		 * 	'description'   => '',
		 * 	'keywords'      => '',
		 * 	'page'          => '',
		 * 	'header_navbar' => '',
		 * 	'header'        => '',
		 * 	'sidebar_left'  => '',
		 * 	'sidebar_right' => '',
		 * 	'navigation'    => '',
		 * 	'context_fx'    => '',
		 * 	'theme'         => '',
		 * 	'active_page'   => '',
		 * );
		 *
		 * ----------------------------------------------------------------------
		 */

		(object) $theme = array_to_object($params);

    	/**
    	 * ----------------------------------------------------------------------
		 * The YoteyoteUI Main Configuration data array.
		 * ----------------------------------------------------------------------
		 */
/*
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
*/

		$data = array(
			'template' => array(
    			'name'          => $theme->name,
			    'version'       => $theme->version,
			    'author'        => $theme->author,
			    'title'         => $theme->title,
			    'description'   => $theme->description,
				'keywords'      => $theme->keywords,
			    'page'          => $theme->page,
			    'header_navbar' => $theme->header_navbar,
			    'header'        => $theme->header,
			    'sidebar_left'  => $theme->sidebar_left,
			    'sidebar_right' => $theme->sidebar_right,
			    'navigation'    => $theme->navigation,
			    'content_fx'    => $theme->content_fx,
			    'theme'         => $theme->theme,
			    'active_page'   => $theme->active_page,
			),
		);

		return $data;
	}
}

// --------------------------------------------------------------------

/**
 * set_now()
 *
 * Converts an array to an object.
 *
 * @access	public
 * @param	array	- the array to convert to an object
 * @return	mixed
 */
if ( ! function_exists('set_now'))
{
	function set_now()
	{
		return date('Y-m-d H:i:s');
	}
}

// --------------------------------------------------------------------

/**
 * array_to_object()
 *
 * Converts an array to an object.
 *
 * @access	public
 * @param	array	- the array to convert to an object
 * @return	mixed
 */
if ( ! function_exists('array_to_object'))
{
	function array_to_object($array)
	{
		if (is_array($array))
		{
			// Return array converted to object Using __FUNCTION__
			// (Magic constant) for recursive call
			return (object) array_map(__FUNCTION__, $array);
		}
		else
		{
			return $array;
		}
	}
}

// -----------------------------------------------------------------------

/**
 * object_to_array()
 *
 * Converts an object to an array.
 *
 * $array = object_to_array($object);
 *
 * @param		object	-	$object The object to convert
 * @return		array
 */
if ( ! function_exists('object_to_array'))
{
	function object_to_array($object)
	{
		if (is_object($object))
		{
			// Gets the properties of the given object with get_object_vars function
			$object = get_object_vars($object);
		}

		if (is_array($object))
		{
			// Return array converted to object Using __FUNCTION__
			// (Magic constant) for recursive call
			return array_map(__FUNCTION__, $object);
		}
		else
		{
			return $object;
		}
	}
}

// -----------------------------------------------------------------------

/**
 * Debug Helper
 *
 * Outputs the given variable(s) with formatting and location
 *
 * @author	Raymond L King Sr.
 * @access	public
 * @param	mixed	- variables to be output
 */
if ( ! function_exists('var_debug'))
{
	function var_debug()
	{
		list($params) = debug_backtrace();

		$arguments = func_get_args();

		$total_arguments = func_num_args();

		echo '<div><fieldset style="background: #fefefe !important; border:1px red solid; padding:15px">';
		echo '<legend style="background:lightgrey; padding:5px;">'.$params['file'].' @line: '.$params['line'].'</legend><pre><code>';

		$i = 0;
		foreach ($arguments as $argument)
		{
			echo '<strong>Debug #'.++$i.' of '.$total_arguments.'</strong>: '.'<br>';
			var_dump($argument);
		}

		echo "</code></pre></fieldset><div><br>";
	}
}

/**
 * ------------------------------------------------------------------------
 * End of file util_helper.php
 * Location: ./application/helpers/util_helper.php
 * ------------------------------------------------------------------------
 */