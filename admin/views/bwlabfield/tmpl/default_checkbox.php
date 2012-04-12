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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_CHECKBOX'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Value'); ?>:
            </label>
            <input class="field300" type="text" name="t_initvalueCB" id="t_initvalueCB" value="<?php if (Isset($this->bwlabfield->t_initvalueCB)) echo $this->bwlabfield->t_initvalueCB; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Checked'); ?>:
            </label>
            <input name="t_checkedCB" id="t_checkedCB" type="checkbox" value="1" <?php
                if (Isset($this->bwlabfield->t_checkedCB)) {
                    if ($this->bwlabfield->t_checkedCB == '1') {
                        ?> checked <?php
               }
           }
                ?>/>
        </li>
</fieldset>