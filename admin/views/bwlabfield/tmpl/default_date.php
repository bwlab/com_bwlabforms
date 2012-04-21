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
                <?php echo JText::_('Initial value'); ?>:
            </label>
            <input class="longfield" type="text" name="t_initvalueT" id="t_initvalueT" value="<?php if (Isset($this->bwlabfield->t_initvalueT)) echo $this->bwlabfield->t_initvalueT; ?>" />
        </li>
        <li>
            <label for="dateformat">
                <?php echo JText::_('Date format'); ?>:
            </label>
            <?php
            echo $this->dateformat;
            ?>
        </li>
        <li>
            <label for="d_daydate">
                <?php echo JText::_('Day date'); ?>:
            </label>
            <input name="d_daydate" id="d_daydate" type="checkbox" value="1" <?php if ($this->bwlabfield->d_daydate == '1') { ?> checked <?php } ?> />
        </li>
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
    </ul>
    <input type="hidden" name="t_texttype" value="date"/>
</fieldset>