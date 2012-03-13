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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_SEPARATOR'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="t_noborderFS">
                <?php echo JText::_('Border not visible'); ?>:
            </label>
            <input name="t_noborderFS" id="t_noborderFS" type="checkbox" value="1" <?php if ($this->bwlabfield->t_noborderFS == '1') { ?> checked <?php } ?> />
        </li>
</fieldset>
