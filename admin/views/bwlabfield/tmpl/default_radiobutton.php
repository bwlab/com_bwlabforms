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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_RADIOBUTTON'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Display'); ?>:
            </label>
            <?php
            $name = 't_displayRB';
            $attribs = null;
            $selected = $this->bwlabfield->t_displayRB ? $this->bwlabfield->t_displayRB : 'INL';
            $id = false;
            $disable = false;

            $inl = new stdClass();
            $inl->text = JText::_('in line');
            $inl->value = 'INL';
            $lst = new stdClass();
            $lst->text = JText::_('as list');
            $lst->value = 'LST';

            $arr = array($inl, $lst);

            echo JHTML::_('select.radiolist', $arr, $name, $attribs, 'value', 'text', $selected, $id);
            ?>
        </li>
        <li>
            <ul>
                <li>
                    <label for="title">
                        <?php echo JText::_('Value'); ?>:
                    </label>
                    <input  type="text" name="t_valueRB" id="t_valueRB" value="" />
                </li>
                <li>
                    <label for="title">
                        <?php echo JText::_('Label'); ?>:
                    </label>
                    <input  type="text" name="t_labelRB" id="t_labelRB" value="" />

                    <input name="add" onclick="addValueToList('t_listRB','t_listHRB','t_valueRB','t_labelRB','t_defaultRB');" type="button" value="add" />
                    &nbsp;<input onclick="resetValues('t_valueRB','t_labelRB','t_defaultRB');" name="reset" type="button" value="reset" />
                </li>
            </ul>

        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Default'); ?>:
            </label>
            <input name="t_defaultRB" id="t_defaultRB" type="checkbox" value="1" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Checkbox list'); ?>:
            </label>
            <select class="field300" id="t_listRB" name="t_listRB" size="3" multiple onchange="editValueList('t_listRB','t_valueRB','t_labelRB','t_defaultRB')">
            </select>
            <input onclick="removeOptions('t_listRB','t_listHRB','t_valueRB','t_labelRB','t_defaultRB');" name="del" type="button" value="del" />
        </li>
</fieldset>