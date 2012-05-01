<?php

/**
 * Form table class
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Form Table class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableBWLabForm extends JTable {

    /**
     * Primary Key
     *
     * @var int
     */
    var $id = null;

    /**
     * @var string
     */
    var $title = null;

    /**
     * @var string
     */
    var $name = null;

    /**
     * @var string
     */
    var $description = null;

    /**
     * @var int
     */
    var $published = 1;

    /**
     *
     * @var boolean 
     */
    var $send_mail = false;

    /**
     *
     * @var string 
     */
    var $mail_from = null;

    /**
     *
     * @var string
     */
    var $mail_to = null;

    /**
     *
     * @var string
     */
    var $mail_cc = null;

    /**
     *
     * @var string
     */
    var $mail_bcc = null;

    /**
     *
     * @var string
     */
    var $mail_subject = null;

    /**
     *
     * @var boolean
     */
    var $mail_receipit = false;

    /**
     *
     * @var string 
     */
    var $mail_receipit_subject = null;

    /**
     *
     * @var string
     */
    var $mail_receipit_text = null;

    /**
     *
     * @var boolean
     */
    var $mail_receipit_include_data = false;

    /**
     *
     * @var boolean
     */
    var $mail_receipit_include_file = false;

    /**
     *
     * @var boolean
     */
    var $result_save = false;

    /**
     *
     * @var string
     */
    var $result_text = null;

    /**
     *
     * @var boolean
     */
    var $result_redirect = false;

    /**
     *
     * @var string
     */
    var $result_redirect_url = null;

    /**
     *
     * @var boolean
     */
    var $advance_captcha = false;

    /**
     *
     * @var string
     */
    var $advance_path_upload = null;

    /**
     * @var int 
     */
    var $hits = 0;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function TableBWLabForm(& $db) {
        $user = & JFactory::getUser();
        $created_by = $user->id;
        parent::__construct('#__bwlabforms', 'id', $db);
    }

    public function moveUp($pk) {

        $this->load($pk);
        $this->move(-1);
    }

    /**
     * move up field
     * @param type $pk 
     */
    public function moveDown($pk) {

        $this->load($pk);
        $this->move(+1);
    }

    public function store($updateNulls = false) {
        
         $this->name = preg_replace('/[[:space:]]/', '', strtolower($this->name));

        parent::store($updateNulls);
    }

}
