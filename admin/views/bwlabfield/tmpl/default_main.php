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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_MAIN'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title"><?php echo JText::_('Name'); ?> :</label>
            <input class="normalField" type="text" name="name" id="name" maxlength="50" value="<?php echo $this->bwlabfield->name; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_('Field name##The field name can only contain the following characters : ##abcdefghijklmnopqrstuvwxy##ABCDEFGHIJKLMNOPQRSTUVWXYZ##0123456789'); ?>" />
        </li>
        <li> 
            <label for="title"><?php echo JText::_('Label'); ?> :</label>
            <input class="normalField" type="text" name="label" id="label" maxlength="250" value="<?php echo $this->bwlabfield->label; ?>" />
        </li>
        <li>
            <label for="title"><?php echo JText::_('Published'); ?> :</label>
            <fieldset class="radio">
            <?php echo JHTML::_('select.booleanlist', 'published', '', $this->bwlabfield->published); ?>
                </fieldset>
        </li>
        <li>
            <label for="mandatory"><?php echo JText::_('Required'); ?> :</label>
            <input name="mandatory" id="mandatory" type="checkbox" value="1" <?php if ($this->bwlabfield->mandatory == '1') { ?> checked <?php } ?> />
        </li>
        <li>
            <label for="readonly"><?php echo JText::_('Read only'); ?> :</label>
            <input name="readonly" id="readonly" type="checkbox" value="1" <?php if ($this->bwlabfield->readonly == '1') { ?> checked <?php } ?> />
        </li>
        <li>
            <label for="title"><?php echo JText::_('Tips text'); ?> :</label>
            <input type="text" class="longfield" name="custominfo" id="custominfo" maxlength="500" value="<?php echo $this->bwlabfield->custominfo; ?>" />
            <img class="bwlabform_tooltip bwlabform_tooltipcss" src="<?php echo JURI::root(true) . '/administrator/components/com_bwlabforms/'; ?>images/help.png" title="<?php echo JText::_("Tips text##Add caracters '#' 2 times to separate the title and the body of tips text##start with 2 caracters '#' to not have a title (see 'help' tab)"); ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Custom error text'); ?>:
            </label>
            <input  class="longfield" type="text" name="customerror" id="customerror" maxlength="500" value="<?php echo $this->bwlabfield->customerror; ?>" />
        </li>
    </ul>
</fieldset>