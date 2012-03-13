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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_HIDDEN'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="t_filluid">
                <?php echo JText::_('Add unique id to value'); ?>:
            </label>
            <input name="t_filluid" id="t_filluid" type="checkbox" value="1" <?php if ($this->bwlabfield->t_filluid == '1') { ?> checked <?php } ?> />
        </li>
        <li>
            <label for="t_initvalueH">
                <?php echo JText::_('Value'); ?>:
            </label>
            <input class="field300" type="text" name="t_initvalueH" id="t_initvalueH" value="<?php if (Isset($this->bwlabfield->t_initvalueH)) echo $this->bwlabfield->t_initvalueH; ?>" />
        </li>
</fieldset>