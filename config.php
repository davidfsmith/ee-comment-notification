<?php
/**
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
if ( ! defined('COMMENT_NOTIFICATION_NAME'))
{
    define('COMMENT_NOTIFICATION_NAME',          'Comment Notification');
    define('COMMENT_NOTIFICATION_MODULE_NAME',   'Comment_Notification');
    define('COMMENT_NOTIFICATION_VERSION',       '0.1.0');
}
$config['name']         = COMMENT_NOTIFICATION_NAME;
$config['module_name']  = COMMENT_NOTIFICATION_MODULE_NAME;
$config['version']      = COMMENT_NOTIFICATION_VERSION;

//$config['nsm_addon_updater']['versions_xml'] = 'http://www.wirewool.com/ee/comment_notification/feed';
/* End of file config.php */
/* Location: ./system/expressionengine/third_party/comment_notification/config.php */
