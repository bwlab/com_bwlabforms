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

<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'application.cancel' || document.formvalidator.isValid(document.id('application-form'))) {
            Joomla.submitform(task, document.getElementById('application-form'));
        }
    }
</script>
<?php //echo $this->loadTemplate('navigation');  ?>
<form action="<?php echo JRoute::_('index.php?option=com_bwlabforms'); ?>" id="application-form" method="post" name="adminForm" class="form-validate">
    <input type="hidden" id="t_listHS" name="t_listHS" value="<?php echo $this->bwlabfield->t_listHS; ?>" />
    <input type="hidden" id="t_listHRB" name="t_listHRB" value="<?php echo $this->bwlabfield->t_listHRB; ?>" />
    <div id="config-document">
        <div id="page-general" class="tab">
            <div class="show">
                <div class="width-50 fltrt">
                    <?php echo $this->loadTemplate('layout'); ?>
                    <?php echo $this->loadTemplate('advanced'); ?>
                </div>
                <div class="width-50 fltlt">
                    <?php echo $this->loadTemplate('main'); ?>
                    <?php if ($this->texttypefield): ?>
                    <?php echo $this->loadTemplate($this->fieldtype . '_' . $this->texttypefield ); ?>
                        <?php else: ?>
                        <?php echo $this->loadTemplate($this->fieldtype); ?>
                    <?php endif ?>
                </div>

            </div>

        </div>

        <input type="hidden" name="id" value="<?php echo $this->bwlabfield->id; ?>" />
        <input type="hidden" name="fid" value="<?php echo $this->fid; ?>" />
        <input type="hidden" name="ordering" value="<?php echo $this->bwlabfield->ordering; ?>" />
        <input type="hidden" name="controller" value="bwlabfields" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="typefield" value="<?php echo $this->fieldtype ?>" />
        <input type="hidden" name="texttypefield" value="<?php echo $this->texttypefield ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <div class="clr"></div>

</form>


