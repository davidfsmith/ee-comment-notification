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
class comment_notification
{

    /**
     * Module constructor
     *
     * @access public
     * @return
     */
    public function __construct()
    {

        // Load the model
        ee()->load->model('comment_notification_model', 'cn');
    }
}
/* End of file mod.comment_notification.php */
/* Location: ./system/expressionengine/third_party/comment_notification/mod.comment_notification.php */
