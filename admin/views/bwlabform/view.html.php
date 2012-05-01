<?php

/**
 * bwlabform View for bwlabforms Component
 * 
 * @package    BWLab.Joomla
 * @subpackage Components
 * @link http://www.bwlab.it
 * @license		GNU/GPL
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

/**
 * bwlabform View
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsViewBWLabForm extends JView {

    /**
     * display method of bwlabform view
     * @return void
     * */
    function display($tpl = null) {

        $jf_standard = JForm::getInstance('standard', 'bwl_form_layout');
        $this->assignRef('jf_standard', $jf_standard);

        //retrieve field data 

        $fid = JRequest::getVar('cid');

        $form = $this->getModel('BWLabForms')
                ->getTable('BWLabForm');
        
        $form->load($fid[0]);
        
        $isNew = ($form->id < 1);

        if (!$isNew) {
            $jf_standard->bind($form);
            $this->assignRef('jf_standard', $jf_standard);
        }

        $this->assignRef('bwlabform', $form);


//        $doc = & JFactory::getDocument();
//        $css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
//        $doc->addStyleDeclaration($css);

        JToolBarHelper::title(JText::_('BWLabForms') . ': <small><small>[ ' . $text . ' ]</small></small>', 'bwlabform');

        JToolBarHelper::save();
        JToolBarHelper::apply('apply');
        JToolBarHelper::cancel();

        JToolBarHelper::divider();
        JToolBarHelper::custom('fields', 'edit.png', 'edit.png', 'Fields', false);

        $document = & JFactory::getDocument();

        $this->_setSubMenu();

        parent::display($tpl);
    }

    /**
     * Setup the SubMenu
     *
     * @since	1.6
     */
    protected function _setSubMenu() {
        $contents = $this->loadTemplate('navigation');
        $document = JFactory::getDocument();
        $document->setBuffer($contents, 'modules', 'submenu');
    }

}
