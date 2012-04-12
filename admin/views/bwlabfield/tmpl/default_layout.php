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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_LAYOUT'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('CSS class for label'); ?>:
            </label>
            <input class="normalField" type="text" name="labelCSSclass" id="labelCSSclass" maxlength="50" value="<?php echo $this->bwlabfield->labelCSSclass; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('CSS class for field'); ?>:
            </label>
            <input class="normalField" type="text" name="fieldCSSclass" id="fieldCSSclass" maxlength="50" value="<?php echo $this->bwlabfield->fieldCSSclass; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('CSS class for Custom text'); ?>:
            </label>
            <input class="normalField" type="text" name="customtextCSSclass" id="customtextCSSclass" maxlength="50" value="<?php echo $this->bwlabfield->customtextCSSclass; ?>" />
        </li>
    </ul>
</fieldset>
