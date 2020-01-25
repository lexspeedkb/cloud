<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

    public function isOwner ($type, $search, $user_id)
    {
        $this->load->model('Model_files');

        if ($_SESSION['id'] == '1') {
            return true;
        }

        if ($type == 'dir') {
            $folder = $this->Model_files->getOneFolder($search);

            if ($folder['owner_id']==$user_id || $folder['free']) {
                return true;
            } else {
                return false;
            }
        } else {
            $file = $this->Model_files->getOneFile($type, $search);

            // If folder is free to use
            $breadcrumbs = $this->breadcrumbs($file['dir']);
            foreach ($breadcrumbs as $item) {
                if ($item['free']) {
                    return true;
                }
            }

            if ($file['user_id']==$user_id) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function breadcrumbs ($folder_id)
    {
        $this->load->library('session');
        $this->load->model('Model_files');

        $i = 0;

        $breadcrumbs[$i] = $this->Model_files->getOneFolder($folder_id);
        if ($breadcrumbs[$i]['parent_id']==0) {
            return $breadcrumbs;
        }

        $i++;

        while ($i < 10) {
            $breadcrumbs[$i] = $this->Model_files->getOneFolder($breadcrumbs[$i-1]['parent_id']);

            if ($breadcrumbs[$i]['parent_id']==0) {
                break;
            }

            $i++;
        }

        $return = array_reverse($breadcrumbs);

        return $return;

    }

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

}
