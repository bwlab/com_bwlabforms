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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_TEXTAREA'); ?></legend>
    <ul class="adminformlist">
         <li>
            <label for="title">
                <?php echo JText::_('Max length'); ?>:
            </label>
            <input name="t_maxchar" type="text" id="t_maxchar" value="<?php if (Isset($this->bwlabfield->t_maxchar)) echo $this->bwlabfield->t_maxchar; ?>" maxlength="5" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Min length'); ?>:
            </label>
            <input name="t_minchar" type="text" id="t_minchar" value="<?php if (Isset($this->bwlabfield->t_minchar)) echo $this->bwlabfield->t_minchar; ?>" maxlength="5" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Initial value'); ?>:
            </label>
            <input class="field300" type="text" name="t_initvalueTA" id="t_initvalueTA" value="<?php if (Isset($this->bwlabfield->t_initvalueTA)) echo $this->bwlabfield->t_initvalueTA; ?>" />
        </li>
        <li>
            <label for="mandatory">
                <?php echo JText::_('HTML Editor'); ?>:
            </label>
            <input name="t_HTMLEditor" id="t_HTMLEditor" type="checkbox" value="1" <?php
                if (Isset($this->bwlabfield->t_HTMLEditor)) {
                    if ($this->bwlabfield->t_HTMLEditor == '1') {
                        ?> checked <?php
               }
           }
                ?>/>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Columns'); ?>:
            </label>
            <input name="t_columns" type="text" id="t_columns" value="<?php if (Isset($this->bwlabfield->t_columns)) echo $this->bwlabfield->t_columns; ?>" maxlength="5" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Rows'); ?>:
            </label>
            <input name="t_rows" type="text" id="t_rows" value="<?php if (Isset($this->bwlabfield->t_rows)) echo $this->bwlabfield->t_rows; ?>"  maxlength="5" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Wrap'); ?>:
            </label>
            <?php
            echo $this->listwrap;
            ?>
        </li>
</fieldset>