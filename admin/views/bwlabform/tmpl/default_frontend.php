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
                <?php echo JText::_('Display IP address'); ?>:
            </label>
            <fieldset class="radio">
            <?php
            echo JHTML::_('select.booleanlist', 'displayip', '', $this->bwlabforms->displayip);
            ?>
                </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Display Data detail'); ?>:
            </label>
            <fieldset class="radio">
            <?php
            echo JHTML::_('select.booleanlist', 'displaydetail', '', $this->bwlabforms->displaydetail);
            ?>
                </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Auto Publish data'); ?>:
            </label>
            <fieldset class="radio">
            <?php
            echo JHTML::_('select.booleanlist', 'autopublish', '', $this->bwlabforms->autopublish);
            ?>
                </fieldset>
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Title'); ?>:
            </label>
            <input type="text" name="fronttitle" id="fronttitle" size="50" maxlength="250" value="<?php echo $this->bwlabforms->fronttitle; ?>" />
        </li>
        <li>
            <label for="title">
                <?php echo JText::_('Description'); ?>:
            </label>
            <?php
            $editorDesc = JFactory::getEditor();
            echo $editorDesc->display('frontdescription', $this->bwlabforms->frontdescription, 600, 200, 10, 10);
            ?>
        </li>
    </ul>
</fieldset>