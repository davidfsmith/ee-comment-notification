<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class Comment_notification_model
{

    private $_cn_settings               = 'wwl_cn_settings';
    private $_cn_log                    = 'wwl_cn_log';

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->EE =& get_instance();
    }

    public function get_setting_value($key)
    {
        $query = $this->EE->db->select(
            'value'
        )->from(
            $this->_cn_settings
        )->where(
            'key', $key
        )->get();

        $row = $query->row();
        return $row->value;
    }

    public function get_settings_values()
    {
        $query = $this->EE->db->get($this->_cn_settings);
        return $query->result_array();
    }

    public function update_setting_value($key, $value)
    {
        $this->EE->db->update($this->_cn_settings, array('value' => $value), array('key' => $key));
        return ($this->EE->db->affected_rows() > 0) ? true : false;
    }

    public function update_settings_values($settings_data)
    {
        $this->EE->db->update_batch($this->_cn_settings, $settings_data, 'key');
        return ($this->EE->db->affected_rows() > 0) ? true : false;
    }

}

/* End of file comment_notification_model.php */
/* Location: ./system/expressionengine/third_party/comment_notification/models/comment_notification_model.php */
