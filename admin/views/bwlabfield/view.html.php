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
     * display field customizing
     * 
     * @return void
     * */
    function display($tpl = null) {


        JForm::addFormPath(JPATH_COMPONENT_ADMINISTRATOR . DS . 'models' . DS . 'forms');

        $jf_standard = JForm::getInstance('standard', 'bwl_flds_standard');
        $this->assignRef('jf_standard', $jf_standard);

         //retrieve field data 
        $bwlabfield = & $this->get('Data');

        $isNew = ($bwlabfield->id < 1);
        
        switch ($isNew? JRequest::getVar('type') : $bwlabfield->type) {

            case 'textarea':
            case 'editor':
                $jf_type = JForm::getInstance('attribute', 'bwl_flds_textarea');
                $type = 'textarea';
                break;

            case 'select':
                $jf_type = JForm::getInstance('attribute', 'bwl_flds_select');
                $type = 'select';
                break;

            default:
                $jf_type = JForm::getInstance('attribute', 'bwl_flds_text');
                $type = 'text';
                break;
        }

        $this->assignRef('type', $type);
        
        $this->assignRef('jf_type', $jf_type);

        if (!$isNew) {
            $bwlabfield->subtype = $bwlabfield->type;
            $jf_type->bind($bwlabfield);
            $jf_standard->bind($bwlabfield);
        }
        /**
         * @todo insert logo image
         */
        $doc = & JFactory::getDocument();
        $css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
        $doc->addStyleDeclaration($css);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title(JText::_('BWLabForms - Fields') . ': <small><small>[ ' . $text . ' ]</small></small>', 'bwlabform');

        JToolBarHelper::save();
        JToolBarHelper::apply('apply');

        if ($isNew) {
            JToolBarHelper::cancel();
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel('cancel', 'Close');
        }


        $this->assignRef('bwlabfield', $bwlabfield);
        $this->assignRef('fid', JRequest::getVar('fid', null));
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
