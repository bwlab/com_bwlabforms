<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_config
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;
?>
<fieldset class="adminform">
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_TEXT'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Email result'); ?>:
            </label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'emailresult', '', $this->bwlabforms->emailresult); ?>
                <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Email result##'Yes' send the data submited by email to the emails addresses with the subject."); ?>" />
            </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Mail FROM'); ?>:
            </label>
            <input class="longfield" type="text" name="emailfrom" id="emailfrom" maxlength="250" value="<?php echo $this->bwlabforms->emailfrom; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("##Separate emails with comma"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Mail TO'); ?>:
            </label>
            <input class="longfield" type="text" name="emailto" id="emailto" maxlength="250" value="<?php echo $this->bwlabforms->emailto; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("##Separate emails with comma"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Mail CC'); ?>:
            </label>
            <input class="longfield" type="text" name="emailcc" id="emailcc" maxlength="250" value="<?php echo $this->bwlabforms->emailcc; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("##Separate emails with comma"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Mail BCC'); ?>:
            </label>
            <input class="longfield" type="text" name="emailbcc" id="emailbcc" maxlength="250" value="<?php echo $this->bwlabforms->emailbcc; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("##Separate emails with comma"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Mail Subject'); ?>:
            </label>
            <input class="longfield" type="text" name="subject" id="subject" maxlength="250" value="<?php echo $this->bwlabforms->subject; ?>" />
        </li>
        <li>
            <label for="title"><?php echo JText::_('Include fileupload file'); ?>:</label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'emailresultincfile', '', $this->bwlabforms->emailresultincfile); ?>
            </fieldset>
        </li>
        <li>
            <label for="title"><?php echo JText::_('Email receipt'); ?>:</label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'emailreceipt', '', $this->bwlabforms->emailreceipt); ?>
                <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Email receipt##only if an 'E-Mail' field is present in the Form"); ?>" />
            </fieldset>
        </li>
        <li>
            <label for="title"><?php echo JText::_('Email receipt Subject'); ?>:</label>
            <input class="text_area" type="text" name="emailreceiptsubject" id="emailreceiptsubject" maxlength="250" value="<?php echo $this->bwlabforms->emailreceiptsubject; ?>" />
        </li>
        <li>
            <label for="title"><?php echo JText::_('Email receipt Text'); ?>:</label>
            <?php $editorResultEMR = JFactory::getEditor(); ?>
            <?php echo $editorResultEMR->display('emailreceipttext', $this->bwlabforms->emailreceipttext, 600, 150, 10, 10); ?>
        </li>
        <li>
            <label for="title"><?php echo JText::_('Include data'); ?>:</label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'emailreceiptincfield', '', $this->bwlabforms->emailreceiptincfield); ?>
            </fieldset>
        </li>
        <li>
            <label for="title"><?php echo JText::_('Include fileupload file'); ?>:</label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'emailreceiptincfile', '', $this->bwlabforms->emailreceiptincfile); ?>
            </fieldset>
        </li>
    </ul>
</fieldset>