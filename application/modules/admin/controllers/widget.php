<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------------
 * Created by phpDesigner 8.1
 * Date  : 8/17/2013
 * Time  : 6:28:14 AM
 * Author: Raymond L King Sr.
 * ------------------------------------------------------------------------
 *
 * Class	Widget	Controller
 *
 * ------------------------------------------------------------------------
 * @package		Package		Yoteyote
 * @subpackage	Subpackage	widget
 * @category	category	widget
 * @author		Raymond L King Sr.
 * @copyright	Copyright (c) 2009 - 2012, Custom Software Designers, LLC.
 * @link		http://www.example.com
 * ------------------------------------------------------------------------
 * To change this template use File | Settings | File Templates.
 * ------------------------------------------------------------------------
 */

class Widget extends Public_Controller
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

		//$this->load->model('mdl_perfectmodel');

		log_message('debug', "Class Name Initialized");
	}

	// -----------------------------------------------------------------------

	/**
	 * render()
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
    public function render($template, $data)
    {
		$layout = $template;

		return $this->load->view($layout, $data, TRUE);
    }

}	// End of Class.

/**
 * ------------------------------------------------------------------------
 * Filename: widget.php
 * Location: ./application/modules/widget/widget.php
 * ------------------------------------------------------------------------
 */