<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// include config file
if (file_exists(PATH_THIRD.'comment_notification/config.php') === true) require PATH_THIRD.'comment_notification/config.php';
else require dirname(dirname(__FILE__)).'/comment_notification/config.php';

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
class comment_notification_upd
{

    /**
     * Module version
     *
     * @var string
     * @access public
     */
    public $version = COMMENT_NOTIFICATION_VERSION;

    /**
     * Module Short Name
     *
     * @var string
     * @access private
     */
    private $module_name = COMMENT_NOTIFICATION_MODULE_NAME;

    /**
     * Has Control Panel Backend?
     *
     * @var string
     * @access private
     */
    private $has_cp_backend = 'y';

    /**
     * Has Publish Fields?
     *
     * @var string
     * @access private
     */
    private $has_publish_fields = 'n';

    /**
     * Settings Table Name
     *
     * @var string
     * @access private
     */
    private $settings_table = 'wwl_cn_settings';

    /**
     * Log Table Name
     *
     * @var string
     * @access private
     */
    private $log_table = 'wwl_cn_log';

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * Installs the module
     *
     * Installs the module, adding a record to the exp_modules table,
     * creates and populates and necessary database tables,
     * adds any necessary records to the exp_actions table,
     * and if custom tabs are to be used, adds those fields to any saved publish layouts
     *
     * @access public
     * @return boolean
     */
    public function install()
    {
        // Load dbforge
        ee()->load->dbforge();

        $module = array(
            'module_name'           => $this->module_name,
            'module_version'        => $this->version,
            'has_cp_backend'        => $this->has_cp_backend,
            'has_publish_fields'    => $this->has_publish_fields,
        );

        ee()->db->insert('modules', $module);


        //
        // Settings Table (name value pair store)
        //
        $fields = array(
            'setting_id'    => array('type' => 'INT',       'unsigned'      => true,    'auto_increment'    => true),
            'key'           => array('type' => 'VARCHAR',   'constraint'    => 100,     'null'              => true,    'default'   => ''),
            'value'         => array('type' => 'VARCHAR',   'constraint'    => 100,     'null'              => true,    'default'   => ''),
        );

        ee()->dbforge->add_field($fields);
        ee()->dbforge->add_key('setting_id', true);
        ee()->dbforge->create_table($this->settings_table, true);

        // Add in the default key / value pairs that we need to setup
        ee()->db->set('key', 'email_from');
        ee()->db->set('value', '');
        ee()->db->insert($this->settings_table);
        ee()->db->set('key', 'email_reply');
        ee()->db->set('value', '');
        ee()->db->insert($this->settings_table);
        ee()->db->set('key', 'email_subject');
        ee()->db->set('value', '');
        ee()->db->insert($this->settings_table);
        // ee()->db->set('key', '');
        // ee()->db->set('value', '');
        // ee()->db->insert($this->settings_table);

        //
        // Log
        //
        $fields = array(
            'log_id'                => array('type' => 'INT',       'unsigned'      => true,    'auto_increment'    => true),
            'log_text'              => array('type' => 'VARCHAR',   'constraint'    => 250,     'default'           => ''),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        );

        ee()->dbforge->add_field($fields);
        ee()->dbforge->add_key('log_id', true);
        ee()->dbforge->create_table($this->log_table, true);


        return true;
    }


    /**
     * Updates the module
     *
     * This function is checked on any visit to the module's control panel,
     * and compares the current version number in the file to
     * the recorded version in the database.
     * This allows you to easily make database or
     * other changes as new versions of the module come out.
     *
     * @access public
     * @param int $current Installed version of the plugin [optional]
     * @return Boolean FALSE if no update is necessary, TRUE if it is.
     **/
    public function update($current = '')
    {
        if (version_compare($current, $this->version, '='))
        {
            return false;
        }

        if (version_compare($current, $this->version, '<'))
        {
            // Load dbforge
            ee()->load->dbforge();

            // Do your update code here

            // Upgrade The Module
            ee()->db->set('module_version', $this->version);
            ee()->db->where('module_name', $this->module_name);
            ee()->db->update('exp_modules');
        }

        return true;
    }


    /**
     * Uninstalls the module
     *
     * @access public
     * @return Boolean FALSE if uninstall failed, TRUE if it was successful
     **/
    public function uninstall()
    {
        // Load dbforge
        ee()->load->dbforge();

        ee()->db->select('module_id');
        $query = ee()->db->get_where('modules', array('module_name' => $this->module_name));

        ee()->db->where('module_id', $query->row('module_id'));
        ee()->db->delete('module_member_groups');

        ee()->db->where('module_name', $this->module_name);
        ee()->db->delete('modules');

        ee()->db->where('class', $this->module_name);
        ee()->db->delete('actions');

        // Remove the tables
        ee()->dbforge->drop_table('wwl_cn_settings', true);
        ee()->dbforge->drop_table('wwl_cn_log', true);

        // Remove the action
        // ee()->db->where($this->module_name, 'cron_task');
        // ee()->db->delete('actions');

        // Required if the module includes fields on the publish page
        // ee()->load->library('layout');
        // ee()->layout->delete_layout_tabs($this->tabs(), $this->module_name);

        return true;
    }
}

/* End of file upd.comment_notification.php */
/* Location: ./system/expressionengine/third_party/comment_notification/upd.comment_notification.php */
