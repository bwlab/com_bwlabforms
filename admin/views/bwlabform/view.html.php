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
        $bwlabforms = & $this->get('Data');
        $isNew = ($bwlabforms->id < 1);

        $doc = & JFactory::getDocument();
        $css = '.icon-48-bwlabform {background:url(../administrator/components/com_bwlabforms/images/logo-banner.png) no-repeat;}';
        $doc->addStyleDeclaration($css);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title(JText::_('BWLabForms') . ': <small><small>[ ' . $text . ' ]</small></small>', 'bwlabform');

        JToolBarHelper::save();
        JToolBarHelper::apply('apply');
        if ($isNew) {
            JToolBarHelper::cancel();
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel('cancel', 'Close');
        }

        JToolBarHelper::divider();
        JToolBarHelper::custom('fields', 'edit.png', 'edit.png', 'Fields', false);

        $document = & JFactory::getDocument();
        $document->addScript(JURI::root(true) . '/administrator/components/com_bwlabforms/js/mootabs.js');

        $document->addStyleSheet(JURI::root(true) . '/administrator/components/com_bwlabforms/css/mootabs.css');
        $document->addStyleSheet(JURI::root(true) . '/administrator/components/com_bwlabforms/css/bwlabforms.css');

        $this->assignRef('bwlabforms', $bwlabforms);
        
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
