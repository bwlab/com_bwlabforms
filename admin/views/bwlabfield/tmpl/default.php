<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_config
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');
// Load tooltips behavior
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.switcher');
JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=' . JRequest::getVar('option')); ?>" id="application-form" method="post" name="adminForm" class="form-validate">

    <div id="config-document">
        <div id="page-general" class="tab">
            <div class="show">
                <div class="width-50 fltrt">
                    <?php echo $this->loadTemplate('layout'); ?>
                    <?php echo $this->loadTemplate('advanced'); ?>
                </div>
                <div class="width-50 fltlt">
                    <?php echo $this->loadTemplate('main'); ?>
                    <fieldset class="adminform">
                        <legend><?php echo JText::_('BWLAB_FORMS_CONFIG_ATTRIBUTES'); ?></legend>
                        <?php
                        foreach ($this->jf_type->getFieldset('attributes-' . $this->type) as $fieldsets => $fieldset):

                            echo $fieldset->label;
                            echo $fieldset->input;

                        endforeach;
                        ?>
                    </fieldset>
                </div>

            </div>

        </div>

        <input type="hidden" name="id" value="<?php echo $this->bwlabfield->id; ?>" />
        <input type="hidden" name="fid" value="<?php echo $this->fid; ?>" />
        <input type="hidden" name="ordering" value="<?php echo $this->bwlabfield->ordering; ?>" />
        <input type="hidden" name="controller" value="bwlabfields" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="type" value="<?php echo $this->type ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <div class="clr"></div>

</form>


