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
    <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_BUTTON'); ?></legend>
    <ul class="adminformlist">
        <li>
            <label for="title">
                <?php echo JText::_('Type'); ?>:
            </label>
            <?php
            echo $this->listbuttontype;
            ?>
        </li>
</fieldset>
