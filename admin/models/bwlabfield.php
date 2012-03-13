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
class BWLabFormsModelBWLabField extends JModel {

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
        if (empty($this->_data)) {
            $query = ' SELECT * FROM #__bwlabfields ' .
                    '  WHERE id = ' . $this->_id;
            $this->_db->setQuery($query);
            $this->_data = $this->_db->loadObject();
        }

        if (!$this->_data) {
            $this->_data = new stdClass();
            $this->_data->id = 0;
            $this->_data->fid = 0;
            $this->_data->name = null;
            $this->_data->label = null;
            $this->_data->published = 1;
            $this->_data->typefield = null;
            $this->_data->ordering = null;
            $this->_data->mandatory = null;
            $this->_data->custominfo = null;
            $this->_data->customerror = null;
            $this->_data->customvalidation = null;
            $this->_data->readonly = null;
            $this->_data->labelCSSclass = null;
            $this->_data->fieldCSSclass = null;
            $this->_data->customtext = null;
            $this->_data->customtextCSSclass = null;
            $this->_data->frontdisplay = 1;
            $this->_data->fillwith = null;

            $this->_data->t_wrap = '';
            $this->_data->t_typeBT = '';
            $this->_data->t_texttype = '';
            $this->_data->t_displayRB = '';
            $this->_data->t_filluid = '';
            $this->_data->t_noborderFS = '';
            $this->_data->d_format = '';
            $this->_data->d_daydate = '';

            $this->_data->t_listHS = '';
            $this->_data->t_listHRB = '';
        } else {
            $opt = explode("[--]", $this->_data->defaultvalue);

            $this->_data->t_wrap = '';
            $this->_data->t_typeBT = '';
            $this->_data->t_texttype = '';
            $this->_data->t_displayRB = '';
            $this->_data->t_filluid = '';
            $this->_data->t_noborderFS = '';
            $this->_data->d_format = '';
            $this->_data->d_daydate = '';

            $this->_data->t_listHS = '';
            $this->_data->t_listHRB = '';

            if (isset($this->_data->frontdisplay) == false) {
                $this->_data->frontdisplay = 1;
            }
            if (isset($this->_data->fillwith) == false) {
                $this->_data->fillwith = null;
            }

            switch ($this->_data->typefield) {
                case 'text':
                    $key1 = explode("===", $opt[0]);
                    $key2 = explode("===", $opt[1]);
                    $key3 = explode("===", $opt[2]);
                    $key4 = explode("===", $opt[3]);
                    $this->_data->t_initvalueT = $key1[1];
                    $this->_data->t_maxchar = $key2[1];
                    $this->_data->t_texttype = $key3[1];
                    $this->_data->t_minchar = $key4[1];
                    if (count($opt) > 4) {
                        $key5 = explode("===", $opt[4]);
                        $this->_data->d_format = $key5[1];
                    }
                    if (count($opt) > 5) {
                        $key6 = explode("===", $opt[5]);
                        $this->_data->d_daydate = $key6[1];
                    }
                    break;

                case 'hidden':
                    $key1 = explode("===", $opt[0]);
                    $this->_data->t_initvalueH = $key1[1];
                    if (count($opt) > 1) {
                        $key2 = explode("===", $opt[1]);
                        $this->_data->t_filluid = $key2[1];
                    }
                    break;

                case 'textarea':
                    $key1 = explode("===", $opt[0]);
                    $key2 = explode("===", $opt[1]);
                    $key3 = explode("===", $opt[2]);
                    $key4 = explode("===", $opt[3]);
                    $key5 = explode("===", $opt[4]);
                    $key6 = explode("===", $opt[5]);
                    $key7 = explode("===", $opt[6]);
                    $this->_data->t_initvalueTA = $key1[1];
                    $this->_data->t_HTMLEditor = $key2[1];
                    $this->_data->t_columns = $key3[1];
                    $this->_data->t_rows = $key4[1];
                    $this->_data->t_wrap = $key5[1];
                    $this->_data->t_maxchar = $key6[1];
                    $this->_data->t_minchar = $key7[1];
                    break;

                case 'checkbox':
                    $key1 = explode("===", $opt[0]);
                    $this->_data->t_initvalueCB = $key1[1];
                    $key2 = explode("===", $opt[1]);
                    $this->_data->t_checkedCB = $key2[1];
                    break;

                case 'radiobutton':
                    $key1 = explode("===", $opt[0]);
                    $this->_data->t_listHRB = $key1[1];
                    if (count($opt) > 1) {
                        $key2 = explode("===", $opt[1]);
                        $this->_data->t_displayRB = $key2[1];
                    }
                    break;

                case 'select':
                    $key1 = explode("===", $opt[0]);
                    $key2 = explode("===", $opt[1]);
                    $key3 = explode("===", $opt[2]);
                    $this->_data->t_multipleS = $key1[1];
                    $this->_data->t_heightS = $key2[1];
                    $this->_data->t_listHS = $key3[1];
                    break;

                case 'button':
                    $key1 = explode("===", $opt[0]);
                    $this->_data->t_typeBT = $key1[1];
                    break;

                case 'fieldsep':
                    $key1 = explode("===", $opt[0]);
                    $this->_data->t_noborderFS = $key1[1];
                    break;
            }
        }

