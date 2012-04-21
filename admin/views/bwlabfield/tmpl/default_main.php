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
    <?php foreach ($this->jf_standard->getFieldset('standard_main') as $fieldsets => $fieldset): ?>
        <?php echo $fieldset->label ?>                        
        <?php echo $fieldset->input ?>
    <?php endforeach; ?>
</fieldset>