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
                <?php echo JText::_('Save result'); ?> :
            </label>
            <fieldset class="radio">
            <?php echo JHTML::_('select.booleanlist', 'saveresult', '', $this->bwlabforms->saveresult); ?>
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Save result 'YES'##save the data of your form in the Database and can be viewed and exported"); ?>" />
            </fieldset>
        </li>
        <li>
            <label for="title"><?php echo JText::_('Text result'); ?> :</label>
            <?php $editorResult = JFactory::getEditor(); ?>
            <?php echo $editorResult->display('textresult', $this->bwlabforms->textresult, 600, 200, 10, 10); ?>
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Text Result##is the text displayed after the form submission"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Redirect form data'); ?> :
            </label>
            <fieldset class="radio">
    <?php echo JHTML::_('select.booleanlist', 'redirectdata', '', $this->bwlabforms->redirectdata); ?>
                </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Redirect URL'); ?> :
            </label>
            <input class="longfield" type="text" name="redirecturl" id="redirecturl" maxlength="250" value="<?php echo $this->bwlabforms->redirecturl; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Redirect URL##is the URL displayed after the form submission"); ?>" />
        </li>
        
    </ul>
</fieldset>