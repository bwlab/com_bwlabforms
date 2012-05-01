<?php

/**
 * bwlabfield table class
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.database.table');

/**
 * bwlabfield Table class
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class TableBWLabField extends JTable {
    /*
     * attributi comuni
     */

    /**
     * Primary Key
     *
     * @public  int
     */
    public $id = null;

    /**
     * @public  int
     */
    public $fid = null;

    /**
     * @public  string
     */
    public $type = null;

    /**
     * @public  string
     */
    public $label = null;

    /**
     * @public  string
     */
    public $name = null;

    /**
     * @public  string
     */
    public $title = null;

    /**
     * @public  int
     */
    public $ordering = null;

    /**
     * @public  int
     */
    public $published = 1;

    /**
     * @public  int
     */
    public $required = 0;

    /**
     * @public  int
     */
    public $readonly = 0;

    /**
     * @public  int
     */
    public $disabled = 0;

    /**
     * @public  string
     */
    public $cssclass = null;

    /**
     * @public  string
     */
    public $labelcssclass = null;

    /**
     * @public  string
     */
    public $custominfo = null;

    /**
     * @public  string
     */
    public $customerror = null;

    /**
     * @public  string
     */
    public $customtext = null;

    /**
     * @public  string
     */
    public $customtextcss = null;

    /**
     * Constructor
     *
     * @param object Database connector object
     */
    public function __construct(&$db, $table = '#__bwlabfields', $key = 'id') {
        parent::__construct($table, $key, $db);
    }

    public function resetPk() {

        $this->set('id', null);
    }

    /**
     * move up field
     * @param type $pk 
     */
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
