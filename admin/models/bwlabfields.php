<?php

/**
 * BWLabFields Model for CK form Component
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
 * BWLabFields Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class BWLabFormsModelBWLabFields extends JModel {

    /**
     * fields data array
     *
     * @var array
     */
    var $_data;

    /**
     * Items total
     * @var integer
     */
    var $_total = null;

    /**
     * Pagination object
     * @var object
     */
    var $_pagination = null;

    function __construct() {
        parent::__construct();

        global $option;
        $mainframe = JFactory::getApplication();
        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');

        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);

        $this->setId((int) JRequest::getVar('fid', 0));
    }

    /**
     * Method to set the parent form identifier
     *
     * @access	public
     * @param	int parent form identifier
     * @return	void
     */
    function setId($id) {
        // Set id and wipe data
        $this->_id = $id;
    }

    function getId() {
        return $this->_id;
    }

    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    function _buildQuery() {
        $query = ' SELECT * from #__bwlabfields c where c.fid=' . $this->_id . ' ' .
                'ORDER BY ordering';

        return $query;
    }

    /**
     * Retrieves the fields data
     * @return array Array of objects containing the data from the database
     */
    function getData() {
        // Lets load the data if it doesn't already exist
        if (empty($this->_data)) {
            $query = $this->_buildQuery();

            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        }

        return $this->_data;
    }

    /**
     * Retrieves all the fields data
     * @return array Array of objects containing the data from the database
     */
    function getAllData() {
        // Lets load the data if it doesn't already exist
        if (empty($this->_data)) {
            $query = ' SELECT * from #__bwlabfields c ORDER BY ordering';

            $this->_data = $this->_getList($query);
        }

        return $this->_data;
    }

    /**
     * Retrieves the fields data
     * @return array Array of objects containing the data from the database
     */
    function getAllFields($fid) {
        // Lets load the data if it doesn't already exist
        if (empty($this->_data)) {
            $query = ' SELECT * from #__bwlabfields c where c.fid=' . $fid . ' ' .
                    'ORDER BY ordering';

            $this->_data = $this->_getList($query);
        }

        return $this->_data;
    }

    function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);
        }
        return $this->_total;
    }

    function getPagination() {
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit'));
        }
        return $this->_pagination;
    }

    /**
     * duplicate field in new field
     * @param type $pk 
     */
    public function duplicateField($pk) {

        $flds = $this->getDbo()->getTableColumns('#__bwlabfields');

        $sqlmodel = "INSERT INTO #__bwlabfields (%s) (SELECT %s FROM #__bwlabfields WHERE id=$pk)";

        unset($flds['id']);

        $query = sprintf($sqlmodel, implode(',', array_keys($flds)), implode(',', array_keys($flds)));

        $this->getDbo()->setQuery($query)->query();
    }

    /**
     * reorder fields in list
     * 
     * @param int $form_id
     * @param array $pks list ok fields keys
     * @param array $order list of relative order
     * @return boolean 
     */
    public function saveOrder($form_id, $pks = array(), $order = array()) {

        if (empty($pks)) {

            $sqlmodel = "SELECT * FROM #__bwlabfields WHERE fid=" . $form_id . " order by ordering, id";

            $objs = $this->getDbo()->setQuery($sqlmodel)->loadObjectList();

            foreach ($objs as $k => $obj) {

                $order = $k;
                $sqlmodel = "update #__bwlabfields set ordering = $order WHERE id = " . $obj->id;

                $this->getDbo()->setQuery($sqlmodel)->query();
            }

            return true;
        }
        
        foreach ($pks as $k=>$pk) {
            
            $field = $this->getTable('BWLabField');
            
            $field->load($pk);
            
            $field->ordering = $order[$k];
            
            $field->store();
        }
        return true;
    }

}
