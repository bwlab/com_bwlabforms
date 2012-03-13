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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_ADVANCED'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Frontend display'); ?>:
            </label>
            <fieldset class="radio">
                <?php echo JHTML::_('select.booleanlist', 'frontdisplay', '', $this->bwlabfield->frontdisplay);?>
            </fieldset>
        </li>
        <li>
            <label for="textseparator">
                <?php echo JText::_('Custom text'); ?>:
            </label>
            <?php
            $editorDesc = JFactory::getEditor();
            echo $editorDesc->display('customtext', $this->bwlabfield->customtext, 600, 150, 10, 10);
            ?>
        </li>
    </ul>
</fieldset>
