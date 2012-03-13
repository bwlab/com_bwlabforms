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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_SELECT'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Allow multiple selection'); ?>:
            </label>
            <input name="t_multipleS" id="t_multipleS" type="checkbox" value="1" <?php
                if (Isset($this->bwlabfield->t_multipleS)) {
                    if ($this->bwlabfield->t_multipleS == '1') {
                        ?> checked <?php
               }
           }
                ?>/>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Height'); ?>:
            </label>
            <input type="text" name="t_heightS" id="t_heightS" value="<?php if (Isset($this->bwlabfield->t_heightS)) echo $this->bwlabfield->t_heightS; ?>" />
        </li>
        <li>
            <ul>
                <li style="display: inline">
                    <label for="title">
                        <?php echo JText::_('Value'); ?>:
                    </label>
                    <input type="text" name="t_valueS" id="t_valueS" value="" />
                </li>
                <li style="display: inline">
                    <label for="title">
                        <?php echo JText::_('Label'); ?>:
                    </label>
                    <input  type="text" name="t_labelS" id="t_labelS" value="" />
                    <input name="add" onclick="addValueToList('t_listS','t_listHS','t_valueS','t_labelS','t_defaultS');" type="button" value="add" />
                    &nbsp;<input onclick="resetValues('t_valueS','t_labelS','t_defaultS');" name="reset" type="button" value="reset" />
                </li>
                <li style="display: inline">
                    <label for="title">
                        <?php echo JText::_('Selected'); ?>:
                    </label>
                    <input name="t_defaultS" id="t_defaultS" type="checkbox" value="1" />
                </li>
            </ul>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Checkbox list'); ?>:
            </label>
            <select class="field300" id="t_listS" name="t_listS" size="3" multiple onchange="editValueList('t_listS','t_valueS','t_labelS','t_defaultS')">
            </select>
            <input onclick="removeOptions('t_listS','t_listHS','t_valueS','t_labelS','t_defaultS');" name="del" type="button" value="del" />
        </li>
</fieldset>
