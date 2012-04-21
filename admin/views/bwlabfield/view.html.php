<?php

/**
 * bwlabfield View for CK forms Component
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
 * bwlabfield View
 *
 * @package    BWLab.Joomla
 * @subpackage Components
 */
class BWLabFormsViewBWLabField extends JView {

    /**
     * display method of bwlabfield view
     * @return void
     * */
    function display($tpl = null) {

        
        JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'forms');
        
        $jf_standard = JForm::getInstance('standard','bwl_flds_standard');
        $this->assignRef('jf_standard', $jf_standard);
        
        $jf_type = JForm::getInstance('attribute','bwl_flds_'.JRequest::getVar('type'));
        $this->assignRef('jf_type', $jf_type);
        
        
        $this->assignRef('type', JRequest::getVar('type', null));


        //get the field data
        $bwlabfield = & $this->get('Data');
        $isNew = ($bwlabfield->id < 1);

        $doc = & JFactory::getDocument();
        $css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
        $doc->addStyleDeclaration($css);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title(JText::_('BWLabForms - Fields') . ': <small><small>[ ' . $text . ' ]</small></small>', 'bwlabform');

        JToolBarHelper::save();
        JToolBarHelper::apply('apply');
        if ($isNew) {
            $this->assignRef('fieldtype', JRequest::getVar('fieldtype', null));
            $this->assignRef('texttypefield', JRequest::getVar('texttypefield', null));

            JToolBarHelper::cancel();
        } else {
            $this->assignRef('fieldtype', $bwlabfield->typefield);
            $this->assignRef('texttypefield', $bwlabfield->texttypefield);
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel('cancel', 'Close');
        }


        $document = JFactory::getDocument();
        $document->addScript(JURI::root(true) . '/administrator/components/com_bwlabforms/js/bwlabforms.js');

        $this->assignRef('bwlabfield', $bwlabfield);

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
