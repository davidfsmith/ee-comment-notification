<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include config file
if (file_exists(PATH_THIRD.'comment_notification/config.php') === true) require PATH_THIRD.'comment_notification/config.php';
else require dirname(dirname(__FILE__)).'/comment_notification/config.php';

/**
 * ----------------------------------------------------------------------------------------------
 * Module to send an email notification to the author when their comment is updated
 *
 * ----------------------------------------------------------------------------------------------
 * Install / Uninstall and updates the modules
 *
 * @category  User_Notification
 * @package   Comment_Notification
 * @author    David Smith <david.smith@wirewool.com>
 * @copyright 2015 Wirewool Ltd <http://www.wirewool.com>
 * @license   http://www.wirewool.com/license/
 * @version   1.0
 * @link      http://www.wirewool.com/
 * @see       http://www.wirewool.com/ee/comment_notification
 */
class comment_notification_mcp
{
    /**
     * Module constructor
     *
     * @access public
     * @return
     */
    public function __construct()
    {
        // Load the libraries and helpers
        ee()->load->library('javascript');
        ee()->load->library('table');
        ee()->load->helper('form');

        // Load the model
        ee()->load->model('comment_notification_model', 'cn');

        // Set the module_link
        $this->_module_link = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.COMMENT_NOTIFICATION_MODULE_NAME;

        // Set the right navigation
        ee()->cp->set_right_nav(
            array(
                ee()->lang->line('settings')    => $this->_module_link.AMP.'method=settings',
                ee()->lang->line('home')        => $this->_module_link
            )
        );
    }

    /**
     * Module index
     *
     * @access public
     * @return boolean
     */
    public function index()
    {
        $this->_set_page_title('comment_notification_module_name');
        $vars = array();
        $vars['form_hidden'] = null;
        $vars['files'] = array();
        $vars['settings_link']  = $this->_module_link.AMP.'method=settings';
        return;
        // return ee()->load->view('index', $vars, true);
    }

    /**
     * Module settings page
     *
     * @access public
     * @return boolean
     */
    public function settings()
    {
        $this->_set_page_title('comment_notification_module_name');

        $vars = array();
        $vars['settings']       = ee()->cn->get_settings_values();
        $vars['action_url']     = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.COMMENT_NOTIFICATION_MODULE_NAME.AMP.'method=update_settings';
        $vars['form_hidden']    = array();

        return ee()->load->view('settings', $vars, true);
    }

    private function _set_page_title($title)
    {
        // $this->EE->cp->set_variable was deprecated in 2.6
        if (version_compare(APP_VER, '2.6', '>=')) {
            ee()->view->cp_page_title = ee()->lang->line($title);
        } else {
            ee()->cp->set_variable('cp_page_title', ee()->lang->line($title));
        }
    }
}

/* End of file mcp.comment_notification.php */
/* Location: ./system/expressionengine/third_party/comment_notification/mcp.comment_notification.php */
