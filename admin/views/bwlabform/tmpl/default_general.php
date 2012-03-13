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
                <?php echo JText::_('Name'); ?>:
            </label>
            <input type="text" name="name" id="name" size="50" maxlength="50" value="<?php echo $this->bwlabforms->name; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_('Field name##The field name can only contain the following characters : ##abcdefghijklmnopqrstuvwxy##ABCDEFGHIJKLMNOPQRSTUVWXYZ##0123456789'); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Title'); ?>:
            </label>
            <input type="text" name="title" id="title" size="50" maxlength="250" value="<?php echo $this->bwlabforms->title; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Published'); ?>:
            </label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'published', '', $this->bwlabforms->published); ?>
            </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Description'); ?>:
            </label>
            <?php $editorDesc = JFactory::getEditor(); ?>
            <?php echo $editorDesc->display('description', $this->bwlabforms->description, 600, 200, 10, 10); ?>

        </li>
    </ul>
</fieldset>