        return $this->_data;
    }

    /**
     * Method to store a record
     *
     * @access	public
     * @return	boolean	True on success
     */
    function store() {

        //$data = JRequest::get( 'post' );
        $data = JRequest::get('POST', JREQUEST_ALLOWHTML);

        $query = ' SELECT max( ordering ) as maxx FROM #__bwlabfields WHERE fid = ' . $data['fid'];
        $this->_db->setQuery($query);
        $max = $this->_db->loadObject();

        $row = & $this->getTable();

        $user = & JFactory::getUser();

        // Get Specific values

        $defaultvalue = '';
        switch ($data['typefield']) {
            case 'text':
                $t_initvalueT = $data['t_initvalueT'];
                $t_maxchar = $data['t_maxchar'];
                $t_minchar = $data['t_minchar'];
                $t_texttype = $data['t_texttype'];
                $d_format = $data['d_format'];
                $d_daydate = $data['d_daydate'];

                $defaultvalue = 't_initvalueT===' . $t_initvalueT . '[--]t_maxchar===' . $t_maxchar . '[--]t_texttype===' . $t_texttype . '[--]t_minchar===' . $t_minchar . '[--]d_format===' . $d_format . '[--]d_daydate===' . $d_daydate;
                break;

            case 'hidden':
                $t_initvalueH = $data['t_initvalueH'];
                if (isset($data['t_filluid'])) {
                    $t_filluid = $data['t_filluid'];
                } else {
                    $t_filluid = 0;
                }
                $defaultvalue = 't_initvalueH===' . $t_initvalueH . '[--]t_filluid===' . $t_filluid;
                break;

            case 'textarea':
                $t_initvalueTA = $data['t_initvalueTA'];
                $t_HTMLEditor = $data['t_HTMLEditor'];
                $t_columns = $data['t_columns'];
                $t_rows = $data['t_rows'];
                $t_wrap = $data['t_wrap'];
                $t_maxchar = $data['t_maxchar'];
                $t_minchar = $data['t_minchar'];
                $defaultvalue = 't_initvalueTA===' . $t_initvalueTA . '[--]t_HTMLEditor===' . $t_HTMLEditor . '[--]t_columns===' . $t_columns . '[--]t_rows===' . $t_rows . '[--]t_wrap===' . $t_wrap . '[--]t_maxchar===' . $t_maxchar . '[--]t_minchar===' . $t_minchar;
                break;

            case 'checkbox':
                $t_initvalueT = $data['t_initvalueCB'];
                $t_checkedCB = $data['t_checkedCB'];
                $defaultvalue = 't_initvalueCB===' . $t_initvalueT . '[--]t_checkedCB===' . $t_checkedCB;
                break;

            case 'radiobutton':
                $t_listHRB = $data['t_listHRB'];
                $t_displayRB = $data['t_displayRB'];
                $defaultvalue = 't_listHRB===' . $t_listHRB . '[--]t_displayRB===' . $t_displayRB;
                break;

            case 'select':
                $t_multipleS = $data['t_multipleS'];
                $t_heightS = $data['t_heightS'];
                $t_listHS = $data['t_listHS'];

                $defaultvalue = 't_multipleS===' . $t_multipleS . '[--]t_heightS===' . $t_heightS . '[--]t_listHS===' . $t_listHS;
                break;

            case 'button':
                $t_typeBT = $data['t_typeBT'];
                $defaultvalue = 't_typeBT===' . $t_typeBT;
                break;

            case 'fieldsep':
                $t_noborderFS = $data['t_noborderFS'];
                $defaultvalue = 't_noborderFS===' . $t_noborderFS;
                break;
        }

        $row->defaultvalue = $defaultvalue;
        // End Get Specific values
        // Bind the form fields to the hello table
        if (!$row->bind($data)) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        // Set complementary data
        if ($row->ordering == "") {
            if (isset($max)) {
                $row->ordering = $max->maxx + 1;
            } else {
                $row->ordering = 1;
            }
        }

        // Make sure the hello record is valid
        if (!$row->check()) {
            $this->setError($this->_db->getErrorMsg());
            return false;
        }

        $this->_id = $row->id;

        // Store the web link table to the database
        if (!$row->store()) {
            $this->setError($row->getError());

            return false;
        }

        /* Test if data must be saved in DB for this form */
        $query = ' SELECT * from #__bwlabforms c where c.id=' . $row->fid . ' ';
        $forms = $this->_getList($query);
        if (count($forms) > 0) {
            $rowTable = $forms[0];
            if ($rowTable->saveresult == 1) {
                $tn = "#__bwlabforms_" . $row->fid;

                $dba = & JFactory::getDBO();

                $tableFields = $dba->getTableFields($tn, false);

                if (!isset($tableFields[$tn][$row->name])) {

                    $query = "ALTER TABLE " . $tn . " ADD F" . $row->id . " TEXT NULL";
                    $dba->setQuery($query);
                    if (!$dba->query()) {
                        echo JText::_('Problem with') . " (" . $query . ")";
                    }
                }
            }
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

}

?>
