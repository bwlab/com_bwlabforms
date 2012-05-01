<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
    <div id="editcell">
        <table class="adminlist">
            <thead>
                <tr>
                    <th width="3%">
                        <?php echo JText::_('Num'); ?>
                    </th>
                    <th width="3%">
                        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->forms); ?>);" />
                    </th>			
                    <th width="40%">
                        <?php echo JText::_('Title'); ?>
                    </th>
                    <th width="20%">
                        <?php echo JText::_('Name'); ?>
                    </th>
                    <th width="5%" nowrap="nowrap">
                        <?php echo JHTML::_('grid.sort', JText::_('Published'), 'published', @$lists['order_Dir'], @$lists['order']); ?>
                    </th>
                    <th width="5%" nowrap="nowrap">
                        <?php echo JText::_('Fields'); ?>
                    </th>
                    <th width="15%" nowrap="nowrap">
                        <?php echo JText::_('Data'); ?>
                    </th>
                    <th width="15%" nowrap="nowrap">
                        <?php echo JText::_('Hits'); ?>
                    </th>
                    <th width="15%" nowrap="nowrap">
                        <?php echo JText::_('Generate'); ?>
                    </th>
                    <th width="3%">
                        <?php echo JText::_('ID'); ?>
                    </th>
                </tr>			
            </thead>
            <?php
            $n = count($this->items);
            foreach ($this->forms as $i => $form):
                $published = JHTML::_('grid.published', $form, $i);
                $checked = JHTML::_('grid.id', $i, $form->id);
                $link = JRoute::_('index.php?'.BWLabFormHelper::getFormEditUrl( $form->id));
                $fields = JRoute::_('index.php?'.BWLabFormHelper::getFieldListUrl($form->id));
                $generate = JRoute::_('index.php?'.BWLabFormHelper::getFormGenerateUrl($form->id));
                ?>
                <tr class="<?php echo "form$k"; ?>">
                    <td>
                        <?php echo $i + 1; ?>
                    </td>
                    <td>
                        <?php echo $checked; ?>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $form->title; ?></a>
                    </td>
                    <td>
                        <a href="<?php echo $link; ?>"><?php echo $form->name; ?></a>
                    </td>
                    <td align="center">
                        <?php echo $published; ?>
                    </td>
                    <td nowrap="nowrap">
                        <a href="<?php echo $fields; ?>"><?php echo JText::_('Display Fields') ?></a>
                    </td>
                    <td nowrap="nowrap">
                        <?php if ($form->result_save == true ) : ?>
                            <a href="<?php echo $displaydata; ?>"><?php echo JText::_('Display data'); ?></a>
                        <?php else: ?>
                            <?php echo JText::_('No save data in form'); ?>
                        <?php endif ?>
                    </td>	
                    <td>
                        <a href="<?php echo $generate; ?>"><?php echo JText::_('Genarate form'); ?></a>
                    </td>
                    <td>
                        <?php echo $form->hits; ?>
                    </td>
                    <td>
                        <?php echo $form->id; ?>
                    </td>
                </tr>
                <?php $k = 1 - $k ?>
            <?php endforeach; ?>


            <tfoot>
                <tr>
                    <td colspan="11"><?php //echo $this->pagination->getListFooter();    ?></td>
                </tr>
            </tfoot>

        </table>
    </div>

    <input type="hidden" name="option" value="com_bwlabforms" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
