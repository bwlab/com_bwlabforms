<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.editor');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.switcher');
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=' . JRequest::getVar('option')); ?>" id="application-form" method="post" name="adminForm" class="form-validate">
    <div id="config-document">
        <?php foreach ($this->jf_standard->getFieldSets('form_config') as $fieldset): ?>
            <div id="page-<?php echo $fieldset->name ?>" class="tab">
                <div class="<?php echo $fieldset->show ?>">
                    <div class="fltrl">                
                        <fieldset class="adminform">
                            <legend><?php echo JText::_($fieldset->label); ?></legend>
                            <?php
                            foreach ($this->jf_standard->getFieldSet($fieldset->name) as $field):

                                echo $field->label;
                                echo $field->input;

                            endforeach;
                            ?>
                        </fieldset>
                    </div>
                </div>
            </div>                
        <?php endforeach ?>

        <input type="hidden" name="option" value="com_bwlabforms" />
        <input type="hidden" name="id" value="<?php echo $this->bwlabforms->id; ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <div class="clr"></div>
</form>