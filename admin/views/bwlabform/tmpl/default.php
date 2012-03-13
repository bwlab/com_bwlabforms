<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.editor');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.switcher');
JHtml::_('behavior.tooltip');
?>

<script type="text/javascript">

    window.addEvent('domready', function(){
        var myTabs = new mootabs('tabcontainer');
    });
    
    function submitbutton(pressbutton)	{
        var form = document.adminForm;

        if (pressbutton == 'cancel') {
            submitform( pressbutton );
            return;
        }

        // do field validation
        if (form.name.value == ""){
            alert( "<?php echo JText::_('Form must have a name', true); ?>" );
        } else if (form.name.value.match(/[a-zA-Z0-9]*/) != form.name.value) {
            alert( "<?php echo JText::_('Field name contains bad caracters', true); ?>" );
        } else {
            submitform( pressbutton );
        }
    }

</script>


<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div id="config-document">
        <div id="page-general" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('general'); ?>
                </div>
            </div>
        </div>
        <div id="page-result" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('result'); ?>
                </div>
            </div>
        </div>
        <div id="page-email" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('email'); ?>
                </div>
            </div>
        </div>
        <div id="page-advanced" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('advanced'); ?>
                </div>
            </div>
        </div>
        <div id="page-frontend" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('frontend'); ?>
                </div>
            </div>
        </div>
        <div id="page-help" class="tab">
            <div class="show">
                <div class="width-50 fltrl">
                    <?php echo $this->loadTemplate('help'); ?>
                </div>
            </div>
        </div>

        <input type="hidden" name="option" value="com_bwlabforms" />
        <input type="hidden" name="id" value="<?php echo $this->bwlabforms->id; ?>" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="controller" value="bwlabforms" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
    <div class="clr"></div>
</form>