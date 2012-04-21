<?php

/**
 * BWLabField for CK form Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

/**
 * BWLabField Model
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsModelBWLabFieldType extends JModel {

    /**
     * Constructor that retrieves the ID from the request
     *
     * @access	public
     * @return	void
     */
    function __construct() {
        parent::__construct();

        $array = JRequest::getVar('cid', 0, '', 'array');
        $fid = JRequest::getVar('fid', 0, '', 'int');

        $this->setId((int) $array[0]);
    }

    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm('com_bwlabforms.bwlabformsfield', 'bwlabformsfield', array('control' => 'jform', 'load_data' => $loadData));
        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to set the field identifier
     *
     * @access	public
     * @param	int field identifier
     * @return	void
     */
    function setId($id) {
        // Set id and wipe data
        $this->_id = $id;
        $this->_data = null;
    }

    function getId() {
        return $this->_id;
    }

    /**
     * Method to get a hello
     * @return object with data
     */
    function &getData() {

        // Load the data
        $query = ' SELECT * FROM #__bwlabfields ' .
                '  WHERE id = ' . $this->_id;

        $this->_db->setQuery($query);

        $this->_data = $this->_db->loadObject();

        if (!$this->_data)
            $this->_data = new stdClass();

        return $this->_data;
    }

    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	True on success
     */
    function store(array $data) {

        $max = $this->getMaxOrdering($data['fid']);

        switch ($data['typefield']) {

            case 'textarea':
                $field = $this->getTable('BWLabFieldTypeTextArea');
                /**
                 * @var TableBWLabFieldTypeTextArea
                 */
                break;


            case 'select':
                $field = $this->getTable('BWLabFieldTypeSelect');
                /**
                 * @var TableBWLabFieldTypeSelect
                 */
                break;

            case 'button':
                break;

            default :
                $field = $this->getTable('BWLabFieldTypeText');
                /**
                 * @var TableBWLabFieldTypeTextArea
                 */
                break;
        }


        if (!$field->bind($data)) {
            $this->setError($this->getDbo()->getErrorMsg());
            return false;
        }

        // Set complementary data
        if ($field->ordering == "") {
            if (isset($max)) {
                $field->ordering = $max->max_ordering + 1;
            } else {
                $field->ordering = 1;
            }
        }

        // Make sure the hello record is valid
        if (!$field->check()) {
            $this->setError($this->getDbo()->getErrorMsg());
            return false;
        }

        $this->_id = $field->id;

        // Store the web link table to the database
        if (!$field->store()) {
            //$this->setError($field->getError());

            return false;
        }

        return true;
    }

    /**
     * Method to delete record(s)
     *
     * @access	public
     * @return	boolean	True on success
     */
    function delete() {
        $saveDB = false;

        $fid = JRequest::getVar('fid', array(0), 'post', 'int');
        if (isset($fid)) {

            $query = ' SELECT * from #__bwlabforms c where c.id=' . $fid . ' ';
            $forms = $this->_getList($query);
            if (count($forms) > 0) {
                $rowTable = $forms[0];
                if ($rowTable->saveresult == 1) {
                    $saveDB = true;
                }
            }
        }

        if ($saveDB == true) {
            $tn = "#__bwlabforms_" . $fid;
            $dba = & JFactory::getDBO();
            $tableFields = $dba->getTableFields($tn, false);
        }

        $cids = JRequest::getVar('cid', array(0), 'post', 'array');

        $row = & $this->getTable();

        if (count($cids)) {
            foreach ($cids as $cid) {

                if ($saveDB == true) {
                    $query = ' SELECT * FROM #__bwlabfields ' .
                            '  WHERE id = ' . $cid;
                    $this->_db->setQuery($query);
                    $field = $this->_db->loadObject();
                }

                if (!$row->delete($cid)) {
                    $this->setError($row->getErrorMsg());
                    return false;
                } else {
                    /* Delete Field From DB */
                    if ($saveDB == true) {

                        if (!isset($tableFields[$tn][$row->name])) {
                            $query = "ALTER TABLE " . $tn . " DROP F" . $field->id;
                            $dba->setQuery($query);
                            if (!$dba->query()) {
                                echo JText::_('Problem with') . " (" . $query . ")";
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    /**
     * Method to move record(s)
     *
     * @access	public
     * @return	boolean	True on success
     */
    function move($direction) {
        $row = & $this->getTable();
        if (!$row->load($this->_id)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        if (!$row->move($direction, ' fid = ' . (int) $row->fid)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        return true;
    }

    /**
     * Method to save the new order
     *
     * @access	public
     * @return	boolean	True on success
     */
    function saveorder($cid = array(), $order) {
        $row = & $this->getTable();
        $groupings = array();

        // update ordering values
        $n = count($cid);
        for ($i = 0; $i < $n; $i++) {
            $row->load((int) $cid[$i]);
            // track categories
            $groupings[] = $row->catid;

            if ($row->ordering != $order[$i]) {
                $row->ordering = $order[$i];
                if (!$row->store()) {
                    $this->setError($this->_db->getErrorMsg());
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * get max order 
     * @param type $form_id
     * @return type integer
     */
    private function getMaxOrdering($form_id) {
        $query = ' SELECT max( ordering ) as max_ordering FROM #__bwlabfields WHERE fid = ' . $form_id;
        $this->_db->setQuery($query);
        return $this->_db->loadObject();
    }

}

