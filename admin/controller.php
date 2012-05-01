<?php

/**
 * BWLabForms default controller
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
jimport('joomla.application.component.controller');

class BWLabFormsController extends JController {

    /**
     * Method to display the view
     *
     * @access	public
     */
    public function display() {

        $view = $this->getView('BWLabForms', 'html');

        $view->setModel($this->getModel('BWLabForms'), true);

        $view->display();
    }

    /**
     * add new form 
     * @access public
     */
    public function add() {

        $this->set('default_view', 'BWLabForm');

        parent::display();
    }

    /**
     * edit form 
     * @access public
     */
    public function edit() {

        $view = $this->getView('BWLabForm', 'html');
        
        $view->setModel($this->getModel('BWLabForms'), true);

        $view->display();
    }

    /**
     * Backup all forms
     * @access public
     */
    public function backup() {
        
    }

    /**
     * restore all forms
     * @access public
     */
    public function restore() {
        
    }

    /**
     * generate form
     * @access public
     */
    public function generate() {
        try {
            $res = $this->getModel('BwlabForms')
                    ->generateTable(JRequest::getVar('fid'));
            $msg = JText::_('Form is generated');
        } catch (Exception $exc) {
            $msg = $exc->getMessage();
        }

        $this->setRedirect('index.php?' . BWLabFormHelper::getFormsUrl(), $msg);
    }

    /**
     * delete form and related fields
     * @access public
     */
    public function remove() {

        $model = $this->getModel('bwlabforms');

        foreach (JRequest::getVar('cid') as $formid) {

            $fields = $this->getModel('bwlabforms')
                    ->getFields($formid);

            foreach ($fields as $field) {

                $field = $this->getModel('bwlabfields')
                        ->getTable('BWLabField')
                        ->delete($field->id);
            }

            $model->dropTable($formid);

            $model->getTable('BWLabForm')->delete($formid);
        }

        $msg = JText::_('Form(s) Deleted');
        $this->setRedirect('index.php?' . BWLabFormHelper::getFormsUrl(), $msg);
    }

    /**
     * publish the form
     * @access public 
     */
    public function publish() {


        $this->getModel('bwlabforms')
                ->getTable('BWLabForm')->publish(JRequest::getVar('cid'), true);

        $this->setRedirect('index.php?' . BWLabFormHelper::getFormsUrl(), $msg);
    }

    /**
     * unpublish the form
     * @access public 
     */
    public function unpublish() {

        $this->getModel('bwlabforms')
                ->getTable('BWLabForm')->publish(JRequest::getVar('cid'), false);

        $this->setRedirect('index.php?' . BWLabFormHelper::getFormsUrl(), $msg);
    }

    /**
     * save form in db
     * @access public 
     */
    public function save() {

        $form_model = $this->getModel('bwlabforms');

        $form_table = $form_model->getTable('bwlabform');

        $form_table->bind(JRequest::getVar('form_config', array()));

        if ($form_table->store()) {

            $msg = JText::_('Form Saved') . " !";
        } else {

            $msg = JText::_('Error Saving Form');
        }

        $task = JRequest::getCmd('task');

        switch ($task) {
            case 'apply':
                $link = 'index.php?' . BWLabFormHelper::getFormEditUrl($form_table->id);
                break;

            case 'save':
            default:
                $link = 'index.php?' . BWLabFormHelper::getFormsUrl();
                break;
        }

        $this->setRedirect($link, $msg);
    }

    /**
     * Duplicate forms
     * @access public
     */
    public function duplicate() {

        $pks_forms = JRequest::getVar('cid', array(), 'post', 'array');

        if (empty($pks_forms)) {
            return JError::raiseWarning(500, JText::_('No items selected'));
        }

        foreach ($pks_forms as $pk_form) {

            $new_fid = $this->getModel('bwlabforms')->duplicateForm($pk_form);


            $fields = $this->getModel('bwlabforms')
                    ->getFields($pk_form);

            foreach ($fields as $field) {

                $field = $this->getModel('bwlabfields')->duplicateField($field->id);
                $field->set('fid', $new_fid->id);
                $field->store();
            }
        }

        $msg = JText::_('Fields duplicated');

        $this->setRedirect('index.php?' . BWLabFormHelper::getFormsUrl(), $msg);
    }

}

