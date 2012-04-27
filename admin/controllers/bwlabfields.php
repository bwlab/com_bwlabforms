<?php

/**
 * bwlabfields Controller for BWLab Forms Component
 * 
 * @package    CK.Joomla
 * @subpackage Components
 * @link http://www.cookex.eu
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'helper' . DS . 'bwlabformhelper.php';

/**
 * bwlabfields Controller
 *
 * @package    CK.Joomla
 * @subpackage Components
 */
class BWLabFormsControllerBWLabFields extends JController {

    /**
     * constructor (registers additional tasks to methods)
     * @return void
     */
    function __construct() {

        parent::__construct();
        // Register Extra tasks
        //$this->registerTask( 'add'  , 	'edit' );
        $this->registerTask('apply', 'save');
        $this->registerTask('unpublish', 'publish');
    }

    /**
     * display the edit form
     * @return void
     */
    function edit() {

        JRequest::setVar('view', 'bwlabfield');

        $view = $this->getView('bwlabfield', 'html');
        $view->setModel($this->getModel('BWLabFieldType'), true);
        $view->display();
    }

    function add() {

        JRequest::setVar('view', 'bwlabfield');
        parent::display();
    }

    /**
     * save a record (and redirect to main page)
     * @return void
     */
    function save() {

        $model = $this->getModel('bwlabfieldtype');

        $fid = JRequest::getVar('fid', -1);

        $field = $model->store(JRequest::get('POST'));

        if (!$field) {

            $msg = JText::_('Error Saving Field');
        }

        switch (JRequest::getCmd('task')) {
            case 'apply':

                $link = 'index.php?' . BWLabFormHelper::getEditFieldUrl($field->get('id'), $fid);

                break;

            case 'save':
            default:
                $link = 'index.php?' . BWLabFormHelper::getFieldListUrl($fid);
                break;
        }

        $this->setRedirect($link, $msg);
    }

    /**
     * remove record(s)
     * @return void
     */
    function remove() {

        $table = $this->getModel('BWLabFields')
                ->getTable('BWLabField');

        foreach (JRequest::getVar('cid', array(), 'request', 'array') as $pk) {
            $table->delete($pk);
        }

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl(JRequest::getVar('fid', -1)));
    }

    /**
     * cancel editing a record
     * @return void
     */
    function cancel() {

        $msg = JText::_('Operation Cancelled');
        $fid = JRequest::getVar('fid', -1);

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl($fid), $msg);
    }

    function publish() {


        $ids = JRequest::getVar('cid', array(), 'post', 'array');
        $task = JRequest::getVar('task', false);

        $this->getModel('bwlabfields')
                ->getTable('BWLabField')
                ->publish($ids, ( $task == "publish" ? 1 : 0));

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl(JRequest::getVar('fid', -1)));
    }

    /**
     * Method to display the view
     *
     * @access	public
     */
    function display() {
        JRequest::setVar('view', 'bwlabfields');

        parent::display();
    }

    /**
     * Method to order up the record
     *
     * @access	public
     */
    function orderup() {
        
        $pk = JRequest::getVar('cid', array(), 'post', 'array');
        
        $this->getModel('bwlabfields')
                    ->getTable('BWLabField')
                        ->moveUp( $pk[0] );

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl(JRequest::getVar('fid', -1)));
    }

    /**
     * Method to order down the record
     *
     * @access	public
     */
    function orderdown() {
        $pk = JRequest::getVar('cid', array(), 'post', 'array');
        
        $this->getModel('bwlabfields')
                    ->getTable('BWLabField')
                        ->moveDown( $pk[0] );

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl(JRequest::getVar('fid', -1)));
    }

    /**
     * Method to save the order
     *
     * @access	public
     */
    function saveorder() {
        $fid = JRequest::getVar('fid', -1);

        $cid = JRequest::getVar('cid', array(), 'post', 'array');
        $order = JRequest::getVar('order', array(), 'post', 'array');
 
        $this->getModel('bwlabfields')
                        ->saveOrder( $fid, $cid, $order );
        
        $this->getModel('bwlabfields')
                        ->saveOrder( $fid);
        
        $this->setRedirect('index.php?'.BWLabFormHelper::getFieldListUrl($fid));

    }

    /**
     * Duplicate selected Fields
     * @return void
     */
    public function duplicate() {

        $pks_fields = JRequest::getVar('cid', array(), 'post', 'array');

        if (empty($pks_fields)) {
            return JError::raiseWarning(500, JText::_('No items selected'));
        }

        foreach ($pks_fields as $pk_field) {

            $this->getModel('bwlabfields')->duplicateField($pk_field);
        }

        $this->getModel('bwlabfields')->saveOrder(JRequest::getVar('fid', -1));

        $msg = JText::_('Fields duplicated');

        $this->setRedirect('index.php?' . BWLabFormHelper::getFieldListUrl(JRequest::getVar('fid', -1)), $msg);
    }

}