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

        $this->assignRef('fieldtype', JRequest::getVar('fieldtype', null));


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

        $typelist[0] = JHTML::_('select.option', '0', '- ' . JText::_('Select Type') . ' -', 'id', 'cattitle');
        $typelist[1] = JHTML::_('select.option', 'text', JText::_('Text'), 'id', 'cattitle');
        $typelist[2] = JHTML::_('select.option', 'hidden', JText::_('Hidden'), 'id', 'cattitle');
        $typelist[3] = JHTML::_('select.option', 'textarea', JText::_('Textarea'), 'id', 'cattitle');
        $typelist[4] = JHTML::_('select.option', 'checkbox', JText::_('Checkbox'), 'id', 'cattitle');
        $typelist[5] = JHTML::_('select.option', 'radiobutton', JText::_('Radio Button'), 'id', 'cattitle');
        $typelist[6] = JHTML::_('select.option', 'select', JText::_('Select'), 'id', 'cattitle');
        $typelist[7] = JHTML::_('select.option', 'fileupload', JText::_('File upload'), 'id', 'cattitle');
        $typelist[8] = JHTML::_('select.option', 'button', JText::_('Button'), 'id', 'cattitle');
        $typelist[9] = JHTML::_('select.option', 'fieldsep', JText::_('Field separator'), 'id', 'cattitle');
        $lists['type'] = JHTML::_('select.genericlist', $typelist, 'typefield', 'onchange="typeFieldChange()" class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->typefield);

        //-- push data to template
        $this->assignRef('listtypes', $lists['type']);

        $dateformat[0] = JHTML::_('select.option', '0', '- ' . JText::_('Default') . ' -', 'id', 'cattitle');
        $dateformat[1] = JHTML::_('select.option', 'US', 'MM/DD/YYYY', 'id', 'cattitle');
        $dateformat[2] = JHTML::_('select.option', 'EUR', 'DD/MM/YYYY', 'id', 'cattitle');
        $lists['dateformat'] = JHTML::_('select.genericlist', $dateformat, 'd_format', 'class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->d_format);

        //-- push data to template
        $this->assignRef('dateformat', $lists['dateformat']);

        $fillwithtext[0] = JHTML::_('select.option', 'inival', JText::_('Initial value'), 'id', 'cattitle');
        $fillwithtext[1] = JHTML::_('select.option', 'usrname', JText::_('Connected user : name'), 'id', 'cattitle');
        $fillwithtext[2] = JHTML::_('select.option', 'usrusername', JText::_('Connected user : username'), 'id', 'cattitle');
        $fillwithtext[3] = JHTML::_('select.option', 'usremail', JText::_('Connected user : e-mail'), 'id', 'cattitle');
        $lists['fillwithtext'] = JHTML::_('select.genericlist', $fillwithtext, 'fillwith', 'class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->fillwith);

        //-- push data to template
        $this->assignRef('fillwithtext', $lists['fillwithtext']);

        //-- push data to template
        $this->assignRef('dateformat', $lists['dateformat']);

        $wraplist[0] = JHTML::_('select.option', 'default', JText::_('default'), 'id', 'cattitle');
        $wraplist[1] = JHTML::_('select.option', 'off', JText::_('off'), 'id', 'cattitle');
        $wraplist[2] = JHTML::_('select.option', 'virtual', JText::_('virtual'), 'id', 'cattitle');
        $wraplist[3] = JHTML::_('select.option', 'physical', JText::_('physical'), 'id', 'cattitle');
        $lists['wrap'] = JHTML::_('select.genericlist', $wraplist, 't_wrap', 'class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->t_wrap);

        $this->assignRef('listwrap', $lists['wrap']);

        $texttypelist[0] = JHTML::_('select.option', 'text', JText::_('Text'), 'id', 'cattitle');
        $texttypelist[1] = JHTML::_('select.option', 'password', JText::_('password'), 'id', 'cattitle');
        $texttypelist[2] = JHTML::_('select.option', 'email', JText::_('Email'), 'id', 'cattitle');
        $texttypelist[3] = JHTML::_('select.option', 'date', JText::_('Date'), 'id', 'cattitle');
        $texttypelist[4] = JHTML::_('select.option', 'number', JText::_('Number'), 'id', 'cattitle');
        $texttypelist[5] = JHTML::_('select.option', 'url', JText::_('Url'), 'id', 'cattitle');
        $lists['texttype'] = JHTML::_('select.genericlist', $texttypelist, 't_texttype', 'onchange="typeFieldTextChange()" class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->t_texttype);

        $this->assignRef('texttype', $lists['texttype']);

        $buttontypelist[0] = JHTML::_('select.option', 'submit', JText::_('submit'), 'id', 'cattitle');
        $buttontypelist[1] = JHTML::_('select.option', 'reset', JText::_('reset'), 'id', 'cattitle');
        $lists['buttontype'] = JHTML::_('select.genericlist', $buttontypelist, 't_typeBT', 'class="inputbox" size="1"', 'id', 'cattitle', $bwlabfield->t_typeBT);

        $this->assignRef('listbuttontype', $lists['buttontype']);

        $fid = JRequest::getVar('fid', -1);
        $this->assignRef('fid', $fid);


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
